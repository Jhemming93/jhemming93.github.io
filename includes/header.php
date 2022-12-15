<?php include("mysql_connect.php"); 



if(isset($_POST['search-submit'])){
  $searchby = "gametitle OR mechanics OR description";
  $searchvalue = strip_tags($_POST['search']);
  if($searchvalue != ""){
    header('Location: https://jhemming1.dmitstudent.ca/dmit2025/labs/lab_8/library.php?searchby=' . $searchvalue);
  }
  


}



?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    

    <link rel="stylesheet" href="styles/main.css" >
    <script src="js/main.js"></script>
    <title>Board Games Collection</title>
  </head>
  <body>
    <header class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-light bg-light container">
  <div class="container-fluid">
  <a class="navbar-brand" href="<?php echo BASE_URL; ?>index.php">
      <img src="<?php echo BASE_URL; ?>imgs/resources/logo.png" alt="Board Game Logo" width="40" height="40" class="d-inline-block align-text-top">
      Board Game Library
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?php echo BASE_URL; ?>index.php">Homepage</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo BASE_URL; ?>library.php">Boardgame Library</a>
        </li>
        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Admin
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
          <?php if(!isset($_SESSION['your-random-session-bney5ifks'])){ ?>
            <a class="dropdown-item" href="<?php echo BASE_URL;?>admin/login.php?refer=welcome\">Login</a>

          <?php } ?>
          <?php if(isset($_SESSION['your-random-session-bney5ifks'])){ ?>
            <li><a class="dropdown-item" href="<?php echo BASE_URL;?>admin/logout.php">Logout</a></li>
            <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item" href="<?php echo BASE_URL;?>admin/insert.php">Upload New Game</a></li> 
          <li><a class="dropdown-item" href="<?php echo BASE_URL;?>admin/update.php">Edit Game Info</a></li>
            <?php }?>
          </ul>
      </li>
     
      </ul>
      <form class="d-flex" method="post" action="library.php">
        <input class="form-control me-2" type="search" placeholder="Search" name="search" aria-label="Search">
        <button class="btn btn-outline-success" name="search-submit" type="post">Search</button>
      </form>
    </div>
  </div>
</nav>
    </header>   
  
    <main class="container my-5">