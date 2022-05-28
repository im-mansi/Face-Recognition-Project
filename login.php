<?php

session_start();
include("connection.php");

if (isset($_POST['submit'])) {
    $user = $_POST['username'];
    $pwd = $_POST['password'];
    $query = "SELECT * FROM register WHERE email='$user' AND password='$pwd'";
    $data = mysqli_query($con, $query);

    $records = mysqli_num_rows($data);
    $result = mysqli_fetch_assoc($data);

    if ($records == 1 && $result['Name'] != 'admin' && $result['password'] != 'admin') {
        // $_SESSION['user_name']=$user;
        $_SESSION['user_name'] = $result['Name'];
        if ($_SESSION['user_name'] == 'admin') {
            header('location:admin.php');
        } else {
            header('location:attendance.php');
        }
    } elseif ($records == 1 && $result['Name'] == 'admin' && $result['password'] == 'admin') {
        $_SESSION['user_name'] = $result['Name'];
        header('location:admin.php');
    } else {
        echo "<script>alert('Login Failed')</script>";
    }
}

?>
<html>

<head>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans&display=swap" rel="stylesheet">

</head>

<body>
    <div class="form-container">
        <form action="" method="post" style="padding:50px;" style="max-width:500px;margin:auto">
            <h2 align="center" style="color:white; margin-bottom:10px;">Login Form</h2>
            <div class="input-container">
                <i class="fa fa-user icon"></i>
                <input class="input-field" type="text" placeholder="Email" name="username">
            </div>

            <div class="input-container">
                <i class="fa fa-key icon"></i>
                <input class="input-field" type="password" placeholder="Password" name="password">
            </div>
            <button type="submit" class="btn" name="submit">Login</button>
            <p align="center" style="margin-top:20px; color:white">Not Registered Yet?? <a href="addStudents.php" style="color:white">Register Now</a></p>
        </form>
    </div>
</body>

</html>