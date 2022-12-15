<?php 
session_start();

include('includes/header.php'); 
include('includes/functions.php');






?>
<?php
if(isset($_GET['id'])){
   
   
   $displaygameid = $_GET['id']; 
   if(isset($_GET['from'])){
    if($_GET['from'] = "library"){
         popularupdate($_GET['id']);
    }
   }
   
}else{
    header('Loctaion: library.php');
}



if(isset($_POST['userweightsubmit'])){
    $weight = $_POST['userweightsubmit'];
    if(is_numeric($weight)){
    averagenumber($weight, 'weight', $displaygameid);
}
}

if(isset($_POST['userplaytimesubmit'])){
    $playtime = $_POST['userinputplaytime'];
   
    if(is_numeric($playtime)){
    averagenumber($playtime, 'playtime', $displaygameid);
}
}
if(isset($_POST['useragesubmit'])){
    $age = $_POST['userinputage'];
   
    if(is_numeric($age) && $age <= 100 ){
    averagenumber($age, 'age', $displaygameid);
}
}



$sql = "SELECT bc.*, bi.*, ba.* FROM boardgame_catalog AS bc INNER JOIN boardgame_image AS bi ON bc.gameid=bi.gameid INNER JOIN boardgame_averages AS ba ON bc.gameid=ba.gameid WHERE bc.gameid LIKE '$displaygameid'";
$result = mysqli_query($con, $sql); ?>


<section>
<?php
        while($row = mysqli_fetch_array($result)):   
    ?>
    <h1 class="text-capitalize"><?php echo $row['gametitle']; ?></h1>
    <div class=" p-3 border rounded">
    <div class="d-xl-flex">
        <div>
            <img  src="imgs/display250/<?php echo $row['filename']; ?>" alt="<?php echo $row['gametitle'];?> Boardgame Image">
        </div>
        <div>
        <div class="d-flex justify-content-between gap-2">
            <p class="mx-2 text-capitalize" ><b>Game Name: </b><?php echo $row['gametitle'];?></p>
            <?php if($row['gamedesigner'] != ""){ echo "<p class=\"text-capitalize\"><b>Game Designer: </b>" . $row['gamedesigner'] . "</p>";} ?>
            <?php if($row['publisher'] != ""){ echo "<p class=\"text-capitalize\><b>Game Publisher: </b>" . $row['publisher'] . "</p>";} ?>
            <?php if($row['releaseyear'] != ""){ echo "<p><b>Release Year: </b>" . $row['releaseyear'] . "</p>";} ?>
        </div>
        <div>
            <?php if($row['mechanics'] != ""){ echo "<p class=\"mx-2\"><b>Game Mechanics: </b>" . $row['mechanics'] . "</p>";} ?>
            </div>
        <div class="d-xl-flex justify-content-between gap-3">
                

                <form  method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
                    <div class="mb-3 d-flex gap-3 mx-2">
                        <label for="userinputweight" class="form-label text-nowrap"><p><b>Weight Average: </b><?php echo $row['weight']; ?>/5</p></label>
                        <div>
                        <select onchange="this.form.submit()" name="userweightsubmit" class="form-select">
                            <option selected>----</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            </select>
                        
                    </div>
                    </div>
                </form>
                <form   method="post" class="d-inline" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
                    <div class="mb-3 d-flex gap-2">
                        <label for="userinputplaytime" class="form-label text-nowrap"><p><b>Average Playtime: </b><?php if($row['playtime'] == ""){ echo "0";}else{ echo $row['playtime'];} ?> mins</p></label>
                        <div class="px-0 col-5">
                        <input  type="number" min="1" class="col-4" id="userinputplaytime" name="userinputplaytime">
                        <button type="submit" class=" btn-success mb-3" name="userplaytimesubmit">Add</button>
                    </div>
                    </div>
                </form>
                <form  method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
                    <div class="mb-3 d-flex gap-3 mx-2">
                        <label for="userinputage" class="form-label text-nowrap"><p><b>Age Average: </b><?php echo $row['age']; ?>+</p></label>
                        <div>
                        <input  type="number" min="1" max="100" class="col-5" id="userinputage" name="userinputage">
                        <button type="submit" class=" btn-success mb-3" name="useragesubmit">Add</button>
                    </div>
                    </div>
                </form>
                
            </div>
            
    </div>
    </div>
        <div class="ml-3 pl-2 border-left">
            
           
            <div>
              <p><b>Game Description: </b><?php echo $row['description']; ?></p>
            </div>
           
          
           <?php 
           $videourl = $row['videofileurl'];
           if(strpos($videourl, 'shorts') !== false){
                $videocode = substr($videourl, 31,11);
           }elseif(strpos($videourl, 'watch') !== false){
            $videocode = substr($videourl, 32,11);
            } 
            if($videourl != ""){ echo "<div class=\"video\"><p><b>Game Tutorial: </b></p><iframe width=\"450\" height=\"253\" src=\"https://www.youtube.com/embed/" . $videocode . "\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>";}?> 
           
           
           
       
           
           
  
           
  
           <?php if(isset($_SESSION['your-random-session-bney5ifks'])){ ?>
            <a  href="admin/update.php?id=<?php echo $row['gameid']; ?>"><button type="button" name="edit" class="btn btn-primary m-2">Edit</button></a>
         <?php } ?>  
        </div>
        
         
    </div>
    <div class="d-flex">
        <?php $previous = mysqli_query($con, "SELECT * FROM boardgame_catalog WHERE gameid >$displaygameid ORDER BY gameid ASC");
        if($row = mysqli_fetch_array($previous)){
            echo '<a href="display.php?id='.$row['gameid'].'"><button type="button" name="pervious" class="btn btn-primary m-2">Previous</button></a>';
        }else{
            echo '<button type="button" name="pervious" class="btn disabled m-2 btn-light">Previous</button>';
        }
        ?>
        <?php 
            $next = mysqli_query($con, "SELECT * FROM boardgame_catalog WHERE gameid<$displaygameid ORDER BY gameid DESC");
            if($row = mysqli_fetch_array($next)){
            echo '<a href="display.php?id='.$row['gameid'].'"><button type="button" name="next" class="btn btn-primary m-2">Next</button></a>';  
            }else{
                echo '<button type="button" name="next" class="btn disabled m-2 btn-light">Next</button>';
            } 
        ?>
    </div>
<?php endwhile; ?>
</section>






<?php include('includes/footer.php'); ?>