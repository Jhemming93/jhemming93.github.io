
<?php 
    if(isset($_GET['id'])){
    $game_id = $_GET['id'];
if(!is_numeric($game_id)){
    header("Location: update.php");
}}
include('../includes/functions.php');
if(isset($_GET['field'])){
    $field = $_GET['field'];
    resetvalues($game_id, $field);
    header("Location: update.php?id=" . $game_id);
}else{
     header("Location: update.php?id=" . $game_id);
}

?>
