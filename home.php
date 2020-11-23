<?php
    include('database.php');
    session_start();

    $cartID = @$_SESSION['cartID'];

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
    </head>
    <body id="homeBodyMain">
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
            <div id="slider">
                <figure>
                    <img src="images/vegetables.png" alt>
                    <img src="images/fruit.png" alt>
                    <img src="images/meat.png" alt>
                    <img src="images/seafood.png" alt>
                    <img src="images/dairy.png" alt>
                </figure>
            </div>
            <p id="welcome">
                <?php
                    if (isset($_SESSION['username'])){
                        echo "Welcome, ".$_SESSION['username'];
                    }
                    else{
                        echo "Welcome";
                    }
                ?>
            </p>
            <p id="welcome2">
                Here at NED's, you get the best &ndash; for less!
            </p>
            <div id="container">
                <a href="search.php" class="homeLink">
                    <div id="savings">
                        <img class="tag" src="images/saleTag.png">
                        <p class="tag2">Savings</p>
                        <p>
                            WEEKLY AD<br>
                            DIGITAL COUPONS<br>
                            ALL DEALS<br>
                        </p>
                    </div>
                </a>
                <a href="search.php" class="homeLink">
                    <div id="savings">
                        <img class="tag" src="images/turkey.png">
                        <p class="tag2">Holiday</p>
                        <p>
                            BUNDLES<br>
                            SPECIALTY ITEMS<br>
                            HOLIDAY DEALS<br>
                        </p>
                    </div>
                </a>
                <a href="search.php" class="homeLink">
                    <div id="shopOnline">
                        <img class="tag" src="images/sprout.jpg">
                        <p class="tag2">Organic</p>
                        <p>
                            ALL NATURAL<br>
                            LOCAL FARMS<br>
                            HEALTH<br>
                        </p>
                    </div>
                </a>
                <a href="search.php" class="homeLink">
                    <div id="shopOnline">
                        <img class="tag" src="images/groceries.png">
                        <p class="tag2">Shop Online</p>
                        <p>
                            DELIVERY<br>
                            IN-STORE PICKUP<br>
                            CURBSIDE PICKUP<br>
                        </p>
                    </div>
                </a>
            </div>
        </main>
        <script src="index.js"></script>  
    </body>
    <footer id="homeFooter">
        <p>&copy; 2020 NED's Grocery</p>
    </footer>
</html>