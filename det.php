<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
    <title>Student Registration Form</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="css/default.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
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
$eid = $_SESSION['eid'];
$password = $_SESSION['password'];
$result=$conn->query("select * from student_details where eid='".$eid."' ");
while($row=$result->fetch_row())
{
$email=$row[4];
$rno=$row[1];
$hostelid=$row[8];
$guardianname=$row[7];
$gender=$row[13];
$dob=$row[6];
$nationality=$row[14];
$course=$row[11];
$sem=$row[10];
$addr=$row[5];
$name=$row[2];
$phone=$row[3];
}
$imagepath='uploads/'. $eid . '.jpg';
}
?>

    <body>
        <form action="upload.php" method="post" enctype="multipart/form-data" class="register">
            <h1>View details</h1>
            <fieldset class="row1">
                <legend>Enrollment Details
                </legend>
                <p>
                    <label>Enrollment ID *
                    </label>
                    <input type="text" name="eid" value="<?= $eid ?>" />
					</p>
								
					<label>Name *
                    </label>
                    <input type="text" name="eid" value="<?= $name ?>" />
					
					
<p>
					<label>Contact *
                    </label>
                    <input type="text" name="eid" value="<?= $phone ?>" />
					</p>
					
<p>
                    <img src="<?= $imagepath ?>" alt="" height="120px" style="float:right;" />
                    <label>Change Image?</label> <br/><br/><input type="file" name="fileToUpload" id="fileToUpload" onchange="check(this)" style="float:right;">
                </p>
                <p> <label>Email Address *
                    </label>
                    <input type="email" name="email" value="<?= $email ?>" required/>


                </p>
                <script language='javascript' type='text/javascript'>
                    function check(input) {
                        var _validFileExtensions = [".jpg"];
                        if (input.type == "file") {
                            var sFileName = input.value;
                            if (sFileName.length > 0) {
                                var blnValid = false;
                                for (var j = 0; j < _validFileExtensions.length; j++) {
                                    var sCurExtension = _validFileExtensions[j];
                                    if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                                        blnValid = true;
                                        break;
                                    }
                                }

                                if (!blnValid) {
                                    alert("Sorry, " + sFileName + " is invalid, allowed extension is: " + _validFileExtensions.join(", "));
                                    input.value = '';
                                    return false;
                                }
                            }

                        }
                    }
                </script>

                <p>
                    <label>Roll number*
                    </label>
                    <input type="number" name="rno" value="<?= $rno ?>" required/>


                </p>
                
                    <label>Hostel ID *
                    </label>
                    <input type="text" name="hostelid" maxlength="10" value="<?= $hostelid ?>" required/>
                
            </fieldset>
            <fieldset class="row2">
                <legend>Personal Details
                </legend>
                <p>
                    <label>Father's/ Guardian's Name *
                    </label>
                    <input type="text" class="long" name="guardianname" value="<?= $guardianname ?>" required/>
                </p>

                <p>
                    <label>Address *
                    </label>
                    <input type="text" class="long" name="addr" value="<?= $addr ?>" required/>
                </p>

            </fieldset>
            <fieldset class="row3">
                <legend>Further Information
                </legend>
                <p>
                    <label>Gender *</label>
                    <input type="radio" value="male" name="gender" <?php if($gender=="male") echo "checked=\"checked\""; ?> />
                    <label class="gender">Male</label>
                    <input type="radio" value="female" name="gender" <?php if($gender=="female") echo "checked=\"checked\""; ?>/>
                    <label class="gender">Female</label>
                </p>
                <p>
                    <label>Birthdate *
                    </label>
                    <input type="date" name="dob" value="<?= $dob ?>" required>
                </p>
                <p>
                    <label>Nationality *
                    </label>
                    <select name="nationality">
                        <option value="Indian">Indian
                        </option>
                        <option value="NRI">NRI
                        </option>
                    </select>
                </p>


            </fieldset>
            <fieldset class="row4">
                <legend>Course details
                </legend>
                <p>
                    <label>Select course *
                    </label>
                    <select name="course" required>
                         <option value=""> SELECT
                        </option>
						<?php
					$conn=mysqli_connect("localhost","root","","student");
if(!isset($conn))
{
echo"sorry!database connection error";
}
else
{
$query = "SELECT * FROM course";
$res = $conn->query($query);
while (($row=$res->fetch_row()) != null)
{
echo "<option value = '{$row[0]}'";
 if ($course == $row[0])
        echo "selected = 'selected'";
 echo ">{$row[1]}.{$row[2]}</option>";

}

}
?>
                    </select>
                </p>
                <p>
                    <label>Semester *
                    </label>
                    <select name="sem" required>
                         <option value="">SELECT
                        </option>
						 <option value="1" <?php if($sem=="1") echo "selected=\"selected\""; ?>>I
                        </option>
                        <option value="2" <?php if($sem=="2") echo "selected=\"selected\""; ?>>II
                        </option>
						 <option value="3" <?php if($sem=="3") echo "selected=\"selected\""; ?>>III
                        </option>
						 <option value="4" <?php if($sem=="4") echo "selected=\"selected\""; ?>>IV
                        </option>
						 <option value="5" <?php if($sem=="5") echo "selected=\"selected\""; ?>>V
                        </option>
						 <option value="6" <?php if($sem=="6") echo "selected=\"selected\""; ?>>VI
                        </option>
						 <option value="7" <?php if($sem=="7") echo "selected=\"selected\""; ?>>VII
                        </option>
						 <option value="8" <?php if($sem=="8") echo "selected=\"selected\""; ?>>VIII
                        </option>
                    </select>
                </p>
                <p class="agreement">
                    <input type="checkbox" value="" required />
                    <label>*  I accept the <a href="#">Rules and Regulations</a> of being a student at AMU</label>
                </p>

            </fieldset>
            <div>
                <?php
			if($password=="amu_reg"){?>
                    <button class="button" onClick="document.location.href='index.php'">Back</button>
                    <?php }else{?>
                    <button class="button" onClick="document.location.href='index.php'">Back</button>
                    <?php } ?>


            </div>
            <div> <input type="submit" class="button" value="Update" name="submit"></div>
        </form>

    </body>

</html>