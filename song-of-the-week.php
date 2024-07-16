<?php
$PageTitle = "Song of the Week";
$Description = "A weekly sampling of one of Pat McCurdy's songs usually not available on any of his CDs.";
include "header.php";
?>

<div style="text-align: center;">
  <?php
  $baseurl = "https://patmccurdy.com";

  // Build RSS file
  $RSSfile = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
  <rss xmlns:itunes=\"http://www.itunes.com/dtds/podcast-1.0.dtd\" version=\"2.0\">
    <channel>
      <title>Pat McCurdy's Song of the Week</title>
      <link>$baseurl</link>
      <language>en-us</language>
      <itunes:author>Pat McCurdy</itunes:author>
      <description>A weekly sampling of one of Pat McCurdy's songs usually not available on any of his CDs.  Most are recorded live at his shows, with an occasional blast from the past from one of Pat's old bands.  Visit $baseurl for more information.</description>
      <itunes:category text=\"Music\" />
      <image>
        <url>//patmccurdy.com/images/sotw_iTunes.jpg</url>
        <title>Pat McCurdy</title>
        <link>$baseurl</link>
      </image>
      <itunes:image href=\"$baseurl/images/sotw_iTunes.jpg\" />
      <itunes:owner>
        <itunes:name>Pat McCurdy</itunes:name>
        <itunes:email>webmaster@patmccurdy.com</itunes:email>
      </itunes:owner>\n";
  
  $now = time();
  $sotw = $mysqli->execute_query("SELECT * FROM sotw WHERE startdate <= ? AND (enddate >= ? OR enddate = '') ORDER BY startdate DESC", [$now, $now]);

  foreach($sotw as $row) {
    echo '<a href="audio/'.$row['file'].'" style="font-weight: 700; font-size: 125%;">'.$row['title'].'</a> <span style="font-size: 80%;">('.round(filesize("audio/".$row['file'])/1048576, 1)." MB)</span><br>\n";

    echo '<audio preload="auto" class="sotw"><source src="audio/'.$row['file'].'" type="audio/mp3" /></audio>';

    // Prepare RSS description
    $desc = "";

    // Display band info if applicable
    if ($row['band'] != "") {
      echo $row['band']."<br>\n";
      $desc .= "Performed by ".$row['band'].". ";
      $author = $row['band'];
    } else {
      $author = "Pat McCurdy";
    }

    // Display "Recorded at..." info if it exists
    if ($row['recat'] != "") {
      echo "Recorded at " .$row['recat']."<br><br>\n";
      $desc .= "Recorded at ".$row['recat'].".";
    }

    // Create RSS item
    $RSSfile .= "<item>
    <title>".$row['title']."</title>
    <link>$baseurl/audio/".$row['file']."</link>
    <itunes:author>$author</itunes:author>
    <description>$desc</description>
    <enclosure url=\"$baseurl/audio/".$row['file']."\" length=\"".filesize("audio/".$row['file'])."\" type=\"audio/mpeg\" />
    <guid>$baseurl/audio/".$row['file']."</guid>
    <pubDate>".date("r", $row['startdate'])."</pubDate>
    </item>\n";
  }

  # Finish the RSS file
  $RSSfile .= "  </channel>
  </rss>";
  
  // Write the RSS file
  $rss = fopen("sotw.xml", "w");
  fwrite($rss, $RSSfile);
  fclose($rss);
  ?>

  <br>
  Get the Song of the Week delivered to you automatically!<br>
  Subscribe by <a href="sotw.xml">adding this link</a> to the podcast-getter-thingy of your choice.
</div>

<br><br>

<h2>Recent Past Songs of the Week</h2>
<?php
include_once "fullshows/inc/Mp3Info/Mp3Info.php";
use wapmorgan\Mp3Info\Mp3Info;

$mp3s = [];
$mp3dir = opendir("audio");
while (false != ($mp3 = readdir($mp3dir))) {
  if (pathinfo($mp3, PATHINFO_EXTENSION) == "mp3") $mp3s[] = $mp3;
}
closedir($mp3dir);

$songs = $mysqli->execute_query("SELECT * FROM sotw WHERE enddate <= ? AND enddate != '' ORDER BY startdate+0 DESC", [$now]);

$html_list = "";
$js_list = "";
$count = 1;

foreach($songs as $song) {
  if (in_array($song['file'],$mp3s)) {
    $band = ($song['band'] != "") ? $song['band'] : "Pat McCurdy";

    $file = new Mp3Info("audio/".$song['file'], true);
    $length = floor($file->duration / 60) .":". floor($file->duration) % 60;

    $html_list .= "<li>".$band.' - '.$song['title']."</li>\n";
    $js_list .= '{"name": "'.$band.' - '.$song['title'].'", "length": "'.$length.'", "file": "'.$song['file'].'"},';

    if ($count == 10) { break; }
    $count++;
  }
}
?>

<div class="wtf">
  <audio preload="auto" id="audio">Your browser does not support HTML5 Audio!</audio>
  <ul id="playlist">
    <?php echo $html_list; ?>
  </ul>
</div>

<script src="https://cdn.plyr.io/3.7.8/plyr.js"></script>
<link rel="stylesheet" href="https://cdn.plyr.io/3.7.8/plyr.css" />

<script type="text/javascript">
  const players = Plyr.setup('.sotw', {
    controls: ['play','current-time','progress','duration','mute','volume']
  });

  const player = Plyr.setup('#audio', {
    controls: ['rewind','play','fast-forward','current-time','progress','duration','mute','volume'],
    seekTime: 1800 // Large number to make it jump to next track
  });

  var index = 0;
  
  var audio = document.getElementById('audio');
  var plSongs = document.querySelectorAll('#playlist LI');

  var tracks = [<?php echo $js_list; ?>];
  var trackCount = tracks.length;
  
  // Playlist: play next track automatically and stop after last song
  audio.addEventListener('ended', function() {
    if ((index + 1) < trackCount) {
      index++;
      loadTrack(index);
      audio.play();
    } else {
      audio.pause();
      index = 0;
      loadTrack(index);
    }
  });
  
  // Playlist: when using rewind button, stop at the first track
  document.querySelector('button[data-plyr="rewind"]').addEventListener('click', function() {
    if ((index - 1) > -1) {
      index--;
      loadTrack(index);
      if (document.querySelector('.wtf .plyr').classList.contains('plyr--playing')) audio.play();
    } else {
      audio.pause();
      index = 0;
      loadTrack(index);
    }
  });
  
  // Playlist: play track when clicked on
  Array.prototype.forEach.call(plSongs, function(plSong, id) {
    plSong.addEventListener('click', function() {
      if (id !== index) playTrack(id);
    })
  });

  loadTrack = function(id) {
    players.forEach(s => { s.pause() }); // Stop other players
    plSongs.forEach(pls => { pls.classList.remove('active'); });
    plSongs[id].classList.add('active');
    index = id;
    audio.src = 'audio/' + tracks[id].file;
  };
  
  // When clicking the play button on current SOTW, stop any other players
  players.forEach(function(p) {
    p.on('play', event => {
      const instance = event.detail.plyr;
      players.forEach(function(p) { if (p != instance) p.pause() });
      audio.pause();
    })
  });
  
  // When clicking the play button on playlist, stop any other players
  document.querySelector('.wtf button[data-plyr="play"]').addEventListener('click', function() {
    players.forEach(s => { s.pause() });
  });

  playTrack = function(id) {
    loadTrack(id);
    audio.play();
  };

  loadTrack(index);
</script>

<?php include "footer.php"; ?>