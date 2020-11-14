<html id="main" lang="en">
    <head>
        <meta charset="UTF-8">
        <title>NED's Grocery</title>
        <link rel="shortcut icon" href="images/favicon.png">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="slider.css">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <header>
            <nav>
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
                <a href="main.php"><img id="logo" src="images/logo.png"></a>
                <form id="searchForm">
                    <input id="searchBar" type=text placeholder="Search Products">
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
        <main>
            <div id="slider">
                <figure>
                    <img src="images/vegetables.png" alt>
                    <img src="images/fruit.png" alt>
                    <img src="images/meat.png" alt>
                    <img src="images/seafood.png" alt>
                    <img src="images/dairy.png" alt>
                </figure>
            </div>
            <p id="welcome">Welcome</p>
            <p id="welcome2">
                Here at NED's, you get the best &ndash; for less!
            </p>
            <div id="container">
                <div id="savings">
                    <img class="tag" src="images/price-tag.png">
                    <p class="tag2">Savings</p>
                    <p>
                        WEEKLY AD<br>
                        DIGITAL COUPONS<br>
                        ALL DEALS<br>
                    </p>
                </div>
                <div id="shopOnline">
                    <a href="search.html"><img class="tag" src="images/groceries.jpg"></a>
                    <p class="tag2">Shop Online</p>
                    <p>
                        DELIVERY<br>
                        IN-STORE PICKUP<br>
                        CURBSIDE PICKUP<br>
                    </p>
                </div>
            </div>
        </main>
        <script src="index.js"></script>  
    </body>
    <footer>
        <p>&copy; 2020 NED's Grocery</p>
    </footer>
</html>