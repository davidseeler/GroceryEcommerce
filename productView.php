<?php
    include('database.php');
    session_start();

    $cartID = @$_SESSION['cartID'];

    $query = "SELECT SUM(quantity) FROM cartDetail WHERE cartID='$cartID'";
    $itemCount = $db->query($query);
    $itemCount = $itemCount->fetch();

    $id = $_GET['productid'];
    
    if (isset($_POST['quantity'])){
        if (!isset($_SESSION['cartID'])){
            header("Location: signin.php");
        }

        $quantity = $_POST['quantity'];
        $statement = "INSERT INTO cartDetail (cartID, productID, quantity) 
        VALUES ($cartID, '$id', $quantity)";
        $db->exec($statement);

        $query = "SELECT SUM(quantity) FROM cartDetail WHERE cartID = '$cartID'";
        $itemCount = $db->query($query);
        $itemCount = $itemCount->fetch();

        header("Location: search.php");
    }
?>

<html lang="en" id="productViewHTML">
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
    <body id="searchBody">
        <form method="POST">
            <header>
                <nav id="searchNav">
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
            <main id="searchMain">
                <div id="sideBar">
                    <p id="filter">Filter Results</p>
                    <p class="filterCategory">Department</p>
                    <form id="form2" method="POST">
                        <ul id="filterList">
                            <li>
                                <input type="radio" value="0" name="department" checked>
                                <label>None</label>
                            </li>
                            <li>
                                <input type="radio" value="1" name="department">
                                <label>Fruit</label>
                            </li>
                            <li>
                                <input type="radio" value="2" name="department">
                                <label>Vegetables</label>
                            </li>
                            <li>
                                <input type="radio" value="3" name="department">
                                <label>Meat</label>
                            </li>
                            <li>
                                <input type="radio" value="4" name="department">
                                <label>Seafood</label>
                            </li>
                            <li>
                                <input type="radio" value="5" name="department">
                                <label>Dairy and Eggs</label>
                            </li>
                        </ul>
                        <p class="filterCategory">Price Range</p>
                        <ul id="filterList">
                            <li>
                                <input type="radio" value="0" name="price-range" checked>
                                <label>None</label>
                            </li>
                            <li>
                                <input type="radio" value="<10" name="price-range">
                                <label>Less than $10</label>
                            </li>
                            <li>
                                <input type="radio" value="10-25" name="price-range">
                                <label>$10 - $25</label>
                            </li>
                            <li>
                                <input type="radio" value="25>" name="price-range">
                                <label>$25+</label>
                            </li>
                        </ul>
                        <p class="filterCategory">Other</p>
                        <ul id="filterList">
                            <li>
                                <input type="checkbox" value="on-sale" name="other">
                                <label>On-Sale</label>
                            </li>
                            <li>
                                <input type="checkbox" value="holiday" name="other">
                                <label>Holiday</label>
                            </li>
                            <li>
                                <input type="checkbox" value="perishable" name="other">
                                <label>Perishable</label>
                            </li>
                        </ul>
                    </form>
                </div>
                <a href="search.php"><img id="back" src="images/back.png"></a>
                <div id="productView">
                    <?php 
                        $query = "SELECT * FROM products WHERE productID = $id";
                        $result = $db->query($query);
                        $product = $result->fetch();
                    ?>
                    <div id="productViewLeft">
                        <img id="productViewPic" src="<?php echo $product['imgLink'];?>">
                        <div id="smallerPics">
                            <img class="smallProductViewPic" alt="Left">
                            <img class="smallProductViewPic" alt="Right">
                            <img class="smallProductViewPic" alt="Back">
                        </div>
                    </div>
                    <div id="productViewRight">
                        <p id="productName"><?php echo $product['name'];?></p>
                        <p id="itemCode">UPC: 0001111060933</p>
                        <div id="rating">
                            <img id="starsRating" src="images/starsRating.png">
                            <span><?php echo(rand(200, 3000));?>   ratings</span>
                        </div>
                        <form method="post">
                            <div class="quantity buttons_added">
                                <input type="hidden" value="<?php echo $id;?>" name="product_id">
                                <input type="button" value="-" id="minus" onclick="subtractItem()">
                                <input type="text" value="1" id="quantity" name="quantity">
                                <input type="button" value="+" id="plus" onclick="addItem()">
                            </div>
                            <p>Purchase Options</p>
                            <div id="purchaseOptions">
                                <input type=hidden value="<?php echo $product['price'];?>" id="originalPrice">
                                <div class="purchaseOption" id="topPurchaseOption">
                                    <input type="radio" name="purchaseOption"><label>Pickup</label>
                                    <span id="purchasePrice1">$<?php echo $product['price'];?></span><br>
                                </div>
                                <div class="purchaseOption">
                                    <input type="radio" name="purchaseOption"><label>Delivery</label>
                                    <span id="purchasePrice2">$<?php echo $product['price'];?></span><br>
                                </div>
                                <div class="purchaseOption" id="bottomPurchaseOption">
                                    <input type="radio" name="purchaseOption"><label>Ship</label>
                                    <span id="purchasePrice3">$<?php echo $product['price'];?></span><br>
                                </div>
                            </div>
                            <input id="addToCartSubmit" type="submit" value="Add To Cart">
                        </form>
                    </div>
                </div>
            </main>
        </form>
    </body>
    <footer id="searchFooter">
        <p>&copy; 2020 NED's Grocery</p>
    </footer>
    <script src="index.js"></script>  
</html>