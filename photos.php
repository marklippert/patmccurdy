<?php
$PageTitle = "Photos";
include "header.php";
?>

<!-- Start of Flickr Badge -->
<style type="text/css">
  .zg_div {margin:0px 5px 5px 0px; width:117px;}
  .zg_div_inner { color:#666666; text-align:center; font-family:arial, helvetica; font-size:11px;}
  .zg_div a, .zg_div a:hover, .zg_div a:visited {color:#3993ff; background:inherit !important; text-decoration:none !important;}
</style>
<script type="text/javascript">
  zg_insert_badge = function() {
  var zg_bg_color = 'ffffff';
  var zgi_url = 'http://www.flickr.com/apps/badge/badge_iframe.gne?zg_bg_color='+zg_bg_color+'&zg_tags=patmccurdy&zg_tag_mode=any';
  document.write('<iframe style="background-color:#'+zg_bg_color+'; border-color:#'+zg_bg_color+'; border:none;" width="113" height="151" frameborder="0" scrolling="no" src="'+zgi_url+'" title="Flickr Badge"><\/iframe>');
  if (document.getElementById) document.write('<div id="zg_whatlink"><a href="http://www.flickr.com/badge.gne"	style="color:#3993ff;" onclick="zg_toggleWhat(); return false;">What is this?<\/a><\/div>');
  }
  zg_toggleWhat = function() {
  document.getElementById('zg_whatdiv').style.display = (document.getElementById('zg_whatdiv').style.display != 'none') ? 'none' : 'block';
  document.getElementById('zg_whatlink').style.display = (document.getElementById('zg_whatdiv').style.display != 'none') ? 'none' : 'block';
  return false;
  }
</script>
<div class="zg_div" style="float: left; margin-right: 20px;">
  <div class="zg_div_inner">
    <a href="http://www.flickr.com">www.<strong style="color:#3993ff">flick<span style="color:#ff1c92">r</span></strong>.com</a><br>
    <script type="text/javascript">zg_insert_badge();</script>
    <div id="zg_whatdiv">This is a Flickr badge showing public items from Flickr tagged with <a href="http://www.flickr.com/photos/tags/patmccurdy">patmccurdy</a>. Make your own badge <a href="http://www.flickr.com/badge.gne">here</a>.</div>
    <script type="text/javascript">if (document.getElementById) document.getElementById('zg_whatdiv').style.display = 'none';</script>
  </div>
</div>
<!-- End of Flickr Badge -->

Do you have a <a href="http://www.flickr.com">Flickr</a> account?  If you do and have any Pat pictures, tag them with "patmccurdy" and they'll be added to the <a href="http://www.flickr.com/photos/tags/patmccurdy/">Pat stream</a>.  Much more timlier than sending them to our lazy-ass webmaster who never gets around to putting them up on this site.

<div style="clear: both;"></div>

<?php include "footer.php"; ?>