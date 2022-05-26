<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php
// $page = $_SERVER['PHP_SELF'];
// $sec = "2";
// header("Refresh: $sec; url=$page");

session_start();
$userprofile=$_SESSION['user_name'];
if($userprofile==null){
    header('location:login.php');
}

include "connection.php";
$file=fopen('Attendance.csv','r');
$row=fgetcsv($file);


echo "<center>";
echo "<table border='1' id='Attendance'>";

echo "
<tr>
    <td colspan='2' style='background:lime;'>Welcome: ".$userprofile."</td>
    <td colspan='2' style='background:yellow;'><a href='logout.php'>Logout</a></td>
</tr>

<tr>
    <th>Name</th>
    <th>
    <form action='' method='post'>
    <input type='date' name='selectedDate' required>
    <input type='submit' name='submit' id='atnSubmit'>
</form>
    </th>
    <th>Entry</th>
    <th>Exit</th>
</tr>
";
$todaysDate=date("y/m/d");

if (isset($_POST['submit'])) {
    $timestamp = strtotime($_POST['selectedDate']); 
    $date=date('d',$timestamp);
    $month=date('m',$timestamp);
    $year=date('y',$timestamp);
    $SelectedDate=$year."/".$month."/".$date;
}else{
    $SelectedDate=$todaysDate;
}
    echo "
    <tr>
    <td colspan='4' bgcolor='lime'><marquee>This Table is showing <mark>".$SelectedDate."</mark> attendance only please select any previous day</marquee></td>
    </tr>
    ";
    if($file){
        while(($row=fgetcsv($file))!==False){
            $timestamp = $row[1];
            $splitTimeStamp = explode(" ",$timestamp);
            $date = $splitTimeStamp[0];
            $time = $splitTimeStamp[1];

            if($row[2]=="Clock In" && $date==$SelectedDate){
                echo "
                <tr>
                    <td>".$row[0]."</td>
                    <td>".$date."</td>
                    <td>".$time."</td>
                ";
            }
            if($row[2]=="Clock Out" && $date==$SelectedDate){
                echo "
                    <td>".$time."</td>
                    </tr>
                ";
            }
        }
    }
echo "</table>";
?>
</body>
</html>