<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Casino Royale - Rock, Paper, Scissors</title>
</head>

<body>
    <div class="container">
        <h1>Cat🐱, Mouse🐭, Elephant🐘</h1>
        <form method="post">
        <?= $game->cat ?>
        <?= $game->mouse ?>
        <?= $game->elephant ?>
        <br> 
        <br> 
        <input type="submit" name="play" value="Play">
        </form>
        <p> User choice: <?= $game->userChoice; ?> </p>
        <p> Computer chose: <?= $game->computerChoice; ?> </p>
        <p> <?= $game->alert; ?> </p>
        <form method="post">
        <?= $game->playAgain; ?>
        </form>
    </div>
</body>

<style> 
body {
    margin: 0;
    padding: 0;
}

.container {
    text-align: center;
    padding: 50px;
}

input {
  background-color: #849984;
  border: none;
  color: white;
  padding: 16px 32px;
  margin: 4px 2px;
  cursor: pointer;
}

</style>

</html>