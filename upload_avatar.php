<?php
session_start();
//include('requires/config.php'); //This is causing problems with JSON... :/
  /*******************************************************
   * Only these origins will be allowed to upload images *
   ******************************************************/
  $accepted_origins = array("http://localhost", "http://192.168.199.151", "http://192.168.199.1", "http://alex.xfocus.ca/");

  /*********************************************
   * Change this line to set the upload folder *
   *********************************************/

/*echo print_r($_FILES);
    echo "<br>";
die();*/
  reset ($_FILES);
  $temp = current($_FILES);
  /*echo $temp['tmp_name'];
  echo "<br>";
  echo print_r($temp);
  die();*/
  if ($temp['error'] !== 0 && is_uploaded_file($temp['tmp_name'])){
      
    $imageFolder = "images/".$_SESSION['username']."/";//.$LS->getUser("username")."/";
    $profpic = scandir($imageFolder);
    unlink($imageFolder.$profpic[2]);
        
    if (isset($_SERVER['HTTP_ORIGIN'])) {
      // same-origin requests won't set an origin. If the origin is set, it must be valid.
      if (in_array($_SERVER['HTTP_ORIGIN'], $accepted_origins)) {
        header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
      } else {
        header("HTTP/1.0 403 Origin Denied");
        return;
      }
    }

    /*
      If your script needs to receive cookies, set images_upload_credentials : true in
      the configuration and enable the following two headers.
    */
    // header('Access-Control-Allow-Credentials: true');
    // header('P3P: CP="There is no P3P policy."');

    // Sanitize input
    if (preg_match("/([^\w\s\d\-_~,;:\[\]\(\).])|([\.]{2,})/", $temp['name'])) {
        header("HTTP/1.0 500 Invalid file name.");
        return;
    }

    // Verify extension
    if (!in_array(strtolower(pathinfo($temp['name'], PATHINFO_EXTENSION)), array("gif", "jpg", "png"))) {
        header("HTTP/1.0 500 Invalid extension.");
        return;
    }

    //Check filename length
    if (mb_strlen($temp['name'], "UTF-8") > 240){
        header("HTTP/1.0 500 File name too long.");
        return;       
    }

    // Accept upload if there was no origin, or if it is an accepted origin
    $filetowrite = $imageFolder . $temp['name'];
    move_uploaded_file($temp['tmp_name'], $filetowrite);

    //Check mime-types
    if (!in_array(exif_imagetype(realpath($filetowrite)), array(IMAGETYPE_GIF, 	IMAGETYPE_JPEG, IMAGETYPE_PNG))) {
        unlink(realpath($filetowrite));
        header("HTTP/1.0 500 Invalid MIME type.");
        return;
    }
    
    //Make an Imagick object on our newly minted image
    //$img can now do lots of neat stuff to the image.
    $img = new \Imagick(realpath($filetowrite));

    //Clean out exif data from jpg files
    if (strtolower(pathinfo($temp['name'], PATHINFO_EXTENSION))==="jpg") {
        $icc = $img->getImageProfiles("icc", true);
        $img->stripImage();
        if(!empty($icc)){
            $img->profileImage("icc", $icc['icc']);
        }
    }
      
   $img->resizeImage(500, 500, FILTER_POINT, 0);

    
    // Respond to the successful upload with JSON.
    // Use a location key to specify the path to the saved image resource.
    // { location : '/your/uploaded/image/file'}
    header("Location: manage-account.php");
    die();
  } else {
    // Notify editor that the upload failed
    header("HTTP/1.0 500 Server Error");
  }
?>
