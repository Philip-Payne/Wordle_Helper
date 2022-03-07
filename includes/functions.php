<?php
/*

*/

function dbconnect () {
	$servername = "localhost";
	$username = "root";
	$password = "root";
	$dbname = "fiveletterwords";

	// Create connection
	$con = new mysqli($servername, $username, $password, $dbname);

	// Check connection
	if ($con->connect_error) {
  		return die("Connection failed: " . $con->connect_error);
	}
	return $con;
}

/*

*/
function showText ($text, $show) {
	if ($show) return $text;
	return "";
}

/*

*/
function correctLetters () {
	$result = "\t<ol>\n\t\t<li>\n";
	for ($i = 1; $i <= 5; $i++) {
		$result .= "\t\t\t<input type=\"text\" class=\"correct\" id=\"c$i\" name=\"c$i\" value=\"{$_POST["c$i"]}\">\n";
	}
	$result .= "\t\t</li>\n\t</ol>\n";
	
	return $result;
}



/*

*/
function wrongPlace () {
	$result = "";
	for ($j = 1; $j <= 5; $j++) {
		$result .= "\t<ol>\n\t\t<li>\n";
		for ($i = 1; $i <= 5; $i++) {
			$result .= "\t\t\t<input type=\"text\" class=\"wrongplace\" id=\"wp$j$i\" name=\"wp$j$i\" value=\"{$_POST["wp$j$i"]}\">\n";
		}
		$result .= "\t\t</li>\n\t</ol>\n";
	}
	return $result;
}



/*

*/
function wrongLetter () {
		$result .= "\t<ol>\n\t\t<li>\n";
		for ($i = 1; $i <= 25; $i++) {
			$result .= "\t\t\t<input type=\"text\" class=\"wrong\" id=\"w$i\" name=\"w$i\" value=\"{$_POST["w$i"]}\">\n";
		}
		$result .= "\t\t</li>\n\t</ol>\n";

	return $result;
}



/*

*/
function queryC () {
	$result = "";
	for ($i = 1; $i <= 5; $i++) {
		if ($_POST["c$i"] == "") {
			$result .= "_";
		} else {
			$result .= $_POST["c$i"];
		}
	}

	return $result;
}



/*

*/
function queryW () {
	$result = "";

	for ($i = 1; $i <= 25; $i++) {
		if ($_POST["w$i"] != "") {
			$result .= "AND id NOT LIKE \"%" . $_POST["w$i"] . "%\" ";
		}
	}

	return $result;
}



/*

*/
function queryWP () {
	$result = "";
	for ($j = 1; $j <= 5; $j++) {
		for ($i = 1; $i <= 5; $i++) {
			if ($_POST["wp$j$i"] != "") {
				$result .= "AND id LIKE \"%" . $_POST["wp$j$i"] . "%\" ";
				$result .= "AND id NOT LIKE \"%" . substr_replace("_____", $_POST["wp$j$i"], $i - 1, 1) . "%\" ";
			}
		}
	}
	return $result;
}



/*

*/
function generateQuery () {
	$result = "SELECT id FROM words WHERE id LIKE \"" . 
	queryC () .
	"\"" .
	" " .
	queryW() .
	queryWP (); 

	

	return $result;
}


/*

*/
function suggestedWord ($data) {
	//$numOfWords = mysqli_num_rows ($data);
	/*
	while ($row = mysqli_fetch_assoc ($data)) {
		$result .= $row['id'] . ", ";
	}
	*/
	// Create the arrays to hold the frequency of each letter
	$words = array ();
	$letters = array ();
	
	// Populate the arrays by getting the frequency of each word
	
	while ($row = mysqli_fetch_assoc ($data)) {
		$words[] = $row['id'];
		for ($i = 0; $i < 5; $i++) {
			$letters[$i][ord(substr($row['id'], $i))] += 1;
		}
	}
	
	// create an array to hold the total for each word
	$totals = array ();
	// Populate the totals array
	foreach ($words AS $key => $word) {
		$subTotal = 0;
		for ($i = 0; $i < 5; $i++) {
			$subTotal += $letters[$i][ord(substr($word, $i))];
		}
		$totals[$key] = $subTotal;
	}
	arsort($totals);
	// We really only want the top 100 words
	//$topHundred = array_slice($totals, 0, 100);
	//var_dump($topHundred);
	foreach ($totals AS $key => $value) {
		$topWordList[] = $words[$key];
	}
	
	// Convert the array into a string with only 100 words max
	$returnString = "";
	foreach ($topWordList AS $key => $value) {
		$returnString .= "$value, ";
		if ($key > 100) break;
	}
	
	// Remove the trailing comma and space
	$returnString = rtrim ($returnString, ", ");
	// Find the index of the  element in the totals array with the highest value
	//$maxVal = max($totals);
	//$maxKey = array_search($maxVal, $totals);
	// return the corresponding word
	
	//return $words[$maxKey];
	//return $topWordList;
	return $returnString;
}

?>