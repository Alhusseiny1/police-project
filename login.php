<?php

require 'db.php';
if (isset($_POST['email'])) {
    extract($_POST);
    $password = crypt($password, 'qwertyuiop;dfghjm,kjhgfdfgh');
    $sql = "select * from users where email = '$email' and password='$password' ";
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    $count = mysqli_num_rows($result);
    if ($count == 1) {
        //success
        $user = mysqli_fetch_assoc($result);
        //sessions
        session_start();
        $_SESSION['user'] = $user;
        header('location:home.php');

    } else {
        $error = "Wrong username or password";
    }
}


/*$password = crypt ('123456','qwertyuiop;dfghjm,kjhgfdfgh');
$sql="INSERT INTO  `users` ( `id`,`names`,`badge_number`,`email`,`password`)VALUES   (null,'Inspector Mwala','P001','mwala@gmail.com','$password')";

//echo $password;

mysqli_query($conn, $sql) or die(mysqli_error($conn));*/


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="bootstrap-4.2/css/bootstrap.css">
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-6">
            <div class="card" style="margin-top:60px ">
                <div class="card-header">
                    Log in
                </div>

                <div class="card-body">
                    <form action="login.php" method="post">
                        <div class="form-group">
                            <label for="email">Email address:</label>
                            <input type="email" name="email" required class="form-control" id="email">
                        </div>
                        <div class="form-group">
                            <label for="pwd">Password:</label>
                            <input type="password" name="password" required class="form-control" id="pwd">
                        </div>
                        <div class="form-check">

                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Sign in</button>
                    </form>
                    <p class="text-danger">
                        <?php
                        if (isset($error))
                            echo $error;
                        ?>
                    </p>

                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>