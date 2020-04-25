<?php
$PageTitle = "Shop";
include "header.php";
?>

<style>
  INPUT.item { width: 2em; }

  INPUT[type="submit"] {
    display: inline-block;
    outline: 0;
    border: 0;
    box-sizing: border-box;
    padding: 0.6em 0.7em 0.5em 0.9em;
    background: #B87D00;
    color: #F7EACA;
    font-family: Arial, Helvetica, sans-serif;
    font-weight: 400;
    font-size: 18px;
    line-height: 1em;
    letter-spacing: 0.2em;
    text-transform: uppercase;
    cursor: pointer;
    -webkit-appearance: none;
    transition: all 0.2s;
  }

  INPUT[type="submit"]:hover { background: #5F2E1F }
</style>

All prices include shipping (unless otherwise indicated). Orders will be sent out as soon as humanly possible. Prices and items available subject to change without notice. Some items may be temporarily out of stock; please be patient.<br>
<br>

<form action="https://www.paypal.com/cgi-bin/webscr" method="POST" id="pmshop" novalidate target="new">
  <div>
    <strong>Shirts</strong><br>
    All shirts are $15 unless otherwise indicated<br>
    <br>

    <div class="half-left centered">
      <img src="images/shirt-sex-and-beer-green.png" alt="I Heart Sex & Beer" style="width: 100%; height: auto;">
      <div class="centered-block" style="text-align: left;">
        <strong>Quantity:</strong> <input type="text" class="item" name="shirtGreenHeartSexBeerM" data-item="Green I Heart Sex & Beer shirt [M]" data-price="15"> M<br>
        <strong>Quantity:</strong> <input type="text" class="item" name="shirtGreenHeartSexBeerXL" data-item="Green I Heart Sex & Beer shirt [XL]" data-price="15"> XL<br>
        <strong>Quantity:</strong> <input type="text" class="item" name="shirtGreenHeartSexBeer2XL" data-item="Green I Heart Sex & Beer shirt [2XL]" data-price="15"> 2XL<br>
        <br>
      </div>
    </div>

    <div class="half-right centered">
      <img src="images/shirt-sex-and-beer-blue-small.png" alt="I Heart Sex & Beer" style="width: 100%; height: auto;">
      <div class="centered-block" style="text-align: left;">
        <strong>Quantity:</strong> <input type="text" class="item" name="shirtBlueHeartSexBeerM" data-item="Blue I Heart Sex & Beer shirt [M]" data-price="15"> M<br>
        <strong>Quantity:</strong> <input type="text" class="item" name="shirtBlueHeartSexBeerXL" data-item="Blue I Heart Sex & Beer shirt [XL]" data-price="15"> XL<br>
        <strong>Quantity:</strong> <input type="text" class="item" name="shirtBlueHeartSexBeer2XL" data-item="Blue I Heart Sex & Beer shirt [2XL]" data-price="15"> 2XL<br>
        <br>
      </div>
    </div>

    <div style="clear: both;"></div>

    <div class="half-left centered">
      <img src="images/shirt-i-heart-sex-and-beer-red.png" alt="I Heart Sex & Beer" style="width: 100%; height: auto;">
      <div class="centered-block" style="text-align: left;">
        <strong>Quantity:</strong> <input type="text" class="item" name="shirtRedHeartSexBeerM" data-item="Red I Heart Sex & Beer shirt [M]" data-price="15"> M<br>
        <strong>Quantity:</strong> <input type="text" class="item" name="shirtRedHeartSexBeerXL" data-item="Red I Heart Sex & Beer shirt [XL]" data-price="15"> XL<br>
        <strong>Quantity:</strong> <input type="text" class="item" name="shirtRedHeartSexBeer2XL" data-item="Red I Heart Sex & Beer shirt [2XL]" data-price="15"> 2XL<br>
        <br>
      </div>
    </div>

    <div class="half-right centered">
      <img src="images/shirt-sex-and-beer-gray.png" alt="Sex & Beer" style="width: 100%; height: auto;">
      <div class="centered-block" style="text-align: left;">
        <strong>Quantity:</strong> <input type="text" class="item" name="shirtGraySexBeerM" data-item="Gray Sex & Beer shirt [M]" data-price="15"> M<br>
        <strong>Quantity:</strong> <input type="text" class="item" name="shirtGraySexBeerXL" data-item="Gray Sex & Beer shirt [XL]" data-price="15"> XL<br>
        <strong>Quantity:</strong> <input type="text" class="item" name="shirtGraySexBeer2XL" data-item="Gray Sex & Beer shirt [2XL]" data-price="15"> 2XL<br>
        <br>
      </div>
    </div>

    <div style="clear: both;"></div>

    <div class="half-left centered">
      <img src="images/shirt-sex-and-beer-shamrock.png" alt="I Shamrock Sex & Beer" style="width: 100%; height: auto;">
      <div class="centered-block" style="text-align: left;">
        <strong>Quantity:</strong> <input type="text" class="item" name="shirtShamrockSexBeerM" data-item="I Shamrock Sex & Beer shirt [M]" data-price="15"> M<br>
        <strong>Quantity:</strong> <input type="text" class="item" name="shirtShamrockSexBeerXL" data-item="I Shamrock Sex & Beer shirt [XL]" data-price="15"> XL<br>
        <strong>Quantity:</strong> <input type="text" class="item" name="shirtShamrockSexBeer2XL" data-item="I Shamrock Sex & Beer shirt [2XL]" data-price="15"> 2XL<br>
        <strong>Quantity:</strong> <input type="text" class="item" name="shirtShamrockSexBeer3XL" data-item="I Shamrock Sex & Beer shirt [3XL]" data-price="15"> 3XL<br>
        <br>
      </div>
    </div>

    <div class="half-right centered">
      <img src="images/shirt-pat-mccurdy-is-my-best-friend.png" alt="Pat McCurdy Is My Best Friend" style="width: 100%; height: auto;">
      <div class="centered-block" style="text-align: left;">
        <strong>Quantity:</strong> <input type="text" class="item" name="shirtBestFriendS" data-item="Pat McCurdy Is My Best Friend shirt [S]" data-price="15"> S<br>
        <strong>Quantity:</strong> <input type="text" class="item" name="shirtBestFriendM" data-item="Pat McCurdy Is My Best Friend shirt [M]" data-price="15"> M<br>
        <strong>Quantity:</strong> <input type="text" class="item" name="shirtBestFriendXL" data-item="Pat McCurdy Is My Best Friend shirt [XL]" data-price="15"> XL<br>
        <br>
      </div>
    </div>

    <div style="clear: both;"></div>

    <div class="half-left centered">
      <img src="images/shirt-monkey-paw.png" alt="I Wish I Had A Monkey Paw" style="width: 100%; height: auto;">
      <div class="centered-block" style="text-align: left;">
        <strong>Quantity:</strong> <input type="text" class="item" name="shirtMonkeyPawM" data-item="I Wish I Had A Monkey Paw shirt [M]" data-price="15"> M<br>
        <strong>Quantity:</strong> <input type="text" class="item" name="shirtMonkeyPawXL" data-item="I Wish I Had A Monkey Paw shirt [XL]" data-price="15"> XL<br>
        <strong>Quantity:</strong> <input type="text" class="item" name="shirtMonkeyPaw2XL" data-item="I Wish I Had A Monkey Paw shirt [2XL]" data-price="15"> 2XL<br>
        <br>
      </div>
    </div>

    <div class="half-right centered">
      <img src="images/shirt-hey-paddy.png" alt="Hey Paddy! Play A Song For Me" style="width: 100%; height: auto;">
      <div class="centered-block" style="text-align: left;">
        <strong>Quantity:</strong> <input type="text" class="item" name="shirtHeyPaddyM" data-item="Hey Paddy! Play A Song For Me shirt [M]" data-price="15"> M<br>
        <strong>Quantity:</strong> <input type="text" class="item" name="shirtHeyPaddyXL" data-item="Hey Paddy! Play A Song For Me shirt [XL]" data-price="15"> XL<br>
        <strong>Quantity:</strong> <input type="text" class="item" name="shirtHeyPaddy2XL" data-item="Hey Paddy! Play A Song For Me shirt [2XL]" data-price="15"> 2XL<br>
        <br>
      </div>
    </div>

    <div style="clear: both;"></div>

    <div class="half-left centered">
      <img src="images/shirt-sex-and-beer-womans-small.png" alt="Women's Sex & Beer" style="width: 100%; height: auto;">
      <div class="centered-block" style="text-align: left;">
        Women's<br>
        <strong>Quantity:</strong> <input type="text" class="item" name="shirtWomensSexBeerM" data-item="Womens Sex & Beer shirt [M]" data-price="15"> M<br>
        <strong>Quantity:</strong> <input type="text" class="item" name="shirtWomensSexBeerL" data-item="Womens Sex & Beer shirt [L]" data-price="15"> L<br>
        <strong>Quantity:</strong> <input type="text" class="item" name="shirtWomensSexBeerXL" data-item="Womens Sex & Beer shirt [XL]" data-price="15"> XL<br>
        <br>
      </div>
    </div>

    <div class="half-right centered">
      <img src="images/shirt-sex-and-beer-womans-tank.png" alt="Women's Sex & Beer Tank" style="width: 100%; height: auto;">
      <div class="centered-block" style="text-align: left;">
        Women's Tank $20<br>
        <strong>Quantity:</strong> <input type="text" class="item" name="shirtWomensSexBeerTankM" data-item="Womens Sex & Beer tank [M]" data-price="20"> M<br>
        <strong>Quantity:</strong> <input type="text" class="item" name="shirtWomensSexBeerTankL" data-item="Womens Sex & Beer tank [L]" data-price="20"> L<br>
        <br>
      </div>
    </div>

    <div style="clear: both;"></div>

    <br>

    <strong>CDs</strong><br>
    All individual CDs are $15<br>
    <br>
<!--     <strong>Ten CD Set</strong><br>
    All ten of Pat's CDs for $125. For the CDs that are out of print we'll burn high-quality copies.<br>
    <strong>Quantity:</strong> <input type="text" class="item" name="cdset" data-item="Ten CD Set" data-price="125"><br>

    <br><br> -->

    <div class="half-left">
      <a href="album.php?16"><img src="images/cds/souvenirs.jpg" alt="Souvenirs" style="width: 100%; height: auto;"><br>
      <div class="half-left">
        <a href="album.php?16">Souvenirs</a><br>
        Quantity: <input type="text" class="item" name="souvenirs" data-item="Souvenirs" data-price="15">
      </div>
      <div class="half-right" style="font-size: 90%;">
        <a href="https://music.apple.com/us/album/souvenirs/1288309545">Download on iTunes</a><br>
        <a href="https://www.amazon.com/dp/B0762RTTJN">Download on Amazon</a>
      </div>
      <div style="clear: both;"></div><br>
      <br>
    </div>

    <div class="half-right">
      Pat's first greatest hits compilation features previously unreleased live and studio versions of Imagine A Picture, Screw You, Monkey Paw and other favorites. And for the first time ever: Hey Paddy!
    </div>
    
    <div style="clear: both;"></div>

    <div class="half-left">
      <a href="album.php?15"><img src="images/cds/pat-mccurdy-now.jpg" alt="Pat McCurdy Now!" style="width: 100%; height: auto;"><br>
      <div class="half-left">
        <a href="album.php?15">Pat McCurdy Now!</a><br>
        Quantity: <input type="text" class="item" name="pmnow" data-item="Pat McCurdy Now!" data-price="15">
      </div>
      <div class="half-right" style="font-size: 90%;">
        <a href="https://music.apple.com/us/album/pat-mccurdy-now/1298129807">Download on iTunes</a><br>
        <a href="https://www.amazon.com/dp/B076JLFCDB">Download on Amazon</a>
      </div>
      <div style="clear: both;"></div><br>
    </div>

    <div class="half-right">
      <a href="album.php?14"><img src="images/cds/love-is-a-beautiful-thing.jpg" alt="Love is a Beautiful Thing" style="width: 100%; height: auto;"><br>
      Love is a Beautiful Thing</a><br>
      Out of print<br>
      Downloads coming soon<br>
      <br>
    </div>
    
    <div style="clear: both;"></div>

    <div class="half-left">
      <a href="album.php?11"><img src="images/cds/fainting-with-happiness.jpg" alt="Fainting With Happiness" style="width: 100%; height: auto;"><br>
      Fainting With Happiness</a><br>
      Out of print<br>
      Downloads coming soon<br>
      <br>
    </div>

    <div class="half-right">
      <a href="album.php?13"><img src="images/cds/15-favorites.jpg" alt="15 Favorites" style="width: 100%; height: auto;">
        15 Favorites</a><br>
      Only available for download<br>
      <a href="https://music.apple.com/us/album/15-favorites/403423126" style="font-size: 90%;">Download on iTunes</a><br>
      <a href="https://www.amazon.com/dp/B004BWYQM6" style="font-size: 90%;">Download on Amazon</a><br>
      <br>
    </div>

    <div style="clear: both;"></div>

    <div class="half-left">
      <a href="album.php?12"><img src="images/cds/my-world-of-love.jpg" alt="My World of Love" style="width: 100%; height: auto;"><br>
      My World of Love</a><br>
      Quantity: <input type="text" class="item" name="mwol" data-item="My World of Love" data-price="15"><br>
      <a href="https://music.apple.com/us/album/my-world-of-love/402817113" style="font-size: 90%;">Download on iTunes</a><br>
      <br>
    </div>

    <div class="half-right">
      <a href="album.php?10"><img src="images/cds/pat-in-person-volume-2.jpg" alt="Pat in Person Volume 2" style="width: 100%; height: auto;"><br>
      Pat in Person Volume 2</a><br>
      Quantity: <input type="text" class="item" name="pipv2" data-item="Pat in Person Volume 2" data-price="15"><br>
      <a href="https://music.apple.com/us/album/pat-in-person-vol-2/402820238" style="font-size: 90%;">Download on iTunes</a><br>
      <br>
    </div>

    <div style="clear: both;"></div>

    <div class="half-left">
      <a href="album.php?9"><img src="images/cds/the-big-bright-beautiful-world-of-pat-mccurdy.jpg" alt="The Big Bright Beautiful World of Pat McCurdy" style="width: 100%; height: auto;"><br>
      The Big Bright Beautiful World of...</a><br>
      Quantity: <input type="text" class="item" name="bbbw" data-item="The Big Bright Beautiful World of Pat McCurdy" data-price="15"><br>
      <a href="https://music.apple.com/us/album/the-big-bright-beautiful-world-of-pat-mccurdy/402750541" style="font-size: 90%;">Download on iTunes</a><br>
      <br>
    </div>

    <div class="half-right">
      <a href="album.php?8"><img src="images/cds/show-tunes.jpg" alt="Show Tunes" style="width: 100%; height: auto;"><br>
      Show Tunes</a><br>
      <!-- Quantity: <input type="text" class="item" name="sho" data-item="Show Tunes" data-price="15"><br> -->
      Out of print<br>
      Downloads coming soon<br>
      <br>
    </div>

    <div style="clear: both;"></div>

    <div class="half-left">
      <a href="album.php?7"><img src="images/cds/pat-in-person.jpg" alt="Pat in Person" style="width: 100%; height: auto;"></a><br>
      <div class="half-left">
        <a href="album.php?7">Pat in Person</a><br>
        Quantity: <input type="text" class="item" name="pip" data-item="Pat in Person" data-price="15"><br>
      </div>
      <div class="half-right" style="font-size: 90%;">
        <a href="https://music.apple.com/us/album/pat-in-person/475034572">Download on iTunes</a><br>
        <a href="https://www.amazon.com/dp/B005ZG605I">Download on Amazon</a>
      </div>
      <div style="clear: both;"></div><br>
    </div>

    <div class="half-right">
      <a href="album.php?6"><img src="images/cds/the-sound-of-music.jpg" alt="The Sound of Music" style="width: 100%; height: auto;"></a><br>
      <div class="half-left">
        <a href="album.php?6">The Sound of Music</a><br>
        Quantity: <input type="text" class="item" name="som" data-item="The Sound of Music" data-price="15">
      </div>
      <div class="half-right" style="font-size: 90%;">
        <a href="https://music.apple.com/us/album/the-sound-of-music/475036158">Download on iTunes</a><br>
        <a href="https://www.amazon.com/dp/B005ZC0RG0">Download on Amazon</a>
      </div>
      <div style="clear: both;"></div><br>
    </div>

    <div style="clear: both;"></div>

    <div class="half-left">
      <img src="images/cds/the-good-life-memorial-day.jpg" alt="The Good Life/Memorial Day" style="width: 100%; height: auto;"><br>
      <a href="album.php?4">The Good Life</a>/<a href="album.php?5">Memorial Day</a><br>
      Out of print<br>
      Downloads coming soon<br>
      <br>
    </div>

    <div class="half-right">
      <a href="album.php?17"><img src="images/cds/yipes3.jpg" alt="Yipes!!!" style="width: 100%; height: auto;"></a><br>
      <div class="half-left">
        <a href="album.php?17">Yipes!!!</a><br>
        Quantity: <input type="text" class="item" name="yipes3" data-item="Yipes!!!" data-price="15">
      </div>
      <div class="half-right" style="font-size: 90%;">
        <a href="https://music.apple.com/us/album/yipes/1445141431">Download on iTunes</a><br>
        <a href="https://www.amazon.com/Yipes/dp/B07KZPCMVK">Download on Amazon</a>
      </div>
      <div style="clear: both;"></div><br>
    </div>

    <div style="clear: both;"></div>

    <div class="half-left">
      <a href="album.php?1"><img src="images/cds/yipes-redux.jpg" alt="Yipes! Redux" style="width: 100%; height: auto;"></a><br>
      <div class="half-left">
        <a href="album.php?1">Yipes! Redux</a><br>
        Quantity: <input type="text" class="item" name="yipesredux" data-item="Yipes! Redux" data-price="15">
      </div>
      <div class="half-right" style="font-size: 90%;">
        <a href="https://music.apple.com/us/album/redux/1488052645">Download on iTunes</a><br>
        <a href="https://www.amazon.com/Redux-Yipes/dp/B081K9K92F">Download on Amazon</a>
      </div>
      <div style="clear: both;"></div><br>
    </div>

    <div class="half-right">
      <img src="images/cds/yipes-a-bit-irrational.jpg" alt="Yipes!/A Bit Irrational" style="width: 100%; height: auto;"><br>
      <div class="two-third-left">
        <a href="album.php?1">Yipes!</a>/<a href="album?2">A Bit Irrational</a><br>
        Quantity: <input type="text" class="item" name="yipes" data-item="Yipes!/A Bit Irrational" data-price="15">
      </div>
      <div class="one-third-right" style="font-size: 90%;">
        <em>Limited time only!</em>
      </div>
      <div style="clear: both;"></div><br>
    </div>

    <div style="clear: both;"></div>
    <br>

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
        <input type="text" name="first_name" required><br>
        <br>
      </div>
      <div class="half-right">
        Last Name <span style="color: #5F2E1F;">*</span><br>
        <input type="text" name="last_name" required><br>
        <br>
      </div>

      <div style="clear: both;"></div>

      <div class="half-left">
        Address <span style="color: #5F2E1F;">*</span><br>
        <input type="text" name="address1" required><br>
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
        <input type="text" name="city" required><br>
        <br>
      </div>
      <div class="half-right">
        State <span style="color: #5F2E1F;">*</span><br>
        <input type="text" name="state" required><br>
        <br>
      </div>

      <div style="clear: both;"></div>

      <div class="one-fourth-left">
        Zip Code <span style="color: #5F2E1F;">*</span><br>
        <input type="text" name="zip" style="width: 6em;" required><br>
        <br>
      </div>

      <div class="half-right">
        Email<br>
        <input type="text" name="email"><br>
        <br>
      </div>

      <div style="clear: both;"></div>
    </div>

    <input type="hidden" name="cmd" value="_cart">
    <input type="hidden" name="upload" value="1">
    <input type="hidden" name="return" value="https://patmccurdy.com/shop.php">
    <input type="hidden" name="business" value="patmccurdy123@yahoo.com">
    <input type="hidden" name="currency_code" value="USD">

    <input type="submit" name="submit" value="Checkout" id="submit"><br>
    <br>

    Payments are processed using PayPal. A PayPal account is not required to submit payment. (Look for the "Pay with Debit or Credt Card" button.)
  </div>
</form>

<script type="text/javascript">
  $(document).ready(function(){
    var form = '#pmshop';
    $(form+' input[type="submit"]').click(function(e) {
      var theorder = '';
      var $i = 1;
      $(".item").each(function() {
        if ($(this).val() != ""){
          theorder += '<input type="hidden" name="item_name_'+$i+'" value="'+$(this).attr("data-item")+'">';
          theorder += '<input type="hidden" name="amount_'+$i+'" value="'+$(this).attr("data-price")+'">';
          theorder += '<input type="hidden" name="quantity_'+$i+'" value="'+$(this).val()+'">';
          $i++;
        }
      });
      $('#submit').prepend(theorder);

      function formValidation() {
        var missing = 'no';

        $(form+' [required]').each(function(){
          if ($(this).val() === "") {
            $(this).addClass('alert').attr("placeholder", "REQUIRED");
            missing = 'yes';
          }
        });

        return (missing == 'no') ? true : false;
      }
      
      if (!formValidation()) e.preventDefault();
    });
  });
</script>

<?php
include "footer.php";
?>