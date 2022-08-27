<a data-toggle="modal" data-target="#manage_teacher" class="btn btn-primary bt-sm" id="new_teacher">
  <i class="fa fa-plus"></i> Add New Teacher
</a>
<br>
<br>
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
<div class="card-body shadow p-3 mb-5">
  <h3 style="margin-bottom:10px" class="card-header bg-primary text-light rounded-top">Teacher list</h3>
  <div class="table-responsive">
    <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
      <thead class="text-dark bg-light">
        <tr>
          <th class="th-sm">Account ID</th>
          <th class="th-sm">Username</th>
          <th class="th-sm">Email</th>
          <th class="th-sm">Create Day</th>
        </tr>
      </thead>
      <tbody>
        <?php
        require_once("../connection.php");
        $sql_select = "SELECT * FROM account WHERE role='teacher' order by accountID desc";
        $result = $conn->query($sql_select);
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
        ?>
            <tr>
              <td><?= $row['accountID'] ?></td>
              <td><?= $row['username'] ?></td>
              <td><?= $row['email'] ?></td>
              <td><?= $row['createDAY'] ?></td>

            </tr>
        <?php }
        } ?>
      </tbody>
    </table>
  </div>
</div>

<div class="modal fade" id="manage_teacher" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-centered" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h4 class="modal-title" id="myModallabel">Add New Teacher</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <form method='post' id='teacher-frm' action='./teacher_account_processing.php'>
        <div class="modal-body">
          <div id="msg"></div>
          <div class="form-group">
            <label for="name">Username</label>
            <label id="uname" class="float-right"></label>
            <input onkeyup='uname();' type="text" placeholder="Enter Username" id="username" name="username" class="form-control" title="Username only contain letters, numbers and underscore" value="<?php if (isset($_POST['submit1'])) echo $_POST['username']; ?>" required>
          </div>
          <div class="form-group">
            <label for="psw">Password</label>
            <input required type="password" placeholder="Enter Password" id="psw" name="psw" class="form-control" title="Must contain at least 8 characters, an uppercase, an lowercase and a number">
          </div>
          <div class="form-group">
            <label for="psw">Confirm password</label>
            <label class="float-right" id='inform'></label>
            <input required id="confirm" type="pasword" name="confirm_password" placeholder="Confirm Password" class="form-control" onkeyup='check();'>
          </div>
          <div class="form-group">
            <label for="e-mail">Email</label>
            <label id="mail" class="float-right"></label>
            <input onkeyup='ver();' type="text" placeholder="Enter Email" id="email" name="email" class="form-control" title="Enter your email address" required>
          </div>
        </div>
        <div class="modal-footer">
          <input class="btn btn-primary" name="save" type="submit" value="Save">
        </div>

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
  </div>
</div>



<script>
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
  ////////////////////////////
  $(document).ready(function() {
    $('#dataTable').dataTable({
      "lengthMenu": [
        [5, 10, 25, 50, -1],
        [5, 10, 25, 50, "All"]
      ]
    });
  });
</script>

<?php $conn->close(); ?>