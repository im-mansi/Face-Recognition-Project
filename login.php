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
</head>

<body>
    <center>
    <form action="" method="post" style="padding:50px;">
        <table border="0" bgcolor='yellow' width='50%'  style="padding:50px ;">
            <tr>
                <td>Email</td>
                <td><input type="text" name="username"></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input type="text" name="password"></td>
            </tr>
            <tr>
                <td colspan="3" align="right"><input type="submit" name="submit" value="Login"></td>
            </tr>
        </table>
    </form>
    </center>

</body>

</html>