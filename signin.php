<?php
session_start();
require('database.php');
?>

<html lang="en" id="signin">
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
                        <p>Categories</p>
                        <a href="#">Fruit</a>
                        <a href="#">Vegetables</a>
                        <a href="#">Meat</a>
                        <a href="#">Seafood</a>
                        <a href="#">Dairy and Eggs</a>
                    </div>
                    <span id="menuButton" onclick="openNav()">&#9776;</span>
                    <a href="home.php"><img id="logo" src="images/logo.png"></a>
                    <div id="searchForm">
                            <input id="searchBar" type=text placeholder="Search Products" name="search">
                            <button id="searchButton" type=submit><i class="fa fa-search"></i></button>
                    </div>
                    <div id="accountBox">
                        <a id="accountLink" href="account.php"><image id="accountIcon" src="images/accountIcon.png"></image>Account</a> 
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
        <main id="homeMain">
            <div id="slider">
                <figure>
                    <img src="images/vegetables.png" alt>
                    <img src="images/fruit.png" alt>
                    <img src="images/meat.png" alt>
                    <img src="images/seafood.png" alt>
                    <img src="images/dairy.png" alt>
                </figure>
            </div>
            <h1>Sign in using your Username and Password!</h1>
            <div id="container_signin">
                <?php
                    $msg = '';

                    if (isset($_POST['login']) && !empty($_POST['username']) 
                        && !empty($_POST['password'])) {

                        // validate username and password
                        $username = $_POST['username'];
                        $password = $_POST['password'];
                        $query = "SELECT * FROM account WHERE username = '$username' 
                                    AND password = '$password'";
                        $statement = $db->prepare($query);
                        $statement->execute();
                        $account = $statement->fetch();
                        $statement->closeCursor();
                        
                        if (!empty($account)) {
                            $_SESSION['username'] = $account['username'];
                            $_SESSION['cartID'] = $account['cartID'];

                            header("Location: home.php");
                            exit;
                        } else {
                            echo 'Username or Password not Found';
                        }
                    }
                ?>
            </div>
            <div id="container_signin_form">
                <form id="signin-form" action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                    <h4><?php echo $msg; ?></h4>
                    <input type="text" name="username" placeholder="username" required autofocus><br>
                    <input type="password" placeholder="abc123" name="password" required><br>
                    <button type="submit" name="login">Login</button>
                </form>
            </div>
            <p>Don't have an account?</p>
            <a href="register.php">Sign Up</a>
        </main>
        <script src="index.js"></script>  
    </body>
    <footer id="homeFooter">
        <p>&copy; 2020 NED's Grocery</p>
    </footer>
</html>