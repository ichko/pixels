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

    <link rel="stylesheet" type="text/css" href="/public/css/styles.css">

    <script src="https://rawgit.com/ajaxorg/ace-builds/master/src-noconflict/ace.js" type="text/javascript" charset="utf-8"></script>
    <script src="/public/js/requester.js"></script>
    <script src="/public/js/loader.js"></script>
    <script src="/public/js/notifier.js"></script>
    <script src="/public/js/editor.js"></script>
</head>
<body>

<nav class="clear">
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
</nav>

<content class="clear">
    <?=$model['content']?>
</content>

<footer>
    &copy; 2018
</footer>

</body>
</html>
