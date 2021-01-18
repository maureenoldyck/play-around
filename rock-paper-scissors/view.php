<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">    
    <title>Casino Royale - Rock, Paper, Scissors</title>
</head>

<body>
    <div class="container">
        <h1>Cat🐱, Mouse🐭, Elephant🐘</h1>
        <form method="post">
            <input type="submit" name="choice" value="Cat">
            <input type="submit" name="choice" value="Mouse">
            <input type="submit" name="choice" value="Elephant">
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

</html>