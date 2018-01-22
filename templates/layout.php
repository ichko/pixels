<?php
$auth_service = $model['auth_service'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?=$model['title']?> :: The joy of painting</title>

    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/default.min.css">
    <link rel="stylesheet" type="text/css" href="/public/css/styles.css">
</head>
<body>
<main>

<nav class="clear">
<div class="limiter">
    <ul class="right">
<?php if ($auth_service->is_logged()) {?>
        <li>Hello, <b><?=$auth_service->get_logged_user()['name']?></b></li>
        <li><a href="/logout">Logout</a></li>
        <li><a href="/snippet/create">Create new</a></li>
<?php } else {?>
        <li><a href="/login">Login</a></li>
        <li><a href="/register">Register</a></li>
<?php }?>
    </ul>
    <ul class="left">
        <li><a href="/">Home</a></li>
    </ul>

    <h1><?=$model['title']?></h1>
</div>
</nav>

<content class="clear">
    <div class="limiter">
        <?=$model['content']?>
    </div>
</content>

<footer>
    &copy; 2018
</footer>

</main>
</body>
</html>
