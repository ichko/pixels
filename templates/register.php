<form method="POST">
    <?=$model['validation_report']?>
    <input type="text" name="name" value="<?=$model['name']?>" placeholder="Username">
    <input type="email" name="email" value="<?=$model['email']?>" placeholder="Email">
    <input type="password" name="password" placeholder="Password">
    <input type="submit" value="submit">
</form>
