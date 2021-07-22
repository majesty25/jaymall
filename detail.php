<?php
session_start();
if ($_SESSION['first_name'] and $_SESSION['last_name'] and $_SESSION['index']) {

    $first_name = $_SESSION['first_name'];
    $last_name = $_SESSION['last_name'];
    $index = $_SESSION['index'];
} else {
    header("location:logout.php");
}

$_SESSION['index'] = $index;
$_SESSION['first_name'] = $first_name;
$_SESSION['last_name'] = $last_name;




$x = 1;
global $index;
while ($x <= 50) {
    // echo "The number is: $x <br>";
    if (isset($_POST[$x])) {
        $index0 = $x;
        $_SESSION['index2'] = $index0;

        // echo $index;
    }
    $x++;
}

include('config.php');

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$index2 = $_SESSION['index2'];

$recommend = "SELECT * FROM item";
$detail = "SELECT * FROM item where Index_Num = {$index2}";
$res = $conn->query($recommend);
$res1 = $conn->query($detail);
// global $ID;
if ($res1->num_rows > 0) {
    while ($Row = $res1->fetch_assoc()) {
        $ID = $Row['Item_id'];
        $ItemIndex = $Row['Index_Num'];
        $Name = $Row['Item_name'];
        $New_Price = $Row['Item_new_price'];
        $y = ($Row["Item_percent_off"] / 100) * $New_Price;
        $old_price = round(($Row["Item_new_price"] + $y), 0);
        $img = $Row['Item_image_name'];
        // $img = "hjjj";
        $Starf_Num = $Row['Starf_Num'];
        $Star_Num = $Row['Star_Num'];
        $Percent_Off = $Row['Item_percent_off'];
        // $it_id = $_REQUEST[$ID];
        $_SESSION['INDEX'] = $ItemIndex;
        $_SESSION['ID'] = $ID;
        $_SESSION['NAME'] = $Name;
        $_SESSION['PRICE'] = $New_Price;
        $_SESSION['PIC_NAME'] = $img;
        $_SESSION['STATUS'] = "in stock";
        // echo($ID);




        $Item_description = "SELECT Item_description FROM item_detail where Item_id = '{$ID}'";
        $description = $conn->query($Item_description);


        $Item_specification = "SELECT Spec_name, Spec_value FROM specification where Item_id = '{$ID}'";
        $specification = $conn->query($Item_specification);

        $Key_feature = "SELECT Key_feature,Feature_value FROM key_features where Item_id = '{$ID}'";
        $feature = $conn->query($Key_feature);


        $Item_package = "SELECT Package, Quantity FROM package where Item_id = '{$ID}'";
        $package = $conn->query($Item_package);

        $Item_size = "SELECT * FROM item_size where Item_id = '{$ID}'";
        $size = $conn->query($Item_size);

        $Color = "SELECT * FROM item_colour where Item_id = '{$ID}'";
        $color = $conn->query($Color);
    }
} else {
    echo ("0 result");
}


//
$IndexNum = $_SESSION['INDEX'];
$Id = $_SESSION['ID'];
$Name = $_SESSION['NAME'];
$Price = $_SESSION['PRICE'];
$PicName = $_SESSION['PIC_NAME'];
$Status = $_SESSION['STATUS'];

if (isset($_REQUEST['add'])) {
    $Size = $_REQUEST['Size'];
    $_SESSION['size'] = $Size;
    $Colour = $_REQUEST['Colour'];
    $_SESSION['color'] = $Colour;
    $Qty = $_REQUEST['Quantity'];
    $insert = "INSERT INTO carts 
            (User_Id,Item_index, Item_Id, Item_name, Price, Colour, Size, Quantity, Pic_name, Status)
            VALUES('{$index}','{$IndexNum}', '{$Id}', '{$Name}', $Price * $Qty, '{$Colour}', '{$Size}', '{$Qty}' , '{$PicName}', '{$Status}')";

    // $conn->query($insert);

    if ($conn->query($insert) === TRUE) {
        // echo "New record created successfully";
    } else {
        echo "Error: " . "" . "<br>" . $conn->error;
    }

    // $conn->close();
}
// echo($ID);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="homepage.css">
    <link rel="stylesheet" href="detail.css">
    <link rel="stylesheet" href="w3school.css">
    <script src='fontawesome-free-5.13.0-web/js/all.js'></script>
    <link rel="stylesheet" href="fontawesome-free-5.13.0-web/css/all.css">
    <script src="jquery.js"></script>
    <title>Document</title>
    <script src="javascript.js"></script>

    <style>
        body {
            /* background-color: rgb(245, 245, 255); */
        }
    </style>

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

        window.onscroll = function() {
            var disappear1 = document.getElementById("searchSmallScreen");
            var disappearLarge = document.getElementById("searchLargeScreen");
            if (window.pageYOffset > 10) {

                disappear1.style.display = "none";
                disappearLarge.style.display = "none";
                // window.onscroll = null;
                // alert("Into view");
            } else if (window.pageXOffset <= 10) {
                disappear1.style.display = "block";
                disappearLarge.style.display = "block";
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
                    $total = "SELECT COUNT(Price) as price FROM carts WHERE User_id = '{$index}'";
                    $Totals = $conn->query($total);
                    if ($Totals->num_rows > 0) {
                        while ($Fetch = $Totals->fetch_assoc()) {
                            $TOTAL = $Fetch['price'];
                            echo ($TOTAL);
                        }
                    }

                    // $count = "SELECT COUNT(Price) AS price FROM carts WHERE User_id = '{$index}'";
                    // $counts = $conn->query($count);


                    ?>


                </sup></button>
        </form>




    </header>



    <br><br><br>
    <div id="space"></div>
    <div class="AllSections">
        <div class="Sections">
            <div class="main-pic">
                <?php

                $Pics = "SELECT * FROM item where Item_id = $Id";
                $Pic = $conn->query($Pics);
                if ($Pic->num_rows > 0) {
                    while ($PIC = $Pic->fetch_assoc()) {
                        $Pictures = $PIC['Item_image_name'];
                        echo ('<img id="pic1" class="mySlides" src="' . $Pictures . ' " style="width:100%">');
                ?>

                        <!-- <img id="pic1" class="mySlides w3-animate-left" src="font/lap_hp_240_g7_i5_4gb_-_base_3.jpg" style="width:100%">
                <img id="pic1" class="mySlides w3-animate-left" src="font/lap_hp_240_g7_i5_4gb_-_base_4.jpg" style="width:100%">
                <img id="pic1" class="mySlides w3-animate-left" src="font/lap_hp_240_g7_i5_4gb_-_base_5.jpg" style="width:100%"> -->
            </div>
        </div>

<?php

                    }
                }


?>

<div class="Sections2">
    <!-- <div class="card"> -->
    <div id="price-info">

        <div class="name"><?php print($Name); ?></div>
        <div id="favorite"><i onclick="fav(this)" class="fa fa-heart"></i>
            <br><br>
            <div style="font-size: 17px; color: gray;">(34 orders)</div><i style="font-size: 18px;">Item is in stock</i>
        </div>
        <br>

        <div class="new-price">GHS <?php print($New_Price) ?></div>
        <div class="star">
            <?php for ($i = 1; $i <= $Starf_Num; $i++) {
                echo ("&starf;");
            }
            for ($i = 1; $i <= $Star_Num; $i++) {
                echo ("&star;");
            } ?><div class="old-price">GHS <?php print($old_price) ?></div>
        </div>
        <div id="percent-OFF"><?php print($Percent_Off); ?>
            % off</div>
        <!-- <div id="percent-Off"><?php print($Percent_Off); ?>% off</div> -->

        <br>

        <form action="detail.php" method="post">
            <input style="width: 25%; height: 34px; padding: 3px;" type="text" name="Colour" id="COLOR" value="" placeholder="Colour:" required />
            <?php

            if ($color->num_rows > 0) {
                while ($colors = $color->fetch_assoc()) {
                    $Colours = $colors['Item_color'];

                    // print("<input  class='color' name='cala' type='radio' value='{$Colours}' id='CALA' required />" . " ");
                    print("<input name='Colour' type='button' onclick='chooseColour{$Colours}()'  id='label'  class='{$Colours}' value='{$Colours}'>" . " ");


                    // print("<label class='color' for='{$Colours}'>{$Colours}</label> ");
            ?>
                    <script>
                        function chooseColour<?php echo ($Colours); ?>() {
                            document.getElementById('COLOR').value = '<?php echo ($Colours); ?>';
                            // document.getElementById("<?php echo ($Colours); ?>").style.background='blue';
                            console.log('<?php echo ($Colours); ?>');
                        }
                    </script>

            <?php
                }
            } else {
                $Colours = "";
                print($Colours);
            }

            ?>
            <!-- </form>     -->
            <br><br>
            <!-- <form action="detail.php" method="post"> -->
            <input style="width: 25%; height: 34px; padding: 3px;" type="text" name="Size" id="SIZE" value="" placeholder="Size:" required />
            <?php

            if ($size->num_rows > 0) {
                while ($sizes = $size->fetch_assoc()) {
                    $Sizes = $sizes['Item_size'];

                    print("<input type='button' onclick='chooseColour{$Sizes}()'  id='label'  class='{$Sizes}' value='{$Sizes}'>" . " ");





            ?>

                    <script>
                        function chooseColour<?php echo ($Sizes); ?>() {
                            document.getElementById('SIZE').value = '<?php echo ($Sizes); ?>';
                            // document.getElementById("<?php echo ($Sizes); ?>").style.background='blue';
                            console.log('<?php echo ($Sizes); ?>');
                        }
                    </script>

            <?php
                }

                // echo("<br>");

            } else {
                $Sizes = "N/A";
                // print($Sizes);
            }
            ?><button id="size-Chart">Size chart</button>

            <hr>

            QTY: <input type="button" disabled onclick="decreaseQuantity()" id="decrease" value="-">
            <input id="Qty" type="" name="Quantity" value="1">
            <input type="button" onclick="increaseQuantity()" id="increase" value="+">

            <!-- <input type="button" value=""> -->

            <div id="Bottom_Nav">
            </div>

            <button id="buy" type="submit" name="add"><i style='font-size:16px; color: white; float: left;' class='fas fa-cart-plus'></i> ADD TO CART</button>
        </form>


    </div>

    <!-- <div id="status"><b>Status:</b> In stock</div><br> -->
    <hr>

</div>

<?php


$User = "SELECT * FROM user WHERE Index_Num = '{$index}'";
$Users = $conn->query($User);
if ($Users->num_rows > 0) {
    while ($USER = $Users->fetch_assoc()) {
        $FirstName = $USER['First_name'];
        $LastName = $USER['Last_name'];
        $Email = $USER['Email'];
        $Phone = $USER['Phone'];
        $City = $USER['City'];
        $Address = $USER['Residential_address'];
    }
}
$Date = date("Y-m-d");
// echo date('M-D', strtotime($Date . ' + 10 days'));
?>



<div class="Sections3">
    <div class="heading">Delivery infomation</div>
    <hr>
    <i class="fas fa-shipping-fast"></i> Free and fast delivery when you order within Cape Coast.
    <br><br>
    <i class="fas fa-hands"></i> Parcel is deliverd to you at your door step.
    <br><br>
    Estimated time of delivery when you order within 24hrs:
    <b><?php
        echo date('D-d,M', strtotime($Date . ' + 7 days'));
        echo (' to ');
        echo date('D-d,M', strtotime($Date . ' + 10 days'));
        ?></b>
    <br><br>
    <b>Current address:</b>
    <?php echo ($City . ", " . $Address) ?>
</div>



<div class="Sections1">
    <b><?php echo ('Details'); ?></b><br>
    <!-- <div class="card"> -->
    <?php
    // print($Description);


    if ($description->num_rows > 0) {
        while ($descriptions = $description->fetch_assoc()) {
            $Description = $descriptions['Item_description'];
            print($Description);
        }
    } else {
        $Description = "N/A";
        print('');
    }

    ?>

    <!-- </div> -->
</div>


    </div>
    <br>
    <div class="row1">
        <div class="column1">

            <h3>Specifications</h3>

            <?php

            if ($specification->num_rows > 0) {
                while ($specifications = $specification->fetch_assoc()) {
                    $Specification = $specifications['Spec_name'];
                    $Spec_value = $specifications['Spec_value'];
                    $_SESSION['spec'] = $Specification;
                    $_SESSION['spec_value'] = $Spec_value;
                    // $Spec = $_SESSION['spec'];
                    print("<b>" . $Specification . ":</b> " . $Spec_value . "<br>");
                }
            } else {
                $Specification = "N/A";
                print($Specification);
            }

            ?>
            <!-- </div> -->
        </div>

        <div class="column1">
            <h3>Key features</h3>
            <?php



            if ($feature->num_rows > 0) {
                while ($features = $feature->fetch_assoc()) {
                    $Feature = $features['Key_feature'];
                    $Feature_value = $features['Feature_value'];
                    print("<b>" . $Feature . ":</b> " . $Feature_value . "<br>");
                }
            } else {
                $Feature = "N/A";
                print($Feature);
            }

            ?>

            <!-- </div> -->
        </div>

        <div class="column1">
            <!-- <div class="card"> -->
            <h3>The package contains</h3>
            <?php


            if ($package->num_rows > 0) {
                while ($packages = $package->fetch_assoc()) {
                    $Package = $packages['Package'];
                    $Quantity = $packages['Quantity'];
                    print("<b>" . $Package . ":</b> " . $Quantity . "<br>");
                }
            } else {
                $Package = "N/A";
                print($Package);
            }

            ?>
            <!-- </div> -->
        </div>

    </div>

    <?php

    $Pics = "SELECT * FROM extra_pics where Item_id = $Id";
    $Pic = $conn->query($Pics);
    if ($Pic->num_rows > 0) {
        while ($PIC = $Pic->fetch_assoc()) {
            $Pictures = $PIC['Pics'];
            // echo('<img id="pic1" class="mySlides w3-animate-left" src=" '. $Pictures . ' " style="width:100%">');

    ?>


            <div class="large-image"><img id="large-image" src="<?php echo ($Pictures);  ?>" alt="" srcset=""></div>

    <?php

        }
    }


    ?>
    <!-- <div class="large-image"><img id="large-image" src="font/lap_hp_240_g7_i5_4gb_-_base_3.jpg" alt="" srcset=""></div>
    <div class="large-image"><img id="large-image" src="font/lap_hp_240_g7_i5_4gb_-_base_4.jpg" alt="" srcset=""></div>
    <div class="large-image"><img id="large-image" src="font/lap_hp_240_g7_i5_4gb_-_base_5.jpg" alt="" srcset=""></div> -->

    <div id="row">

        <div id="Div">YOU MAY ALSO LIKE</div>

        <?php
        if ($res->num_rows > 0) {
            // output data of each row
            while ($row = $res->fetch_assoc()) {
                $x = ($row["Item_percent_off"] / 100) * $row["Item_new_price"];
                $old_price = $row["Item_new_price"] + $x;

        ?>
                <form action="detail.php" method="POST">
                    <div class="column" id="column">

                        <button type="submit" id="pic" name="<?php echo ($row["Index_Num"]); ?>">
                            <img src="font/<?php echo ($row["Item_image_name"]); ?>" alt="" srcset="">
                        </button>
                        <br>
                        <div id="name">
                            <?php echo ($row["Item_name"]); ?>
                        </div>
                        <br>
                        <div id="price">
                            GH₵ <?php echo ($row["Item_new_price"] + 778); ?>
                        </div>
                        <br>
                        <div id="oldPrice">
                            GH₵ <?php echo ($old_price); ?>
                        </div>
                        <div id="PercentOff">
                            -<?php echo ($row["Item_percent_off"]); ?>%
                        </div>
                        <br>
                        <div id="star">
                            <?php for ($i = 1; $i <= $row["Starf_Num"]; $i++) {
                                echo ("&starf;");
                            }
                            for ($i = 1; $i <= $row["Star_Num"]; $i++) {
                                echo ("&star;");
                            } ?>

                        </div>
                        <div id="rate">
                            (<?php echo ($row["Rate"]); ?>)
                        </div>
                        <br>
                        <div>
                            <button id="ADD">ADD TO CART</button>
                        </div>

                    </div>

            <?php
            }
        } else {
            echo "0 results";
        }
        $conn->close();
            ?>
                </form>

    </div>


</body>

<script>
    var myIndex = 0;
    carousel();

    function carousel() {
        var i;
        let Enabled;
        var x = document.getElementsByClassName("mySlides");
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
        }
        myIndex++;
        if (myIndex > x.length) {
            myIndex = 1
        }
        if (Enabled == true) {
            x[myIndex - 1].style.display = "block";
            setTimeout(carousel, 1000);
        } else {
            x[myIndex - 1].style.display = "block";
            setTimeout(carousel, 6000);
        }
    }
</script>

</html>
<script>
    var counter = 1;
    let count = document.querySelector('#Qty');


    function increaseQuantity() {

        counter++;
        count.value = counter;
        document.getElementById("decrease").disabled = false;
        document.getElementById("decrease").style.cursor = "pointer";


    }

    // if (count.value < 1) {
    function decreaseQuantity() {
        counter--;
        count.value = counter;
        if (count.value < 2) {
            document.getElementById("decrease").disabled = true;
            document.getElementById("decrease").style.cursor = "no-drop";

        }
    }

    function fav(x) {
        x.classList.toggle("fa-heart");
    }

    // }
</script>


<?php

include("footer.html");

?>