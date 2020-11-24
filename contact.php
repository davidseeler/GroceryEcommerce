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
		<script type = "text/javascript" src = "checkout_check.js"></script>
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
                        <a href="contact.php">Contact</a>
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
		<main id = "contactMain">
			<div id = "nickInfo">
				<img id = "nickPicture" src = "images/nickImage.jpg">
				<h3 id = "nickName">Name: Nick Evans</h3>
				<h3 id = "nickEmail">Email: nbe20420@uga.edu</h3>
			</div>
			<div id = "bigN">
				<h2 id = "bigN">N</h2>
			</div>
			<div id = "erikInfo">
				<img id = "erikPicture" src = "images/erikImage.jpg">
				<h3 id = "erikName">Name: Erik Prince</h3>
				<h3 id = "erikEmail">Email: edp93729@uga.edu</h3>
			</div>
			<div id = "bigE">
				<h2 id = "bigE">E</h2>
			</div>
			<div id = "davidInfo">
				<img id = "davidPicture" src = "images/davidImage.jpg" style="width: 100px; height: 100px;">
				<h3 id = "davidName">Name: David Seeler</h3>
				<h3 id = "davidEmail">Email: David.Seeler@uga.edu</h3>
			</div>
			<div id = "bigD">
				<h2 id = "bigD">D</h2>
			</div>
		</main>
        <script src="index.js"></script>  
    </body>
    <footer id="searchFooter">
        <p>&copy; 2020 NED's Grocery</p>
    </footer>
</html>