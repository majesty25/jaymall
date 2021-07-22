<?php
session_start();


if ($_SESSION['first_name'] and $_SESSION['last_name'] and $_SESSION['index']) {

  $first_name = $_SESSION['first_name'];
  $last_name = $_SESSION['last_name'];
  $index = $_SESSION['index'];
} else {
  header("location:logout.php");
}  

// $_SESSION['index'] = $ID;

$_SESSION['index'] = $index;
$_SESSION['first_name'] = $first_name;
$_SESSION['last_name'] = $last_name;



?>








<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style>
    body {
      font-family: Arial;
      font-size: 17px;
      padding: 8px;
    }

    * {
      box-sizing: border-box;
    }

    .row {
      display: -ms-flexbox;
      /* IE10 */
      display: flex;
      -ms-flex-wrap: wrap;
      /* IE10 */
      flex-wrap: wrap;
      margin: 0 -16px;
    }

    .col-25 {
      -ms-flex: 25%;
      /* IE10 */
      flex: 25%;
    }

    .col-50 {
      -ms-flex: 50%;
      /* IE10 */
      flex: 50%;
    }

    .col-75 {
      -ms-flex: 60%;
      /* IE10 */
      flex: 60%;
    }

    .col-25,
    .col-50,
    .col-75 {
      padding: 0 16px;
    }

    li {
      line-height: 30px;
    }

    .container {
      background-color: #f2f2f2;
      padding: 5px 20px 15px 20px;
      border: 1px solid lightgrey;
      border-radius: 3px;
    }

    input[type=text] {
      width: 100%;
      margin-bottom: 20px;
      padding: 12px;
      border: 1px solid #ccc;
      border-radius: 3px;
    }

    label {
      margin-bottom: 10px;
      display: block;
    }

    .icon-container {
      width: 100%;
      margin-bottom: 20px;
      padding: 7px 0;
      font-size: 24px;
    }

    #cvv {
      width: 45%;
      height: 40px;
    }

    b {
      color: red;
    }

    .btn {
      background-color: crimson;
      color: white;
      padding: 12px;
      margin: 10px 0;
      border: none;
      width: 100%;
      border-radius: 3px;
      cursor: pointer;
      font-size: 17px;
    }

    #vodafone {
      margin-left: 15%;
    }

    .btn:hover {
      background-color: crimson;
    }

    a {
      color: #2196F3;
    }

    hr {
      border: 1px solid lightgrey;
    }

    span.price {
      float: right;
      color: grey;
    }

    img {
      width: 100%;
    }

    @media (max-width: 800px) {
      .row {
        flex-direction: column-reverse;
      }

      .col-25 {
        margin-bottom: 20px;
      }

      @media screen and (max-width: 600px) {
        .container {
          width: 100%;
        }
      }


    }

    @media screen and (min-width: 700px) {
      img {
        width: 50%;
      }

      .icon-container {
        width: 100%;
      }
    }
  </style>
</head>

<body>

  <h2>Make Payment</h2>
  <div class="row">
    <div class="col-75">
      <div class="container">
        <form action="payment.php" method="post">

          <div class="row">


            <div class="col-50">
              <h3>Payment</h3>
              <label for="fname">Accepted Payment methhods</label>
              <!-- <ul>
                <li>MTN Mobile Money</li>
                <li>AirtelTigo Cash</li>
                <li>Vodafone Cash</li>
              </ul> -->
              <div class="icon-container">

                <img src="font/payment.png" alt="" srcset="">
              </div>
              <label for="cname">Associated name</label>
              <input type="text" id="cname" name="cardname" placeholder="John More Doe">
              <label for="ccnum">Phone number</label>
              <input type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444">
              <!-- <label for="expmonth">Exp Month</label> -->
              <!-- <input type="text" id="expmonth" name="expmonth" placeholder="September"> -->
              <div class="row">
                <div class="col-50">
                  <label for="expyear">Enter Amount</label>
                  <input type="text" id="expyear" name="expyear" placeholder="2018">
                </div>
                <div class="col-50">
                  <label for="cvv">Network</label>
                  <select id="cvv" name="">
                    <option value="">MTN</option>
                    <option value="">AirtelTigo</option>
                    <option value="">Vodafone</option>
                  </select>
                  <!-- <input type="text" id="cvv" name="cvv" placeholder="352"> -->
                </div>
              </div>
            </div>

          </div>
          <label>
            <input type="checkbox" checked="checked" name="sameadr"> Shipping address same as billing
          </label>
          <input type="submit" value="I have made complete payment" class="btn" name="order">

        </form>
        <form action="Homepage.php" method="post">
          <input type="submit" value="Continue shopping" class="btn" name="order">
        </form>
      </div>
    </div>
    <div class="col-25">
      <div class="container">
        <h4><button>MTN</button>
          <button id="vodafone">AirtelTigo</button>
          <span class="price" style="color:black"></i> <b>
              <button>Vodafone</button></b></span>
        </h4>
        <div id="mtn-procedure">

          <ol>
            <li>Dial *170#</li>
            <li>Choose option 1 - Transfer Money</li>
            <li>The choose option 1 - MoMo User</li>
            <li>Enter the mobile number: <b>0555089255</b></li>
            <li>Repeat the mobile number: <b>0555089255</b></li>
            <li>Enter Amount <b>(The amount must be greater than or the same as the total price
                of your carts. If the amount is greater, the remaining amount will be in your prepaid account)</b></li>
            <li>Enter this reference code: <b> fr28spLdj </b></li>
            <li>The name associated with this MTN MoMo account number is: <b> STEPHEN NYANKSON </b></li>
            <li>Click on <b>I have made complete payment</b> after complete payment is made</li>
          </ol>


          <!-- <p>Total <span class="price" style="color:black"><b>$30</b></span></p> -->
        </div>
      </div>
    </div>
  </div>

</body>

</html>


<?php

include('config.php');

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$cart = "SELECT * FROM carts WHERE User_id = '{$index}'";

$carts = $conn->query($cart);


$OrderId = rand(10000000000, 99999999999);
$s = 10;
$date = date("Y/m/D");
// echo($date);

if ($carts->num_rows > 0) {
  while ($CART = $carts->fetch_assoc()) {
    $Name = $CART['Item_name'];
    $Pic = $CART['Pic_name'];
    $Price = $CART['Price'];
    $Status = "Pending";
    $ItemId = $CART['Item_id'];
    $Quanti = $CART['Quantity'];
    $Item_index = $CART['Item_index'];
    $IndexNum = $CART['Index_Num'];
    // $date = $CART['Order_date'];
    $Size =  $CART['Size'];
    // echo($Name);
    if (isset($_REQUEST['order'])) {
      $Order = "INSERT INTO order_table (User_id, Order_id, Item_id, Item_name, Pic_name, Order_date, Delivery_period, Order_status, Quantity, Size)
                VALUES('{$index}', '{$OrderId}', '{$ItemId}', '{$Name}',  '{$Pic}', '{$date}', '{$date}', '{$Status}', '{$Quanti}', '{$Size}')";

      // $ord = $conn->query($Order);
      if ($conn->query($Order) === TRUE) {
        // echo "New record created successfully";
      } else {
        echo "Error: " . "" . "<br>" . $conn->error;
      }

      // $conn->close();
      // echo($index);
      // $conn->close();
    }
  }
}



?>