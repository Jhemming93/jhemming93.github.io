<?php 
session_start();
include("includes/header.php");
include("includes/functions.php");
?>




<?php 





if(isset($_GET['displayby'])){
  $displayby = strip_tags($_GET['displayby']);
}

if(isset($_GET['displayvalue'])){
  $displayvalue = strip_tags($_GET['displayvalue']);
}
if(isset($_GET['displayvalue1'])){
  $displayvalue1 = strip_tags($_GET['displayvalue1']);
}
if(isset($_GET['searchby'])){
  $search = $_GET['searchby'];
}

// if(isset($_POST['mysubmit'])){

//   if(isset($_POST['maxweight'])){
//     $maxweight = $_POST['maxweight'];
//   }else{
//     $maxweight = "";
//   }
//   if(isset($_POST['minweight'])){
//     $minweight = $_POST['minweight'];
//   }else{
//     $maxweight = '';
//   }

//   if($maxweight != "" && $minweight != ""){
//     $searchby = "WHERE weight BETWEEN $minweight AND $maxweight";
//   }
// }

if(isset($_POST['game-weight'])){
  $gameweight = $_POST['game-weight'];
 
}




if(isset($displayby) && isset($displayvalue) || isset($displayvalue1)){
  if(isset($displayvalue)){
    $searchby = "WHERE $displayby LIKE '$displayvalue'";
    
  }else{
    $searchby = "WHERE $displayby LIKE '%$displayvalue1'";
  
  }
  
}elseif(isset($gameweight)){
 
  if($gameweight == "light" ){
    $searchby = "WHERE weight BETWEEN 1 AND 2.2";
  }
  if($gameweight == "medium" ){
    $searchby = "WHERE weight BETWEEN 2.3 AND 3.5";
  }
  if($gameweight == "heavy" ){
    $searchby = "WHERE weight BETWEEN 3.6 AND 5";
  }
}elseif(isset($search)){
  $searchby = "WHERE description LIKE '%$search%' OR gametitle LIKE '%$search%' OR mechanics LIKE '%$search%'";
}elseif(!isset($searchby)){
  $searchby = "";
}



?>





<h1>The Game Library</h1>
<div>
  <?php if(isset($search)){
    
   
      echo "<p><b>Search Results: </b>" .$search. "</p>";
     
  } 
  
  ?>
</div>

<section class=" col-12">

<div class="side-bar  d-flex col-12 flex-wrap ">
  <div>
      <h4>Title by Alphabetical Search</h4>
      
      <?php 
      $qry = "SELECT *, LEFT(gametitle, 1) AS first_char FROM boardgame_catalog 

      WHERE UPPER(gametitle) BETWEEN 'A' AND 'Z'

      ORDER BY gametitle ASC";



    $result = mysqli_query($con,$qry);

    $current_char = '';

    while ($row = mysqli_fetch_assoc($result)) {

    if ($row['first_char'] != $current_char) {

      $current_char = $row['first_char'];

    $thisChar = strtoupper($current_char);

      echo "<a href=\"library.php?displayby=gametitle&displayvalue=$thisChar%\">$thisChar</a> | ";

    }  

    } ?>

    </div>  
      <div>
        <h4 >Game Mechanics</h4>
        <?php 
          $mechanicsSql = "SELECT mechanics FROM boardgame_catalog ";
          $result = mysqli_query($con,$mechanicsSql);
          $try= $result;
          // print_r($result);
          ?>
          <div class="d-flex flex-wrap ">
        <?php $myarray = "";
        while($row= mysqli_fetch_array($result)):
          // print_r($row);
          $mechanicsinput = $row['mechanics'];
          if($mechanicsinput != ''){
          $myarray .= $mechanicsinput . ",";
          $removespace = str_replace(' ','', $myarray);
          }
            endwhile;
          // echo $removespace; 
            // $removespace = substr($removespace, 1);
           
            $mechanicsexplode = (explode(",", $removespace));
          $results =  array_unique(array_map('strtolower',$mechanicsexplode));
          
          foreach($results as $value):
            if($value != '' ):
            ?>
              
            <p><?php  echo "<a  class=\"px-2 text-nowrap text-caplization\" href=\"library.php?displayby=mechanics&displayvalue1=$value%\">$value</a>";?>|</p>
      <?php endif;
    endforeach; ?>
    </div>
    
</div>
<div>
      <h4>Game Difficulty</h4>
      <form method="post"  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
            <div class="form-check">
            <input class="form-check-input myRadioBtn" type="radio" onclick="this.form.submit()" <?php if(isset($gameweight) && $gameweight == 'light'){echo 'Checked';} ?> name="game-weight" id="light-weight" value="light">
            <label class="form-check-label" for="light-weight" >Light Difficulty </label>
  </div>
            <div class="form-check">
            <input class="form-check-input myRadioBtn" type="radio" onclick="this.form.submit()" name="game-weight" <?php if(isset($gameweight) && $gameweight == 'medium'){echo 'Checked';} ?> id="medium-weight" value="medium">
            <label class="form-check-label" for="medium-weight">Medium Difficulty</label> 
      </div>
      <div class="form-check">
            <input class="form-check-input myRadioBtn" type="radio"  onclick="this.form.submit()" name="game-weight" <?php if(isset($gameweight) && $gameweight == 'heavy'){echo 'Checked';} ?> id="heavy-weight" value="heavy">
            <label class="form-check-label" for="medium-weight">Heavy Difficulty</label>
              

      </form>
    </div>
    <div>
  <a href="library.php">Reset Search</a></div>

  </div> 


  
</div>
<div class="">
<table class="table">
  <thead>
    <tr>
      <th scope="col">Image</th>
      <th scope="col">Game Title</th>
      <th scope="col">Publisher</th>
      <th scope="col">Year</th>
      <th scope="col">Mechanics</th> 
      <th scope="col">Player Count</th>
      <th scope="col">Weight</th>
     
    </tr>
  </thead>
  <tbody>
  
 
  <?php $sql = "SELECT bc.*,ba.*,bi.filename FROM boardgame_catalog AS bc INNER JOIN boardgame_averages AS ba ON bc.gameid = ba.gameid INNER JOIN boardgame_image AS bi ON bc.gameid=bi.gameid $searchby ORDER BY gametitle ASC";
$result = mysqli_query($con, $sql); ?>
<?php
        while($row = mysqli_fetch_array($result)){
          
    ?>
    <tr >
      <th scope="row" >
    <img src="imgs/img100/<?php echo $row['filename'];  ?>" alt="<?php echo $row['gametitle'];?> Boardgame Image"></th>
      <td class=" align-middle "><a class="text-capitalize text-decoration-none text-primary text-truncate fw-bold" href="display.php?id=<?php echo $row['gameid'];?>&from=library"><?php echo $row['gametitle'];?> </a></td>
      <td class="align-middle text-capitalize "><?php echo $row['publisher']; if($row['publisher'] == ''){echo "Unkown";}?></td>
      <td class="align-middle text-capitalize"><?php echo $row['releaseyear']; if($row['releaseyear'] == ''){echo "Unkown";}?></td>
      <td class="align-middle text-capitalize"><?php echo $row['mechanics']; if($row['mechanics'] == ''){echo "Unkown";}?></td>
      <td class="align-middle text-capitalize"><?php echo $row['playermin']; if($row['playermin'] == ''){echo "Unkown";}?> - <?php echo $row['playermax']; if($row['playermax'] == ''){echo "Unkown";}?></td>
      <td class="align-middle"><?php echo $row['weight'];?></td>
   
    </tr>
    <?php  }  ?>
  </tbody>
</table>
</div>
</section>








<?php include("includes/footer.php") ?>