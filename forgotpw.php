<!DOCTYPE html>
<html>

<head>
    <title> Student Form </title>
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="css/normalize.css">


    <link rel="stylesheet" href="css/style.css">
</head>
<?php

session_start();
$conn=mysqli_connect("localhost","root","","student");
if(!isset($conn))
{
echo"sorry!database connection error";
}
else
{
if(isset($_POST['s1']))
{
$ma="1";
$eid=$_POST['eid'];
$_SESSION['eid'] = $eid;

$guardianname=$_POST['t1'];
$pw=$_POST['t3'];
$cpw=$_POST['t4'];
$dob=$_POST['t5'];
$result=$conn->query("select * from student_details where eid='".$eid."'");
while($row=$result->fetch_row())
{
if($row[7]==$guardianname && $row[6]==$dob)
{
$qr="UPDATE student_details SET password='".$pw."'WHERE eid='".$eid."'";
$conn->query($qr);
echo "<script type='text/javascript'>alert('Congratulations! password successfully reset')</script>";
}
else{
echo "<script type='text/javascript'>alert('The details you provided do not match records.')</script>";
}
}  

}
}
?>
    <?php
if(isset($_POST['s2']))
{
$ch=0;
$id=$_POST['tt1'];
$pas=$_POST['tt2'];
$_SESSION['eid'] = $id;
$_SESSION['password'] = $pas;
if($id=="0000" && $pas=="amu_reg")
{
header("location:admin_page.php");
$ch="1";
}
$result=$conn->query("select * from student_details");
while($row=$result->fetch_row())
{
if($id==$row[0] && $pas==$row[9])
{
header("location:det.php");
$ch="1";
}
}
if($ch=="0")
{
echo "<script type='text/javascript'>alert('Sorry!! wrong username or password..')</script>";
}
}
?>

        <div class="form">

            <ul class="tab-group">
                <li class="tab active"><a href="#signup">Forgot password</a></li>
                <li class="tab"><a href="#login">Login</a></li>
            </ul>

            <div class="tab-content">
                <div id="signup">
                    <h1>Reset your password</h1>

                    <form method="post">

                        <div class="top-row">
                            <div class="field-wrap">
                                <label>
                Guardian's Name<span class="req">*</span>
              </label>
                                <input type="text" name="t1" required minlength="7" />
                            </div>

                            <div class="field-wrap">
                                <label>
                Date of birth<span class="req">*</span>
              </label>
                                <input name="t5" type="date" required />

                            </div>
                        </div>

 <div class="field-wrap">
                            <label>
              Enrolment ID<span class="req">*</span>
            </label>
                            <input name="eid" type="text" required minlength="6" maxlength="7" />
                        </div>

                      
                        <div class="field-wrap">
                            <label>
              Set New Password<span class="req">*</span>
            </label>
                            <input name="t3" type="password" id="password" required minlength="8" />
                        </div>

                        <div class="field-wrap">
                            <label>
              Confirm Password<span class="req">*</span>
            </label>
                            <input name="t4" type="password" required oninput="check(this)" />
                        </div>

                        <script language='javascript' type='text/javascript'>
                            function check(input) {
                                if (input.value != document.getElementById('password').value) {
                                    input.setCustomValidity('Password Must be Matching.');
                                } else {
                                    // input is valid -- reset the error message
                                    input.setCustomValidity('');
                                }
                            }
                        </script>

                        <input type="submit" value="Reset password" name="s1" class="button button-block" />

                    </form>

                </div>

                                <div id="login">
                    <h1>Welcome Back!</h1>

                    <form method="post">

                        <div class="field-wrap">
                            <label>
              Enrollment ID<span class="req">*</span>
            </label>
                            <input name="tt1" type="text" required />
                        </div>

                        <div class="field-wrap">
                            <label>
              Password<span class="req">*</span>
            </label>
                            <input name="tt2" type="password" required />
                        </div>

                        <p class="forgot"><a href="forgotpw.php">Forgot Password?</a></p>

                        <input type="submit" value="Login" name="s2" class="button button-block" />

                    </form>

                </div>

            </div>
            <!-- tab-content -->

        </div>
        <!-- /form -->

        <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

        <script src="js/index.js"></script>

        </body>

</html>