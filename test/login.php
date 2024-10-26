<?php
$Accout = [['User' => 'Khanh', 'Password' => 'Duy']];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doc</title>
    <style>
        .container {
            width: 1000px;
            margin: 0 auto;
            display: flex;
        }

        .Status {
            display: none;
        }

        .Login {
            opacity: 1;
            width: 500px;
            height: 300px;
            margin: 0 auto;
            border: 1px solid black;
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgb(0, 0, 0);
            transition: transform 1s;
        }

        .Register {
            opacity: 0;
            width: 500px;
            height: 300px;
            margin: 0 auto;
            border: 1px solid black;
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgb(0, 0, 0);
            transform: translateX(-500px);
            transition: transform 1s;
        }

        .Form-User::before {
            content: "";
            width: 20px;
            height: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgb(0, 0, 0);
        }

        .Status:checked~.Login {
            transform: translateX(500px);
            opacity: 0;
        }

        .Status:checked~.Register {
            transform: translateX(0);
            opacity: 1;
        }
    </style>
</head>

<body>
    <div class="container">
        <input class="Status" type="checkbox" id="Login-Register">
        <form class="Login" method="post">
            <h1>Login</h1>
            <input type="text" name="User" placeholder="User">
            <input type="text" name="Password" placeholder="Password">
            <input type="submit" name="Log_Sub" value="Login">
            <label class="Form-User" for="Login-Register">Register</label>
        </form>
        <form class="Register" method="post">
            <h1>Register</h1>
            <input type="text" name="User" placeholder="User">
            <input type="text" name="Password" placeholder="Password">
            <input type="submit" name="Reg_Sub" value="Register">
            <label class="Form-User" for="Login-Register">Login</label>
        </form>
    </div>
</body>

</html>