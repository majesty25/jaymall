<?php

$servername = "localhost";
$username = "Majesty";
$password = "JOE892550.bitcoin";
$dbname = "majesty_store";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$servername = "localhost";
$username = "Majesty";
$password = "JOE892550.bitcoin";
$dbname = "majesty_store";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

?>

















<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
<style>
  * {
    box-sizing: border-box;
    font-family:candara, calibri, 'Courier New', Courier, monospace;
  }

  body {
    background-color: #f1f1f1;
  }

  a {
    text-decoration: none;
    color: rgb(255, 1, 81);
  }

  #regForm {
    background-color: #ffffff;
    margin: 100px auto;
    font-family: Raleway;
    padding: 40px;
    width: 70%;
    min-width: 300px;
  }

  h1 {
    text-align: center;
  }

  input {
    padding: 10px;
    width: 100%;
    font-size: 17px;
    font-family: Raleway;
    border: 1px solid #aaaaaa;
  }


  #Region {
    width: 50%;
    height: 45px;
    font-size: 17px;
  }

  /* Mark input boxes that gets an error on validation: */
  input.invalid {
    background-color: rgb(255, 241, 241);
  }

  /* Hide all steps by default: */
  .tab {
    /* display: none; */
  }

  button {
    background-color: rgb(255, 1, 81);
    color: #ffffff;
    border: none;
    padding: 10px 20px;
    font-size: 17px;
    font-family: Raleway;
    margin-top: 30px;
    cursor: pointer;
  }

  button:hover {
    opacity: 0.8;
  }

  #prevBtn {
    background-color: #bbbbbb;
  }

  /* Make circles that indicate the steps of the form: */
  .step {
    height: 15px;
    width: 15px;
    margin: 0 2px;
    background-color: #bbbbbb;
    border: none;
    border-radius: 50%;
    display: inline-block;
    opacity: 0.5;
  }

  .step.active {
    opacity: 1;
  }

  /* Mark the steps that are finished and valid: */
  .step.finish {
    background-color: rgb(255, 1, 81);
  }

  @media screen and (max-width: 600px) {
    #regForm {
      width: 100%;
      padding: 20px;
      margin: 0px;
    }
  }
</style>

<body>

  <form id="regForm" action="" method="post">
    <h3>Sign Up:</h3>
    <!-- One "tab" for each step in the form: -->
    <div class="tab">Name:
      <p><input placeholder="First name..." oninput="this.className = ''" name="fname"></p>
      <p><input placeholder="Last name..." oninput="this.className = ''" name="lname"></p>
    </div>
    <div class="tab">Contact Info:
      <p><input placeholder="E-mail..." oninput="this.className = ''" name="email"></p>
      <p><input placeholder="Phone..." oninput="this.className = ''" name="phone"></p>
    </div>
    <div class="tab">Address:
      <!-- <p><input placeholder="Regoin" oninput="this.className = ''" name="region"></p> -->
      <!-- <select name="regin" id="Region" oninput="this.className = ''">
        <option value="Central">Central</option>
        <option value="Ashanti">Ashanti</option>
        <option value="Western">Western</option>
        <option value="Northern">Northern</option>
      </select> -->
      <p><input placeholder="City" oninput="this.className = ''" name="Hall/Hostel"></p>
      <p><input placeholder="Room number" oninput="this.className = ''" name="address"></p>
      <!-- <p><input placeholder="Residential address" oninput="this.className = ''" name="yyyy"></p> -->
    </div>
    <div class="tab">Enter new password:
      <p><input placeholder="Password..." oninput="this.className = ''" name="password" type="password"></p>
      <p><input placeholder="Confirm password..." oninput="this.className = ''" name="pword" type="password"></p>
      <input style="background-color: rgb(255, 1, 81); color: white" name="signup" type="submit" value="Submit">
    </div>
    <div style="overflow:auto; margin-top: 10px;">
      <div>Already have an account? <a href="login.php">Sign in</a></div>
      <div style="float:right;">
        <!-- <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button> -->
        <!-- <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button> -->
      </div>
    </div>
    <!-- Circles which indicates the steps of the form: -->
    <!-- <div style="text-align:center;margin-top:40px;">
      <span class="step"></span>
      <span class="step"></span>
      <span class="step"></span>
      <span class="step"></span>
    </div> -->
  </form>

  <!-- <script>
    var currentTab = 0; // Current tab is set to be the first tab (0)
    showTab(currentTab); // Display the current tab

    function showTab(n) {
      // This function will display the specified tab of the form...
      var x = document.getElementsByClassName("tab");
      x[n].style.display = "block";
      //... and fix the Previous/Next buttons:
      if (n == 0) {
        document.getElementById("prevBtn").style.display = "none";
      } else {
        document.getElementById("prevBtn").style.display = "inline";
        document.getElementById("nextBtn").style.display = "inline";
      }
      if (n == (x.length - 1)) {
        document.getElementById("nextBtn").innerHTML = "Submit";
        document.getElementById("nextBtn").style.display = "none";
      } else {
        document.getElementById("nextBtn").innerHTML = "Next";
      }
      //... and run a function that will display the correct step indicator:
      fixStepIndicator(n)
    }

    function nextPrev(n) {
      // This function will figure out which tab to display
      var x = document.getElementsByClassName("tab");
      // Exit the function if any field in the current tab is invalid:
      if (n == 1 && !validateForm()) return false;
      // Hide the current tab:
      x[currentTab].style.display = "none";
      // Increase or decrease the current tab by 1:
      currentTab = currentTab + n;
      // if you have reached the end of the form...
      if (currentTab >= x.length) {
        // ... the form gets submitted:
        document.getElementById("regForm").submit();
        return false;
      }
      // Otherwise, display the correct tab:
      showTab(currentTab);
    }

    function validateForm() {
      // This function deals with validation of the form fields
      var x, y, i, valid = true;
      x = document.getElementsByClassName("tab");
      y = x[currentTab].getElementsByTagName("input");
      // A loop that checks every input field in the current tab:
      for (i = 0; i < y.length; i++) {
        // If a field is empty...
        if (y[i].value == "") {
          // add an "invalid" class to the field:
          y[i].className += " invalid";
          // and set the current valid status to false
          valid = false;
        }
      }
      // If the valid status is true, mark the step as finished and valid:
      if (valid) {
        document.getElementsByClassName("step")[currentTab].className += " finish";
      }
      return valid; // return the valid status
    }

    function fixStepIndicator(n) {
      // This function removes the "active" class of all steps...
      var i, x = document.getElementsByClassName("step");
      for (i = 0; i < x.length; i++) {
        x[i].className = x[i].className.replace(" active", "");
      }
      //... and adds the "active" class on the current step:
      x[n].className += " active";
    }
  </script> -->

</body>

</html>








<?php

if (isset($_POST['signup'])) {
  $First_Name = $_POST['fname'];
  $Last_Name = $_POST['lname'];
  $Email = $_POST['email'];
  $Phone = $_POST['phone'];
  $Region = $_POST['regin'];
  $City = $_POST['city'];
  $Address = $_POST['address'];
  $Pword = $_POST['password'];
  // $First_Name = $_POST['fname'];



  $insert = "INSERT INTO user 
  (First_name, Last_name, Email, phone, Regoin, City,  Residential_address, Password)
  VALUES('{$First_Name}', '{$Last_Name}', '{$Email}', '{$Phone}', '{$Region}', '{$City}', '{$Address}', '{$Pword}')";

  // $conn->query($insert);

  if ($conn->query($insert) === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  $conn->close();
}


?>