<?php
include "inc/dbconfig.php";
$PageTitle = "Song of the Week";
$HeaderExtra = "<link rel=\"alternate\" type=\"application/rss+xml\" href=\"sotw.xml\" title=\"Pat McCurdy's Song of the Week\">";
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
  
  $result = $mysqli->query("SELECT * FROM sotw WHERE startdate <= " . time() . " AND (enddate >= " . time() . " OR enddate = '') ORDER BY startdate DESC");
  
  while($row = $result->fetch_array(MYSQLI_BOTH)) {
    echo "<strong style=\"font-size: large;\"><a href=\"audio/" . $row['file'] . "\">" . $row['title'] . "</a></strong> <span style=\"font-size: small;\">(" . round(filesize("audio/" . $row['file'])/1048576, 1) . " MB)</span><br>\n";
    
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

  $result->free();
  ?>
  
  <br>
  <br>
  Get the Song of the Week delivered to you automatically!<br>
  Subscribe by <a href="sotw.xml">adding this link</a> to iTunes or the podcast-getter-thingy of your choice.
</div>

<br>
<br>

<link type="text/css" href="inc/jplayer/jplayer.pat2010.css" rel="stylesheet" />
<script type="text/javascript" src="inc/jplayer/jquery.jplayer.min.js"></script>
<script type="text/javascript" src="inc/jplayer/jplayer.playlist.min.js"></script>
<script type="text/javascript">
  $(window).load(function(){
    new jPlayerPlaylist({ jPlayer: "#jquery_jplayer_1", cssSelectorAncestor: "#jp_container_1" }, [
      <?php
      $dir = opendir("audio");
      while (false != ($file = readdir($dir))) {
        $file_array = explode(".", $file);
        if (($file != ".") and ($file != "..") and (array_pop($file_array) == "mp3")) {
          $files[] = $file;
        }
      }
      closedir($dir);
      natcasesort($files);
      
      $result = $mysqli->query("SELECT * FROM sotw WHERE enddate <= " . time() . " AND enddate != '' ORDER BY startdate+0 DESC");
      
      $count = 1;
      
      while($row = $result->fetch_array(MYSQLI_BOTH)) {
        if (in_array($row[file], $files)) {
          $name = ($row[band] != "") ? $row[band] : "Pat McCurdy";
          echo "{ title: \"$name - " . $row[title] . "\", mp3: \"audio/" . $row[file] . "\" },\n";
          
          if ($count == "10") { break; }
          $count++;
        }
      }

      $result->free();
      ?>
    ], {
      swfPath: "inc/jplayer",
      supplied: "mp3",
      wmode: "window",
      smoothPlayBar: true,
      keyEnabled: true
    });
  });
</script>

<span style="font-size: 120%; font-weight: bold;">Recent Past Songs of the Week</span><br>

<div id="jquery_jplayer_1" class="jp-jplayer"></div>
<div id="jp_container_1" class="jp-audio">
  <div class="jp-type-playlist">
    <div class="jp-gui jp-interface">
      <ul class="jp-controls">
        <li><a href="javascript:;" class="jp-previous" tabindex="1">previous</a></li>
        <li><a href="javascript:;" class="jp-play" tabindex="1">play</a></li>
        <li><a href="javascript:;" class="jp-pause" tabindex="1">pause</a></li>
        <li><a href="javascript:;" class="jp-next" tabindex="1">next</a></li>
        <li><a href="javascript:;" class="jp-stop" tabindex="1">stop</a></li>
        <li><a href="javascript:;" class="jp-mute" tabindex="1" title="mute">mute</a></li>
        <li><a href="javascript:;" class="jp-unmute" tabindex="1" title="unmute">unmute</a></li>
        <li><a href="javascript:;" class="jp-volume-max" tabindex="1" title="max volume">max volume</a></li>
      </ul>
      
      <div class="jp-progress-wrap">
        <div class="jp-current-time"></div>
        <div class="jp-progress">
          <div class="jp-seek-bar">
            <div class="jp-play-bar"></div>
          </div>
        </div>
        <div class="jp-duration"></div>
      </div>
      
      <div class="jp-volume-bar-wrap">
        <div class="jp-volume-bar">
          <div class="jp-volume-bar-value"></div>
        </div>
      </div>
    </div>
    <div class="jp-playlist">
      <ul>
        <li></li>
      </ul>
    </div>
    <div class="jp-no-solution">
      <span>Update Required</span>
      To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
    </div>
  </div>
</div>

<?php
$mysqli->close();

include "footer.php";
?>