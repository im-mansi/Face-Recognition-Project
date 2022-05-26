<?php
include 'connection.php';
if (isset($_POST['submit'])) {
    $imgname = $_FILES['Image']['name'];
    $stu_name = $_POST['name'];
    echo '<br>';
    $extension = pathinfo($imgname, PATHINFO_EXTENSION);
    $newname = $stu_name . '.' . $extension;

    $filename = $_FILES['Image']['tmp_name'];

    $name=$_POST['name'];
    $course=$_POST['course'];
    $password=$_POST['password'];
    $session=$_POST['session'];
    $email=$_POST['email'];

    // var_dump($admNo);
    
    if (move_uploaded_file($filename, 'ImagesAttendance/' . $newname)) {
        $insertqry = "INSERT INTO register VALUES(null,'$name', '$course', '$session', '$email','$password', '$newname')";
        $insertes = mysqli_query($con, $insertqry);

        if($insertes){
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
</head>

<body>
    <table>
        <table border="1" align="center" id='addStudents'>
            <form action="" method="post" enctype="multipart/form-data">
               <tr>
                   <td colspan="2" align="center">
    <h2>Registration Form</h2>
                   </td>
               </tr>
                <tr>
                    <td>Name</td>
                    <td><input type="text" name="name" placeholder="Enter Name" required></td>
                </tr>
                <tr>
                    <td>Course</td>
                    <td><input type="text" name="course" placeholder="Enter Course" required></td>
                </tr>
                <tr>
                    <td>Session</td>
                    <td><input type="text" name="session" placeholder="Enter Session" required></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><input type="email" name="email" placeholder="Enter Email" required></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="text" name="password" placeholder="Enter Password" required></td>
                </tr>
                <tr>
                    <td>Image</td>
                    <div>
                        <td>
                            <div id="img-preview"></div>
                            <input type="file" name="Image" accept="image/*" required id="choose-file">
                        </td>
                    </div>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" name="submit"></td>
                </tr>
            </form>
        </table>
    </table>

    <script>
    const chooseFile = document.getElementById("choose-file");
    const imgPreview = document.getElementById("img-preview");

chooseFile.addEventListener("change", function () {
  getImgData();
});

function getImgData() {
  const files = chooseFile.files[0];
  if (files) {
    const fileReader = new FileReader();
    fileReader.readAsDataURL(files);
    fileReader.addEventListener("load", function () {
      imgPreview.style.display = "block";
      imgPreview.innerHTML = '<img src="' + this.result + '" />';
    });    
  }
}
    </script>
</body>

</html>