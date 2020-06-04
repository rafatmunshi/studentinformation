<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
    <title>Student Registration Form</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="css/default.css" />
</head>
<?php

session_start();
$password = $_SESSION['password'];
?>
<body>
    <form action="upload.php" method="post" enctype="multipart/form-data" class="register">
        <h1>Other details</h1>
        <fieldset class="row1">
            <legend>Enrollment Details
            </legend>
            <p>


                <label>Email Address *
                    </label>
                <input type="email" name="email" required/>
                <label>Upload image * (Only .jpg file)
                    </label>

                <input type="file" name="fileToUpload" id="fileToUpload" required onchange="check(this)">
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


            </p>
            <p>
                <label>Roll number*
                    </label>
                <input type="number" name="rno" required/>


            </p>
            <p>
                <label>Hostel ID *
                    </label>
                <input type="text" maxlength="10" name="hostelid" required/>
            </p>
        </fieldset>
        <fieldset class="row2">
            <legend>Personal Details
            </legend>
            <p>
                <label>Father's/ Guardian's Name *
                    </label>
                <input type="text" class="long" name="guardianname" required/>
            </p>

            <p>
                <label>Address *
                    </label>
                <input type="text" class="long" name="addr" required/>
            </p>

        </fieldset>
        <fieldset class="row3">
            <legend>Further Information
            </legend>
            <p>
                <label>Gender *</label>
                <input type="radio" value="male" name="gender" />
                <label class="gender">Male</label>
                <input type="radio" value="female" name="gender" />
                <label class="gender">Female</label>
            </p>
            <p>
                <label>Birthdate *
                    </label>
                <input type="date" name="dob" required>
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
    echo "<option value = '{$row[0]}'>{$row[1]}.{$row[2]}</option>";
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
					
					    <?php
			if(date('m', strtotime('-1 month'))+1>=6 && date('m', strtotime('-1 month'))+1<=12){?>
                    <option value="1">I
                        </option>
						<option value="3">III
                        </option>
						<option value="5">V
                        </option>
						 <option value="7">VII
                        </option>
                    <?php }else{?>
                       <option value="2">II
                        </option>
						 
						 <option value="4">IV
                        </option>
						 
						 <option value="6">VI
                        </option>
						
						 <option value="8">VIII
                        </option>
                    <?php } ?>
					
						 
                     
                    </select>
            </p>
            <p class="agreement">
                <input type="checkbox" value="" required/>
                <label>*  I accept the <a href="#">Rules and Regulations</a> of being a student at AMU</label>
            </p>

        </fieldset>

        <div> <input type="submit" class="button" value="Complete Registration" name="submit">

            <div>
			
                <?php
			if($password=="amu_reg"){?>
                    <button class="button" onClick="document.location.href='admin_page.php'">Back</button>
                    <?php }else{?>
                    <button class="button" onClick="document.location.href='index.php'">Back</button>
                    <?php } ?>
                   
					</div>
        </div>
    </form>
</body>

</html>