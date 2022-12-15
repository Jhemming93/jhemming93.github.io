<?php




function createSquareImageCopy($file, $folder, $newWidth){
   
    //echo "$filename, $folder, $newWidth";
    //exit();
 
    $thumb_width = $newWidth;
    $thumb_height = $newWidth;// tweak this for ratio
 
    list($width, $height) = getimagesize($file);
 
    $original_aspect = $width / $height;
    $thumb_aspect = $thumb_width / $thumb_height;
 
    if($original_aspect >= $thumb_aspect) {
       // If image is wider than thumbnail (in aspect ratio sense)
       $new_height = $thumb_height;
       $new_width = $width / ($height / $thumb_height);
    } else {
       // If the thumbnail is wider than the image
       $new_width = $thumb_width;
       $new_height = $height / ($width / $thumb_width);
    }
 
    if($_FILES['gameimg']['type'] == "image/jpeg"){
         $source = imagecreatefromjpeg($file);
    }elseif($_FILES['gameimg']['type'] == "image/png"){
        $source = imagecreatefrompng($file);
    }
 
   
    $thumb = imagecreatetruecolor($thumb_width, $thumb_height);
 
    // Resize and crop
    imagecopyresampled($thumb,
                       $source,0 - ($new_width - $thumb_width) / 2, // Center the image horizontally
                       0 - ($new_height - $thumb_height) / 2, // Center the image vertically
                       0, 0,
                       $new_width, $new_height,
                       $width, $height);
   
    $newFileName = $folder. "/" .basename($file);
    // imagejpeg($thumb, $newFileName, 80);
    if($_FILES['gameimg']['type'] == "image/jpeg"){
        imagejpeg($thumb, $newFileName, 80);
   }elseif($_FILES['gameimg']['type'] == "image/png"){
        imagepng($thumb, $newFileName, 9);
   }
 
    // echo "<p><img src=\"$newFileName\" /></p>"; // if you want to see the image
 
 
 }


 function createThumb($file, $folder, $newwidth){
    list($width, $height) = getimagesize($file);

    $imgRatio =$width/$height;
    $newheight = $newwidth/ $imgRatio;

    // echo "<p> $newwidth | $newheight </p>";
    $thumb = imagecreatetruecolor($newwidth,$newheight);
    if($_FILES['gameimg']['type'] == "image/jpeg"){
        $source = imagecreatefromjpeg($file);
   }elseif($_FILES['gameimg']['type'] == "image/png"){
       $source = imagecreatefrompng($file);
   }


    imagecopyresampled($thumb, $source, 0,0,0,0, $newwidth, $newheight, $width, $height);
    $newFileName =$folder . basename($_FILES['gameimg']['name']);
    if($_FILES['gameimg']['type'] == "image/jpeg"){
        imagejpeg($thumb, $newFileName, 80);
   }elseif($_FILES['gameimg']['type'] == "image/png"){
        imagepng($thumb, $newFileName, 9);
   }
    // imagejpeg($thumb, $newFileName, 80);
    imagedestroy($thumb);
    imagedestroy($source);
}

// function fileWriteAppend(){
//     $current_data = file_get_contents('../js/average.json');
//     $array_data = json_decode($current_data, true);
//     $con2 = mysqli_connect("localhost", "jhemming1","2tQ7508sxp", "jhemming1_dmit2025") or die(mysqli_error($con2));
//     $sql2 = "SELECT * FROM boardgame_catalog WHERE gameid LIKE LAST_INSERT_ID() LIMIT 1";
//     $result2 = mysqli_query($con2, $sql2);
//     while($row2 = mysqli_fetch_array($result2)):  
//     $averagearray =  array(
       

//         $row2['gameid'] => array(
//           'gameweight' => array($row2['gameweight']),
//           'playerage' => array($row2['averageage']),
//           'playtime' => array($row2['playtime']),
//         )
//       );
//     endwhile;
//     $array_data[] = $averagearray;
//     $final_data = json_encode($array_data);
//     return $final_data;
// }


// function fileCreateWrite(){
//     $file=fopen("../js/average.json","w");
//     $array_data=array();
//     $con2 = mysqli_connect("localhost", "jhemming1","2tQ7508sxp", "jhemming1_dmit2025") or die(mysqli_error($con2));
//     $sql2 = "SELECT * FROM boardgame_catalog WHERE gameid LIKE LAST_INSERT_ID() LIMIT 1";
//     $result2 = mysqli_query($con2, $sql2);
//     while($row2 = mysqli_fetch_array($result2)):  
//     $averagearray =  array(
       

//         $row2['gameid'] => array(
//           'gameweight' => array($row2['gameweight']),
//           'playerage' => array($row2['averageage']),
//           'playtime' => array($row2['playtime']),
//         )
//       );
//     endwhile;
//     $array_data[] = $averagearray;
//     $final_data = json_encode($array_data);
//     fclose($file);
//     return $final_data;
// }
// https://www.php.net/parse_url

// function unparse_url($parsed_url) {
//   $scheme   = isset($parsed_url['scheme']) ? $parsed_url['scheme'] . '://' : '';
//   $host     = isset($parsed_url['host']) ? $parsed_url['host'] : '';
//   $port     = isset($parsed_url['port']) ? ':' . $parsed_url['port'] : '';
//   $user     = isset($parsed_url['user']) ? $parsed_url['user'] : '';
//   $pass     = isset($parsed_url['pass']) ? ':' . $parsed_url['pass']  : '';
//   $pass     = ($user || $pass) ? "$pass@" : '';
//   $path     = "/embed/";

//   $query    = isset($parsed_url['query']) ?   $parsed_url['query'] : '';
//   $fragment = isset($parsed_url['fragment']) ? '#' . $parsed_url['fragment'] : '';
//   return "$scheme$user$pass$host$port$path$query$fragment";
 
// }

function averagenumber ($averageform, $feild, $id){
    $con = mysqli_connect("localhost", "jhemming1","2tQ7508sxp", "jhemming1_dmit2025");
    $sqlget = mysqli_query($con, "SELECT * FROM boardgame_averages WHERE gameid = '$id'");
    $feildinput = $feild . "input";
    while($rowget = mysqli_fetch_array($sqlget)){
            $currentaverage = $rowget[$feild];
            if(!is_numeric($currentaverage)){
                $currentaverage = settype($currentaverage, 'int');
            }
            $totalnumberinput = $rowget[$feildinput];
    
            $newtotalnumberinput = $totalnumberinput + 1;

         $average = (($currentaverage * $totalnumberinput) + $averageform);
        
       if($feild != 'weight'){
        $newaverage = (ceil($average/$newtotalnumberinput));
       }else{
        $newaverage = number_format(($average/$newtotalnumberinput), 2, '.', ',');
        }
        $sqlupdate = "UPDATE boardgame_averages SET $feild = '$newaverage', $feildinput = '$newtotalnumberinput' WHERE gameid = $id";

        mysqli_query($con, $sqlupdate) or die(mysqli_error($con));
};
}
function resetvalues($id, $feild){
    $feildinput = $feild . "input";
    $con = mysqli_connect("localhost", "jhemming1","2tQ7508sxp", "jhemming1_dmit2025");
    if($feild == 'weight'){
        $fvalue = 2.5;
        $ivalue = 1;
    }else{
        $fvalue = 0;
        $ivalue = 0;
    }
    $sqlupdate = "UPDATE boardgame_averages SET $feild = '$fvalue', $feildinput = '$ivalue' WHERE gameid = $id";
    mysqli_query($con, $sqlupdate) or die(mysqli_error($con));
};



function popularupdate($id){ 
    $con = mysqli_connect("localhost", "jhemming1","2tQ7508sxp", "jhemming1_dmit2025");
    $sqlget = mysqli_query($con, "SELECT * FROM boardgame_catalog WHERE gameid = '$id'");
    while($rowget = mysqli_fetch_array($sqlget)){
    $polularityadd = $rowget['popularity'];
    $newpopularity = $polularityadd + 1;
    $sql = "UPDATE boardgame_catalog SET popularity = '$newpopularity' WHERE gameid = '$id' ";
    mysqli_query($con, $sql) or die(mysqli_error($con));
    }
}

function countplayers($min,$max, $id){



}

function checkduplicates($gametitle,$gamedesigner,$playermin,$playermax,$publisher){

    


}

?>