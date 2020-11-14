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
                <p id="resultsCount">39 Search Results for "eggs"</p>
                <table id="resultsTable">
                    <form>
                        <tr>
                            <td>
                                <div class="item">
                                    <img class="itemPic" src="images/apple.jpg">
                                    <p class="itemPrice">$1.99</p>
                                    <p class="itemDescription">Apple</p>
                                    <button class="addToCart" type=submit>Add to Cart</button>
                                </div>
                            </td>
                            <td>
                                <div class="item">
                                    <img class="itemPic" src="images/apple.jpg">
                                    <p class="itemPrice">$1.99</p>
                                    <p class="itemDescription">Apple</p>
                                    <button class="addToCart" type=submit>Add to Cart</button>
                                </div>
                            </td>
                            <td>
                                <div class="item">
                                    <img class="itemPic" src="images/apple.jpg">
                                    <p class="itemPrice">$1.99</p>
                                    <p class="itemDescription">Apple</p>
                                    <button class="addToCart" type=submit>Add to Cart</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="item">
                                    <img class="itemPic" src="images/apple.jpg">
                                    <p class="itemPrice">$1.99</p>
                                    <p class="itemDescription">Apple</p>
                                    <button class="addToCart" type=submit>Add to Cart</button>
                                </div>
                            </td>
                            <td>
                                <div class="item">
                                    <img class="itemPic" src="images/apple.jpg">
                                    <p class="itemPrice">$1.99</p>
                                    <p class="itemDescription">Apple</p>
                                    <button class="addToCart" type=submit>Add to Cart</button>
                                </div>
                            </td>
                            <td>
                                <div class="item">
                                    <img class="itemPic" src="images/apple.jpg">
                                    <p class="itemPrice">$1.99</p>
                                    <p class="itemDescription">Apple</p>
                                    <button class="addToCart" type=submit>Add to Cart</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="item">
                                    <img class="itemPic" src="images/apple.jpg">
                                    <p class="itemPrice">$1.99</p>
                                    <p class="itemDescription">Apple</p>
                                    <button class="addToCart" type=submit>Add to Cart</button>
                                </div>
                            </td>
                            <td>
                                <div class="item">
                                    <img class="itemPic" src="images/apple.jpg">
                                    <p class="itemPrice">$1.99</p>
                                    <p class="itemDescription">Apple</p>
                                    <button class="addToCart" type=submit>Add to Cart</button>
                                </div>
                            </td>
                            <td>
                                <div class="item">
                                    <img class="itemPic" src="images/apple.jpg">
                                    <p class="itemPrice">$1.99</p>
                                    <p class="itemDescription">Apple</p>
                                    <button class="addToCart" type=submit>Add to Cart</button>
                                </div>
                            </td>
                        </tr>
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
