<div id="id05">
  <form class="animate" action="./resetpass_process.php" method="post">
    <div class="imgcontainer">
      <h2>Reset Password</h2>
      <p>Please fill out this form to reset your password.</p>
    </div>

    <div class="container">
      <?php
      if (isset($_SESSION["error"])) {
        echo "<div style='color:red'>" . $_SESSION["error"] . "</div>";
        unset($_SESSION["error"]);
      }
      // if (isset($_SESSION["success"])) {
      //     echo "<div style='color:blue'>" . $_SESSION["success"] . "</div>";
      //     unset($_SESSION["success"]);
      // }
      ?>
      <p>
        <label for="psw" style="color:black;font-size:16px;"><b>Enter Old Password</b></label>
        <input required type="password" autocomplete="off" placeholder="Enter Old Password" id="oldPass" name="oldPass" title="Must contain at least 8 characters, an uppercase, an lowercase and a number">
      </p>
      <p>
        <label for="psw" style="color:black;"><b>New Password</b></label>
        <input required type="password" autocomplete="off" placeholder="Enter New Password" id="psw" name="psw" title="Must contain at least 8 characters, an uppercase, an lowercase and a number" onkeyup='checkOld();'>
      </p>
      <p>
        <label for="psw" style="color:black;"><b>Confirm new password</b></label>
        <label class="float-right" id='inform'></label>
        <input required id="confirm" autocomplete="off" type="password" name="confirm_password" placeholder="Confirm Password" onkeyup='check();'>
      </p>
      <input class="lo" type="submit" name="submit5" value="Submit">
    </div>

    <div id="message">
      <h4>Password must contain the following:</h4>
      <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
      <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
      <p id="number" class="invalid">A <b>number</b></p>
      <p id="length" class="invalid">Minimum <b>8 characters</b></p>
      <p id="space" class="valid"> No <b>white space</b></p>
      <p id="reOld" class="valid"> <b>Different from old password</b></p>
    </div>
  </form>
</div>
<script>
  // When the user clicks anywhere outside of the modal, close it
  var modal = document.getElementById('id05');
  window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  }
  // modal.addEventListener('click', function(event) {
  //   event.stopPropagation()
  // })

  var oldPass = document.getElementById("oldPass");
  var myInput = document.getElementById("psw");
  var letter = document.getElementById("letter");
  var capital = document.getElementById("capital");
  var number = document.getElementById("number");
  var length = document.getElementById("length");
  var space = document.getElementById("space");
  var reold = document.getElementById("reOld");

  // When the user clicks on the password field, show the message box
  myInput.onfocus = function() {
    document.getElementById("message").style.display = "block";
    document.getElementById("informNew").style.display = "block";
  }
  // When the user clicks outside of the password field, hide the message box
  myInput.onblur = function() {
    document.getElementById("message").style.display = "none";
    document.getElementById("informNew").style.display = "none";
  }
  // When the user starts to type something inside the password field
  myInput.onkeyup = function() {
    // Validate lowercase letters
    var lowerCaseLetters = /[a-z]/g;
    if (myInput.value.match(lowerCaseLetters)) {
      letter.classList.remove("invalid");
      letter.classList.add("valid");
    } else {
      letter.classList.remove("valid");
      letter.classList.add("invalid");
    }

    // Validate capital letters
    var upperCaseLetters = /[A-Z]/g;
    if (myInput.value.match(upperCaseLetters)) {
      capital.classList.remove("invalid");
      capital.classList.add("valid");
    } else {
      capital.classList.remove("valid");
      capital.classList.add("invalid");
    }

    // Validate numbers
    var numbers = /[0-9]/g;
    if (myInput.value.match(numbers)) {
      number.classList.remove("invalid");
      number.classList.add("valid");
    } else {
      number.classList.remove("valid");
      number.classList.add("invalid");
    }

    var white = /^\S*$/;
    if (myInput.value.match(white)) {
      space.classList.remove("invalid");
      space.classList.add("valid");
    } else {
      space.classList.remove("valid");
      space.classList.add("invalid");
    }

    // Validate length
    if (myInput.value.length >= 8) {
      length.classList.remove("invalid");
      length.classList.add("valid");
    } else {
      length.classList.remove("valid");
      length.classList.add("invalid");
    }

    if (myInput.value != oldPass.value) {
      reold.classList.remove("invalid");
      reold.classList.add("valid");
    } else {
      reold.classList.remove("valid");
      reold.classList.add("invalid");
    }

  }

  /*for confirm password */
  var confirmPass = document.getElementById("confirm");
  confirmPass.onfocus = function() {
    document.getElementById("inform").style.display = "block";
  }
  // When the user clicks outside of the password field, hide the message box
  confirmPass.onblur = function() {
    document.getElementById("inform").style.display = "none";
  }
  var check = function() {
    if (myInput.value == confirmPass.value) {
      document.getElementById('inform').style.color = 'blue';
      document.getElementById('inform').innerHTML = 'Password matching';
    } else {
      document.getElementById('inform').style.color = 'red';
      document.getElementById('inform').innerHTML = 'Password not matching';
    }
  }
</script>