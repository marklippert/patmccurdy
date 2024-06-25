<?php
$PageTitle = "Add A Set List";
include "header.php";
?>

<form action="form-add-set-list.php" method="POST" id="addsetlist" novalidate>
  <div>
    <input type="text" name="username" tabindex="-1" aria-hidden="true" autocomplete="new-password">

    <label>
      Date<br>
      <input type="date" name="date" required>
    </label>

    <label>
      Venue
      <input type="text" name="venue">
    </label>

    <div id="citystate">
      <label id="city">
        City
        <input type="text" name="city">
      </label>

      <label id="state">
        State
        <input type="text" name="state">
      </label>
    </div>

    <label>
      Set 1
      <textarea name="set1"></textarea>
    </label>
    
    <label>
      Set 2
      <textarea name="set2"></textarea>
    </label>
    
    <label>
      Set 3
      <textarea name="set3"></textarea>
    </label>

    <button type="submit" id="submit">Add</button>
  </div>
</form>

<div id="modal">
  <div id="modal-box">
    <div id="modal-button"></div>
    <div id="modal-content"></div>
  </div>
</div>

<script>
  // BEGIN form submit
  const form = document.getElementById('addsetlist');
  form.addEventListener('submit', submitForm);

  function submitForm(event) {
    event.preventDefault();

    // Validate any fields with "required" selector
    var valid = 'yes';

    for (const el of form.querySelectorAll('[required]')) {
      if (!el.checkValidity()) {
        document.getElementsByName(el.name).forEach(function (input) {
          input.classList.add('alert');
          input.insertAdjacentHTML('afterEnd', ' <span class="datealert">REQUIRED</span>');
        });

        valid = 'no';
      }
    }

    // If fields are valid, send the data
    if (valid == 'yes') {
      document.getElementById("submit").classList.add("loader");

      const data = new FormData(form);

      fetch(form.action, {
        method: 'POST',
        body: data
      })
      .then((response) => response.text())
      .then((result) => {
        // Data sent, so display success message in modal
        // and clear all the form fields
        document.getElementById('modal-content').innerHTML = result;
        modal.style.display = "block";
        form.reset();
        
        // Clear alerts
        document.querySelectorAll('.alert').forEach(function (alert) {
          alert.classList.remove('alert');
          document.querySelectorAll('.datealert').forEach(e => e.remove());
        });

        document.getElementById("submit").classList.remove("loader");
      });
    }
  } // END rsubmitForm

  const modal = document.getElementById("modal");
  const modalbutton = document.getElementById("modal-button");

  window.onclick = function(event) {
    if (event.target == modal) modal.style.display = "none";
  }

  modalbutton.onclick = function() { modal.style.display = "none"; }
</script>

<?php include "footer.php"; ?>