<?php 
session_start();

include("includes/header.php") 




?>

  <h2 class="main-title index-title">Welcome, to my Boardgame Library</h2>
    
  
  <div class="container d-flex justify-content-center flex-column px-0">
  <p>Here you can look up games to play with your friends and add your own playtime, age and how difficult you found the games. Check out the popular game or maybe a random to start.</p>
  <img src="imgs/resources/front-banner-2.webp"  class="img-fluid mx-auto" alt="boardgame library">
</div>  
    <div class="d-flex justify-content-center my-4">
      
    <a  class="btn btn-success fs-5" href="library.php" role="button">Check out the Library</a>
  </div>
    <div class="container p-2">
      <h3 class="frontpage-scetion text-center fs-2 fw-bold mb-5">Top 3 Popular Games</h3>
      <div class="d-flex flex-wrap flex-md-nowrap gap-2 mx-auto justify-content-center justify-content-md-around">
      <?php 
        $results = mysqli_query($con, "SELECT bc.popularity,bc.gametitle,bc.gameid,bi.filename FROM boardgame_catalog AS bc INNER JOIN boardgame_image AS bi ON bc.gameid=bi.gameid ORDER BY bc.popularity DESC LIMIT 3 ");
        
        while($row = mysqli_fetch_array($results)):  ?>
    

          <div class="card" style="width: 18rem;">
            <img src="imgs/img250/<?php echo $row['filename']; ?>" class="card-img-top" alt="<?php echo $row['gametitle']; ?>">
            <div class="card-body">
              <p class="card-title text-capitalize"><a href="display.php?id=<?php echo $row['gameid']; ?>&from=library"> <?php echo $row['gametitle']; ?></a></p>
            </div>
          </div>
      
      
        <?php endwhile;  ?>
      </div>
    </div>
    <div class="container my-3">
      <h3 class="mb-4">Random Game</h3>
      <p>Don't know what to play why not try this game?</p>
      <?php $results = mysqli_query($con, "SELECT bc.*,bi.filename,ba.weight FROM boardgame_catalog AS bc INNER JOIN boardgame_image AS bi ON bc.gameid=bi.gameid INNER JOIN boardgame_averages AS ba ON bc.gameid=ba.gameid ORDER BY RAND() LIMIT 1 ");
       while($row = mysqli_fetch_array($results)):  ?>

        <div class="container d-md-flex gap-3" >
        <div style="width: 35rem;">
          <img src="imgs/img250/<?php echo $row['filename']; ?>" class="card-img-top img-fluid" alt="<?php echo $row['gametitle']; ?>">
      </div>
        <div>
          <div class="d-flex gap-4">
            <h3 class="text-capitalize"><b><?php echo $row['gametitle'];?></b></h3>
            <h4>Game Weight: <?php echo $row['weight'];?></h4>
          </div>
          <p class="text-capitalize"><b><?php echo $row['description'];?></b></p>
          <a class="btn btn-primary" href="display.php?id=<?php echo $row['gameid']; ?>" role="button">Learn More</a>
        </div>

        </div>
      <?php endwhile; ?>

    </div>


<?php include("includes/footer.php"); ?>



