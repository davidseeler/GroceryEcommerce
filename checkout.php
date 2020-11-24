<?php
	// Include Database
    include('database.php');
	
	// Check for existing session (Might not be necessary, but better safe than sorry)
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	
	// Obtain cart ID from session
	$cartID = @$_SESSION['cartID'];
	
	// Necessary for Account Update
	$query = "SELECT SUM(quantity) FROM cartDetail WHERE cartID='$cartID'";
    $itemCount = $db->query($query);
    $itemCount = $itemCount->fetch();
    
	// Obtain grossTotal from previous cart view
	$grossTotal = @$_SESSION['grossTotal'];
	
	// Compute total cost for later
	$totalOverallCost = $grossTotal + 6.99;
	
	// Obtain account Info for filling
	$queryAccount = 'SELECT * FROM account
					WHERE cartID = :cartID';
	$statement1 = $db->prepare($queryAccount);
	$statement1->bindValue(':cartID', $cartID);
	$statement1->execute();
	$userAccount = $statement1->fetch();
	$statement1->closeCursor();
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
        <script Language = "Javascript">
			function enable_text(status) {
			status =! status;	
				document.billingInfo.billName.disabled = status;
				document.billingInfo.billAddress1.disabled = status;
				document.billingInfo.billCountry.disabled = status;
				document.billingInfo.billCityState.disabled = status;
				document.billingInfo.billZip.disabled = status;
			}
		</script>
    </head>
    <body id="homeBodyCheckout">
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
        <main id = "checkoutMain" onload = enable_text(false);>
			<div id = "shippingInfo">
				<h2 id = "shipInfoTitle">Shipping Information</h2>
				<label>Name:</label>
				<input type = "text" id = "shipName" value = "<?php echo $userAccount['firstName']; ?> <?php echo $userAccount['lastName']; ?>" required><br>
				
				<label>Street Address:</label>
				<input type = "text" id = "shipAddress1" value = "<?php echo $userAccount['address1']; ?>" required><br>
				
				<label>Country:</label>
				<input type = "text" id = "shipCountry" value = "<?php echo $userAccount['country']; ?>" required><br>
				
				<label>City, State:</label>
				<input type = "text" id = "shipCityState" value = "<?php echo $userAccount['city']; ?>, <?php echo $userAccount['state']; ?>" required><br>
				
				<label>Zip:</label>
				<input type = "text" id = "shipZip" value = "<?php echo $userAccount['zipcode']; ?>" required><br>
				
				<input type= "checkbox" name = "diffShip" id = "diffShip" onclick = "enable_text(this.checked)" >Different Billing Address?<br>
			</div>
			<form name = "billingInfo" id = "billingInfo" method = "post">
				<h2 id = "billInfoTitle">Billing Information</h2>
				
				<label id = "billNameLabel">Name:</label>
				<input type = "text" name = "billName" id = "billName" value = "<?php echo $userAccount['firstName']; ?> <?php echo $userAccount['lastName']; ?>" required disabled><br>
				
				<label>Street Address:</label>
				<input type = "text" name = "billAddress1" id = "billAddress1" value = "<?php echo $userAccount['address1']; ?>" required disabled><br>
				
				<label>Country:</label>
				<input type = "text" name = "billCountry" id = "billCountry" value = "<?php echo $userAccount['country']; ?>" required disabled><br>
				
				<label>City, State:</label>
				<input type = "text" name = "billCityState" id = "billCityState" value = "<?php echo $userAccount['city']; ?>, <?php echo $userAccount['state']; ?>" required disabled><br>
				
				<label>Zip:</label>
				<input type = "text" name = "billZip" id = "billZip"value = "<?php echo $userAccount['zipcode']; ?>" required disabled><br>
				
				<label>&nbsp;</label>
			</form>
			<form action = "checkout_clean.php" method = "post" id = "orderSummary">
				<h2>Total Grocery Price:</h2>
				<h3>Gross Total: $ <?php echo number_format($grossTotal, 2); ?></h3>
				<h3>Shipping Costs: $ 6.99</h3>
				<h3>______________________</h3>
				<h2>Total Factored Cost: $ <?php echo number_format($totalOverallCost, 2); ?></h2>
				<h3>______________________</h3>
				
				<label>Card Holder Name:</label>
				<input type = "text" name = "cardName" id = "cardName" value = "<?php echo $userAccount['firstName']; ?> <?php echo $userAccount['lastName']; ?>" required><br>
				
				<label>Card Number:</label>
				<input type = "text" name = "cardNumber" id = "cardNumber" value = "<?php echo $userAccount['creditCard']; ?>" required><br>
				
				<label>Expiration Date:</label>
				<input type = "text" name = "cardExp" title = "Format must be MM/YYYY" required><br>
				
				<label>Security Code:</label>
				<input type = "text" class = "code" name = "cardCode" required>
				
				<div id = "finalCheckoutContainer">
					<input type = "submit" id = "finalCheckoutButton" value = "Checkout"><br>
				</div>
			</form>
        </main>
        <script src="index.js"></script>  
    </body>
    <footer id="searchFooter">
        <p>&copy; 2020 NED's Grocery</p>
    </footer>
</html>