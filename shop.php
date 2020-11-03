<?php
$PageTitle = "Shop";
include "header.php";
?>

<style>
  INPUT.item { width: 2em; }

  #pmshop INPUT[type="submit"] {
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

All prices include shipping (unless otherwise indicated). Orders will be sent out as soon as humanly possible. Prices and items available subject to change without notice. Some items may be temporarily out of stock; please be patient. If you have questions about your order, please <a href="mailto: fatmurf@wi.rr.com">contact Murf</a>.<br>
<br>

<form action="https://www.paypal.com/cgi-bin/webscr" method="POST" id="pmshop" novalidate target="new">
  <div>
    <strong>I &#10084; Sex & Beer Mask</strong><br>
    <img src="images/i-heart-sex-and-beer-mask.png" alt="I Heart Sex & Beer Mask" style="max-width: 100%; height: auto;"><br>
    Washable white cloth masks. $10 each or a 10 pack for $80.<br>
    <div class="half-left centered">
      <strong>Quantity (Single):</strong> <input type="text" class="item" name="MaskSingle" data-item="I Heart Sex & Beer Mask (single)" data-price="10">
    </div>
    <div class="half-right">
      <strong>Quantity (10 Pack):</strong> <input type="text" class="item" name="Mask10Pack" data-item="I Heart Sex & Beer Mask (10 pack)" data-price="80">
    </div>
    <div style="clear: both;"></div>
    <br>
    <br>


    <strong>Shirts</strong><br>
    All shirts are $15 unless otherwise indicated<br>
    <br>

    <div class="shop-two-col">
      <div>
        <img src="images/shirt-mistress-of-alcohol-tank.png" alt="Mistress of Alcohol Tank">
        <div>
          $25<br>
          <strong>Quantity:</strong> <input type="number" min="1" class="item" name="shirtMistressOfAlcoholTankS" data-item="Mistress of Alcohol tank [S]" data-price="25"> S<br>
          <strong>Quantity:</strong> <input type="number" min="1" class="item" name="shirtMistressOfAlcoholTankM" data-item="Mistress of Alcohol tank [M]" data-price="25"> M<br>
          <strong>Quantity:</strong> <input type="number" min="1" class="item" name="shirtMistressOfAlcoholTankL" data-item="Mistress of Alcohol tank [L]" data-price="25"> L<br>
          <strong>Quantity:</strong> <input type="number" min="1" class="item" name="shirtMistressOfAlcoholTankXL" data-item="Mistress of Alcohol tank [XL]" data-price="25"> XL
        </div>
      </div>

      <div>
        <img src="images/shirt-mistress-of-alcohol-scoop.png" alt="Mistress of Alcohol Shirt">
        <div>
          $20<br>
          <strong>Quantity:</strong> <input type="number" min="1" class="item" name="shirtMistressOfAlcoholS" data-item="Mistress of Alcohol shirt [S]" data-price="20"> S<br>
          <strong>Quantity:</strong> <input type="number" min="1" class="item" name="shirtMistressOfAlcoholM" data-item="Mistress of Alcohol shirt [M]" data-price="20"> M<br>
          <strong>Quantity:</strong> <input type="number" min="1" class="item" name="shirtMistressOfAlcoholL" data-item="Mistress of Alcohol shirt [L]" data-price="20"> L<br>
          <strong>Quantity:</strong> <input type="number" min="1" class="item" name="shirtMistressOfAlcoholXL" data-item="Mistress of Alcohol shirt [XL]" data-price="20"> XL<br>
          <strong>Quantity:</strong> <input type="number" min="1" class="item" name="shirtMistressOfAlcohol2XL" data-item="Mistress of Alcohol shirt [2XL]" data-price="20"> 2XL<br>
          <strong>Quantity:</strong> <input type="number" min="1" class="item" name="shirtMistressOfAlcohol3XL" data-item="Mistress of Alcohol shirt [3XL]" data-price="20"> 3XL<br>
          <br>
          
          <strong>Quantity:</strong> <input type="number" min="1" class="item" name="shirtMistressOfAlcoholSMens" data-item="Mistress of Alcohol shirt (Mens) [S]" data-price="20"> Men's S<br>
          <strong>Quantity:</strong> <input type="number" min="1" class="item" name="shirtMistressOfAlcoholMMens" data-item="Mistress of Alcohol shirt (Mens) [M]" data-price="20"> Men's M<br>
          <strong>Quantity:</strong> <input type="number" min="1" class="item" name="shirtMistressOfAlcoholLMens" data-item="Mistress of Alcohol shirt (Mens) [L]" data-price="20"> Men's L<br>
          <strong>Quantity:</strong> <input type="number" min="1" class="item" name="shirtMistressOfAlcoholXLMens" data-item="Mistress of Alcohol shirt (Mens) [XL]" data-price="20"> Men's XL<br>
          <strong>Quantity:</strong> <input type="number" min="1" class="item" name="shirtMistressOfAlcohol2XLMens" data-item="Mistress of Alcohol shirt (Mens) [2XL]" data-price="20"> Men's 2XL<br>
          <strong>Quantity:</strong> <input type="number" min="1" class="item" name="shirtMistressOfAlcohol3XLMens" data-item="Mistress of Alcohol shirt (Mens) [3XL]" data-price="20"> Men's 3XL<br>
          <strong>Quantity:</strong> <input type="number" min="1" class="item" name="shirtMistressOfAlcohol4XLMens" data-item="Mistress of Alcohol shirt (Mens) [4XL]" data-price="20"> Men's 4XL
        </div>
      </div>

      <div>
        <img src="images/shirt-sex-and-beer-green.png" alt="I Heart Sex & Beer">
        <div>
          <strong>Quantity:</strong> <input type="number" min="1" class="item" name="shirtGreenHeartSexBeerM" data-item="Green I Heart Sex & Beer shirt [M]" data-price="15"> M<br>
          <strong>Quantity:</strong> <input type="number" min="1" class="item" name="shirtGreenHeartSexBeerXL" data-item="Green I Heart Sex & Beer shirt [XL]" data-price="15"> XL<br>
          <strong>Quantity:</strong> <input type="number" min="1" class="item" name="shirtGreenHeartSexBeer2XL" data-item="Green I Heart Sex & Beer shirt [2XL]" data-price="15"> 2XL
        </div>
      </div>

      <div>
        <img src="images/shirt-sex-and-beer-blue.png" alt="I Heart Sex & Beer">
        <div>
          <strong>Quantity:</strong> <input type="number" min="1" class="item" name="shirtBlueHeartSexBeerM" data-item="Blue I Heart Sex & Beer shirt [M]" data-price="15"> M<br>
          <strong>Quantity:</strong> <input type="number" min="1" class="item" name="shirtBlueHeartSexBeerXL" data-item="Blue I Heart Sex & Beer shirt [XL]" data-price="15"> XL<br>
          <strong>Quantity:</strong> <input type="number" min="1" class="item" name="shirtBlueHeartSexBeer2XL" data-item="Blue I Heart Sex & Beer shirt [2XL]" data-price="15"> 2XL
        </div>
      </div>

      <div>
        <img src="images/shirt-i-heart-sex-and-beer-red.png" alt="I Heart Sex & Beer">
        <div>
          <strong>Quantity:</strong> <input type="number" min="1" class="item" name="shirtRedHeartSexBeerM" data-item="Red I Heart Sex & Beer shirt [M]" data-price="15"> M<br>
          <strong>Quantity:</strong> <input type="number" min="1" class="item" name="shirtRedHeartSexBeerXL" data-item="Red I Heart Sex & Beer shirt [XL]" data-price="15"> XL<br>
          <strong>Quantity:</strong> <input type="number" min="1" class="item" name="shirtRedHeartSexBeer2XL" data-item="Red I Heart Sex & Beer shirt [2XL]" data-price="15"> 2XL
        </div>
      </div>

      <div>
        <img src="images/shirt-sex-and-beer-gray.png" alt="Sex & Beer">
        <div>
          <strong>Quantity:</strong> <input type="number" min="1" class="item" name="shirtGraySexBeerM" data-item="Gray Sex & Beer shirt [M]" data-price="15"> M<br>
          <strong>Quantity:</strong> <input type="number" min="1" class="item" name="shirtGraySexBeerXL" data-item="Gray Sex & Beer shirt [XL]" data-price="15"> XL<br>
          <strong>Quantity:</strong> <input type="number" min="1" class="item" name="shirtGraySexBeer2XL" data-item="Gray Sex & Beer shirt [2XL]" data-price="15"> 2XL
        </div>
      </div>

      <div>
        <img src="images/shirt-sex-and-beer-shamrock.png" alt="I Shamrock Sex & Beer">
        <div>
          <strong>Quantity:</strong> <input type="number" min="1" class="item" name="shirtShamrockSexBeerM" data-item="I Shamrock Sex & Beer shirt [M]" data-price="15"> M<br>
          <strong>Quantity:</strong> <input type="number" min="1" class="item" name="shirtShamrockSexBeerXL" data-item="I Shamrock Sex & Beer shirt [XL]" data-price="15"> XL<br>
          <strong>Quantity:</strong> <input type="number" min="1" class="item" name="shirtShamrockSexBeer2XL" data-item="I Shamrock Sex & Beer shirt [2XL]" data-price="15"> 2XL<br>
          <strong>Quantity:</strong> <input type="number" min="1" class="item" name="shirtShamrockSexBeer3XL" data-item="I Shamrock Sex & Beer shirt [3XL]" data-price="15"> 3XL
        </div>
      </div>

      <div>
        <img src="images/shirt-pat-mccurdy-is-my-best-friend.png" alt="Pat McCurdy Is My Best Friend">
        <div>
          <strong>Quantity:</strong> <input type="number" min="1" class="item" name="shirtBestFriendS" data-item="Pat McCurdy Is My Best Friend shirt [S]" data-price="15"> S<br>
          <strong>Quantity:</strong> <input type="number" min="1" class="item" name="shirtBestFriendM" data-item="Pat McCurdy Is My Best Friend shirt [M]" data-price="15"> M<br>
          <strong>Quantity:</strong> <input type="number" min="1" class="item" name="shirtBestFriendXL" data-item="Pat McCurdy Is My Best Friend shirt [XL]" data-price="15"> XL
        </div>
      </div>

      <div>
        <img src="images/shirt-monkey-paw.png" alt="I Wish I Had A Monkey Paw">
        <div>
          <strong>Quantity:</strong> <input type="number" min="1" class="item" name="shirtMonkeyPawM" data-item="I Wish I Had A Monkey Paw shirt [M]" data-price="15"> M<br>
          <strong>Quantity:</strong> <input type="number" min="1" class="item" name="shirtMonkeyPawXL" data-item="I Wish I Had A Monkey Paw shirt [XL]" data-price="15"> XL<br>
          <strong>Quantity:</strong> <input type="number" min="1" class="item" name="shirtMonkeyPaw2XL" data-item="I Wish I Had A Monkey Paw shirt [2XL]" data-price="15"> 2XL
        </div>
      </div>

      <div>
        <img src="images/shirt-hey-paddy.png" alt="Hey Paddy! Play A Song For Me">
        <div>
          <strong>Quantity:</strong> <input type="number" min="1" class="item" name="shirtHeyPaddyM" data-item="Hey Paddy! Play A Song For Me shirt [M]" data-price="15"> M<br>
          <strong>Quantity:</strong> <input type="number" min="1" class="item" name="shirtHeyPaddyXL" data-item="Hey Paddy! Play A Song For Me shirt [XL]" data-price="15"> XL<br>
          <strong>Quantity:</strong> <input type="number" min="1" class="item" name="shirtHeyPaddy2XL" data-item="Hey Paddy! Play A Song For Me shirt [2XL]" data-price="15"> 2XL
        </div>
      </div>

      <div>
        <img src="images/shirt-sex-and-beer-womans.png" alt="Women's Sex & Beer">
        <div>
          Women's<br>
          <strong>Quantity:</strong> <input type="number" min="1" class="item" name="shirtWomensSexBeerM" data-item="Womens Sex & Beer shirt [M]" data-price="15"> M<br>
          <strong>Quantity:</strong> <input type="number" min="1" class="item" name="shirtWomensSexBeerL" data-item="Womens Sex & Beer shirt [L]" data-price="15"> L<br>
          <strong>Quantity:</strong> <input type="number" min="1" class="item" name="shirtWomensSexBeerXL" data-item="Womens Sex & Beer shirt [XL]" data-price="15"> XL
        </div>
      </div>

      <div>
        <img src="images/shirt-sex-and-beer-womans-tank.png" alt="Women's Sex & Beer Tank">
        <div>
          Women's Tank $20<br>
          <strong>Quantity:</strong> <input type="number" min="1" class="item" name="shirtWomensSexBeerTankM" data-item="Womens Sex & Beer tank [M]" data-price="20"> M<br>
          <strong>Quantity:</strong> <input type="number" min="1" class="item" name="shirtWomensSexBeerTankL" data-item="Womens Sex & Beer tank [L]" data-price="20"> L
        </div>
      </div>
    </div> <!-- /.shop-two-col -->

    <strong>CDs</strong><br>
    All individual CDs are $15<br>
    <br>
    <strong>Ten CD Set</strong><br>
    All ten of Pat's CDs for $125. For the CDs that are out of print we'll burn high-quality copies.<br>
    <strong>Quantity:</strong> <input type="number" min="1" class="item" name="cdset" data-item="Ten CD Set" data-price="125"><br>

    <br><br>

    <div class="shop-two-col">
      <div>
        <a href="album.php?16"><img src="images/cds/souvenirs.jpg" alt="Souvenirs"></a>
        <div class="shop-cd-two-col">
          <div>
            <a href="album.php?16">Souvenirs</a><br>
            <strong>Quantity:</strong> <input type="number" min="1" class="item" name="souvenirs" data-item="Souvenirs" data-price="15">
          </div>
          <div>
            <a href="https://music.apple.com/us/album/souvenirs/1288309545">Buy on Apple Music</a><br>
            <a href="https://www.amazon.com/dp/B0762RTTJN">Buy on Amazon</a>
          </div>
        </div>
      </div>

      <div style="text-align: left;">
        Pat's first greatest hits compilation features previously unreleased live and studio versions of Imagine A Picture, Screw You, Monkey Paw and other favorites. And for the first time ever: Hey Paddy!
      </div>

      <div>
        <a href="album.php?15"><img src="images/cds/pat-mccurdy-now.jpg" alt="Pat McCurdy Now!"></a>
        <div class="shop-cd-two-col">
          <div>
            <a href="album.php?15">Pat McCurdy Now!</a><br>
            <strong>Quantity:</strong> <input type="number" min="1" class="item" name="pmnow" data-item="Pat McCurdy Now!" data-price="15">
          </div>
          <div>
            <a href="https://music.apple.com/us/album/pat-mccurdy-now/1298129807">Buy on Apple Music</a><br>
            <a href="https://www.amazon.com/dp/B076JLFCDB">Buy on Amazon</a>
          </div>
        </div>
      </div>

      <div>
        <a href="album.php?14"><img src="images/cds/love-is-a-beautiful-thing.jpg" alt="Love is a Beautiful Thing"></a>
        <div class="shop-cd">
          <a href="album.php?14">Love is a Beautiful Thing</a><br>
          <strong>Quantity:</strong> <input type="number" min="1" class="item" name="liabt" data-item="Love is a Beautiful Thing" data-price="15">
        </div>
      </div>
      
      <div>
        <a href="album.php?13"><img src="images/cds/15-favorites.jpg" alt="15 Favorites"></a>
        <div class="shop-cd-two-col">
          <div>
            <a href="album.php?13">15 Favorites</a><br>
            <strong>Quantity:</strong> <input type="number" min="1" class="item" name="15fav" data-item="15 Favorites" data-price="15">
          </div>
          <div>
            <a href="https://music.apple.com/us/album/15-favorites/403423126">Buy on Apple Music</a><br>
            <a href="https://www.amazon.com/dp/B004BWYQM6">Buy on Amazon</a>
          </div>
        </div>
      </div>

      <div>
        <a href="album.php?12"><img src="images/cds/my-world-of-love.jpg" alt="My World of Love"></a>
        <div class="shop-cd-two-col">
          <div>
            <a href="album.php?12">My World of Love</a><br>
            <strong>Quantity:</strong> <input type="number" min="1" class="item" name="mwol" data-item="My World of Love" data-price="15">
          </div>
          <div>
            <a href="https://music.apple.com/us/album/my-world-of-love/402817113">Buy on Apple Music</a>
          </div>
        </div>
      </div>

      <div>
        <a href="album.php?11"><img src="images/cds/fainting-with-happiness.jpg" alt="Fainting With Happiness"></a>
        <div class="shop-cd">
          <a href="album.php?11">Fainting With Happiness</a><br>
          <strong>Quantity:</strong> <input type="number" min="1" class="item" name="fwh" data-item="Fainting With Happiness" data-price="15">
        </div>
      </div>

      <div>
        <a href="album.php?10"><img src="images/cds/pat-in-person-volume-2.jpg" alt="Pat in Person Volume 2"></a>
        <div class="shop-cd-two-col">
          <div>
            <a href="album.php?10">Pat in Person Volume 2</a><br>
            <strong>Quantity:</strong> <input type="number" min="1" class="item" name="pipv2" data-item="Pat in Person Volume 2" data-price="15">
          </div>
          <div>
            <a href="https://music.apple.com/us/album/pat-in-person-vol-2/402820238">Buy on Apple Music</a>
          </div>
        </div>
      </div>

      <div>
        <a href="album.php?9"><img src="images/cds/the-big-bright-beautiful-world-of-pat-mccurdy.jpg" alt="The Big Bright Beautiful World of Pat McCurdy"></a>
        <div class="shop-cd-two-col">
          <div>
            <a href="album.php?9">The Big Bright Beautiful World of Pat McCurdy</a><br>
            <strong>Quantity:</strong> <input type="number" min="1" class="item" name="bbbw" data-item="The Big Bright Beautiful World of Pat McCurdy" data-price="15">
          </div>
          <div>
            <a href="https://music.apple.com/us/album/the-big-bright-beautiful-world-of-pat-mccurdy/402750541">Buy on Apple Music</a>
          </div>
        </div>
      </div>

      <div>
        <a href="album.php?8"><img src="images/cds/show-tunes.jpg" alt="Show Tunes"></a>
        <div class="shop-cd">
          <a href="album.php?8">Show Tunes</a><br>
          <strong>Quantity:</strong> <input type="number" min="1" class="item" name="sho" data-item="Show Tunes" data-price="15">
        </div>
      </div>

      <div>
        <a href="album.php?7"><img src="images/cds/pat-in-person.jpg" alt="Pat in Person"></a>
        <div class="shop-cd-two-col">
          <div>
            <a href="album.php?7">Pat in Person</a><br>
            <strong>Quantity:</strong> <input type="number" min="1" class="item" name="pip" data-item="Pat in Person" data-price="15">
          </div>
          <div>
            <a href="https://music.apple.com/us/album/pat-in-person/475034572">Buy on Apple Music</a><br>
            <a href="https://www.amazon.com/dp/B005ZG605I">Buy on Amazon</a>
          </div>
        </div>
      </div>

      <div>
        <a href="album.php?6"><img src="images/cds/the-sound-of-music.jpg" alt="The Sound of Music"></a>
        <div class="shop-cd-two-col">
          <div>
            <a href="album.php?6">The Sound of Music</a><br>
            <strong>Quantity:</strong> <input type="number" min="1" class="item" name="som" data-item="The Sound of Music" data-price="15">
          </div>
          <div>
            <a href="https://music.apple.com/us/album/the-sound-of-music/475036158">Buy on Apple Music</a><br>
            <a href="https://www.amazon.com/dp/B005ZC0RG0">Buy on Amazon</a>
          </div>
        </div>
      </div>

      <div>
        <img src="images/cds/the-good-life-memorial-day.jpg" alt="The Good Life/Memorial Day">
        <div class="shop-cd">
          <a href="album.php?4">The Good Life</a>/<a href="album.php?5">Memorial Day</a><br>
          Quantity: <input type="number" min="1" class="item" name="glmd" data-item="Good Life / Memorial Day" data-price="15">
        </div>
      </div>

      <div>
        <a href="album.php?17"><img src="images/cds/yipes3.jpg" alt="Yipes!!!"></a>
        <div class="shop-cd-two-col">
          <div>
            <a href="album.php?17">Yipes!!!</a><br>
            <strong>Quantity:</strong> <input type="number" min="1" class="item" name="yipes3" data-item="Yipes!!!" data-price="15">
          </div>
          <div>
            <a href="https://music.apple.com/us/album/yipes/1445141431">Buy on Apple Music</a><br>
            <a href="https://www.amazon.com/Yipes/dp/B07KZPCMVK">Buy on Amazon</a>
          </div>
        </div>
      </div>

      <div>
        <a href="album.php?1"><img src="images/cds/yipes-redux.jpg" alt="Yipes! Redux"></a>
        <div class="shop-cd-two-col">
          <div>
            <a href="album.php?1">Yipes! Redux</a><br>
            <strong>Quantity:</strong> <input type="number" min="1" class="item" name="yipesredux" data-item="Yipes! Redux" data-price="15">
          </div>
          <div>
            <a href="https://music.apple.com/us/album/redux/1488052645">Buy on Apple Music</a><br>
            <a href="https://www.amazon.com/Redux-Yipes/dp/B081K9K92F">Buy on Amazon</a>
          </div>
        </div>
      </div>

      <div>
        <img src="images/cds/yipes-a-bit-irrational.jpg" alt="Yipes!/A Bit Irrational">
        <div class="shop-cd-two-col">
          <div>
            <a href="album.php?1">Yipes!</a>/<a href="album?2">A Bit Irrational</a><br>
            <strong>Quantity:</strong> <input type="number" min="1" class="item" name="yipes" data-item="Yipes!/A Bit Irrational" data-price="15">
          </div>
          <div>
            <em>Limited time only!</em>
          </div>
        </div>
      </div>
    </div> <!-- /.shop-two-col -->

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

    Payments are processed using PayPal. A PayPal account is not required to submit payment. (Look for the "Pay with Debit or Credt Card" button.)<br>
    <br>

    If you have questions about your order, please <a href="mailto: fatmurf@wi.rr.com">contact Murf</a>.
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