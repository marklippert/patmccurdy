<?php
$PageTitle = "Song of the Week";
include "header.php";
?>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/plyr/3.6.2/plyr.min.js"></script>
<link rel="stylesheet" href="https://cdn.plyr.io/3.6.3/plyr.css" />
<script type="text/javascript">
  jQuery(function($) {
    var player = new Plyr('#sotw', {
      controls: ['play','current-time','progress','duration','mute','volume']
    });
  });
</script>

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

  $sotw = $mysqli->query("SELECT * FROM sotw WHERE startdate <= " . time() . " AND (enddate >= " . time() . " OR enddate = '') ORDER BY startdate DESC");

  while($row = $sotw->fetch_array(MYSQLI_BOTH)) {
    echo '<a href="audio/'.$row['file'].'" style="font-weight: 700; font-size: 125%;">'.$row['title'].'</a> <span style="font-size: 80%;">('.round(filesize("audio/".$row['file'])/1048576, 1)." MB)</span><br>\n";

    echo '<audio preload="auto" id="sotw"><source src="audio/'.$row['file'].'" type="audio/mp3" /></audio>';

    // Prepare RSS description
    $desc = "";

    // Display band info if applicable
    if ($row['band'] != "") {
      echo $row['band'] . "<br>\n";
      $desc .= "Performed by " . $row['band'] . ".  ";
      $author = $row['band'];
    } else {
      $author = "Pat McCurdy";
    }

    // Display "Recorded at..." info if it exists
    if ($row['recat'] != "") {
      echo "Recorded at " . $row['recat'] . "<br>\n";
      $desc .= "Recorded at " . $row['recat'] . ".";
    }

    // Create RSS item
    $RSSfile .= "<item>
    <title>" . $row['title'] . "</title>
    <link>$baseurl/audio/" . $row['file'] . "</link>
    <itunes:author>$author</itunes:author>
    <description>$desc</description>
    <enclosure url=\"$baseurl/audio/" . $row['file'] . "\" length=\"" . filesize("audio/" . $row['file']) . "\" type=\"audio/mpeg\" />
    <guid>$baseurl/audio/" . $row['file'] . "</guid>
    <pubDate>" . date("r", $row['startdate']) . "</pubDate>
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
  <br>
  Get the Song of the Week delivered to you automatically!<br>
  Subscribe by <a href="sotw.xml">adding this link</a> to iTunes or the podcast-getter-thingy of your choice.
</div>

<br><br>

<h2>Recent Past Songs of the Week</h2>
<?php
require_once('fullshows/inc/getid3/getid3.php');
$getID3 = new getID3;

$songs = $mysqli->query("SELECT * FROM sotw WHERE enddate <= " . time() . " AND enddate != '' ORDER BY startdate+0 DESC");

$html_list = "";
$js_list = "";
$count = 1;

while($song = $songs->fetch_array(MYSQLI_ASSOC)) {
  if (file_exists("audio/".$song['file'])) {
    $band = ($song['band'] != "") ? $song['band'] : "Pat McCurdy";

    $file_info = $getID3->analyze("audio/".$song['file']);
    $length = @$file_info['playtime_string'];

    $html_list .= "<li>".$band.' - '.$song['title']."</li>\n";
    $js_list .= '{"name": "'.$band.' - '.$song['title'].'", "length": "'.$length.'", "file": "'.$song['file'].'"},'."\n";

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

<script type="text/javascript">
  jQuery(function($) {
    var supportsAudio = !! document.createElement('audio').canPlayType;

    if (supportsAudio) {
      var index = 0, playing = false;

      var player = new Plyr('#audio', {
        controls: ['rewind','play','fast-forward','current-time','progress','duration','mute','volume'],
        seekTime: 1800 // Large number to make it jump to next track
      });

      tracks = [<?php echo $js_list; ?>],
      trackCount = tracks.length,

      audio = $('#audio').bind('play', function () {
        playing = true;
      }).bind('pause', function () {
        playing = false;
      }).bind('ended', function () {
        if ((index + 1) < trackCount) {
          index++;
          loadTrack(index);
          audio.play();
        } else {
          audio.pause();
          index = 0;
          loadTrack(index);
        }
      }).get(0),

      $('button[data-plyr="rewind"').click(function() {
        if ((index - 1) > -1) {
          index--;
          loadTrack(index);
          if (playing) audio.play();
        } else {
          audio.pause();
          index = 0;
          loadTrack(index);
        }
      }),

      $('#playlist LI').click(function () {
        var id = parseInt($(this).index());
        if (id !== index) playTrack(id);
      }),

      loadTrack = function(id) {
        $('.active').removeClass('active');
        $('#playlist LI:eq(' + id + ')').addClass('active');
        index = id;
        audio.src = 'audio/' + tracks[id].file;
      },

      playTrack = function(id) {
        loadTrack(id);
        audio.play();
      };

      loadTrack(index);
    }
});
</script>

<?php include "footer.php"; ?>