<?php
    include('database.php');
	
	// Check for existing session (Might not be necessary, but better safe than sorry)
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	
    if (!isset($_SESSION['username'])){
        header("Location: signin.php"); 
    }

    if (isset($_POST['signout'])){
        session_unset();
        header("Location: signin.php");
    }

    $cartID = @$_SESSION['cartID'];
    $username = @$_SESSION['username'];

    $query = "SELECT SUM(quantity) FROM cartDetail WHERE cartID='$cartID'";
    $itemCount = $db->query($query);
    $itemCount = $itemCount->fetch();

    $query = "SELECT * FROM account WHERE username='$username'";
    $account = $db->query($query);
    $account = $account->fetch();

    $name = $account['firstName']." ".$account['lastName'];
    $email = $account['email'];
    $credit_card = $account['creditCard'];
    $credit_card = "********".substr($credit_card, -4);
    $phone = $account['phone'];
    $address = $account['address1']."...";
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
                        <a href="contact.html">Contact</a>
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
            <div id="accountContainer">
                <img id="accountPageIcon" src="images/accountIcon.png">
                <h2 id="accountUsername"><?php echo $_SESSION['username'];?></h2> 
                <p>Name: <?php echo $name;?></p>
                <p>Phone: <?php echo $phone;?></p>
                <p>Email: <?php echo $email;?></p>
                <p>Credit Card: <?php echo $credit_card;?></p>
                <p>Address: <?php echo $address;?></p>
                <a href="cart.php">Shopping Cart</p>
                <a href="#">Order History</p>
                <a href="account.php">Edit Information</p>
                <br>
                <form method="POST">
                    <input name="signout" type="hidden">
                    <input id="signoutButton" type="submit" value="Sign Out">
                </form>
            </div>
        </main>
        <script src="index.js"></script>  
    </body>
    <footer id="homeFooter">
        <p>&copy; 2020 NED's Grocery</p>
    </footer>
</html>