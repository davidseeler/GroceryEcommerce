<?php
    include('database.php');

    $query = "SELECT SUM(quantity) FROM cartDetail";
    $itemCount = $db->query($query);
    $itemCount = $itemCount->fetch();
    //start_session();
    //$_SESSION['cartID'] = $account['cartID'];
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
        <header>
            <nav id="homeNav">
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
                <form id="searchForm">
                    <input id="searchBar" type=text placeholder="Search Products">
                    <button id="searchButton" type=submit><i class="fa fa-search"></i></button>
                </form>
                <div id="accountBox">
                    <a id="accountLink" href="signin.php"><image id="accountIcon" src="images/accountIcon.png"></image>Account</a> 
                </div>
                <div id="cartBox">
                    <a id="cartLink" href="cart.html"><image id="cartIcon" src="images/shoppingCartIcon.png"></image>Shopping Cart</a>
                    <span id="itemCount"><?php echo "(".$itemCount['SUM(quantity)'].")";?></span>
                </div>
            </nav>
        </header>
        <main>
            <!--start here-->
        </main>
        <script src="index.js"></script>  
    </body>
    <footer id="homeFooter">
        <p>&copy; 2020 NED's Grocery</p>
    </footer>
</html>