<?php
    include('database.php');

    session_start();

    $cartID = @$_SESSION['cartID'];

    $query = "SELECT SUM(quantity) FROM cartDetail WHERE cartID='$cartID'";
    $itemCount = $db->query($query);
    $itemCount = $itemCount->fetch();

    if (!isset($_POST['search'])){
        $search = "";
    }
    else{
        $search = $_POST['search'];
    }

    $searchTerm = $search;

    switch($search){
        case "fruit":
            $search = "";
            $department = 1;
        break;
        case "vegetables":
            $search = "";
            $department = 2;
        break;
        
        case "meat":
            $search = "";
            $department = 3;
        break;

        case "seafood":
            $search = "";
            $department = 4;
        break;

        case "dairy":
            $search = "";
            $department = 5;
        break;

        default:
        $department = @$_POST['department'];
    }

    $queryHalf = "FROM products WHERE name like '%$search%'";

    if ($department != 0){
        $queryHalf .= " AND departmentID = '$department'";  
    }

    $price_range = @$_POST['price-range'];
    if ($price_range == "<10"){
        $queryHalf .= " AND price < 10";
    }
    else if ($price_range == "10-25"){
        $queryHalf .= " AND price BETWEEN 10 AND 25";
    }
    else if ($price_range == "25>"){
        $queryHalf .= " AND price > 25";
    }

    $query = "SELECT count(*) ".$queryHalf;
    $results = $db->query($query);
    $count = $results->fetch();

    $query = "SELECT * ".$queryHalf;
    $results = $db->query($query);
?>

<html lang="en" id="searchHTML">
    <head>
        <meta charset="UTF-8">
        <title>NED's Grocery</title>
        <link rel="shortcut icon" href="images/favicon.png">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="slider.css">
        <link rel="stylesheet" href="style.css">
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
                <div id="results">
                    <p id="resultsCount">
                        <?php 
                            if ($searchTerm == ''){
                                echo "Select items to add to your cart";
                            }
                            else{
                                echo $count['count(*)']." Search Results for '".$searchTerm."'";
                            }
                        ?>
                    </p>
                    <table id="resultsTable">
                        <form>
                            <?php
                            $i = 0;
                            foreach($results as $product):
                                if ($i % 4 == 0){
                                    echo "<tr>";
                                }
                            ?>
                                <td>
                                    <div class="item">
                                            <img class="itemPic" src="<?php echo $product['imgLink'];?>">
                                            <p class="itemPrice">$<?php echo $product['price']?></p>
                                            <p class="itemDescription"><?php echo $product['name'];?></p>
                                            <a class="addToCart" href="productView.php?productid=<?php echo $product['productID']?>">
                                            View Product</a>
                                    </div>
                                </td>
                            <?php
                            $i++;
                            if ($i % 4 == 0){
                                echo "</tr>";
                            } endforeach;?>
                        </form>
                    </table>
                </div>
            </main>
        </form>
    </body>
    <footer id="searchFooter">
        <p>&copy; 2020 NED's Grocery</p>
    </footer>
    <script src="index.js"></script>  
</html>