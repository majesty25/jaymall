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


include('config.php');

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="homepage.css">
    <link rel="stylesheet" href="orderlist.css">
    <script src='fontawesome-free-5.13.0-web/js/all.js'></script>
    <!-- <link rel="stylesheet" href="fontawesome-free-5.13.0-web/css/all.css"> -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="jquery.js"></script>
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="jquery.js"></script>
    <title>Document</title>
    <!-- <script src="javascript.js"></script> -->




    <script>
        function openNav() {
            document.getElementById("sidenav").style.width = "250px";
        }

        function closeNav() {
            document.getElementById("sidenav").style.width = "0px";
        }

        function openCategory() {
            var categoryPanel = document.getElementById("category_panel");
            categoryPanel.style.display = "block";

        }

        function closeCategory() {
            var categoryPanel = document.getElementById("category_panel");
            categoryPanel.style.display = "none";

        }

        function showFassionSub() {
            var subCategory = document.getElementById("fassion_sub_category");
            var categoryPanel = document.getElementById("category_panel");
            subCategory.style.display = "block";
            categoryPanel.style.display = "block"
        }

        function hideFassionSub() {
            var subCategory = document.getElementById("fassion_sub_category");
            var categoryPanel = document.getElementById("category_panel");
            subCategory.style.display = "none";
            categoryPanel.style.display = "none"
        }

        window.onscroll = function() {
            var disappear = document.getElementById("searchSmallScreen");
            var disappear1 = document.getElementById("searchLargeScreen");
            if (window.pageYOffset >= 10) {

                disappear.style.display = "none";
                disappear1.style.display = "none";
                // window.onscroll = null;
                // alert("Into view");
            } else if (window.pageXOffset <= 10) {
                disappear.style.display = "block";
                disappear1.style.display = "block";
            }
        }

        function openUser() {
            var categoryPanel = document.getElementById("user_panel");
            categoryPanel.style.display = "block";

        }

        function closeUser() {
            var categoryPanel = document.getElementById("user_panel");
            categoryPanel.style.display = "none";

        }
    </script>
</head>

<body>
    <header>
        <form action="Homepage.php">
            <button type="submit" id="openNav_SmallDevice"><i style="font-size: 21px;" class="fa fa-home"></i></button>
        </form>
        <div id="sidenav" class="SideNav">
            <div onclick="closeNav()" id="closeNav">&times;</div>

            <div id="head">
                <h3>CATEGORIES</h3>
            </div>
            <form action="category.php" method="POST">
                <button name="fassion" id="category_list" type="submit"><i class='fas fa-tshirt'></i> Fassion</li></button>
                <button id="category_list" type="submit"><i class='fas fa-desktop'></i> Computers</li></button>
                <button id="category_list" type="submit"><i class='fas fa-bolt'></i> Electronics</li></button>
                <button id="category_list" type="submit"><i class='fas fa-utensils'></i> Utensils</li></button>
            </form>
            <form action="viewCart.php" method="POST">
                <button id="category_list" type="submit"><i class='fas fa-eye'></i> View carts</li> </button>
            </form>
        </div>


        <div id="category_panel" onmouseout="closeCategory()" onmouseover="openCategory()">
            <i id="arrow1-up" class="fas fa-caret-up"></i>
            <div class="head">
                <h3>HELP</h3>
            </div>
            <form action="category.php" method="POST">
                <button name="fassion" onmouseover="showFassionSub()" onmouseout="hideFassionSub()" id="help_list" type="submit"><i class='fas fa-tshirt'></i>Contact us</button>
                <!-- <button name="computers" id="help_list" type="submit"><i class='fas fa-desktop'></i> FAQ</button> -->
                <button name="electronics" id="help_list" type="submit"><i class='fas fa-bolt'></i> Leave message</button>
                <button name="electronics" id="help_list" type="submit"><i class='fas fa-bolt'></i> About us</button>
                <button name="food" class="chat" type="submit"><i class='fas fa-utensils'></i> Live chat</button>
                <!-- <button id="help_list" type="submit"><i class='fas fa-eye'></i> View carts</button> -->
            </form>

        </div>
        <!-- 
        <div id="fassion_sub_category" onmouseover="showFassionSub()" onmouseout="hideFassionSub()">
            <button id="category_sub_list" type="submit">▣ Men</button>
            <button id="category_sub_list" type="submit">▣ Women</button>
            <button id="category_sub_list" type="submit">▣ Boys</button>
            <button id="category_sub_list" type="submit">▣ Girls</button>
        </div> -->


        <div>
            <a href="Homepage.php"><img id="logo" src="font/Jaymall2.png" alt="" srcset=""></a>
        </div>
        <!-- <div id="searchLargeScreen"> -->


        <form autocomplete="off" action="/action_page.php">
            <div class="autocomplete">
                <input id="myInput" type="text" name="myCountry" placeholder="What are you looking for?">
            </div>
            <input id="search-submit" type="submit" value="Search">
        </form>


        <div onmouseover="openCategory()" onmouseout="closeCategory()" id="openNav_LargeDevice"><i style="font-size: 14px;" class="fas fa-question-circle"></i> Help <i style="margin-top: 3px; font-size: 16px" class="fas fa-chevron-down "></i></div>

        <!-- <div id="login">Log In</div> -->
        <div id="user" onmouseover="openUser()" onmouseout="closeUser()"> <i class="far fa-user"></i> <i style="font-size: 14px" class="fas fa-chevron-down "></i></div>



        <div id="user_panel" onmouseout="closeUser()" onmouseover="openUser()">
            <i id="arrow-up" class="fas fa-caret-up"></i>
            <div class="head">
                <h5><?php echo (" " . $first_name . " " . $last_name);  ?></h5>
            </div>
            <form action="account.php" method="POST">
                <button name="fassion" id="user_list" type="submit"><i style="margin-right: 15px;" class='far fa-user'></i> Account</button>
            </form>
            <form action="orderlist.php" method="POST">
                <button name="computers" id="user_list" type="submit"><i style="margin-right: 15px;" class='fas fa-store-alt'></i> My Orders</button>
            </form>
            <button name="electronics" id="user_list" type="submit"><i style="margin-right: 15px;" class='far fa-heart'></i> Saved items</button>
            <form method="post">
                <button id="user_list" name="logout" type="submit"><i style="margin-right: 15px;" class='fas fa-sign-out-alt'></i> Log out</button>
                <?php

                if (isset($_REQUEST['logout'])) {

                    header('location:logout.php');
                    unset($_SESSION['first_name']);
                    unset($_SESSION['last_name']);
                    unset($_SESSION['index']);
                    echo "<script>window.location = 'Homepage.php' </script>";
                }

                // 
                ?>
            </form>

        </div>





        <form id="fa-cart" action="viewCart.php" method="post">
            <button id="fa-btn" type="submit"><i class="fas fa-cart-plus"></i> <sup>

                    <?php
                    $total = "SELECT count(Price) as price FROM carts WHERE User_id = '{$index}'";
                    $Totals = $conn->query($total);
                    if ($Totals->num_rows > 0) {
                        while ($Fetch = $Totals->fetch_assoc()) {
                            $TOTAL = $Fetch['price'];
                            echo ($TOTAL);
                        }
                    }

                    ?>


                </sup></button>
        </form>




    </header>
    <br><br><br>

    <div class="space"></div>

    <div id="cart-Num">My Orders</div>

    <?php

    $Order = "SELECT * FROM order_table WHERE User_id = '{$index}' ORDER BY Index_Num DESC";
    $order = $conn->query($Order);

    if ($order->num_rows > 0) {
        while ($ORDERS = $order->fetch_assoc()) {
            $OrderId = $ORDERS['Order_id'];
            $img = $ORDERS['Pic_name'];
            $Name = $ORDERS['Item_name'];
            $Quantity = $ORDERS['Quantity'];
            $Size = $ORDERS['Size'];
            $OrderStatus = $ORDERS['Order_status'];
            $OrderDate = $ORDERS['Order_date'];
            $Status = $ORDERS['Order_status'];



    ?>

            <div class="cart">
                <div class="order-Id">
                    <div id="order-Id"> Order ID: <?php echo ($OrderId); ?></div>
                    <div id="date"> <?php echo ($OrderDate); ?></div>
                </div>
                <div id="Picture">
                    <img class="Picture" src="font/<?php echo ($img); ?>" alt="" srcset="">
                </div>
                <div id="Name">
                    <?php echo ($Name); ?><div style="font-size: 14px" id="small-price"></div><br><br>
                    <div id="Qty">X<?php echo ($Quantity); ?></div>
                    <div id="size"> size: <?php echo ($Size); ?></div>
                    <div id="link"><i class="fab fa-staylinked"></i> view</div>

                </div>

                <div id="Status"><button id="Small-Remove"><?php echo ($Status); ?></button></div>



                <!-- <div id="Remove"></div> -->

            </div>




    <?php

        }
    } else {
        echo ("<h3 style='text-align: center;'>You have no order </h3>");
    }

    ?>

    <br><br>



    <!-- <div class="checkout">
        <form action="payment.php" method="post">
            <div id="prepaid">Majesty prepaid: GHS 12.90</div>
            <div id="total">Total: GHS 475.00</div>

            <div id="checkout"><button id="checkout-button" type="submit">CHECKOUT</button></div>
        </form>

    </div> -->
</body>

</html>

<?php
include('footer.html');
?>