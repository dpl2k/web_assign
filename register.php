<div id="id02" class="myModal">
  <form autocomplete="off" class="myContent animate" action="./signup_processing.php" method="post">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
      <!-- <img src="image/logo.svg" alt="Avatar" class="avatar"> -->
      <h3 class="text-dark">Create an account!</h3>
    </div>

    <div class="container">
      <p>
        <?php
        if (isset($_SESSION["error"])) {
          echo "<div style='color:red'>" . $_SESSION["error"] . "</div>";
          unset($_SESSION["error"]);
        }
        if (isset($_SESSION["success"])) {
          echo "<div style='color:blue'>" . $_SESSION["success"] . "</div>";
          unset($_SESSION["success"]);
        }
        ?>
        <label for="name"><b>Username</b></label>
        <label id="uname" class="float-right"></label>
        <input onkeyup='uname();' type="text" placeholder="Enter username" id="username" name="username" title="Username only contain letters, numbers and underscore" value="<?php if (isset($_POST['submit1'])) echo $_POST['username']; ?>" required>
      </p>
      <p>
        <label for="e-mail"><b>Email</b></label>
        <label id="mail" class="float-right"></label>
        <input onkeyup='ver();' type="text" placeholder="Enter email" id="email" name="email" title="Enter your email address" required>
      </p>
      <p>
        <label for="psw"><b>Password</b>
        </label>
        <input required type="password" placeholder="Enter Password" id="psw" name="psw" title="Must contain at least 8 characters, an uppercase, an lowercase and a number">
      </p>
      <p>
        <label for="psw"><b>Confirm password</b></label>
        <label class="float-right" id='inform'></label>
        <input required id="confirm" type="password" name="confirm_password" placeholder="Confirm Password" onkeyup='check();'>
      </p>

      <input class="lo btn-primary" type="submit" name="submit1" value="Sign up">
      <label>
        <p>Already have an account? <a style="color:darkblue" href="index/login.html">
            Login</a>.</p>
      </label>
    </div>

    <!-- <div id="name">
		<h4>Username must be in correct form of email address</h4> 
		<p id="mail" class="invalidname"></p>
		</div> -->

    <div id="message">
      <h4>Password must contain the following:</h4>
      <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
      <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
      <p id="number" class="invalid">A <b>number</b></p>
      <p id="length" class="invalid">Minimum <b>8 characters</b></p>
      <p id="space" class="valid"> No <b>white space</b></p>
    </div>
  </form>
</div>
<script>
  // When the user clicks anywhere outside of the modal, close it
  var modal = document.getElementById('id02');
  window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  }
  // modal.addEventListener('click', function(event) {
  //   event.stopPropagation()
  // })

  /*for username */
  var username = document.getElementById("username");
  /*for display message for username */
  username.onfocus = function() {
    document.getElementById("uname").style.display = "block";
  }
  // When the user clicks outside of the password field, hide the message box
  username.onblur = function() {
    document.getElementById("uname").style.display = "none";
  }
  const regx = /^[a-zA-Z0-9_]*$/;
  var uname = function() {
    if (regx.test(username.value)) {
      document.getElementById('uname').style.color = 'blue';
      document.getElementById('uname').innerHTML = 'Username: correct format';
    } else {
      document.getElementById('uname').style.color = 'red';
      document.getElementById('uname').innerHTML = 'Username: incorrect format';
    }
  }

  /*for email */
  var email = document.getElementById("email");
  /*for display message for username */
  email.onfocus = function() {
    document.getElementById("mail").style.display = "block";
  }
  // When the user clicks outside of the password field, hide the message box
  email.onblur = function() {
    document.getElementById("mail").style.display = "none";
  }
  const reg = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  var ver = function() {
    if (reg.test(email.value)) {
      document.getElementById('mail').style.color = 'blue';
      document.getElementById('mail').innerHTML = 'Email: correct format';
    } else {
      document.getElementById('mail').style.color = 'red';
      document.getElementById('mail').innerHTML = 'Email: incorrect format';
    }
  }
  // $('#psw, #confirm_password').on('keyup', function () {
  //   if ($('#psw').val() == $('#confirm_password').val()) {
  //     $('#inform').html('Matching').css('color', 'green');
  //   } else 
  //     $('#inform').html('Not Matching').css('color', 'red');
  // });

  var myInput = document.getElementById("psw");
  var letter = document.getElementById("letter");
  var capital = document.getElementById("capital");
  var number = document.getElementById("number");
  var length = document.getElementById("length");
  var space = document.getElementById("space");

  // When the user clicks on the password field, show the message box
  myInput.onfocus = function() {
    document.getElementById("message").style.display = "block";
    document.getElementById("passErr").style.display = "none";
  }
  // When the user clicks outside of the password field, hide the message box
  myInput.onblur = function() {
    document.getElementById("message").style.display = "none";
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
  }

  /*for confirm password */
  var confirmPass = document.getElementById("confirm");
  confirmPass.onfocus = function() {
    document.getElementById("inform").style.display = "block";
    document.getElementById("conErr").style.display = "none";
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