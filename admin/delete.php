<?php 
    if(isset($_GET['id'])){
    $game_id = $_GET['id'];
if(!is_numeric($game_id)){
    header("Location: update.php");
}}

$con = mysqli_connect("localhost", "jhemming1","2tQ7508sxp", "jhemming1_dmit2025") or die(mysqli_error($con));
$sql1 = "SELECT * FROM boardgame_image WHERE gameid LIKE '$game_id'";

$result = mysqli_query($con,$sql1);

while($row = mysqli_fetch_array($result)): 
    $myfilename = $row['filename'];
    $myfiletype = $row['filetype'];
    if($myfiletype == 'image/png'){
        $ext = ".png";
    }elseif($myfiletype == 'image/jpeg'){
        $ext = ".jpg";
    }

unlink('../imgs/display250/'. $myfilename );
unlink('../imgs/img100/' . $myfilename );
unlink('../imgs/img250/' . $myfilename );
unlink('../imgs/orginals/' . $myfilename);
endwhile;
$sql = "DELETE FROM boardgame_catalog WHERE gameid LIKE '$game_id'";



mysqli_query($con,$sql) or die(mysqli_error($con));






header('Location: https://jhemming1.dmitstudent.ca/dmit2025/labs/lab_8/admin/update.php');
?>