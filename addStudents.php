<?php
include 'connection.php';
if (isset($_POST['submit'])) {
    $imgname = $_FILES['Image']['name'];
    $stu_name = $_POST['name'];
    $Uppername = strtoupper($stu_name);
    echo '<br>';
    $extension = pathinfo($imgname, PATHINFO_EXTENSION);
    $newname = $Uppername . '.' . $extension;

    $filename = $_FILES['Image']['tmp_name'];

    //$name = $_POST['name'];
    $course = $_POST['course'];
    $password = $_POST['password'];
    $session = $_POST['session'];
    $email = $_POST['email'];

    // var_dump($admNo);

    if (move_uploaded_file($filename, 'ImagesAttendance/' . $newname)) {
        $insertqry = "INSERT INTO register VALUES(null,'$Uppername', '$course', '$session', '$email','$password', '$newname')";
        $insertes = mysqli_query($con, $insertqry);

        if ($insertes) {
            echo "<script>alert('Successfully Registered');</script>";
        }
    } else {
        echo "not uploaded";
    }
}
?>

<html>

<head>
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans&display=swap" rel="stylesheet">


</head>

<body>
    <div class="form-container">
        <form action="" method="post" style="padding:50px;" style="max-width:500px;margin:auto" enctype="multipart/form-data">
            <h2 align="center" style="color:white; margin-bottom:10px;">Registration Form</h2>
            <div class="input-container">
                <i class="fa fa-user icon"></i>
                <input class="input-field" type="text" placeholder="Name" name="name">
            </div>
            <div class="input-container">
                <i class="fa fa-envelope icon"></i>
                <input class="input-field" type="text" placeholder="Email" name="email">
            </div>
            <div class="input-container">
                <i class="fa fa-key icon"></i>
                <input class="input-field" type="password" placeholder="Password" name="password">
            </div>
            <div class="input-container">
                <i class="fa fa-calendar icon"></i>
                <input class="input-field" type="text" placeholder="Session" name="session">
            </div>
            <div class="input-container">
                <i class="fa fa-book icon"></i>
                <input class="input-field" type="text" placeholder="Course" name="course">
            </div>
            <input type="file" name="Image" accept="image/*" required id="choose-file">
            <div id="img-preview"></div>
            <button type="submit" class="btn" name="submit">Register</button>
            <p align="center" style="margin-top:20px; color:white">Already Registered?? <a href="login.php" style="color:white">Login Now</a></p>
        </form>
    </div>

    <script>
        const chooseFile = document.getElementById("choose-file");
        const imgPreview = document.getElementById("img-preview");

        chooseFile.addEventListener("change", function() {
            getImgData();
        });

        function getImgData() {
            const files = chooseFile.files[0];
            if (files) {
                const fileReader = new FileReader();
                fileReader.readAsDataURL(files);
                fileReader.addEventListener("load", function() {
                    imgPreview.style.display = "block";
                    imgPreview.innerHTML = '<img src="' + this.result + '" />';
                });
            }
        }
    </script>
</body>

</html>