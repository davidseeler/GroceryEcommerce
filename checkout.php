<?php
    include('database.php');
    session_start();

    $cartID = @$_SESSION['cartID'];
    $subtotal = @$_SESSION['subtotal'];
    $shipping = 7.66;
    $totalB4Tax = $subtotal + $shipping;
    $estimatedTax = number_format(($totalB4Tax * .06), 2);
    $total = $totalB4Tax + $estimatedTax;

    $query = "SELECT SUM(quantity) FROM cartDetail WHERE cartID='$cartID'";
    $itemCount = $db->query($query);
    $itemCount = $itemCount->fetch();

?>

<html lang="en" id="homeHTML">
    <head>
        <meta charset="UTF-8">
        <title>NED's Grocery</title>
        <link rel="shortcut icon" href="images/favicon.png">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="slider.css">
        <link rel="stylesheet" href="style.css">
        <script data-require="jquery@3.1.1" data-semver="3.1.1" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="script.js"></script>
    </head>
    <body id="homeBody">
    <form method="POST" action="search.php">
            <header>
                <nav id="homeNav">
                    <div id="mySidenav" class="sidenav">
                        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                        <a href="account.php">Account</a>
                        <a href="search.php">Search</a>
                        <a href="search.php">Department</a>
                        <a href="checkout.php">Checkout</a>
                        <a href="#">Contact</a>
                    </div>
                    <span id="menuButton" onclick="openNav()">&#9776;</span>
                    <a href="home.php"><img id="logo" src="images/logo.png"></a>
                    <div id="searchForm">
                            <input id="searchBar" type=text placeholder="Search Products" name="search">
                            <button id="searchButton" type=submit><i class="fa fa-search"></i></button>
                    </div>
                    <div id="accountBox">
                       <a id="accountLink" href="account.php"><image id="accountIcon" src="images/accountIcon.png"></image>
                            <?php
                                if (isset($_SESSION['username'])){
                                    echo $_SESSION['username'];
                                }
                                else{
                                    echo "Account";
                                }
                            ?>
                        </a> 
                    </div>
                    <div id="cartBox">
                        <a id="cartLink" href="cart.php"><image id="cartIcon" src="images/shoppingCartIcon.png"></image>Shopping Cart</a>
                        <span id="itemCount">
                            <?php
                                if (!isset($_SESSION['cartID'])){
                                    echo "";
                                }
                                else if ($itemCount['SUM(quantity)'] == NULL){
                                    echo "(0)";
                                }
                                else{
                                    echo "(".$itemCount['SUM(quantity)'].")";
                                } 
                                ?>
                        </span>
                    </div>
                </nav>
            </header>
        </form>
        <main id="homeMain">
            <form action="orderPlaced.php" method="POST">
                <p id="checkoutTitle">Review your order</p>
                <div id="checkoutContainer">
                    <div id="checkoutInfo">
                        <?php
                            $query = "SELECT * FROM account WHERE cartID='$cartID'";
                            $accountInfo = $db->query($query);
                            $accountInfo = $accountInfo->fetch();
                        ?>
                        <h2>Payment & Shipping</h2>
                        <h4 class="checkoutSubtitle">Shipping Address</h4>
                        <span><?php echo $accountInfo['firstName']." ".$accountInfo['lastName'];?></span><br>
                        <span><?php echo strtoupper($accountInfo['address1']);?></span><br>
                        <span><?php echo strtoupper($accountInfo['city']. ", ".$accountInfo['state'])." ".$accountInfo['zipcode'];?></span><br>
                        <span><?php echo $accountInfo['country'];?></span><br>
                        <span>Phone: <?php echo $accountInfo['phone'];?></span><br>

                        <h4 class="checkoutSubtitle">Payment method</h4>
                        <span><?php echo "VISA ending in ".substr($accountInfo['creditCard'], -4); ?></span>

                        <h4 class="checkoutSubtitle">Billing Address</h4>
                        <span><?php echo $accountInfo['firstName']." ".$accountInfo['lastName'];?></span><br>
                        <span><?php echo $accountInfo['address1'];?></span><br>
                        <span><?php echo $accountInfo['city']. ", ".$accountInfo['state']." ".$accountInfo['zipcode'];?></span><br>
                        <span><?php echo $accountInfo['country'];?></span><br><br>

                        <a href="account.php">Edit Information</a>
                
                    </div>
                    <div id="checkoutOrder">
                        <h2>Order Summary</h2>
                        <span class="checkoutLeft">Items <?php echo " (".$itemCount['SUM(quantity)']."):";?></span>
                        <span class="checkoutRight"><?php echo "$".$subtotal;?></span><br><br>
                        <span class="checkoutLeft">Shipping & handling:</span>
                        <span class="checkoutRight"><?php echo "$".$shipping;?></span><br>
                        <span class="checkoutRight">_________</span><br><br>
                        <span class="checkoutLeft">Total before tax: </span>
                        <span class="checkoutRight"><?php echo "$".$totalB4Tax;?></span><br><br>
                        <span class="checkoutLeft">Estimated tax to be collected: </span>
                        <span class="checkoutRight"><?php echo "$".$estimatedTax;?></span><br>
                        <span>______________________________________</span><br><br>
                        <span id="orderTotal" class="checkoutLeft">Order total: </span>
                        <span id="orderTotal" class="checkoutRight"><?php echo "$".number_format($total, 2);?></span><br><br><br>
                        <button id="orderButton" type="submit">Place your order</button>
                    </div>
                </div>
            </form>
        </main>
        <script src="index.js"></script>  
    </body>
    <footer id="searchFooter">
        <p>&copy; 2020 NED's Grocery</p>
    </footer>
    <script src="index.js"></script>  
</html>