<?php
	// Include the Database
	include('database.php');

	// Check for existing session (Might not be necessary, but better safe than sorry)
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}

	$cartID = @$_SESSION['cartID'];
	
	if ($cartID != false) {
		$query = "DELETE FROM cartdetail
					WHERE cartID='$cartID'";
		$statement = $db->prepare($query);
		$success = $statement->execute();
		$statement->closeCursor();
	}
	
	// Display account.php
	include('account.php');
?>