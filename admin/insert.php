<?php
session_start();
if(!isset($_SESSION['your-random-session-bney5ifks'])){
	header("Location:login.php?refer=insert");
}
?>
<?php include('../includes/functions.php')?>
<?php include('../includes/header.php') ?>


<?php
    if(isset($_POST['mysubmit'])){

    //    echo "submitted";

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
        if(isset($_POST['playtime'])){
            $playtime = ($_POST['playtime']);
        }else{
            $playtime = "";
        }
        if(isset($_POST['averageage'])){
            $averageage = ($_POST['averageage']);
        }else{
            $averageage = "";
        }
        if(isset($_POST['averageweight'])){
            $averageweight = ($_POST['averageweight']);
        }else{
            $averageweight = "";
        }
        if(isset($_POST['videotitle'])){
            $videotitle = strip_tags($_POST['videotitle']);
        }else{
            $videotitle = "";
        }
        if(isset($_POST['videourl'])){
            $videourl = strip_tags($_POST['videourl']);
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
        if($year != '' && strlen($year) != 4 ){
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
        if($averageage > 100 || $averageage < 0){
            $valid = 0;
            $averageagemsg = "Age must be between 0 and 100";
        }
        if($averageweight > 5 || $averageweight < 0){
            $valid = 0;
            $averageweightmsg = "Weight must be between 1 and 5";
        }

        if($description == ""){
            $valid = 0;
            $descriptionmsg = "A Game Description is required";
        }elseif((strlen($description) < 3) && (strlen($description) <= 255 ) && $description != ""){
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
                $playermsg = "Maxplayer count must be more or equal to min player count";
            }
      $file_type = $_FILES['gameimg']['type'];
        $img_allowed = array("image/jpeg", "image/png");
       if($file_type == ""){
        $valid = 0;
        $imgmsg = "Please Upload an image of the board game";
       }elseif(!in_array($file_type, $img_allowed)){
            $valid = 0;
            $imgmsg = "File needs to be a JPEG or PNG  Image; Your file type: " . $file_type ;   
        }
       
      
 if($_FILES['gameimg']['size'] > (8000 * 1024)){
            $filesize = ceil(($_FILES['gameimg']['size']) / 1024);
            $valid = 0;
            $imgmsg .= "File is to Large; Your file size: " . $filesize . "/8000kb MAX";
        }

        if($videourl != ""){
            $videourl1 = filter_var($videourl, FILTER_SANITIZE_URL); 
            // if(!filter_var($videourl, FILTER_VALIDATE_URL)){
            //   $valid = 0;
            // $videourlmsg = "Please enter a corretly formatted URL address";
            // }
            $headers = @get_headers($videourl1);
            if($headers && strpos( $headers[0], '200')) {
                $videourlmsg ="";
            }
            else {
                $valid = 0;
                $videourlmsg = "Your Address doesnt link anywhere";
            }


        }


       

        if($valid == 1){
            
            $_FILES['gameimg']['name'] =  uniqid() . $_FILES['gameimg']['name'] ; 
            if(move_uploaded_file($_FILES['gameimg']['tmp_name'], "../imgs/orginals/" . $_FILES['gameimg']['name'])){
                
                $newfileName = basename( $_FILES['gameimg']['name']);
                $thisfile =  "../imgs/orginals/" .  $newfileName;
                $thisfileDisplay = "../imgs/display/" . $newfileName;
                $mechanics = strtolower(str_replace(' ','', $mechanics));
            
                createSquareImageCopy($thisfile, "../imgs/img250/", 250);
                createSquareImageCopy($thisfile, "../imgs/img100/", 100);
                createThumb($thisfile, "../imgs/display250/", 250);
    
                

                $gameimgname =  basename( $_FILES['gameimg']['name']); 
                // $gameimgsize =$_FILES['gameimg']['size'];
                $gameimgtype = $_FILES['gameimg']['type'];

                if($playtime == ""){
                    $playtimeinput = 0;
                }else{
                    $playtimeinput = 1;
                }
                if($averageage == ""){
                    $ageinput = 0;
                }else{
                    $ageinput = 1;
                }

            
                    $success = "Successfully Uploaded";
                    mysqli_query($con, "INSERT INTO boardgame_catalog (gametitle, gamedesigner, publisher, releaseyear, mechanics, description, videofileurl, playermin, playermax, uploadon) VALUES ('$gametitle', '$gamedesigner', '$publisher', '$year', '$mechanics', '$description', '$videourl', '$playermin', '$playermax' ,NOW())") or die(mysqli_error($con));
                    mysqli_query($con, "INSERT INTO boardgame_averages (gameid, playtime, age, weight, playtimeinput, ageinput) VALUES (LAST_INSERT_ID(), '$playtime', '$averageage', '$averageweight', '$playtimeinput','$ageinput')") or die(mysqli_error($con));
                    mysqli_query($con, "INSERT INTO boardgame_image (gameid, filename, filetype) VALUES (LAST_INSERT_ID(), '$gameimgname', '$gameimgtype')") or die(mysqli_error($con));

              

               

                $gametitle = "";
                $gamedesigner = "";
                $publisher ="";
                $playermin = "";
                $playermax = "";
                $description = "";
                $mechanics = "";
                $year = "";
                $playtime = "";
                $averageage = "";
                $videourl = "";
                $averageweight = "";
            }
               
               
             

            // if(file_exists('../js/average.json'))
            // {
            //      $final_data=fileWriteAppend();
            //      if(file_put_contents('../js/average.json', $final_data))
            //      {
            //           $message = "<label class='text-success'>Data added Successfully</p>";
            //      }
            // }
            // else
            // {
            //      $final_data=fileCreateWrite();
            //      if(file_put_contents('../js/average.json', $final_data))
            //      {
            //           $message = "<label class='text-success'>File created and data added Successfully</p>";
            //      }
            
            // }

      





           

        }
        





        // echo "$gametitle, $gamedesigner, $publisher, $description, $mechanics, $year, $playtime, $videotitle, $videourl";







    }


?>







<h2 class="main-title insert-title">Add New Boardgame</h2>
<?php
if(isset($success)){
        echo "<h3 style=\"color:green;\">$success</h3>";
    }elseif(isset($duplicate)){
        echo "<h3 style=\"color:red;\">$duplicate</h3>";
    }

?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" class="d-lg-flex flex-wrap gap-2 " >
    <div class="mb-3 col-lg-3 position-relative">

        <label for="gametitle" class="form-label">Game Title <b>(Required)</b></label>
        <input type="text" class="form-control " id="gametitle" name="gametitle" value="<?php if(isset($gametitle)){ echo $gametitle;}?>">
        <?php if(isset($gametitlemsg)){ echo "$msgalert  $gametitlemsg  $msgend";} ?> 
    </div>
    <div class="mb-3 col-lg-3">

        <label for="gamedesigner" class="form-label">Game Designer</label>
        <input type="text" class="form-control" id="gamedesigner" name="gamedesigner" value="<?php if(isset($gamedesigner)){ echo $gamedesigner;}?>">
        <?php if(isset($gamedesignermsg)){ echo "$msgalert  $gamedesignermsg  $msgend";} ?> 
    </div>

    <div class="mb-3 col-lg-3 ">
        <label for="publisher" class="form-label">Publisher</label>
        <input type="text" class="form-control" id="publisher" name="publisher" value="<?php if(isset($publisher)){ echo $publisher;}?>">
        <?php if(isset($publishermsg)){ echo "$msgalert  $publishermsg  $msgend";} ?> 
    </div>
    <div class="mb-3 col-lg-3">
    <p >Player Count <b>(Required)</b></p>
<div class="d-flex gap-2">
    <div class="col-5">
        <label for="playercountmin" class="form-label">Min</label>
        <input type="number" class="form-control" id="playercountmin" name="playercountmin" value="<?php if(isset($playermin)){ echo $playermin;}?>">
    </div>
    <div class="col-5">
        <label for="playercountmax" class="form-label">Max</label>
        <input type="number" class="form-control" id="playercountmax" name="playercountmax" value="<?php if(isset($playermax)){ echo $playermax;}?>">
    </div>
</div>
        <?php if(isset($playermsg)){ echo "$msgalert  $playermsg  $msgend";} ?> 
    </div>

    <div class="mb-3 col-12">
        <div class="mb-3 col-lg-6">
            <label for="description" class="form-label">Description <b>(Required)</b></label>
            <textarea class="form-control" id="description" name="description"><?php if(isset($description)){ echo $description;}?></textarea>
            <?php if(isset($descriptionmsg)){ echo "$msgalert  $descriptionmsg  $msgend";} ?> 
        </div>
    </div>
    <div class="mb-3 col-12">
        <div class="col-lg-5">
            <label for="mechanics" class="form-label">Game Mechanics (Seperate different Mechanics with a comma and replace spaces with dashes)</label>
            <input type="text" class="form-control" id="mechanics" name="mechanics" value="<?php if(isset($mechanics)){ echo $mechanics;}?>">
            <?php if(isset($mechanicsmsg)){ echo "$msgalert  $mechanicsmsg $msgend";} ?> 
        </div>
    </div>
    <div class="mb-3 col-12">
        <div class="mb-3 col-lg-2">
            <label for="releaseyear" class="form-label">Release Year </label>
            <input type="number" class="form-control" id="releaseyear" name="releaseyear" value="<?php if(isset($year)){ echo $year;}?>">
            <?php if(isset($yearmsg)){ echo "$msgalert  $yearmsg  $msgend";} ?> 
        </div>

        <div class="mb-3 col-lg-2">
            <label for="playtime" class="form-label">Playtime in Minutes</label>
            <input type="number" step="any" class="form-control" id="playtime" name="playtime" value="<?php if(isset($playtime)){ echo $playtime;}?>">
            <?php if(isset($playtimemsg)){ echo "$msgalert  $playtimemsg  $msgend";} ?> 
        </div>
        <div class="mb-3 col-lg-2">
            <label for="averageage" class="form-label">Recommended Player Age</label>
            <input type="number" class="form-control" id="averageage" name="averageage" value="<?php if(isset($averageage)){ echo $averageage;}?>">
            <?php if(isset($averageagemsg)){ echo "$msgalert  $averageagemsg  $msgend";} ?> 
        </div>
        <div class="mb-3 col-lg-2">
            <label for="averageweight" class="form-label">Starting Weight</label>
            <input type="decim" class="form-control" id="averageweight" name="averageweight" value="<?php if(isset($averageweight)){ echo $averageweight;}?>">
            <?php if(isset($averageweightmsg)){ echo "$msgalert  $averageweightmsg  $msgend";} ?> 
        </div>
    </div>
    <div class="mb-3 col-lg-5">
        <label for="videourl" class="form-label">Youtube Tutorial Link</label>
        <input type="text" class="form-control" id="videourl" name="videourl" value="<?php if(isset($videourl)){ echo $videourl;}?>">
        <?php if(isset($videourlmsg)){ echo "$msgalert  $videourlmsg  $msgend";} ?> 
    </div>

<div class="mb-3 col-lg-5">
        <label for="gameimg" class="form-label">Boardgame Front Box Image <b>(Required)</b></label>
        <input type="file" class="form-control" id="gameimg" name="gameimg">
        <?php if(isset($imgmsg)){ echo "$msgalert  $imgmsg  $msgend";} ?> 
    </div>
    <button type="submit" class="btn btn-primary col-3" name="mysubmit">Submit</button>
</form>

<?php include("../includes/footer.php") ?>