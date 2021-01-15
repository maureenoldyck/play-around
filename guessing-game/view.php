<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Casino Royale - Guessing Game</title>
</head>
<body>
	<div class="container">
		<h1>Can you guess the correct number?</h1>
		<p>Guess a random number between 1 and 10!</p>
		<form action="" method="post">
			Guess: <input type="number" name="guess"><br>
			<input name="submit" type="submit">
		</form>
		<p> <?=$game->alert;?> </p>
	</div>
</body>
</html>