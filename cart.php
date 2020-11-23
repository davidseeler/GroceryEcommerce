<?php
	// Include Database
    include('database.php');
	
	// Check for existing session (Might not be necessary, but better safe than sorry)
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	
	// Obtain cart ID from Session
    $cartID = @$_SESSION['cartID'];

	// Necessary for Account updates
    $query = "SELECT SUM(quantity) FROM cartDetail WHERE cartID='$cartID'";
    $itemCount = $db->query($query);
    $itemCount = $itemCount->fetch();

	// Get products for selected category
	$queryCart = 'SELECT * FROM cartDetail
					WHERE cartID = :cartID';
	$statement1 = $db->prepare($queryCart);
	$statement1->bindValue(':cartID', $cartID);
	$statement1->execute();
	$cartItems = $statement1->fetchAll();
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
        <main id = "cartMain">
			<div id = "itemList">
				<table id = "itemTable">
					<thead>
						<?php
							if ($itemCount['SUM(quantity)'] != NULL) {
								echo "<tr>
										<th>&nbsp;</th>
										<th>Name</th>
										<th>Quantity</th>
										<th class = 'right'>Price</th>
										<th class = 'right'>Total Price</th>
										<th>&nbsp;</th>
									</tr>";
							}
							else {
								echo "<h4>Cart is Empty</h4>";
							}
						?>
					</thead>
					<tbody>
						<?php
							$grandTotal = 0; 
							foreach ($cartItems as $item) :
								// Obtain quantity of items
								$itemQuantity = $item['quantity'];
							
								// Obtain product name
								$productID = $item['productID'];
								$queryName = 'SELECT * FROM products
											WHERE productID = :productID';
								$statement2 = $db->prepare($queryName);
								$statement2->bindValue(':productID', $productID);
								$statement2->execute();
								$product = $statement2->fetch();
								$statement2->closeCursor();
							
								// Obtain total price of all items
								$totalPrice = $product['price'] * $itemQuantity;
								
								// Keep tally of final price of basket
								$grandTotal += $totalPrice;
						?>
						<tr>
							<td id = "itemPic"><img class = "cartPic" src = "<?php echo $product['imgLink'];?>">
							<td id = "itemName" class = "right"><?php echo $product['name']; ?></td>
							<td id = "itemQuant" class = "right"><?php echo $itemQuantity; ?></td>
							<td id = "itemPrice" class = "right">$ <?php echo $product['price']; ?></td>
							<td id = "itemTotalPrice" class = "right">$ <?php echo number_format($totalPrice, 2); ?></td>
							<td id = "deleteItem"><form action = "delete_from_cart.php" method = "post">
								<input type = "hidden" name = "delete"
									value = "<?php echo $product['productID']; ?>">
								<input type = "submit" value = "Delete"></form></td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
				<h3>___________________________________________</h3>
			</div>
			<div id = "itemTotals">
				<?php 
					// Calculate gross total from grandTotal and sales tax
					$salesTax = $grandTotal * 0.04;
					$grossTotal = $grandTotal * 1.04;
					$_SESSION['grossTotal'] = $grossTotal;
				?>
				<h3>Grand Total:</h3>
				<h4>Before Taxes: $ <?php echo number_format($grandTotal, 2); ?></h4> 
				<h4>Sales Tax: $ <?php echo number_format($salesTax, 2); ?></h4>
				<h4>Final Price: $ <?php echo number_format($grossTotal, 2); ?></h4>
			</div>
			<div id = "checkoutButtonFormatting">
				<a id="newCheckoutButton" href="checkout.php"><img id = "shopCartIcon" src = "images/shopping_cart_right.png">CLICK TO CHECKOUT</a><br>
			</div>
			<div id = "rtsButtonFormatting">
				<a id="backToShoppingButton" href="search.php"><img id = "returnToShopIcon" src = "images/back.png">   BACK TO SHOPPING </a>
			</div>
			<div id = "editAccountFormatting">
				<a id="editAccountButton" href="account.php"><img id = "backToAccountIcon" src = "images/accountIcon.png">   EDIT ACCOUNT  </a>
			</div>
        </main>
        <script src="index.js"></script>  
    </body>
    <footer id = "cartFooter">
        <p>&copy; 2020 NED's Grocery</p>
    </footer>
</html>