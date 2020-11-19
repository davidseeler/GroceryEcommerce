<?php
    include('database.php');

    session_start();

    $cartID = @$_SESSION['cartID'];

    if (isset($_POST['subtractItem']) && isset($_POST['itemQuantity'])){
        $newQuantity = $_POST['itemQuantity'] - 1;
        $removedItemID = $_POST['subtractItem'];
        if ($newQuantity < 1){
            $statement = "DELETE FROM cartDetail WHERE productID='$removedItemID'";
        }
        else{
            $statement = "UPDATE cartDetail SET quantity='$newQuantity' WHERE cartID='$cartID' AND productID='$removedItemID'";
        }
        $db->exec($statement);     
    }

    $query = "SELECT SUM(quantity) FROM cartDetail WHERE cartID='$cartID'";
    $itemCount = $db->query($query);
    $itemCount = $itemCount->fetch();

    $query = "SELECT * from cartDetail WHERE cartID='$cartID'";
    $cartItems = $db->query($query);
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
        <main>
            <div id="cartContainer">
                <div id="cartLeft">
                    <p id="shoppingCartTitle">Shopping Cart</p>
                    <?php
                        if ($itemCount['SUM(quantity)'] < 1){
                            echo "<p id='cartIsEmpty'>Your cart is empty.</p>";
                        }
                    ?>
                    <table id="resultsTable">
                        <form method="POST">
                            <?php
                            $products = array();
                            $quantities = array();
                            $i = 0;
                            foreach($cartItems as $item):
                                if (empty($cartItems)){
                                    echo "<p>empty</p>";
                                }
                                else{
                                    
                                }
                                if ($i % 4 == 0){
                                    echo "<tr>";
                                }
                                $quantity = $item['quantity'];
                                $productID = $item['productID'];
                                $query = "SELECT * FROM products WHERE productID='$productID'";
                                $product = $db->query($query);
                                $product = $product->fetch();
                            ?>
                                <td>
                                    <div class="cartItem">
                                        <form method="POST">
                                            <input name="itemQuantity" type="hidden" value="<?php echo $quantity;?>">
                                            <input name="subtractItem" type="hidden" value="<?php echo $product['productID'];?>">
                                            <button type="submit" id="removeItem"><span id="removeItemInner">-</span></button>
                                            <img class="cartItemPic" src="<?php echo $product['imgLink'];?>">
                                            <p class="itemPrice">$<?php echo $product['price']?></p>
                                            <p class="itemDescription"><?php echo $product['name'];?></p>
                                            <p class="itemDescription">Quantity: <?php echo $quantity;?></p>
                                        </form>
                                    </div>
                                </td>
                            <?php
                            $products[] = $product['name'];
                            $quantities[] = $quantity;
                            $prices[] = $product['price'] * $quantity;
                            $i++;
                            if ($i % 4 == 0){
                                echo "</tr>";
                            } endforeach;?>
                        </form>
                    </table>
                </div>
                <div id="cartRight">
                    <h1>Subtotal</h1>
                    <ul id="cartList">
                        <?php
                            $subtotal = 0;
                            $x = 0;
                            foreach ($products as $grocery):
                        ?>
                        <li>
                            <p class="subtotalItem">
                                <?php echo "x".$quantities[$x]." ".$products[$x];?>
                                <span class="subtotalPrice">
                                    <?php 
                                        echo "$" . number_format($prices[$x], 2); 
                                        $subtotal += $prices[$x]; 
                                        $x++;
                                    ?>
                                </span>
                            </p>
                            <?php endforeach;?>
                        </li>
                    </ul>
                    <p>__________________________________</p>
                    <h2 id="subtotalNum"><?php echo "$".$subtotal;?></h2>
                    <a id="checkoutButton" href="checkout.php"><img id="lock" src="images/lock.png">CHECKOUT</a>
                </div>
            </div>
        </main>
        <script src="index.js"></script>  
    </body>
    <footer id="searchFooter">
        <p>&copy; 2020 NED's Grocery</p>
    </footer>
</html>