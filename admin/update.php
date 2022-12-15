<?php

session_start();
if(!isset($_SESSION['your-random-session-bney5ifks'])){
	header("Location:login.php?refer=update");
}




?>

<?php include('../includes/header.php'); 
include('../includes/functions.php');

if(isset($_GET['id']) ){
  $id = $_GET['id'];
}else{
  $sql = "SELECT * FROM boardgame_catalog ORDER BY gameid ASC LIMIT 1";
  $result = mysqli_query($con, $sql);
  while($row = mysqli_fetch_array($result)): 
  $id= $row['gameid'];
endwhile;

}

if(!isset($id)){
  $id= '';
}

if(isset($_POST['mysubmit'])){
  // echo 'tested';

  if(isset($_POST['gametitle'])){
    $gametitle = strip_tags($_POST['gametitle']);
}else{
    $gametitle = "";
}
if(isset($_POST['gamedesigner'])){
    $gamedesigner = strip_tags($_POST['gamedesigner']);
}else{
    $gamedesigner = "";
}
if(isset($_POST['publisher'])){
    $publisher = strip_tags($_POST['publisher']);
}else{
    $publisher = "";
}
if(isset($_POST['description'])){
    $description = strip_tags($_POST['description']);
}else{
    $description = "";
}
if(isset($_POST['mechanics'])){
    $mechanics = strip_tags($_POST['mechanics']);
}else{
    $mechanics = "";
}
if(isset($_POST['releaseyear'])){
    $year = ($_POST['releaseyear']);
}else{
    $year = "";
}



if(isset($_POST['videourl'])){
    $videourl =($_POST['videourl']);
}else{
    $videourl = "";
}
if(isset($_POST['playercountmin'])){
    $playermin = ($_POST['playercountmin']);
}else{
    $playermin = "";
}

if(isset($_POST['playercountmax'])){
    $playermax = ($_POST['playercountmax']);
}else{
    $playermax = "";
}
  
  

$valid = 1;

// Validation
$msgalert = "<div class=\"bg-danger text-light mt-1 rounded\"><p class=\"ps-2\">";
$msgend = "</p></div>";

if($gametitle == ""){
    $valid = 0;
    $gametitlemsg = "Game Title Required"; 
}elseif((strlen($gametitle) < 3) && (strlen($gametitle) <= 75 )){
    $valid = 0;
    $gametitlemsg = "Game Title's are required to be between 3 and 75 characters";
}

if((strlen($gamedesigner) < 3) && (strlen($gamedesigner) <= 75 ) && $gamedesigner != ""){
    $valid = 0;
    $gamedesignermsg = "Game Designer Name's are required to be between 3 and 75 characters";
}

if((strlen($publisher) < 3) && (strlen($publisher) <= 75 ) && $publisher != ""){
    $valid = 0;
    $publishermsg = "Game Publishers Name's are required to be between 3 and 75 characters";
}
if($year != '' && strlen($year) != 4){
    $valid = 0;
    $yearmsg = "Please put 4 numbers for a complete year";
}

if(strlen($year) == 4 && $year <= 1900 || $year > date("Y")){
    $valid = 0;
    if($year <= 1900){
    $yearmsg = "Please input a year later then 1900 ";
    }
    if($year > date("Y")){
        $yearmsg = "Please input a year  no later then current year (" . date("Y") . ")";
        }
}


if($description == ""){
    $valid = 0;
    $descriptionmsg = "A Game Description is required";
}elseif((strlen($description) < 3) && (strlen($description) <= 500 ) && $description != ""){
    $valid = 0;
    $descriptionmsg = "Game Description are required to be between 3 and 500 characters";
}
if($playermin == "" && $playermax == ""){
    $valid = 0;
    $playermsg = "Player min and max count required"; 
}elseif($playermax == "" || $playermin == ""){
    $valid = 0;
    if($playermax == ""){
        $playermsg = "Player Max is Required";
    }
    if($playermin == ""){
        $playermsg = "Player Min is Required";
    }
}
    if($playermax != '' && $playermin != '' && number_format($playermax) < number_format($playermin)){
        $valid = 0;
            $playermsg .= "Maxplayer count must be more or equal to min player count";
        }
    
      

    if($videourl != ""){
        $videourl1 = filter_var($videourl, FILTER_SANITIZE_URL); 
        // if(!filter_var($videourl1, FILTER_VALIDATE_URL)){
        //   $valid = 0;
        // $videourlmsg = "Please enter a corretly formatted URL address";
        // }

        // if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $videourl1)) {
        //     $valid = 0;
        //     $videourlmsg = "Invalid URL";
        //   }

            // if (!filter_var($videourl, FILTER_VALIDATE_URL, FILTER_FLAG_QUERY_REQUIRED) === false) {
  
            // } else {
            // $valid = 0;
            // $videourlmsg = "Please enter a corretly formatted URL address";
            // }
            $headers = @get_headers($videourl1);
            if($headers && strpos( $headers[0], '200')) {
                $videourlmsg ="";
            }else {
                $valid = 0;
                $videourlmsg = "Your Address doesnt link anywhere";
            }
            // echo $videourl1;
            // parse_str($videourl1, $output);
            // echo $output['v'];
              
       

       
    }

     


 



  if($valid == 1 ){

    
    $mechanics = strtolower(str_replace(' ','', $mechanics));
 

    
$sql = "UPDATE boardgame_catalog
 SET gametitle = '$gametitle', 
 gamedesigner = '$gamedesigner', 
 publisher = '$publisher', 
 releaseyear = '$year', 
 mechanics = '$mechanics', 
 description = '$description', 
 videofileurl = '$videourl',
playermin = '$playermin', 
playermax = '$playermax'

WHERE gameid = '$id'";
    mysqli_query($con,$sql) or die(mysqli_error($con));




// $idsql = "SELECT gameid"

// header("location: jhemming1.dmitstudent.ca/dmit2025/labs/lab_8/admin/update.php?id=")
    $msgupdated = "Updated";
    // averagenumber(5, 'weight', $id); 
    // resetvalues($id, 'weight');
  }


 





}








?>


<H2 class="main-title insert-title">Edit Page</H2>
<section class="d-flex ">
<div class="m-3 p-1 border rounded col-6">
  <?php if($id != ''){ ?>
<?php
$sql = "SELECT bc.* , bi.filename, ba.*  FROM boardgame_catalog AS bc  INNER JOIN boardgame_image AS bi ON bc.gameid=bi.gameid INNER JOIN boardgame_averages AS ba ON bc.gameid=ba.gameid WHERE bc.gameid LIKE '$id'";
$result = mysqli_query($con, $sql);
        while($row = mysqli_fetch_array($result)): 
            $gametile= $row['gametitle'];
            $gameid = $row['gameid'];
            $filename = $row['filename'];
    ?>
<div>

    <img  src="../imgs/img250/<?php echo $filename;  ; ?>" alt="<?php echo $gametile?>"></a>
    <div>
        
        <div class="d-flex justify-content-between my-1">
            <p><b>Player Age Average: </b><?php if($row['age'] == "" || $row['age'] == 0){echo 'Unkown';}else{echo $row['age'] . "+"; } ?></p>
            <a href="reset.php?id=<?php echo $id; ?>&field=age" class=" btn-danger btn">Reset Age</a>
        </div >
        <div class="d-flex justify-content-between my-1">
            <p><b>Weight Average: </b><?php echo $row['weight']; ?>/5</p>
            <a href="reset.php?id=<?php echo $id; ?>&field=weight" class="btn btn-danger ml-3">Reset Weight</a>
        </div>
        <div class="d-flex justify-content-between my-1">
            <p><b>Playtime Average: </b><?php if($row['playtime'] == "" || $row['playtime'] == 0){echo 'Unkown';}else{ echo $row['playtime'] . "mins"; }?></p>
            <a href="reset.php?id=<?php echo $id; ?>&field=playtime" class="btn btn-danger ml-3">Reset Playtime</a>
        </div>
        
    </div>
</div>
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" enctype="multipart/form-data" class="d-lg-flex flex-wrap gap-2">
    <div class="mb-3  position-relative">

        <label for="gametitle" class="form-label">Game Title <b>(Required)</b></label>
        <input type="text" class="form-control " id="ugametitle" name="gametitle" value="<?php if(isset($id)){ echo $row['gametitle'];}?>">
        <?php if(isset($gametitlemsg)){ echo "$msgalert  $gametitlemsg  $msgend";} ?> 
    </div>
      
    <div class="mb-3 ">

        <label for="gamedesigner" class="form-label">Game Designer</label>
        <input type="text" class="form-control" id="ugamedesigner" name="gamedesigner" value="<?php if(isset($id)){ echo $row['gamedesigner'];}?>">
        <?php if(isset($gamedesignermsg)){ echo "$msgalert  $gamedesignermsg  $msgend";} ?> 
    </div>

    <div class="mb-3  ">
        <label for="publisher" class="form-label">Publisher</label>
        <input type="text" class="form-control" id="upublisher" name="publisher" value="<?php if(isset($id)){ echo $row['publisher'];}?>">
        <?php if(isset($publishermsg)){ echo "$msgalert  $publishermsg  $msgend";} ?> 
    </div>
    <div class="mb-3 ">
    <p >Player Count <b>(Required)</b></p>
<div class="d-flex gap-2">
    <div class="col-5">
        <label for="playercountmin" class="form-label">Min</label>
        <input type="number" class="form-control" id="uplayercountmin" name="playercountmin" value="<?php if(isset($id)){ echo $row['playermin'];}?>">
    </div>
    <div class="col-5">
        <label for="playercountmax" class="form-label">Max</label>
        <input type="number" class="form-control" id="uplayercountmax" name="playercountmax" value="<?php if(isset($id)){ echo $row['playermax'];}?>">
    </div>
</div>
        <?php if(isset($playermsg)){ echo "$msgalert  $playermsg  $msgend";} ?> 
    </div>

    <div class="mb-3 col-12">
        <div class="mb-3 ">
            <label for="description" class="form-label">Description <b>(Required)</b></label>
            <textarea class="form-control" id="udescription" name="description"><?php if(isset($id)){ echo $row['description'];}?></textarea>
            <?php if(isset($descriptionmsg)){ echo "$msgalert  $descriptionmsg  $msgend";} ?> 
        </div>
    </div>
    <div class="mb-3 col-12">
        <div class="">
            <label for="mechanics" class="form-label">Game Mechanics (Seperate different Mechanics with a comma and replace spaces with dashes)</label>
            <input type="text" class="form-control" id="umechanics" name="mechanics" value="<?php if(isset($id)){ echo $row['mechanics'];}?>">
            <?php if(isset($mechanicsmsg)){ echo "$msgalert  $mechanicsmsg $msgend";} ?> 
        </div>
    </div>
    <div class="mb-3 col-12">
        <div class="mb-3 col-lg-6">
            <label for="releaseyear" class="form-label">Release Year </label>
            <input type="number" class="form-control" id="ureleaseyear" name="releaseyear" value="<?php if(isset($id)){ echo $row['releaseyear'];}?>">
            <?php if(isset($yearmsg)){ echo "$msgalert  $yearmsg  $msgend";} ?> 
        </div>
    </div>
    <div class="mb-3 col-lg-12">
        <label for="videourl" class="form-label">Youtube Tutorial Link</label>
        <input type="text" class="form-control" id="uvideourl" name="videourl" value="<?php if(isset($id )){ echo $row['videofileurl'];}?>">
        <?php if(isset($videourlmsg)){ echo "$msgalert  $videourlmsg  $msgend";} ?> 
    </div>
    
    <button type="submit" class="btn btn-primary col-3" name="mysubmit">Update</button>
    <a onclick="return confirm('Are you sure you want to delete this item?');" href="<?php echo BASE_URL; ?>admin/delete.php?id=<?php echo $id;?>"  class="btn btn-danger ml-2 mydelete" name="mydelete">Delete</a>
</form>
<?php endwhile; ?>
<?php
if(isset($msgupdated)){
        echo "<h3 style=\"color:green;\">$msgupdated</h3>";
    }

?>
</div>

<div class="m-3 border rounded">
  <?php $sql = "SELECT bc.gametitle,bi.filename,bc.gameid FROM boardgame_catalog AS bc INNER JOIN boardgame_image AS bi ON bc.gameid=bi.gameid  ORDER BY gametitle ASC";
$result = mysqli_query($con, $sql);
?>
<form class="d-flex flex-wrap" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">


<?php while($row = mysqli_fetch_array($result)){ ?>

<div class="card m-2 <?php if($id == $row['gameid']){ echo "border border-danger";} ?>"  style="width: 100px; <?php if($id == $row['gameid']){ echo "border-width: 3px !important;";} ?>" >
<a href="update.php?id=<?php echo $row['gameid'];?>">

    <img class="card-img-top" src="../imgs/img100/<?php echo $row['filename'];  ?>" alt="<?php echo $row['gametitle'];?>"></a>
</div>
    
<?php } }else{ ?>

<h3>Please upload a file to edit.</h3>

<?php  } ?> 
</form>
</div>
</section>



<?php include('../includes/footer.php') ?>