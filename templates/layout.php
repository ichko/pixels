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
</head>
<body>
<main>

<nav>
    <ul class="right">
<?php if ($auth_service->is_logged()) {?>
    <li>Hello, <?=$auth_service->get_logged_user()['name']?></li>
    <li><a href="/logout">Logout</a></li>
    <li><a href="/snippet/create">Create new</a></li>
<?php } else {?>
        <li><a href="/login">Login</a></li>
        <li><a href="/register">Register</a></li>
<?php }?>
    </ul>
    <ul>
        <li><a href="/">Home</a></li>
    </ul>
</nav>

<h1><?=$model['title']?></h1>
<?=$model['content']?>

</main>
</body>
</html>
