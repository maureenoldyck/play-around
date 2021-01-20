<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Casino royale - Blackjack</title>
</head>
<body>
	<div class="container">
		<h2> Drawn Cards: </h2>
		<table>
			<tr>
			<?php foreach ($_SESSION['userCards'] as $cardDrawn): ?>
				<td class="drawnCards"> <b> <?= $cardDrawn ?> </b> </td> 
			<?php endforeach; ?>			
			</tr>
		</table>
		<form method="post">
			<?= $game->hit ?> 
			<?= $game->stop ?>	
			<?= $game->reset ?>	
		</form>
		<p> <?= $game->cardDrawn ?></p>
		<p> <?= $game->sumUser ?></p>
		<p> <?= $game->sumDealer ?></p>
		<p> <?= $game->alert ?></p>
		<h2> Dealer Cards: </h2>
		<table>
			<tr>
			<?php foreach ($_SESSION['dealerCards'] as $cardDrawn): ?>
				<td class="drawnCards"> <b> <?= $cardDrawn ?> </b> </td> 
			<?php endforeach; ?>			
			</tr>
		</table>
	</div>
</body>

<style>

body {
	background-color: #B5CCBD;
}

h2 {
	color: #CF9490;
}

td {
	list-style-type: none;
	display: inline;
	text-align: center;
}

input {
  background-color: #849984;
  border: none;
  color: white;
  padding: 16px 32px;
  margin: 4px 2px;
  cursor: pointer;
}

.container {
	margin: 0 auto;
	width: 70%;
	text-align: center;
}

.drawnCards {
	color: white;
	font-size: 30px;
	border: 1px solid white;
	margin: 0 10px;
	padding: 40px;
}

table {
	margin: 80px 0;
}

</style>
</html>