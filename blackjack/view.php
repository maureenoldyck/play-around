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
		<ul>
		<?= $game->cardsUser ?>
		</ul>
		<form method="post">
			<?= $game->hit ?> 
			<?= $game->stop ?>	
			<?= $game->reset ?>	
		</form>
		<p> Card drawn: <?= $game->cardDrawn ?></p>
		<p> Cards total: <?= $game->sumUser ?></p>
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

</style>
</html>