<?php
    include('database.php');

    if (!isset($_GET['search'])){
        $search = "";
    }
    else{
        $search = $_GET['search'];
    }

    $query = "SELECT count(*) FROM Product WHERE name like '%$search%'";
    $results = $db->query($query);
    $count = $results->fetch();

    $query = "SELECT * FROM Product WHERE name like '%$search%'";
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
        <header>
            <nav id="searchNav">
                <div id="mySidenav" class="sidenav">
                    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                    <p>Categories</p>
                    <a href="#">Fruit</a>
                    <a href="#">Vegetables</a>
                    <a href="#">Meat</a>
                    <a href="#">Seafood</a>
                    <a href="#">Dairy and Eggs</a>
                </div>
                <span id="menuButton" onclick="openNav()">&#9776;</span>
                <a href="home.php"><img id="logo" src="images/logo.png"></a>
                <form id="searchForm" method="GET">
                    <input id="searchBar" type=text placeholder="Search Products" name="search">
                    <button id="searchButton" type=submit><i class="fa fa-search"></i></button>
                </form>
                <div id="accountBox">
                    <a id="accountLink" href="account.html"><image id="accountIcon" src="images/accountIcon.png"></image>Account</a>
                </div>
                <div id="cartBox">
                    <a id="cartLink" href="cart.html"><image id="cartIcon" src="images/shoppingCartIcon.png"></image>Shopping Cart</a>
                </div>
            </nav>
        </header>
        <main id="searchMain">
            <div id="sideBar">
                <p id="filter">Filter Results</p>
                <form>
                    <ul id="filterList">
                        <li>
                            <input type="checkbox" value="Fruit" name="fruit">
                            Fruit
                        </li>
                        <li>
                            <input type="checkbox" value="Vegetables" name="vegetables">
                            Vegetables
                        </li>
                        <li>
                            <input type="checkbox" value="Meat" name="meat">
                            Meat
                        </li>
                        <li>
                            <input type="checkbox" value="Seafood" name="seafood">
                            Seafood
                        </li>
                        <li>
                            <input type="checkbox" value="Dairy and Eggs" name="dairt">
                            Dairy and Eggs
                        </li>
                    </ul>
                </form>
            </div>
            <div id="results">
                <p id="resultsCount"><?php echo $count['count(*)'];?> Search Results for "<?php echo $search;?>"</p>
                <table id="resultsTable">
                    <form>
                        <?php
                        $i = 0;
                        foreach($results as $product):
                            if ($i % 3 == 0){
                                echo "<tr>";
                            }
                        ?>
                            <td>
                                <div class="item">
                                    <img class="itemPic" src="<?php echo $product['imgLink'];?>">
                                    <p class="itemPrice">$<?php echo $product['price']?></p>
                                    <p class="itemDescription"><?php echo $product['name']?></p>
                                    <button class="addToCart" type=submit>Add to Cart</button>
                                </div>
                            </td>
                        <?php
                        $i++;
                        if ($i % 3 == 0){
                            echo "</tr>";
                        } endforeach;?>
                    </form>
                </table>
            </div>
        </main>
    </body>
    <footer id="searchFooter">
        <p>&copy; 2020 NED's Grocery</p>
    </footer>
    <script src="index.js"></script>  
</html>
