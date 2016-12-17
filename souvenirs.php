<?php
$PageTitle = "Souvenirs";
include "header.php";
?>

<h2>Pre-Order "Souvenirs" NOW!</h2>

<script type="text/javascript">
  function checkform (form) {
    if (form.souvenirs.value == "") { alert('Quantity required.'); form.souvenirs.focus(); return false ; }
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

<form action="shop.php" method="POST" onsubmit="return checkform(this)">
  <div>
    Pat's first greatest hits compilation features previously unreleased live and studio versions of <a href="album.php?16">Imagine A Picture, Screw You, Monkey Paw and other favorites</a>. And for the first time ever: Hey Paddy! <em style="color: #F20E1C;"><strong>This CD has not yet been released.</strong> You may pre-order it now and we will deliver it to you when it arrives.</em><br>
    <br>

    <img src="images/cds/souvenirs.jpg" alt="Souvenirs" style="width: 100%; height: auto;"><br>
    
    <div style="text-align: center; font-size: 125%; line-height: 1em;">
      $15 each! Quantity: <input type="text" size="3" style="width: 2em;" name="souvenirs">
    </div>
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

<?php include "footer.php"; ?>