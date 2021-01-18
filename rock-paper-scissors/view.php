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
        <h1>Rock, Paper, Scissors</h1>
        <form method="post">
            <input type="button" name="choice" value="Rock">
            <input type="button" name="choice" value="Paper">
            <input type="button" name="choice" value="Scissors">
            <input type="submit" name="play" value="Play">
        </form>
        <p> User choice: <?= $game->userChoice; ?> </p>
        <p> <?= $game->alert; ?> </p>
    </div>
</body>

</html>