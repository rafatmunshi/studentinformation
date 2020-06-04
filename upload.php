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
$eid = $_SESSION['eid'];
$password = $_SESSION['password'];
$email=$_POST['email'];
$rno=$_POST['rno'];
$hostelid=$_POST['hostelid'];
$gname=$_POST['guardianname'];
$gender=$_POST['gender'];
$dob=$_POST['dob'];
$nationality=$_POST['nationality'];
$course=$_POST['course'];
$sem=$_POST['sem'];
$addr=$_POST['addr'];

$result=$conn->query("SELECT COUNT(eid) FROM student_details WHERE cid='".$course."' AND sem='".$sem."' ");

while($row=$result->fetch_row())
{

$studentnum=$row[0];


}
$studentnum=$studentnum+1;

$result=$conn->query("SELECT * FROM course where cid='".$course."' ");
while($row=$result->fetch_row())
{
$maxlimit=$row[3];

}
if ($studentnum > $maxlimit) {

    echo "<script type='text/javascript'>alert('Sorry no more place to register in this course for this semester. Kindly check the course and semester details before registering')</script>";
die("Sorry no more place to register in this course for this semester. Kindly check the course and semester details before registering &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type='button' onclick='javascript:history.back()'>Back</button>");
} 
else{
	
if($password!="amu_reg")
{

$qr="UPDATE student_details
SET cid='".$course."',fathername='".$gname."',email='".$email."',rno='".$rno."',hostelid='".$hostelid."',gender='".$gender."',dob='".$dob."',nationality='".$nationality."',sem='".$sem."',address='".$addr."'
WHERE eid='".$eid."' AND password='".$password."'";
}
else
{
$qr="UPDATE student_details
SET cid='".$course."',fathername='".$gname."',email='".$email."',rno='".$rno."',hostelid='".$hostelid."',gender='".$gender."',dob='".$dob."',nationality='".$nationality."',sem='".$sem."',address='".$addr."'
WHERE eid='".$eid."'";
}


$conn->query($qr);


//code to upload image
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$temp = explode(".", $_FILES["fileToUpload"]["name"]);
$newfilename = $eid . '.' . end($temp);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" ) {
    echo "Sorry, only JPG files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {

    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir . $newfilename)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}


//code to generate pdf file of the student data	
require('fpdf.php');
$pdf = new FPDF();

$pdf->AddFont('times', '', 'times.php');
$pdf->AddFont('times', 'B', 'timesb.php');
$pdf->AddFont('times', 'I', 'timesi.php');

# Add UTF-8 support (only add a Unicode font)

$pdf->SetFont('times', '', 12);

$pdf->SetTitle('My title');
$pdf->SetAuthor('My author');
$pdf->SetDisplayMode('fullpage', 'single');

$pdf->SetLeftMargin(20);
$pdf->SetRightMargin(20);

$pdf->AddPage();
$pdf->Write(5, "Your registration has been done successfully. Please find your details below. You may login into the system using your Enrolment ID and password"); //write
/*$pdf->Image($target_dir . $newfilename,25,25,30);

    $pdf->Ln(10); // new line
    $pdf->Ln(10); // new line
    $pdf->Ln(10); // new line
    $pdf->Ln(10); // new line
    $pdf->Ln(10); // new line */
    $pdf->Ln(10); // new line

	$pdf->Write(5, "Enrolment ID: $eid"); //write
    $pdf->Ln(10); // new line
	if($password!="amu_reg")
	{
	$pdf->Write(5, "Password: $password"); //write
    $pdf->Ln(10); // new line
	}
	
foreach ($_POST as $key =>$data)
{
    $pdf->Write(5, "$key: $data"); //write
    $pdf->Ln(10); // new line
}

$pdf->Output('uploads/' .$eid. '.pdf','F'); // save to file

//code to open it in tab


$file = 'uploads/' .$eid. '.pdf';
$filename = $eid. '.pdf'; 

header('Content-type: application/pdf');
header('Content-Disposition: inline; filename="' . $filename . '"');
header('Content-Transfer-Encoding: binary');
header('Content-Length: ' . filesize($file));
header('Accept-Ranges: bytes');
header('Expires: 0');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');

readfile($file);

//echo file_get_contents($file);

}
}
}
?>