<!DOCTYPE html>
<html>

<head>
    <title> Admin Form </title>
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
  $result=$conn->query("select * from student_details where eid='".$eid."'");		
while($row=$result->fetch_row())		
{		
echo "<script type='text/javascript'>alert('Enrolment ID already registered. Please login with your enrolment id and registered password')</script>";		
 die("Enrolment ID already registered. Please login with your enrolment id and registered password &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='addremovestudent.php'><button>Back</button></a>");		
} 
$n=$_POST['t1'];
$e=$_POST['t2'];
$cp=$_POST['t3'];
$cmp=$_POST['t4'];
$pn=$_POST['t5'];
	
$_SESSION['password'] = $cp;		
$qr="insert into student_details(name, phone, email, password, eid) values('".$n."','".$pn."','".$e."','".$cp."','".$eid."')";
$conn->query($qr);
header("location:completeregis.php");
}
}
?>
    <?php
if(isset($_POST['s2']))
{
$ch=0;
$eid=$_POST['eid'];

$result=$conn->query("select * from student_details where eid='".$eid."'");
while($row=$result->fetch_row())
{
$qr="delete from student_details where eid='".$eid."'";
if($conn->query($qr)==TRUE)
{
echo "<script type='text/javascript'>alert('Record successfully deleted')</script>";
$ch=1;
}
else
{
echo "<script type='text/javascript'>alert('Error deleting record')</script>";
$ch=1;
}
}  
if($ch=="0")
{
echo "<script type='text/javascript'>alert('Sorry, no student with this enrolment id is registered')</script>";
}

}
?>

        <div class="form">

            <ul class="tab-group">
                <li class="tab active"><a href="#signup">Add Student</a></li>
                <li class="tab"><a href="#login">Remove Student</a></li>
            </ul>

            <div class="tab-content">
                <div id="signup">
                    <h1>Student Registration System</h1>

                    <form method="post">

                        <div class="top-row">
                            <div class="field-wrap">
                                <label>
                Name<span class="req">*</span>
              </label>
                                <input type="text" name="t1" required minlength="7" />
                            </div>

                            <div class="field-wrap">
                                <label>
                Contact Number<span class="req">*</span>
              </label>
                                <input name="t5" type="text" required minlength="10" maxlength="15" onkeypress='return event.charCode >= 48 && event.charCode <= 57' />
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
              Set A Password<span class="req">*</span>
            </label>
                            <input name="t3" type="password" required id="password" required minlength="8" />
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

                        <input type="submit" value="Get Started" name="s1" class="button button-block" />
                        <br/><br/><button class="button button-block" onClick="document.location.href='admin_page.php'">Back</button>

                    </form>

                </div>

                <div id="login">
                    <h1>Be sure before removing a student</h1>

                    <form method="post">

                        <div class="field-wrap">
                            <label>
              Enrollment ID<span class="req">*</span>
            </label>
                            <input name="eid" type="text" required autocomplete="off" />
                        </div>

                        <input type="submit" value="Remove" name="s2" class="button button-block" />
                        <br/><br/><button class="button button-block" onClick="document.location.href='admin_page.php'">Back</button>


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