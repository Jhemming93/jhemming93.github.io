<?php 
session_start();

include('includes/header.php'); ?>



<?php
$gameid = $_GET['id'];
$sql = "SELECT * FROM boardgame_catalog WHERE gameid LIKE '$gameid'";
$result = mysqli_query($con, $sql); ?>


<section>
<?php
        while($row = mysqli_fetch_array($result)):   
    ?>
    <h1><?php echo $row['gametitle']; ?></h1>
    <div class=" p-3 border rounded">
    <?php 
    $fgameid = $row['gameid'];
    $sql1 = "SELECT * FROM boardgame_image WHERE gameid LIKE '$fgameid'";
    $result1 = mysqli_query($con, $sql1); 
    while($row1 = mysqli_fetch_array($result1)){
    ?>
    <img  src="imgs/img250/<?php echo $row1['filename']; } ?>" alt="<?php echo $row['gametitle'];?> Boardgame Image">
        <div class="ml-3 pl-2 border-left">
            <p><b>Game Name: </b><?php echo $row['gametitle'];?></p>
            <?php if($row['gamedesigner'] != ""){ echo "<p><b>Game Designer: </b>" . $row['gamedesigner'] . "</p>";} ?>
            <?php if($row['publisher'] != ""){ echo "<p><b>Game Publisher: </b>" . $row['publisher'] . "</p>";} ?>
           <?php if($row['description'] != ""){ echo "<p><b>Game Description: </b>" . $row['description'] . "</p>";} ?>

           <?php if($row['mechanics'] != ""){ echo "<p><b>Game Mechanics: </b>" . $row['mechanics'] . "</p>";} ?>
           <?php if($row['releaseyear'] != ""){ echo "<p><b>Release Year: </b>" . $row['releaseyear'] . "</p>";} ?>
           <?php if($row['playtime'] != ""){ echo "<p><b>Average Playtime: </b>" . $row['playtime'] . "</p>";} ?>
           <?php if($row['age'] != ""){ echo "<p><b>Average Player Age: </b>" . $row['age'] . "</p>";} ?>

            




           <?php if($row['videofileurl'] != ""){ echo "<div><p><b>Game Tutorial: </b></p><video src=\"" . $row['videofileurl'] . "\" controls></video>";} ?>
           

           
  
           <?php if(isset($_SESSION['your-random-session-bney5ifks'])){ ?>
            <a href="admin/update.php?id=<?php echo $row['gameid']; ?>"><button type="button" name="edit" class="btn btn-primary m-2">Edit</button></a>
         <?php } ?>  
        </div>
         
    </div>
    <div class="d-flex">
        <?php $previous = mysqli_query($con, "SELECT * FROM boardgame_catalog WHERE gameid >$gameid ORDER BY gameid ASC");
        if($row = mysqli_fetch_array($previous)){
            echo '<a href="display.php?id='.$row['gameid'].'"><button type="button" name="pervious" class="btn btn-primary m-2">Previous</button></a>';
        }else{
            echo '<button type="button" name="pervious" class="btn disabled m-2 btn-light">Previous</button>';
        }
        ?>
        <?php 
            $next = mysqli_query($con, "SELECT * FROM boardgame_catalog WHERE gameid<$gameid ORDER BY gameid DESC");
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