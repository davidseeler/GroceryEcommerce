<?php
	// Include Database
    include('database.php');
	
	// Check for existing session (Might not be necessary, but better safe than sorry)
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}

	$cartID = @$_SESSION['cartID'];
	
	if (($cartID != false) && isset($_POST['delete'])){
		$productID = $_POST['delete'];
		$query = 'DELETE FROM cartdetail
					WHERE productID = :productID';
		$statement = $db->prepare($query);
		$statement->bindValue(':productID', $productID);
		$success = $statement->execute();
		$statement->closeCursor();
	}
	
	// Display cart.php
	include('cart.php');
?>