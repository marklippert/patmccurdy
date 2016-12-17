<?php
if (isset($_POST['submit'])) {
  // Items in catalog (id|name|price)
  $items = array(
  "newsletter|Newsletter Subscription|10",
  "intnewsletter|Newsletter Subscription (International)|25",
  "sex|\"Sex\" Sticker|2",
  "beer|\"Beer\" Sticker|2",
  "both|Set of Sex & Beer Stickers|3",
  "pick|Sex & Beer Guitar Pick|1",
  "shirtChooseSexBeerM|Choose Sex & Beer shirt [M]|15",
  "shirtChooseSexBeerXL|Choose Sex & Beer shirt [XL]|15",
  "shirtChooseSexBeer2XL|Choose Sex & Beer shirt [2XL]|15",
  "shirtHeartSexBeerM|I Heart Sex & Beer shirt [M]|15",
  "shirtHeartSexBeerXL|I Heart Sex & Beer shirt [XL]|15",
  "shirtHeartSexBeer2XL|I Heart Sex & Beer shirt [2XL]|15",
  "shirtHeartSexBeer3XL|I Heart Sex & Beer shirt [3XL]|15",
  "shirtHeyPaddyM|Hey Paddy! Play A Song For Me shirt [M]|15",
  "shirtHeyPaddyXL|Hey Paddy! Play A Song For Me shirt [XL]|15",
  "shirtHeyPaddy2XL|Hey Paddy! Play A Song For Me shirt [2XL]|15",
  "shirtSexBeerPatM|I Had Sex & Beer With Pat shirt [M]|15",
  "shirtSexBeerPatXL|I Had Sex & Beer With Pat shirt [XL]|15",
  "shirtSexBeerPat2XL|I Had Sex & Beer With Pat shirt [2XL]|15",
  "cdset|Ten CD Set|125",
  "souvenirs|Souvenirs|15",
  "pmnow|Pat McCurdy Now!|15",
  "liabt|Love is a Beautiful Thing|15",
  "15fav|15 Favorites|15",
  "mwol|My World of Love|15",
  "fwh|Fainting With Happiness|15",
  "pipv2|Pat In Person Vol. 2|15",
  "bbbw|The Big Bright Beautiful World of Pat McCurdy|15",
  "sho|Show Tunes|15",
  "pip|Pat In Person|15",
  "som|The Sound of Music|15",
  "glmd|Good Life/Memorial Day|15",
  "yipes|Yipes!/A Bit Irrational|15",
  "vinylyipes|Vinyl Yipes! (first album)|15",
  "vinylabi|Vinyl A Bit Irrational|15",
  "giftcert|Gift Certificate|15"
  );

  // Create array of ordered items
  $ordered = array();

  foreach ($items as $item) {
    list($id, $name, $price) = explode("|", $item);
    if ($_POST[$id] != "") {
      $totalcost = $_POST[$id] * $price;
      $ordered[] = "$id|$name|$totalcost|$_POST[$id]";
    }
  }
?>
  <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
  <html lang="en">
  <head>
    <META http-equiv="Content-Type" content="text/html;charset=utf-8">
    <META http-equiv="pragma" content="no-cache">
    <META http-equiv="imagetoolbar" content="no">
    <META name="language" content="en">
    <META name="author" content="Mark Lippert">
    <META name="description" content="">
    <META name="keywords" content="">
    <title>Invoice</title>
    <link rel="shortcut icon" href="images/favicon.ico">
    <style type="text/css" media="screen,print">
      BODY { background: #FFFFFF; font-family: Arial, Helvetica, sans-serif; font-size: 17px; }
      TD { font-family: Arial, Helvetica, sans-serif; font-size: 15px; font-weight: bold; }
    </style>
  </head>
  <body>

  <span style="font-size: 20px; font-weight: bold;">Pat McCurdy Merchandise Order</span><br>
  <br>

  <strong>Ship to:</strong><br>
  <?php echo $_POST['firstname'] . " " . $_POST['lastname']; ?><br>
  <?php echo $_POST['address']; ?><br>
  <?php if ($_POST['address2'] != "") echo $_POST['address2'] . "<br>\n"; ?>
  <?php echo $_POST['city'] . ", " . $_POST['state'] . " " . $_POST['zip']; ?><br>
  <?php if ($_POST['email'] != "") echo $_POST['email'] . "<br>\n"; ?>
  <br>

  <table cellspacing="0" cellspacing="0" border="0">
    <?php
    foreach ($ordered as $order) {
      list($id, $name, $subtotal, $amount) = explode("|", $order);

      echo "
      <tr>
        <td style=\"text-align: right; padding-right: 10px;\">$amount</td>
        <td style=\"width: 350px; white-space: nowrap; padding-right: 10px;\">$name</td>
        <td>$</td>
        <td style=\"text-align: right; padding-right: 4px;\">$subtotal.00</td>
      </tr>
      ";

      # Add to the grand total
      $total += $subtotal;

      # Set postage for stickers
      $postage = (($id == "sex") || ($id == "beer") || ($id == "both")) ? "yes" : "no";
    }

    if ($postage == "yes") {
      # Print postage line
      echo "
      <tr>
        <td colspan=\"2\" style=\"text-align: right; padding-right: 10px;\"><em>Postage</em></td>
        <td>$</td>
        <td style=\"text-align: right; padding-right: 4px;\">0.50</td>
      </tr>
      ";

      # Set cents for grand total
      $cents = "50";
    } else {
      $cents = "00";
    }
    ?>
    <tr style="background: #CCCCCC;">
      <td colspan="2" style="text-align: right; padding-right: 10px;">Total</td>
      <td>$</td>
      <td style="text-align: right; padding-right: 4px;"><?php echo "$total.$cents"; ?></td>
    </tr>
  </table><br>
  <br>

  <strong>Make check or money order payable to <u>Pat McCurdy Show LLC</u> and send to:</strong><br>
  Pat McCurdy Merch<br>
  c/o Brian Murphy<br>
  1433 N. 51st St.<br>
  Milwaukee, WI 53208<br>
  <br>

  <span style="font-size: 10px;">Generated <?php echo date("r", time()); ?></span>
  </body></html>
<?php
} else {
$PageTitle = "Shop";
include "header.php";
?>

<script type="text/javascript">
  function checkform (form) {
    if (form.firstname.value == "") { alert('First Name required.'); form.firstname.focus(); return false ; }
    if (form.lastname.value == "") { alert('Last Name required.'); form.lastname.focus(); return false ; }
    if (form.address.value == "") { alert('Address required.'); form.address.focus(); return false ; }
    if (form.city.value == "") { alert('City required.'); form.city.focus(); return false ; }
    if (form.state.value == "") { alert('State required.'); form.state.focus(); return false ; }
    if (form.zip.value == "") { alert('Zip Code required.'); form.zip.focus(); return false ; }
    return true ;
  }
  $(document).ready(function() { $("form").attr('target','_blank'); });
</script>

Welcome to Pat's online store, where you can get all the CDs, stickers and more! If you wish to purchase an item, simply fill in the quantity. Then, at the bottom, fill in your name and address and click the "Create Order Form" button. Your order will be totaled onto a personalized order form for you to <strong>print out and send in</strong> with your payment to:<br>
<div class="centered-block">
  Pat McCurdy Merch<br>
  c/o Brian Murphy<br>
  1433 N. 51st St.<br>
  Milwaukee, WI 53208<br>
</div><br>

All prices include shipping (unless otherwise indicated). Orders will be sent out as soon as humanly possible. Prices and items available subject to change without notice. Some items may be temporarily out of stock; please be patient.<br>
<br>
And now...shop away!<br>
<br>

<form action="shop.php" method="POST" onsubmit="return checkform(this)">
  <div>
    <strong>Gift Certificate</strong><br>
    <div class="half-left">
      <img src="images/gift-certificate.jpg" alt="Gift Certificate" style="width: 100%; height: auto;">
    </div>
    <div class="half-right">
      Got a PatHead in your life and you don't know what CDs or t-shirts they already have?  Here's the perfect solution!  Each certificate is good for $15.00 worth of any Pat merchandise.  Valid for on-line purchases only.  Not redeemable for cash.  Void one year after purchase.<br>
      <strong>Quantity:</strong> <input type="text" size="3" style="width: 2em;" name="giftcert">
    </div>
    <div style="clear: both;"></div>

    <br>
    <!--
    <strong>Lifetime subscription to the Pat! Newsletter</strong><br>
    For a mere <strong>$10.00</strong>, you can have Pat's monthly newsletter sent right to your door!  It includes the monthly schedule, as well as contests and words of wit and wisdom.  Be sure to give us your new address if you move.  It's a <strong>lifetime</strong> subscription, which means you'll keep getting it until either you or Pat dies.<br>
    <br>
    Now overseas PatHeads can keep in touch with our new <strong>International subscriptions</strong> for an inexpensive <b>$25.00</b>!  It's the same newsletter and the same lifetime deal, but just costs a little more due to them pesky air mail rates.<br>

    <div class="centered-block">
      <input type="checkbox" name="newsletter" value="1"> <strong>Domestic rate ($10.00)</strong><br>
      <input type="checkbox" name="intnewsletter" value="1"> <strong>International rate ($25.00)</strong>
    </div>

    <br>
    -->
    <strong>Sex &amp; Beer Bumper Stickers</strong><br>
    Prevent road rage by letting the other drivers know what you like!<br>
    <div class="half-left centered">
      <img src="images/sticker-sex.gif" style="width: 100%; height: auto;" alt=""><br>
      <strong>"Sex" $2.00</strong> <input type="text" size="3" style="width: 2em;" name="sex">
    </div>

    <div class="half-right centered">
      <img src="images/sticker-beer.gif" style="width: 100%; height: auto;" alt=""><br>
      <strong>"Beer" $2.00</strong> <input type="text" size="3" style="width: 2em;" name="beer">
    </div>

    <div style="clear: both;"></div>

    <div class="centered">
      <strong>Both $3.00</strong> <input type="text" size="3" style="width: 2em;" name="both">
    </div>
    An additional 50 cent postage charge is added if you are ordering <strong>only</strong> stickers.  Postage is waived if you also order CDs.<br>

    <br>

    <strong>Shirts</strong><br>
    All shirts are $15.<br>
    <br>

    <div class="half-left centered">
      <img src="images/shirt-i-heart-sex-and-beer-red.png" alt="I Heart Sex & Beer" style="width: 100%; height: auto;">
      <div class="centered-block" style="text-align: left;">
        <strong>Quantity:</strong> <input type="text" size="3" style="width: 2em;" name="shirtHeartSexBeerM"> M<br>
        <strong>Quantity:</strong> <input type="text" size="3" style="width: 2em;" name="shirtHeartSexBeerXL"> XL<br>
        <strong>Quantity:</strong> <input type="text" size="3" style="width: 2em;" name="shirtHeartSexBeer2XL"> 2XL<br>
        <br>
      </div>
    </div>

    <div class="half-right centered">
      <img src="images/shirt-i-had-sex-and-beer.png" alt="I Had Sex & Beer With Pat" style="width: 100%; height: auto;">
      <div class="centered-block" style="text-align: left;">
        <strong>Quantity:</strong> <input type="text" size="3" style="width: 2em;" name="shirtSexBeerPatM"> M<br>
        <strong>Quantity:</strong> <input type="text" size="3" style="width: 2em;" name="shirtSexBeerPatXL"> XL<br>
        <strong>Quantity:</strong> <input type="text" size="3" style="width: 2em;" name="shirtSexBeerPat2XL"> 2XL<br>
        <br>
      </div>
    </div>

    <div style="clear: both;"></div>

    <div class="half-left centered">
      <img src="images/shirt-hey-paddy.png" alt="Hey Paddy! Play A Song For Me" style="width: 100%; height: auto;">
      <div class="centered-block" style="text-align: left;">
        <strong>Quantity:</strong> <input type="text" size="3" style="width: 2em;" name="shirtHeyPaddyM"> M<br>
        <strong>Quantity:</strong> <input type="text" size="3" style="width: 2em;" name="shirtHeyPaddyXL"> XL<br>
        <strong>Quantity:</strong> <input type="text" size="3" style="width: 2em;" name="shirtHeyPaddy2XL"> 2XL<br>
        <br>
      </div>
    </div>

    <div style="clear: both;"></div>
    <br>

    <strong>CDs</strong><br>
    All individual CDs are $15<br>
    <br>
    <strong>Ten CD Set</strong><br>
    All ten of Pat's CDs for $125. For the CDs that are out of print we'll burn high-quality copies.<br>
    <strong>Quantity: </strong><input type="text" size="3" style="width: 2em;" name="cdset"><br>

    <br><br>

    <div class="half-left">
      <a href="album.php?16"><img src="images/cds/souvenirs.jpg" alt="Souvenirs" style="width: 100%; height: auto;"><br>
      Souvenirs</a><br>
      Quantity: <input type="text" size="3" style="width: 2em;" name="souvenirs"><br>
      <br>
    </div>

    <div class="half-right">
      <strong>Pre-order "Souvenirs" now!</strong><br>
      Buy now and have it sent to you as soon as it's available.<br>
      <br>

      Pat's first greatest hits compilation features previously unreleased live and studio versions of Imagine A Picture, Screw You, Monkey Paw and other favorites. And for the first time ever: Hey Paddy!
    </div>
    
    <div style="clear: both;"></div>

    <div class="half-left">
      <a href="album.php?15"><img src="images/cds/pat-mccurdy-now.jpg" alt="Pat McCurdy Now!" style="width: 100%; height: auto;"><br>
      Pat McCurdy Now!</a><br>
      Quantity: <input type="text" size="3" style="width: 2em;" name="pmnow"><br>
      <br>
    </div>

    <div class="half-right">
      <a href="album.php?14"><img src="images/cds/love-is-a-beautiful-thing.jpg" alt="Love is a Beautiful Thing" style="width: 100%; height: auto;"><br>
      Love is a Beautiful Thing</a><br>
      Quantity: <input type="text" size="3" style="width: 2em;" name="liabt"><br>
      <a href="http://www.cdbaby.com/cd/patmccurdy9" style="font-size: 90%;">Download on CD Baby</a><br>
      <br>
    </div>
    
    <div style="clear: both;"></div>

    <div class="half-left">
      <a href="album.php?13"><img src="images/cds/15-favorites.jpg" alt="15 Favorites" style="width: 100%; height: auto;"></a><br>
      <div class="half-left">
        <a href="album.php?13">15 Favorites</a><br>
        Quantity: <input type="text" size="3" style="width: 2em;" name="15fav">
      </div>
      <div class="half-right" style="font-size: 90%;">
        <a href="http://itunes.apple.com/us/album/15-favorites/id403423126">Download on iTunes</a><br>
        <a href="http://www.amazon.com/15-Favorites-Explicit/dp/B004BWYQM6">Download on Amazon</a>
      </div>
      <div style="clear: both;"></div><br>
    </div>

    <div class="half-right">
      <a href="album.php?12"><img src="images/cds/my-world-of-love.jpg" alt="My World of Love" style="width: 100%; height: auto;"><br>
      My World of Love</a><br>
      Quantity: <input type="text" size="3" style="width: 2em;" name="mwol"><br>
      <a href="http://itunes.apple.com/us/album/my-world-of-love/id402817113" style="font-size: 90%;">Download on iTunes</a><br>
      <br>
    </div>

    <div style="clear: both;"></div>

    <div class="half-left">
      <a href="album.php?10"><img src="images/cds/pat-in-person-volume-2.jpg" alt="Pat in Person Volume 2" style="width: 100%; height: auto;"><br>
      Pat in Person Volume 2</a><br>
      Quantity: <input type="text" size="3" style="width: 2em;" name="pipv2"><br>
      <a href="http://itunes.apple.com/us/album/pat-in-person-vol-2/id402820238" style="font-size: 90%;">Download on iTunes</a><br>
      <br>
    </div>

    <div class="half-right">
      <a href="album.php?9"><img src="images/cds/the-big-bright-beautiful-world-of-pat-mccurdy.jpg" alt="The Big Bright Beautiful World of Pat McCurdy" style="width: 100%; height: auto;"><br>
      The Big Bright Beautiful World of...</a><br>
      Quantity: <input type="text" size="3" style="width: 2em;" name="bbbw"><br>
      <a href="http://itunes.apple.com/us/album/the-big-bright-beautiful-world/id402750541" style="font-size: 90%;">Download on iTunes</a><br>
      <br>
    </div>

    <div style="clear: both;"></div>

    <div class="half-left">
      <a href="album.php?8"><img src="images/cds/show-tunes.jpg" alt="Show Tunes" style="width: 100%; height: auto;"><br>
      Show Tunes</a><br>
      Quantity: <input type="text" size="3" style="width: 2em;" name="sho"><br>
      <br>
    </div>

    <div class="half-right">
      <a href="album.php?7"><img src="images/cds/pat-in-person.jpg" alt="Pat in Person" style="width: 100%; height: auto;"></a><br>
      <div class="half-left">
        <a href="album.php?7">Pat in Person</a><br>
        Quantity: <input type="text" size="3" style="width: 2em;" name="pip">
      </div>
      <div class="half-right" style="font-size: 90%;">
        <a href="https://itunes.apple.com/us/album/pat-in-person/id475034572">Download on iTunes</a><br>
        <a href="http://www.amazon.com/Pat-Person-McCurdy/dp/B005ZG605I">Download on Amazon</a>
      </div>
      <div style="clear: both;"></div><br>
    </div>

    <div style="clear: both;"></div>

    <div class="half-left">
      <a href="album.php?6"><img src="images/cds/the-sound-of-music.jpg" alt="The Sound of Music" style="width: 100%; height: auto;"></a><br>
      <div class="half-left">
        <a href="album.php?6">The Sound of Music</a><br>
        Quantity: <input type="text" size="3" style="width: 2em;" name="som">
      </div>
      <div class="half-right" style="font-size: 90%;">
        <a href="https://itunes.apple.com/us/album/the-sound-of-music/id475036158">Download on iTunes</a><br>
        <a href="http://www.amazon.com/Sound-Music-Pat-McCurdy/dp/B005ZC0RG0">Download on Amazon</a>
      </div>
      <div style="clear: both;"></div><br>
    </div>

    <div class="half-right">
      <img src="images/cds/the-good-life-memorial-day.jpg" alt="The Good Life/Memorial Day" style="width: 100%; height: auto;"><br>
      <a href="album.php?4">The Good Life</a>/<a href="album.php?5">Memorial Day</a><br>
      Quantity: <input type="text" size="3" style="width: 2em;" name="glmd"><br>
      <br>
    </div>

    <div style="clear: both;"></div>

    <div class="half-left">
      <img src="images/cds/yipes-a-bit-irrational.jpg" alt="Yipes!/A Bit Irrational" style="width: 100%; height: auto;"><br>
      <div class="two-third-left">
        <a href="album.php?1">Yipes!</a>/<a href="album?2">A Bit Irrational</a><br>
        Quantity: <input type="text" size="3" style="width: 2em;" name="yipes">
      </div>
      <div class="one-third-right" style="font-size: 90%;">
        <em>Limited time only!</em>
      </div>
      <div style="clear: both;"></div><br>
    </div>

    <div style="clear: both;"></div>
    <br>

    
    <strong>Vinyl Junkies</strong><br>
    Now available - a limited number of original Yipes! records on rich-sounding vinyl.<br>$15 each.<br>
    <div class="half-left">
      <a href="album.php?1"><img src="images/cds/yipes.jpg" alt="Yipes!" style="width: 100%; height: auto;"></a>
      <div class="half-left"><a href="album.php?1">Yipes!</a></div>
      <div class="half-right">Quantity: <input type="text" size="3" style="width: 2em;" name="vinylyipes"></div>
      <div style="clear: both;"></div>
    </div>

    <div class="half-right">
      <a href="album.php?2"><img src="images/cds/a-bit-irrational.jpg" alt="A Bit Irrational" style="width: 100%; height: auto;"></a>
      <div class="half-left"><a href="album.php?2">A Bit Irrational</a></div>
      <div class="half-right">Quantity: <input type="text" size="3" style="width: 2em;" name="vinylabi"></div>
      <div style="clear: both;"></div>
    </div>

    <div style="clear: both;"></div><br>
    <br>


    
    <div class="half-left">
      <strong>Ship to:</strong><br>
      <br>
    </div>
    <div class="half-right" style="font-style: italic; color: #5F2E1F;">
      * required field<br>
      <br>
    </div>

    <div style="clear: both;"></div>
    
    <div class="shipto">
      <div class="half-left">
        First Name <span style="color: #5F2E1F;">*</span><br>
        <input type="text" name="firstname"><br>
        <br>
      </div>
      <div class="half-right">
        Last Name <span style="color: #5F2E1F;">*</span><br>
        <input type="text" name="lastname"><br>
        <br>
      </div>

      <div style="clear: both;"></div>

      <div class="half-left">
        Address <span style="color: #5F2E1F;">*</span><br>
        <input type="text" name="address"><br>
        <br>
      </div>
      <div class="half-right">
        Address 2<br>
        <input type="text" name="address2"><br>
        <br>
      </div>

      <div style="clear: both;"></div>

      <div class="half-left">
        City <span style="color: #5F2E1F;">*</span><br>
        <input type="text" name="city"><br>
        <br>
      </div>
      <div class="half-right">
        State <span style="color: #5F2E1F;">*</span><br>
        <input type="text" name="state"><br>
        <br>
      </div>

      <div style="clear: both;"></div>

      <div class="one-fourth-left">
        Zip Code <span style="color: #5F2E1F;">*</span><br>
        <input type="text" name="zip" style="width: 6em;"><br>
        <br>
      </div>

      <div class="half-right">
        Email<br>
        <input type="text" name="email"><br>
        <br>
      </div>

      <div style="clear: both;"></div>
    </div>
    <input type="submit" name="submit" value="Create Order Form"><br>
    <br>

    Be sure to <strong>print out and send in</strong> the order form that is created. This only creates the order form; it does not notify anyone of your order.
  </div>
</form>

<?php
include "footer.php";
}
?>