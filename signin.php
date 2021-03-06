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
                        <a href="account.php">Account</a>
                        <a href="search.php">Search</a>
                        <a href="search.php">Department</a>
                        <a href="checkout.php">Checkout</a>
                        <a href="contact.php">Contact</a>
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
            <div id="container_signin">
                <?php
                    $msg = '';

                    if (isset($_POST['login']) && !empty($_POST['username']) 
                        && !empty($_POST['password'])) {

                        // validate username and password
                        $username = $_POST['username'];
                        $password = $_POST['password'];
                        $query = "SELECT * FROM account WHERE username = '$username'";
                        $statement = $db->prepare($query);
                        $statement->execute();
                        $account = $statement->fetch();
                        $hashed_password = @$account['hashed_password'];
                        $statement->closeCursor();
                        
                        if (!empty($account) && password_verify($password, $hashed_password)) {
                            $_SESSION['username'] = $account['username'];
                            $_SESSION['cartID'] = $account['cartID'];

                            // Set cookie after signing in
                            setcookie("userID", $username, strtotime('+1 hour'), '/');

                            header("Location: home.php");
                            exit;
                        } else {
                            $msg = 'Username or Password not Found';
                        }
                    }
                ?>
                <img id="signinImg" src="images/logo.png"><br>
                <h3 id="signinSubtitle">NED's Single Sign-On Service</h3>
                <form id="signin-form" action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                    <h4><?php echo $msg; ?></h4>
                    <label class="signinLabel">Username:</label><br>
                    <input class="signinField" type="text" name="username" placeholder="username" required autofocus><br>
                    <label class="siginLabel">Password:</label><br>
                    <input class="signinField" type="password" placeholder="abc123" name="password" required><br>
                    <button id="signinButton" type="submit" name="login">Login</button>
                </form>
                <p>Don't have an account?</p>
                <a href="register.php">Sign Up</a>
            </div>
        </main>
        <script src="index.js"></script>  
    </body>
    <footer id="homeFooter">
        <p>&copy; 2020 NED's Grocery</p>
    </footer>
</html>