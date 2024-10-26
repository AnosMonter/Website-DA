<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>

<body>
    <div class="Backgrounds-Admin-Login">
        <form action="" method="post" class="Admin-Login">
            <label for="">
                <?php
                echo isset($_GET['Error']) ? '<b>' . $_GET['Error'] . '</b>' : '';
                echo isset($_GET['Success']) ? '<b>' . $_GET['Success'] . '</b>' : '';
                ?>
            </label>
            <label><h1>Login</h1></label>
            <fieldset>
                <legend>UserName</legend>
                <input type="text" name="username" placeholder="UserName">
            </fieldset>
            <fieldset>
                <legend>Password</legend>
                <input type="password" name="password" placeholder="Password">
            </fieldset>
            <label for=""><input type="submit" name="submit" value="Login"></label>
        </form>
    </div>
</body>

</html>