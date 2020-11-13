<html id="main" lang="en">
    <head>
        <meta charset="UTF-8">
        <title>NED's Grocery</title>
        <link rel="shortcut icon" href="images/favicon.png">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <header>
            <nav>
                <div id="mySidenav" class="sidenav">
                    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                    <a href="#">placeholder</a>
                    <a href="#">placeholder</a>
                    <a href="#">placeholder</a>
                    <a href="#">placeholder</a>
                </div>
                <span id="menuButton" onclick="openNav()">&#9776;</span>
                <img id="logo" src="images/logo.png">
                <form id="searchForm">
                    <input id="searchBar" type=text placeholder="Search Products">
                    <button id="searchButton" type=submit><i class="fa fa-search"></i></button>
                </form>
                <div id="accountBox">
                    <a id="accountLink" href="account.html"><image id="accountIcon" src="images/accountIcon.png"></image>Account</a>
                </div>
                <div id="cartBox">
                    <a id="accountLink" href="cart.html"><image id="accountIcon" src="images/shoppingCartIcon.png"></image>Shopping Cart</a>
                </div>
            </nav>
        </header>
        <script src="index.js"></script>  
    </body>
</html>