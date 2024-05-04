<?php
require_once 'dbconnection.inc.php';
session_start();
if (!isset($_SESSION['adminname'])) {
    header("Location: index.html");
}else{
  $filter = $_SESSION['adminname'];
  $query=mysqli_query($conn,"SELECT * FROM `users` WHERE `User_ID`='$filter'")or die(mysqli_error());
  $row=mysqli_fetch_array($query);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Mental Health Homepage - Administrator</title>
  <meta name="description" content="Free Bootstrap Theme by BootstrapMade.com">
  <meta name="keywords" content="free website, free bootstrap themes, free bootstrap">

  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans|Raleway|Candal">
  <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
        <style type="text/css">
        
          table{
    align-items: center;
  }

   th, tr, td{
    padding: 10px 10px;
  }
    </style>

            <script type="text/javascript">
function printData()
{
   var divToPrint=document.getElementById("printTable");
   newWin= window.open("");
   newWin.document.write(divToPrint.outerHTML);
   newWin.print();
   newWin.close();
}

$('button').on('click',function(){
printData();
})  
</script>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">
  <!--banner-->
  <section id="banner" class="banner">
    <div class="bg-color">
      <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
          <div class="col-md-12">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                      </button>
              <a class="navbar-brand" href="#"><img src="img/hlog.png" class="img-responsive" style="width: 140px; margin-top: -16px;"></a>
            </div>
            <div class="collapse navbar-collapse navbar-right" id="myNavbar">
              <ul class="nav navbar-nav">
                <li class="active"><a href="#banner">Home</a></li>
                <li class=""><a href="logout.php">Logout</a></li>
                <li class=""><a href="#footer">Contact</a></li>
              </ul>
            </div>
          </div>
        </div>
      </nav>
      <div class="container">
        <div class="row">
          <div class="banner-info">
            <div class="banner-logo text-center">
              <img src="img/hlog.png" class="img-responsive" style="width: 500px;">
            </div>
            <div class="banner-text text-center">
              <h1 class="white">Embrace Your Mental Well-Being!</h1>
              <p>Welcome <?php echo $row['User_Type']; ?>, <?php echo $row['Fullname']; ?>!</p>
              <a href="#start" class="btn btn-appoint">Get Started.</a>
            </div>
            <div class="overlay-detail text-center">
              <a href="#service"><i class="fa fa-angle-down"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--/ banner-->
  <!--service-->
  <section id="about" class="section-padding">
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-sm-4">
          <h2 class="ser-title">About Us</h2>
          <hr class="botm-line">
          <p>At Mental Health, we firmly believe that mental well-being is a fundamental aspect of leading a happy and fulfilling life. We aim to create a safe space where people can freely discuss their challenges, find solace in shared experiences, and access professional guidance.
            <br>
            <br>
          Our platform offers a wide range of articles, guides, and self-help tools on various mental health topics, including anxiety, depression, stress management, self-care, and more. We strive to empower individuals with knowledge and coping strategies to enhance their emotional resilience.</p>
        </div>
        <div class="col-md-3 col-sm-4">
          <div class="service-info">
            <div class="icon">
              <i class="fa fa-user-md"></i>
            </div>
            <div class="icon-info">
              <h4>Specialist Counseling</h4>
            </div>
          </div>          
        </div>
        <div class="col-md-3 col-sm-4">
          <div class="service-info">
            <div class="icon">
              <i class="fa fa-stethoscope"></i>
            </div>
            <div class="icon-info">
              <h4>24 Hour Support</h4>
            </div>
          </div>          
        </div>        
      </div>
    </div>
  </section>
  <!--/ service-->
  <!--about-->
  <section id="about" class="section-padding">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-sm-4 col-xs-12">
          <div class="section-title">
            <h2 class="head-title lg-line">Database</h2>
            <hr class="botm-line">
            <p class="sec-para">List of Users</p>
                                     <table id="printTable">
<tr style="text-align: left;
  padding: 8px;">
<th style="text-align: left;
  padding: 8px;">User ID</th>
<th style="text-align: left;
  padding: 8px;">Fullname</th>
  <th style="text-align: left;
  padding: 8px;">Email Address</th>
 <th style="text-align: left;
  padding: 8px;">Phone Number</th>
  <th style="text-align: left;
  padding: 8px;">User Type</th>
   <th style="text-align: left; padding: 8px;"></th>
</tr>

<?php
$conn = mysqli_connect("localhost", "root", "", "mental_health");
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT `User_ID`, `Fullname`, `Phone_Number`, `Email_Address`, `User_Type` FROM `users`";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
?>
<tr>
<td><?php echo($row["User_ID"]); ?></td>
<td><?php echo($row["Fullname"]); ?></td>
<td><?php echo($row["Email_Address"]); ?></td>
<td><?php echo($row["Phone_Number"]); ?></td>
<td><?php echo($row["User_Type"]); ?></td>
<td><button class="btn btn-primary py-3 px-5" onclick="return confirm('Are you sure you want to delete this user?')?window.location.href='insertion.inc.php?action=deleteU&id=<?php echo($row["User_ID"]); ?>':true;" title='Delete User'>Delete</button></td>
</tr>
<?php
}
} else { echo "No results"; }
$conn->close();
?>

</table>
            <a href="" onclick="printData();" style="color: #0cb8b6; padding-top:10px;">Print</a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--/ about-->
  <!--contact-->
  <section id="contact" class="section-padding">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h2 class="ser-title">My Module</h2>
          <hr class="botm-line">
        </div>
        <div class="col-md-6 col-sm-8 marb20">
          <div class="contact-info">
            <h3 class="cnt-ttl">Update My Details</h3>
            <div class="space"></div>
            <form action="insertion.inc.php" method="post" class="contactForm">
            <div class="form-group">
                <input type="text" name="fname" class="form-control br-radius-zero" id="fname" placeholder="Your Fullname" required />
                <input type="hidden" value="1" name="mod" required>
                <input type="hidden" value="<?php echo $filter; ?>" name="uid" required>
              </div>
              <div class="form-group">
                <input type="email" class="form-control br-radius-zero" name="email" id="email" placeholder="Your Email" required />
              </div>
              <div class="form-group">
                <input type="text" class="form-control br-radius-zero" name="phone" id="phone" placeholder="Your Phone" required />
              </div>
              <div class="form-group">
                <input type="password" class="form-control br-radius-zero" name="password" id="password" placeholder="Your Password"required />
              </div>
              <div class="form-group">
                <input type="password" class="form-control br-radius-zero" name="cpassword" id="cpassword" placeholder="Confirm Your Password"required />
              </div> 
              <div class="form-action">
                <button type="submit" class="btn btn-form" name="upu">Update</button>
              </div>
            </form>
          </div>
        </div>
        <div class="col-md-6 col-sm-8 marb20">
          <div class="contact-info">
            <h3 class="cnt-ttl">Register A User</h3>
            <div class="space"></div>
            <form action="insertion.inc.php" method="post" class="contactForm">
              <div class="form-group">
                <input type="text" name="fname" class="form-control br-radius-zero" id="fname" placeholder="Your Fullname" required />
                <input type="hidden" value="3" name="mod" required>
              </div>
              <div class="form-group">
                <input type="email" class="form-control br-radius-zero" name="email" id="email" placeholder="Your Email" required />
              </div>
              <div class="form-group">
                <input type="text" class="form-control br-radius-zero" name="phone" id="phone" placeholder="Your Phone" required />
              </div>
              <div class="form-group">
                <select class="form-control br-radius-zero" name="type" required>
                    <option value="" disabled selected>Select A User Type</option>
                    <option value="Administrator">Administrator</option>
                    <option value="Specialist">Specialist</option>
                    <option value="User">User</option>
                </select>
              </div>              
              <div class="form-group">
                <input type="password" class="form-control br-radius-zero" name="password" id="password" placeholder="Your Password"required />
              </div>
              <div class="form-group">
                <input type="password" class="form-control br-radius-zero" name="cpassword" id="cpassword" placeholder="Confirm Your Password"required />
              </div>                
              <div class="form-action">
                <button type="submit" class="btn btn-form" name="regu">Register</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--/ contact-->
  <!--footer-->
  <footer id="footer">
    <div class="top-footer">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-sm-4 marb20">
            <div class="ftr-tle">
              <h4 class="white no-padding">Quick Links</h4>
            </div>
            <div class="info-sec">
              <ul class="quick-info">
                <li><a href="index.php"><i class="fa fa-circle"></i>Home</a></li>
                <li><a href="#about"><i class="fa fa-circle"></i>About Us</a></li>
                <li><a href="logout.php"><i class="fa fa-circle"></i>Logout</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md-6 col-sm-4 marb20">
            <div class="ftr-tle">
              <h4 class="white no-padding">Contact Us</h4>
            </div>
            <div class="info-sec">
          <p><i class="fa fa-map-marker fa-fw pull-left fa-2x"></i>Nairobi, Kenya.</p>
          <div class="space"></div>
          <p><i class="fa fa-envelope-o fa-fw pull-left fa-2x"></i>mental_health@gmail.com</p>
          <div class="space"></div>
          <p><i class="fa fa-phone fa-fw pull-left fa-2x"></i>+254 758 189349</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="footer-line">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center">
            © Copyright Mental Health. All Rights Reserved
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!--/ footer-->

  <script src="js/jquery.min.js"></script>
  <script src="js/jquery.easing.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/custom.js"></script>
  <script src="contactform/contactform.js"></script>

</body>

</html>