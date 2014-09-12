MatchMaking
===========

//PHP CODE FOR CREATING PROFILE -------------------------------

<?php
//CREATE PROFILE

//these variables NEED to be filled in
$fsuid = $_SESSION['fsuid'];
$comment = $_POST['comment'];
$email = $_POST['showemail'];
$picture = $_POST['showpic'];

//courses variables in array 
$courses = $_POST['courses'];
$number = count($courses);
$total = 0;


for($i=0; $i< $number; $i++)
{
//check if there is no profile for each course
if(profilecreated($fsuid, $courses[$i] == false)
{ $total++; }
}
 
 //check if all the classes selected dont have a profile created
 // direct to the same page with message PROFILE CREATED
if ($total == $number)
{
mysql_query("INSERT INTO Profiles (FSUID, Comments, Date, showemail, showpic)
VALUES('$fsuid','$comment', CURDATE(), '$email' , '$picture' ");

die(header("location:editprofile.html?Submitfailed=true&reason=correct"));
}
//else print error that one of the classes selected has a profile already
//need to include how to get the specific class that has the profile 
//direct to the same page with error showing
else
{
die(header("location:editprofile.html?Submitfailed=true&reason=created"));
}

//put this code underneath submit code in html
//<?php $reasons = array("created" => "ERROR: Profile has already been created for one of the classes selected",
 //"correct" => "You have successfully submitted a new profile"); if ($_GET["Submitfailed"]) echo $reasons[$_GET["reason"]]; ?>

?>

//END OF PHP CODE --------------------------------------
