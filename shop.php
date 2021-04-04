<?php
$PageTitle = "Shop";
include "header.php";
?>

All prices include shipping (unless otherwise indicated). Orders will be sent out as soon as humanly possible. Prices and items available subject to change without notice. Some items may be temporarily out of stock; please be patient. If you have questions about your order, please <a href="mailto: fatmurf@wi.rr.com">contact Murf</a>.<br>
<br>

<form action="https://www.paypal.com/cgi-bin/webscr" method="POST" id="pmshop" novalidate target="new">
  <div>
    <h3>I &#10084; Sex & Beer Mask</h3>
    <img src="images/i-heart-sex-and-beer-mask.png" alt="I Heart Sex & Beer Mask"><br>
    Washable white cloth masks. $10 each or a 10 pack for $80.<br>
    <div class="flex-centered">
      <label>Quantity (Single): <input type="number" pattern="[0-9]*" class="item" name="MaskSingle" data-item="I Heart Sex & Beer Mask (single)" data-price="10"></label>
      <label>Quantity (10 Pack): <input type="number" pattern="[0-9]*" class="item" name="Mask10Pack" data-item="I Heart Sex & Beer Mask (10 pack)" data-price="80"></label>
    </div>

    <br><br>

    <h3>Handwritten Lyrics</h3>
    <img src="images/handwritten-lyrics.jpg" alt=""><br>
    On the same cheap, crappy paper Pat writes all of his songs on and suitable for framing. $25 per song, written out and signed by Pat, will cover postage and hand cramps. Be sure to specify which song you want (except "Vacation"; it's just too damn long) and to whom you want it dedicated.<br>
    <input type="text" class="lyrics" name="HandwrittenLyrics" data-item="Handwritten Lyrics" data-price="25"><br>
    <br>
    <br>


    <h3>Shirts</h3>
    All shirts are $20 unless otherwise indicated<br>
    <br>

    <div class="shop-two-col">
      <div>
        <img src="images/shirt-nude-party.png" alt="Let's Have A Nude Party!">
      </div>

      <div class="two-col-sizes">
        <h4>Let's Have A Nude Party! Shirt</h4>
        <div>
          <strong>Men's</strong>
          <label><strong>Qty:</strong> <input type="number" pattern="[0-9]*" min="1" class="item" name="shirtNudePartyS" data-item="Nude Party shirt [S]" data-price="20"> S</label>
          <label><strong>Qty:</strong> <input type="number" pattern="[0-9]*" min="1" class="item" name="shirtNudePartyM" data-item="Nude Party shirt [M]" data-price="20"> M</label>
          <label><strong>Qty:</strong> <input type="number" pattern="[0-9]*" min="1" class="item" name="shirtNudePartyL" data-item="Nude Party shirt [L]" data-price="20"> L</label>
          <label><strong>Qty:</strong> <input type="number" pattern="[0-9]*" min="1" class="item" name="shirtNudePartyXL" data-item="Nude Party shirt [XL]" data-price="20"> XL</label>
          <label><strong>Qty:</strong> <input type="number" pattern="[0-9]*" min="1" class="item" name="shirtNudeParty2XL" data-item="Nude Party shirt [2XL]" data-price="20"> 2XL</label>
          <label><strong>Qty:</strong> <input type="number" pattern="[0-9]*" min="1" class="item" name="shirtNudeParty3XL" data-item="Nude Party shirt [3XL]" data-price="20"> 3XL</label>
          <label><strong>Qty:</strong> <input type="number" pattern="[0-9]*" min="1" class="item" name="shirtNudeParty4XL" data-item="Nude Party shirt [4XL]" data-price="20"> 4XL</label>
        </div>
        <div>
          <strong>Women's</strong>
          <label><strong>Qty:</strong> <input type="number" pattern="[0-9]*" min="1" class="item" name="shirtWomansNudePartyS" data-item="Woman's Nude Party shirt [S]" data-price="20"> S</label>
          <label><strong>Qty:</strong> <input type="number" pattern="[0-9]*" min="1" class="item" name="shirtWomansNudePartyM" data-item="Woman's Nude Party shirt [M]" data-price="20"> M</label>
          <label><strong>Qty:</strong> <input type="number" pattern="[0-9]*" min="1" class="item" name="shirtWomansNudePartyL" data-item="Woman's Nude Party shirt [L]" data-price="20"> L</label>
          <label><strong>Qty:</strong> <input type="number" pattern="[0-9]*" min="1" class="item" name="shirtWomansNudePartyXL" data-item="Woman's Nude Party shirt [XL]" data-price="20"> XL</label>
          <label><strong>Qty:</strong> <input type="number" pattern="[0-9]*" min="1" class="item" name="shirtWomansNudeParty2XL" data-item="Woman's Nude Party shirt [2XL]" data-price="20"> 2XL</label>
        </div>
      </div>

      <div>
        <img src="images/shirt-sex-and-beer-green.png" alt="I Heart Sex & Beer">
        <div>
          <label><strong>Quantity:</strong> <input type="number" pattern="[0-9]*" min="1" class="item" name="shirtGreenHeartSexBeerM" data-item="Green I Heart Sex & Beer shirt [M]" data-price="20"> M</label>
          <label><strong>Quantity:</strong> <input type="number" pattern="[0-9]*" min="1" class="item" name="shirtGreenHeartSexBeerXL" data-item="Green I Heart Sex & Beer shirt [XL]" data-price="20"> XL</label>
          <label><strong>Quantity:</strong> <input type="number" pattern="[0-9]*" min="1" class="item" name="shirtGreenHeartSexBeer2XL" data-item="Green I Heart Sex & Beer shirt [2XL]" data-price="20"> 2XL</label>
        </div>
      </div>

      <div>
        <img src="images/shirt-sex-and-beer-blue.png" alt="I Heart Sex & Beer">
        <div>
          <label><strong>Quantity:</strong> <input type="number" pattern="[0-9]*" min="1" class="item" name="shirtBlueHeartSexBeerM" data-item="Blue I Heart Sex & Beer shirt [M]" data-price="20"> M</label>
          <label><strong>Quantity:</strong> <input type="number" pattern="[0-9]*" min="1" class="item" name="shirtBlueHeartSexBeerXL" data-item="Blue I Heart Sex & Beer shirt [XL]" data-price="20"> XL</label>
          <label><strong>Quantity:</strong> <input type="number" pattern="[0-9]*" min="1" class="item" name="shirtBlueHeartSexBeer2XL" data-item="Blue I Heart Sex & Beer shirt [2XL]" data-price="20"> 2XL</label>
        </div>
      </div>

      <div>
        <img src="images/shirt-i-heart-sex-and-beer-red.png" alt="I Heart Sex & Beer">
        <div>
          <label><strong>Quantity:</strong> <input type="number" pattern="[0-9]*" min="1" class="item" name="shirtRedHeartSexBeerM" data-item="Red I Heart Sex & Beer shirt [M]" data-price="20"> M</label>
          <label><strong>Quantity:</strong> <input type="number" pattern="[0-9]*" min="1" class="item" name="shirtRedHeartSexBeerXL" data-item="Red I Heart Sex & Beer shirt [XL]" data-price="20"> XL</label>
          <label><strong>Quantity:</strong> <input type="number" pattern="[0-9]*" min="1" class="item" name="shirtRedHeartSexBeer2XL" data-item="Red I Heart Sex & Beer shirt [2XL]" data-price="20"> 2XL</label>
        </div>
      </div>

      <div>
        <img src="images/shirt-sex-and-beer-shamrock.png" alt="I Shamrock Sex & Beer">
        <div>
          <label><strong>Quantity:</strong> <input type="number" pattern="[0-9]*" min="1" class="item" name="shirtShamrockSexBeerM" data-item="I Shamrock Sex & Beer shirt [M]" data-price="20"> M</label>
          <label><strong>Quantity:</strong> <input type="number" pattern="[0-9]*" min="1" class="item" name="shirtShamrockSexBeerXL" data-item="I Shamrock Sex & Beer shirt [XL]" data-price="20"> XL</label>
          <label><strong>Quantity:</strong> <input type="number" pattern="[0-9]*" min="1" class="item" name="shirtShamrockSexBeer2XL" data-item="I Shamrock Sex & Beer shirt [2XL]" data-price="20"> 2XL</label>
          <label><strong>Quantity:</strong> <input type="number" pattern="[0-9]*" min="1" class="item" name="shirtShamrockSexBeer3XL" data-item="I Shamrock Sex & Beer shirt [3XL]" data-price="20"> 3XL</label>
        </div>
      </div>

      <div>
        <img src="images/shirt-sex-and-beer-gray.png" alt="Sex & Beer">
        <div>
          <label><strong>Quantity:</strong> <input type="number" pattern="[0-9]*" min="1" class="item" name="shirtGraySexBeerM" data-item="Gray Sex & Beer shirt [M]" data-price="20"> M</label>
          <label><strong>Quantity:</strong> <input type="number" pattern="[0-9]*" min="1" class="item" name="shirtGraySexBeerXL" data-item="Gray Sex & Beer shirt [XL]" data-price="20"> XL</label>
          <label><strong>Quantity:</strong> <input type="number" pattern="[0-9]*" min="1" class="item" name="shirtGraySexBeer2XL" data-item="Gray Sex & Beer shirt [2XL]" data-price="20"> 2XL</label>
        </div>
      </div>
      
      <div>
        <img src="images/shirt-pat-mccurdy-is-my-best-friend.png" alt="Pat McCurdy Is My Best Friend">
        <div>
          <label><strong>Quantity:</strong> <input type="number" pattern="[0-9]*" min="1" class="item" name="shirtBestFriendS" data-item="Pat McCurdy Is My Best Friend shirt [S]" data-price="20"> S</label>
          <label><strong>Quantity:</strong> <input type="number" pattern="[0-9]*" min="1" class="item" name="shirtBestFriendM" data-item="Pat McCurdy Is My Best Friend shirt [M]" data-price="20"> M</label>
          <label><strong>Quantity:</strong> <input type="number" pattern="[0-9]*" min="1" class="item" name="shirtBestFriendXL" data-item="Pat McCurdy Is My Best Friend shirt [XL]" data-price="20"> XL</label>
        </div>
      </div>

      <div>
        <img src="images/shirt-monkey-paw.png" alt="I Wish I Had A Monkey Paw">
        <div>
          <label><strong>Quantity:</strong> <input type="number" pattern="[0-9]*" min="1" class="item" name="shirtMonkeyPawM" data-item="I Wish I Had A Monkey Paw shirt [M]" data-price="20"> M</label>
          <label><strong>Quantity:</strong> <input type="number" pattern="[0-9]*" min="1" class="item" name="shirtMonkeyPawXL" data-item="I Wish I Had A Monkey Paw shirt [XL]" data-price="20"> XL</label>
          <label><strong>Quantity:</strong> <input type="number" pattern="[0-9]*" min="1" class="item" name="shirtMonkeyPaw2XL" data-item="I Wish I Had A Monkey Paw shirt [2XL]" data-price="20"> 2XL</label>
        </div>
      </div>

      <div>
        <img src="images/shirt-hey-paddy.png" alt="Hey Paddy! Play A Song For Me">
        <div>
          <label><strong>Quantity:</strong> <input type="number" pattern="[0-9]*" min="1" class="item" name="shirtHeyPaddyM" data-item="Hey Paddy! Play A Song For Me shirt [M]" data-price="20"> M</label>
          <label><strong>Quantity:</strong> <input type="number" pattern="[0-9]*" min="1" class="item" name="shirtHeyPaddyXL" data-item="Hey Paddy! Play A Song For Me shirt [XL]" data-price="20"> XL</label>
          <label><strong>Quantity:</strong> <input type="number" pattern="[0-9]*" min="1" class="item" name="shirtHeyPaddy2XL" data-item="Hey Paddy! Play A Song For Me shirt [2XL]" data-price="20"> 2XL</label>
        </div>
      </div>

      <div>
        <img src="images/shirt-sex-and-beer-womans.png" alt="Women's Sex & Beer">
        <div>
          Women's Tee<br>
          <label><strong>Quantity:</strong> <input type="number" pattern="[0-9]*" min="1" class="item" name="shirtWomensSexBeerM" data-item="Womens Sex & Beer shirt [M]" data-price="20"> M</label>
          <label><strong>Quantity:</strong> <input type="number" pattern="[0-9]*" min="1" class="item" name="shirtWomensSexBeerL" data-item="Womens Sex & Beer shirt [L]" data-price="20"> L</label>
          <label><strong>Quantity:</strong> <input type="number" pattern="[0-9]*" min="1" class="item" name="shirtWomensSexBeerXL" data-item="Womens Sex & Beer shirt [XL]" data-price="20"> XL</label>
        </div>
      </div>

      <div>
        <img src="images/shirt-sex-and-beer-womans-tank.png" alt="Women's Sex & Beer Tank">
        <div>
          Women's Tank<br>
          <label><strong>Quantity:</strong> <input type="number" pattern="[0-9]*" min="1" class="item" name="shirtWomensSexBeerTankM" data-item="Womens Sex & Beer tank [M]" data-price="20"> M</label>
          <label><strong>Quantity:</strong> <input type="number" pattern="[0-9]*" min="1" class="item" name="shirtWomensSexBeerTankL" data-item="Womens Sex & Beer tank [L]" data-price="20"> L</label>
        </div>
      </div>
    </div> <!-- /.shop-two-col -->

    <h3>CDs</h3>
    All individual CDs are $15<br>
    <br>

    <h4>Ten CD Set</h4>
    All ten of Pat's CDs for $125. For the CDs that are out of print we'll burn high-quality copies.<br>
    <label>Quantity: <input type="number" pattern="[0-9]*" min="1" class="item" name="cdset" data-item="Ten CD Set" data-price="125"></label>

    <br><br><br>

    <?php
    function ShopCD($id, $price = 15) {
      global $mysqli;

      $album = $mysqli->query("SELECT * FROM albums WHERE id = '" . $id . "'");

      if (!empty($album) && $album->num_rows > 0) {
        $row = $album->fetch_array(MYSQLI_ASSOC);

        $words = preg_split("/\s+/", $row['title']);
        $acronym = "";
        foreach ($words as $w) $acronym .= $w[0];

        echo "<div>\n";
          echo '<a href="album.php?'.$id.'"><img src="images/cds/'.$row['cover_image'].'" alt="'.$row['title'].'"></a>'."\n";
          echo '<div class="shop-cd';
          if ($row['itunes'] != "" || $row['amazon'] != "") echo "-two-col";
          echo '">'."\n";
            if ($row['itunes'] != "" || $row['amazon'] != "") echo "<div>\n";
              echo '<a href="album.php?'.$id.'"><strong>'.$row['title']."</strong></a><br>\n";
              echo '<label>Quantity: <input type="number" pattern="[0-9]*" min="1" class="item" name="'.$acronym.'" data-item="'.$row['title'].'" data-price="'.$price.'"></label>'."\n";
            if ($row['itunes'] != "" || $row['amazon'] != "") echo "</div>\n<div>\n";
              if ($row['itunes'] != "") echo "<a href=\"" . $row['itunes'] . "\">Buy on Apple Music</a>\n";
              if ($row['itunes'] != "" && $row['amazon'] != "") echo "<br>\n";
              if ($row['amazon'] != "") echo "<a href=\"" . $row['amazon'] . "\">Buy on Amazon</a>\n";
            if ($row['itunes'] != "" || $row['amazon'] != "") echo "</div>\n";
          echo "</div>\n";
        echo "</div>\n";
      }
    }
    ?>

    <div class="shop-two-col">
      <?php
      ShopCD(18); // Now is Not the Time for Sad Songs
      ShopCD(16); // Souvenirs
      ShopCD(15); // Pat McCurdy Now
      ShopCD(14); // Love is a Beautiful Thing
      ShopCD(13); // 15 Favorites
      ShopCD(12); // My World of Love
      ShopCD(11); // Fainting With Happiness
      ShopCD(10); // Pat in Person Volume 2
      ShopCD(9); // The Big Bright Beautiful World of Pat McCurdy
      ShopCD(8); // Show Tunes
      ShopCD(7); // Pat in Person
      ShopCD(6); // The Sound of Music
      ?>

      <div>
        <img src="images/cds/the-good-life-memorial-day.jpg" alt="The Good Life/Memorial Day">
        <div class="shop-cd">
          <strong><a href="album.php?4">The Good Life</a>/<a href="album.php?5">Memorial Day</a></strong><br>
          <label>Quantity: <input type="number" pattern="[0-9]*" min="1" class="item" name="glmd" data-item="Good Life / Memorial Day" data-price="15"></label>
        </div>
      </div>

      <?php ShopCD(17); // Yipes!!! ?>

      <div>
        <a href="album.php?1"><img src="images/cds/yipes-redux.jpg" alt="Yipes! Redux"></a>
        <div class="shop-cd-two-col">
          <div>
            <a href="album.php?1"><strong>Yipes! Redux</strong></a><br>
            <label>Quantity: <input type="number" pattern="[0-9]*" min="1" class="item" name="yipesredux" data-item="Yipes! Redux" data-price="15"></label>
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
            <strong><a href="album.php?1">Yipes!</a>/<a href="album?2">A Bit Irrational</a></strong><br>
            <label>Quantity: <input type="number" pattern="[0-9]*" min="1" class="item" name="yipes" data-item="Yipes!/A Bit Irrational" data-price="15"></label>
          </div>
          <div>
            <em>Limited time only!</em>
          </div>
        </div>
      </div>
    </div> <!-- /.shop-two-col -->

    <br>
    
    <div class="checkout-two-col">
      <div><h3>Ship to:</h3></div>
      <div style="color: #5F2E1F; text-align: right;"><em>* required field</em></div>

      <label>First Name <span>*</span> <input type="text" name="first_name" required></label>
      <label>Last Name <span>*</span> <input type="text" name="last_name" required></label>

      <label>Address <span>*</span> <input type="text" name="address1" required></label>
      <label>Address 2 <input type="text" name="address2"></label>

      <label>City <span>*</span> <input type="text" name="city" required></label>
      <label>State <span>*</span> <input type="text" name="state" required></label>

      <label>Zip Code <span>*</span> <input type="number" pattern="[0-9]*" name="zip" required></label>
      <label>Email <input type="email" name="email"></label>
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
      $(".lyrics").each(function() {
        if ($(this).val() != ""){
          var string = $(this).val().replace(/\"/g,"''");
          theorder += '<input type="hidden" name="item_name_'+$i+'" value="Handwritten Lyrics for '+string+'">';
          theorder += '<input type="hidden" name="amount_'+$i+'" value="'+$(this).attr("data-price")+'">';
          theorder += '<input type="hidden" name="quantity_'+$i+'" value="1">';
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