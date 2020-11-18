<?php
    include('database.php');
    session_start();

    $username = $password = $confirmation = $creditcard = $email = "";
    $usernameErr = $passwordErr = $confirmationErr = $creditCardErr = $emailErr = "";

    // Insert values into database once submit is entered
    if (isset($_POST['username'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $confirmation = $_POST['passwordConfirmation'];
        $creditcard = $_POST['credit-card'];
        $email = $_POST['email'];
        $cartID = rand(1000, 9999); // check for duplicates

        // Username Validation
        if (!preg_match("/^[a-zA-Z0-9]*$/",$username)) {
            $usernameErr = "Only alphanumeric characters allowed.";
        }

        // Password Validation
        if (strcmp($password, $confirmation) !== 0) {
            $confirmationErr = "Passwords must match. ";
        }
        if (!preg_match("/^[a-zA-Z0-9]*$/",$password)) {
            $passwordErr = "Only alphanumeric characters allowed.";
        }

        // Email Validation
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format.";
        }

        // Credit-Card Validation
        if (!preg_match('/^[0-9]+$/', $creditcard)) {
            $creditCardErr = "Only numbers allowed.";
        }

        // If no errors then account is created
        if (!empty($usernameErr) || !empty($confirmationErr) || !empty($passwordErr) || !empty($emailErr) || !empty($creditCardErr)) {

            $_POST['username'] = NULL;
            $_POST['password'] = NULL;
            $_POST['passwordConfirmation'] = NULL;
            $_POST['credit-card'] = NULL;
            $_POST['email'] = NULL;
        } else {

            $statement = "INSERT INTO account (username, password, cartID, creditCard, email)
            VALUES ('$username', '$password', $cartID, $creditcard, '$email')";
            $db->exec($statement);

            // Create session variables
            $_SESSION['username'] = $username;
            $_SESSION['cartID'] = $cartID; 

            // Redirect to account details page
            header("Location: account.php");
        }
    }
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
            <form method="POST">
                <p><span class="error">* All Fields Required</span></p>
                <ul id="registrationList"> <!-- validate data first and put text restrictions on input-->
                    <li>
                        <label>Username: </label>
                        <input name="username" type="text" value="<?php echo $username;?>" required>
                        <span class="error">* <?php echo $usernameErr;?></span>
                    </li>
                    <li>
                        <label>Password: </label>
                        <input name="password" type="password" value="<?php echo $password;?>" required>
                        <span class="error">* <?php echo $passwordErr;?></span>
                    </li>
                    <li>
                        <label>Password Confirmation: </label>
                        <input name="passwordConfirmation" type="password" value="<?php echo $confirmation;?>" required>
                        <span class="error">* <?php echo $confirmationErr;?></span>
                    </li>
                    <li>
                        <label>Credit Card:</label>
                        <input name="credit-card" type="text" value="<?php echo $creditcard;?>" required>
                        <span class="error">* <?php echo $creditCardErr;?></span>
                    </li>
                    <li>
                        <label>Email:</label>
                        <input name="email" type="text" value="<?php echo $email;?>" required>
                        <span class="error">* <?php echo $emailErr;?></span>
                    </li>
                    <li>
                        <label>Phone:</label>
                        <input name="phone" type="text" required>
                        <span class="error">*</span>
                    </li>
                    <li>
                        <label>Shipping Address:</label>
                        <span class="error">*</span><br>
                        <input name="firstName" type="text" placeholder="First Name">
                        <input name="lastName" type="text" placeholder="Last Name"><br>
                        <input name="address1" type="text" placeholder="Address 1"><br>
                        <input name="address2" type="text" placeholder="Address 2"><br>
                        <input name="country" type="text" placeholder="Country / Region"><br>
                        <input name="zipcode" type="text" placeholder="Zipcode">
                        <input name="city" type="text" placeholder="City">
                        <input name="state" type="text" placeholder="State"><br>
                        <label>Same as billing address?</label>
                        <input name="sameAddress" type="checkbox">
                    </li>
                </ul>
                <input type="submit">
            </form>
        </main>
        <script src="index.js"></script>  
    </body>
    <footer id="homeFooter">
        <p>&copy; 2020 NED's Grocery</p>
    </footer>
</html>