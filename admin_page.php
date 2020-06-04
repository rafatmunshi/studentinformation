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
if(isset($_POST['submit']))
{
$ma="1";
$cid=$_POST['cid'];
$sem=$_POST['sem'];
$_SESSION['cid'] = $cid;
$_SESSION['sem'] = $sem;
header("location:course_details.php");
}
}
?>

    <?php
if(isset($_POST['s2']))
{
$ch=0;
$eid=$_POST['tt1'];
$_SESSION['eid'] = $eid;
$result=$conn->query("select * from student_details where eid='".$eid."'");
while($row=$result->fetch_row())
{
if($eid==$row[0])
{
header("location:det.php");
$ch="1";
}
}
if($ch=="0")
{
echo "<script type='text/javascript'>alert('Sorry, student with this enrolment id is not registered.')</script>";
}
}
?>

        <div class="form">

            <ul class="tab-group">
                <li class="tab active"><a href="#signup">Course</a></li>
                <li class="tab"><a href="#login">Student</a></li>
            </ul>

            <div class="tab-content">
                <div id="signup">
                    <h1>Find Course details</h1>

                    <form method="post">

                        <div class="top-row">
                            <div class="field-wrap">
                                <label>
                Course Name<span class="req">*</span>
              </label>
                                <select name="cid">
                        <option value="0"> SELECT
                        </option>
						 <option value="1">MTECH CS
                        </option>
                        <option value="2">MTECH ELECTRONICS
                        </option>
						  <option value="3">MTECH MECHANICAL
                        </option>
						  <option value="4">MTECH CIVIL
                        </option>
						  <option value="5">MTECH ELECTRICAL
                        </option>
						  <option value="6">BTECH ELECTRONICS
                        </option>
						  <option value="7">BTECH CS
                        </option>
						  <option value="8">BTECH MECHANICAL
                        </option>
                    </select>
                            </div>


                            <div class="field-wrap">
                                <label>
                Semester<span class="req">*</span>
              </label>
                                <select name="sem">
                        <option value="0">SELECT
                        </option>
						 <option value="1">I
                        </option>
                        <option value="2">II
                        </option>
						 <option value="3">III
                        </option>
						 <option value="4">IV
                        </option>
						 <option value="5">V
                        </option>
						 <option value="6">VI
                        </option>
						 <option value="7">VII
                        </option>
						 <option value="8">VIII
                        </option>
                    </select>
                            </div>



                            <input type="submit" value="Submit" name="submit" class="button button-block" />

                    </form>

                    </div>
                </div>

                <div id="login">
                    <h1>Find Student details</h1>

                    <form method="post">

                        <div class="field-wrap">
                            <label>
              Enrollment ID<span class="req">*</span>
					</label>
                            <input name="tt1" type="text" required autocomplete="off" />
                        </div>
                        <p class="forgot"><a href="addremovestudent.php">Add/Remove a student</a></p>
                        <input type="submit" value="Submit" name="s2" class="button button-block" />


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