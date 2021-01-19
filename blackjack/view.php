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
		<h3> Drawn Cards: </h3>
<table>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
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
	</div>
</body>

<style>

li {
	list-style-type: none;
	display: inline;
	padding: 16px;
	text-align: center
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

</style>
</html>