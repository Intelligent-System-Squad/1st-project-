<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);
require('connection.php');
 $vote = $_REQUEST['vote'];
 $voter_id=$_REQUEST['voter_id'];
 $position=$_REQUEST['position'];

 //Checks whether there are any rows in the tblvotes table with matching position and voterid 
$sql=mysqli_query($con, "SELECT position,voter_id FROM tblvotes where position='$position' and voter_id='$voter_id'");

if(mysqli_num_rows($sql))//Doesn't allow to vote 
{
    echo "<div style='display:flex; height:70px; font-weight:bolder;font-family: Georgia, serif;  justify-content:center;
    align-items: center;
    text-align: center; 
    margin: 0 auto;  width:500px;background: rgb(192,52,81);
    background: linear-gradient(90deg, rgba(192,52,81,1) 57%, rgba(226,151,190,1) 79%, rgba(243,224,230,1) 100%);'><h3>You have already voted for this position and you cannot vote again.</h3></div>";
 
}
else
{
    //insert the data into table by increasing the vote of the candidate after voter votes.
    $ins=mysqli_query($con,"INSERT INTO tblvotes (voter_id, position, candidateName) VALUES ('$voter_id', '$position', '$vote')");
    mysqli_query($con, "UPDATE tbCandidates SET candidate_cvotes=candidate_cvotes+1 WHERE candidate_name='$vote'");
    mysqli_close($con);
 
    echo "<div style='display:flex; height:70px; font-weight:bolder;font-family: Georgia, serif;  justify-content:center;
    align-items: center;
    text-align: center; 
    margin: 0 auto;  width:500px;background: rgb(192,52,81);
    background: linear-gradient(90deg, rgba(192,52,81,1) 57%, rgba(226,151,190,1) 79%, rgba(243,224,230,1) 100%);'><h3>You have successfully casted your vote to ".$vote."!</h3></div>";

}

?> 