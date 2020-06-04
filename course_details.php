<!DOCTYPE html>

<html>

<head>
    <title> Course details </title>

</head>

<body>
    <?php
session_start();
$conn=mysqli_connect("localhost","root","","student");
if(!isset($conn))
{
echo"sorry!database connection error";
}
else
{
$cid = $_SESSION['cid'];
$sem = $_SESSION['sem'];
$result=$conn->query("select * from student_details where cid='".$cid."' AND sem='".$sem."'");

if (($result)||(mysql_errno == 0))
{
  echo "<table align='center' width='80%' border='1' padding='15px'><tr>";
    //display the data
while ($fieldinfo=mysqli_fetch_field($result))
          {
       echo "<th>". $fieldinfo->name . "</th>";
    }
     echo "<th>Image</th>";
   echo "</tr>";
    while ($row=$result->fetch_row())
    {
	$eid=$row[0];
      echo "<tr>";
      foreach ($row as $data)
      {
        echo "<td align='center'>". $data . "</td>";
      }
	  $imagepath='uploads/'. $eid . '.jpg';
	echo "<td align='center'><img src='$imagepath' alt='' height='120px'/></td>";
    }
	
  }else{
    echo "<tr><td colspan='" . ($i+1) . "'>No Results found!</td></tr>";
  }
  echo "</table>";
if(isset($_POST['submit']))
{
header("location:admin_page.php");
}
}
?>

        <form method="post">

            <input type="submit" value="Back" name="submit" />

        </form>



</body>

</html>