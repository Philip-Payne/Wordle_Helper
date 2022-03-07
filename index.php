<?php
	// Enable access to the functions which provide the err... functionality!
	include "includes/functions.php";
	// Enable access to the help text for the "tool tips"
	include "includes/helpText.php";
	$query = generateQuery ();
	$result = mysqli_query (dbconnect(), $query);
	mysqli_close($con);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Wordle Solver</title>
	<link rel="stylesheet" href="styles/style.css">
</head>
<body>
<div id="wrapper">

	<header>
		<h1>Wordle Solver</h1>
	</header>

	<main>

	<form action="index.php" method="POST">

		<div id="leftcol">

			<fieldset>
				<legend>
					<a href="#" data-tooltip="<?php echo $knownLetters; ?>" class="tooltipleft">
						Known Letters
					</a>
				</legend>
				<?php echo correctLetters(); ?>
			</fieldset>

			<fieldset>
				<legend>
					<a href="#" data-tooltip="<?php echo $wrongPlaceLetters; ?>" class="tooltipleft">
						Right Letter, Wrong Place
					</a>
				</legend>
				<?php echo wrongPlace(); ?>
			</fieldset>

		</div>

		<div id="rightcol">

			<fieldset>
				<legend>
					<a href="#" data-tooltip="<?php echo $wrongLetters; ?>" class="tooltipright">
						Wrong Letter
					</a>
				</legend>
				<?php echo wrongLetter(); ?>
		</fieldset>

		</div>
		
		<div id="go">
			<input type="submit" id="submit" name="submit" value="GO" class="go">
		</div>
		
	</form>
	<p class="clearForm">
		<a href="clearForm.php">Clear Form</a>
	</p>
	<h3>Suggested Words:</h3>
	<p>
		<?php  echo suggestedWord($result); ?>
	</p>

	</main>

	<footer>
	
		<p>
			<?php echo showText ("<h4>The Query</h4>\n$query", false); ?>
		</p>
		
	</footer>

</div>
</body>
</html>