<?php 

session_start();

//Register User
if (isset($_POST['regu'])) {
 $fname = $_POST['fname'];
 $email = $_POST['email'];
 $password = $_POST['password'];
 $passwordconfirm = $_POST['cpassword'];
 $phone = $_POST['phone'];
 $mod = $_POST['mod'];
 $type = $_POST['type'];

 require_once 'dbconnection.inc.php';

 if ($password == $passwordconfirm) {
  if ($mod == 1) {
  $sql = "INSERT INTO `users`(`Fullname`, `Email_Address`, `Phone_Number`, `Password`, `User_Type`) VALUES ('$fname','$email','$phone',md5('$password') , 'User')";
     mysqli_query($conn, $sql);
  header("Location: index.html?userregistration=success");
  }else{
   $sql = "INSERT INTO `users`(`Fullname`, `Email_Address`, `Phone_Number`, `Password`, `User_Type`) VALUES ('$fname','$email','$phone', md5('$password'), '$type')";
     mysqli_query($conn, $sql);
  header("Location: index.php?userregistration=success");
 }
}else{
  echo "Passwords do not match.";
 }
}

//Make Appointment
if (isset($_POST['addp'])) {
 $det = $_POST['det']; 
 $uid = $_SESSION['username'];
 $sid = $_POST['sid'];
 $time = $_POST['time'];
 $date = $_POST['date']; 

 require_once 'dbconnection.inc.php';
  
  $sql = "INSERT INTO `appointments`(`User_ID`, `Specialist_ID`, `Details`, `Date`, `Time`) VALUES ('$uid','$sid','$det','$date','$time')";
     mysqli_query($conn, $sql);
  header("Location: index2.php?makeappointment=success");
 }

//Add Resources
if (isset($_POST['addre'])) {
 $uid = $_POST['uid'];
 $sid = $_SESSION['specname'];
 $fname = $_POST['fname'];
 $det = $_POST['det'];

 require_once 'dbconnection.inc.php';


if ($_FILES["file"]["error"] === 4) {
   echo "<script> alert('File does not exist!'); </script>";
  }else{
  $uploads_dir = 'upload';
  $fileName = $_FILES["file"]["name"];
  $fileSize = $_FILES["file"]["size"];
  $tmpName = $_FILES["file"]["tmp_name"];

  $validImageExtension = ['doc', 'pdf', 'png', 'jpg', 'mp3'];
  $imageExtension = explode('.', $fileName);
  $imageExtension = strtolower(end($imageExtension));

  if (!in_array($imageExtension, $validImageExtension)) {
    echo "<script> alert('Invalid File Format!'); </script>";
  }else if($fileSize > 10000000){
    echo "<script> alert('File is too large!'); </script>";
  }else{

    $newImgName = uniqid();
    $newImgName .= '.' . $imageExtension;

    move_uploaded_file($tmpName, "$uploads_dir/$newImgName");

  
  $sql = "INSERT INTO `resources`(`User_ID`, `Specialist_ID`, `Name`, `Details`, `File`) VALUES ('$uid','$sid', '$fname', '$det', '$newImgName')";
     mysqli_query($conn, $sql);
  header("Location: index1.php?addfile=success");
 }
}
}

//Add Progress Report
if (isset($_POST['addr'])) {
 $sid = $_SESSION['specname'];
 $det = $_POST['det'];
 $uid = $_POST['uid']; 

 require_once 'dbconnection.inc.php';
  
  $sql = "INSERT INTO `progress_report`(`User_ID`, `Specialist_ID`, `Details`) VALUES ('$uid', '$sid', '$det')";
     mysqli_query($conn, $sql);
  header("Location: index1.php?addprogressreport=success");
 }

//Delete Functions

        if($_REQUEST['action'] == 'deleteU' && !empty($_REQUEST['id'])){ 
        require_once 'dbconnection.inc.php';
        $deleteItem = $_REQUEST['id'];
        $sql = "DELETE FROM `users` WHERE `User_ID` = '$deleteItem'";
        mysqli_query($conn, $sql); 
        header("Location: index.php?deleteuser=success");
        }

        if($_REQUEST['action'] == 'deleteP' && !empty($_REQUEST['id'])){ 
        require_once 'dbconnection.inc.php';
        $deleteItem = $_REQUEST['id'];
        $sql = "DELETE FROM `progress_report` WHERE `Report_ID` = '$deleteItem'";
        mysqli_query($conn, $sql); 
        header("Location: index1.php?deleteprogressreport=success");
        }

        if($_REQUEST['action'] == 'deleteA' && !empty($_REQUEST['id'])){ 
        require_once 'dbconnection.inc.php';
        $deleteItem = $_REQUEST['id'];
        $sql = "DELETE FROM `appointments` WHERE `Appointment_ID` = '$deleteItem'";
        mysqli_query($conn, $sql);         
        header("Location: index2.php?deleteappointment=success");
        }

        if($_REQUEST['action'] == 'deleteR' && !empty($_REQUEST['id'])){ 
        require_once 'dbconnection.inc.php';
        $deleteItem = $_REQUEST['id'];
        $sql = "DELETE FROM `resources` WHERE `Resource_ID` = '$deleteItem'";
        mysqli_query($conn, $sql);         
        header("Location: index1.php?deleteresource=success");
        }        

//Update Functions

        if($_REQUEST['action'] == 'cancelA' && !empty($_REQUEST['id'])){ 
        require_once 'dbconnection.inc.php';
        $updateItem = $_REQUEST['id'];
        $sql = "UPDATE `appointments` SET `Status`='Cancelled' WHERE `Appointment_ID`='$updateItem'";
        mysqli_query($conn, $sql); 
        header("Location: index1.php?cancelAppointment=success");          
        }

        if($_REQUEST['action'] == 'acceptA' && !empty($_REQUEST['id'])){ 
        require_once 'dbconnection.inc.php';
        $updateItem = $_REQUEST['id'];
        $sql = "UPDATE `appointments` SET `Status`='Accepted' WHERE `Appointment_ID`='$updateItem'";
        mysqli_query($conn, $sql); 
        header("Location: index1.php?acceptAppointment=success");          
        }        

        if($_REQUEST['action'] == 'completeA' && !empty($_REQUEST['id'])){ 
        require_once 'dbconnection.inc.php';
        $updateItem = $_REQUEST['id'];
        $sql = "UPDATE `appointments` SET `Status`='Complete' WHERE `Appointment_ID`='$updateItem'";
        mysqli_query($conn, $sql); 
        header("Location: index1.php?completeAppointment=success");          
        }

//Update User
if (isset($_POST['upu'])) {
 $fname = $_POST['fname'];
 $email = $_POST['email'];
 $uid = $_POST['uid'];
 $phone = $_POST['phone'];
 $password = $_POST['password'];
 $passwordconfirm = $_POST['cpassword'];

 require_once 'dbconnection.inc.php';

 if ($password == $passwordconfirm) {
  if ($mod == 1) {
  $sql = "UPDATE `users` SET `Fullname`='$fname',`Email_Address`='$email',`Phone_Number`='$phone',`Password`=md5('$password') WHERE `User_ID`='$uid'";
     mysqli_query($conn, $sql);
  header("Location: index.php?updateadministrator=success");
  }else if ($mod == 2) {
  $sql = "UPDATE `users` SET `Fullname`='$fname',`Email_Address`='$email',`Phone_Number`='$phone',`Password`=md5('$password') WHERE `User_ID`='$uid'";
     mysqli_query($conn, $sql);
  header("Location: index1.php?updatespecialist=success");
  }else{
  $sql = "UPDATE `users` SET `Fullname`='$fname',`Email_Address`='$email',`Phone_Number`='$phone',`Password`=md5('$password') WHERE `User_ID`='$uid'";
     mysqli_query($conn, $sql);
  header("Location: index2.php?updateuser=success");
 }
 }else{
  echo "Passwords do not match.";
 }
}

?>