<?php
/****************** Clear Form ******************
 *                                              *
 * This code clears the $_POST array and then   *
 * returns the user to the index page.          *
 * I cannot think of a simple way of doing this *
 * in a function and without reloading the      *
 * page.                                        *
 *                                              *
 ***********************************************/
 
 	// Unset (empty) the $_POST array
	$_POST = array();
	// Return the user to the home page
	header('Location: index.php');
?>