<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);
require('connection.php');
 $vote = $_REQUEST['vote'];
 $voter_id=$_REQUEST['voter_id'];
 $position=$_REQUEST['position'];

$sql=mysqli_query($con, "SELECT position,voter_id FROM tblvotes where position='$position' and voter_id='$voter_id'");

if(mysqli_num_rows($sql))
{
    echo "<div style='height:50px; width:500px;background-color:#D49FE7'><h3>You have already voted for this position and you cannot vote again.</h3></div>";
  //return "1";
 /* echo "<script>alert('already vote')</script>";*/ 
}
else
{
    //insert data and check position
    $ins=mysqli_query($con,"INSERT INTO tblvotes (voter_id, position, candidateName) VALUES ('$voter_id', '$position', '$vote')");
    mysqli_query($con, "UPDATE tbCandidates SET candidate_cvotes=candidate_cvotes+1 WHERE candidate_name='$vote'");
    mysqli_close($con);
 
echo "<h3 >You have successfully submitted your vote for the canditate ".$vote." !</h3>";

}

?> 