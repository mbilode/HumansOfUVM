    
<!DOCTYPE html>

<html lang="en">
<head>
    <title>HumansOfUVM</title>
    <meta charset="utf-8">
    <meta name="author" content="Monica">
    <meta name="description" content="Humans of UVM">
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    
    <link href="css/style.css" rel="stylesheet">
    <link href="css/js-image-slider.css" rel="stylesheet">
    <script src="js-image-slider.js"></script>
  
</head>


<body>

<header>
    <img src="HumansOfUVM.jpg" alt="banner">
</header>
<?php    
    

if ($debug2){ print "<p>DEBUG MODE IS ON</p>";}
$folder = "HumanPics";
// %^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// Automatically set up PATH
//
// $domain = "https://www.uvm.edu" or http://www.uvm.edu;

if ($_SERVER['HTTPS']) {
    $domain = "https://";
    print "<h1>This code does not work on https</h1>";
} else {
    $domain = "http://";
}

$server = htmlentities($_SERVER['SERVER_NAME'], ENT_QUOTES, "UTF-8");

$domain .= $server;

$phpSelf = htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES, "UTF-8");

$path_parts = pathinfo($phpSelf);

$basePath = $domain . $path_parts['dirname'] . "/";

/*
 * this functions gets a list of all the image files in variable url
 * however the url cannot have an index file
 * 
 */

function getFileList($url) {
    $outputBuffer = array();

    error_reporting(0); //404 reports a warning i dont want
    $var = file_get_contents($url);
    error_reporting(1);

    if ($var != "") {
        preg_match_all("/a[\s]+[^>]*?href[\s]?=[\s\"\']+" .
                "(.*?)[\"\']+.*?>" . "([^<]+|.*?)?<\/a>/", $var, &$matches);

        $matches = $matches[1];

        foreach ($matches as $var) {
            $ext = pathinfo($var, PATHINFO_EXTENSION);
            if ($ext == "jpg" | $ext == "png" | $ext == "gif") {
                $outputBuffer[] = $var;
            }
        }
    }
    return $outputBuffer;
}

$images = getFileList($basePath . $folder);




//!@#!@#!@#!@#!@#!@#!@#!@#!@#!@#!@#!@#!@#!@#!@#!@#!@#!@#!@#!@#!@#!@#!@#!@#!@#!@#!@#!@#!@#!@#!@#!@#!@#
?>


    
		
<div id="sliderFrame">
<div id="ribbon"></div>
<div id="slider">  
    
    

    
    
    <?php
    
    foreach ($images as $img) {
    echo '<a class="lazyImage" href="' . $folder . '/' . $img . '" title="**********************************">Plain Javascript Slider</a>';
  
}
//needs to be set in css width="150" height="150"
    ?>
   

        </div>
<?php       

if ($debug) print "<p>END</p>";

    
  
        
 //!@!#!@#!@#!@#!@#!@#!@#!@#!@#!@#!@#!@#!@#!@#!@#!@#!@#!@#!@#!@#!@#!@#!@#!@#!@#!@#!@#!@#!@#!@#!@#!@#!@
        
   
        
   
   
   
   
   
if ($debug2){ print "<p>DEBUG MODE IS ON</p>";}

$folder2 = "images/thumbs/";
// %^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// Automatically set up PATH
//
// $domain = "https://www.uvm.edu" or http://www.uvm.edu;

if ($_SERVER2['HTTPS']) {
    $domain2 = "https://";
    print "<h1>This code does not work on https</h1>";
} else {
    $domain2 = "http://";
}

$server2 = htmlentities($_SERVER2['SERVER_NAME'], ENT_QUOTES, "UTF-8");

$domain2 .= $server2;

$phpSelf2 = htmlentities($_SERVER2['PHP_SELF'], ENT_QUOTES, "UTF-8");

$path_parts2 = pathinfo($phpSelf2);

$basePath2 = $domain2 . $path_parts2['dirname'] . "/";

/*
 * this functions gets a list of all the image files in variable url
 * however the url cannot have an index file
 * 
 */

function getFileList2($url2) {
    $outputBuffer2 = array();

    error_reporting(0); //404 reports a warning i dont want
    $var2 = file_get_contents($url2);
    error_reporting(1);

    if ($var2 != "") {
        preg_match_all("/a[\s]+[^>]*?href[\s]?=[\s\"\']+" .
                "(.*?)[\"\']+.*?>" . "([^<]+|.*?)?<\/a>/", $var2, &$matches2);

        $matches2 = $matches2[1];

        foreach ($matches2 as $var2) {
            $ext2 = pathinfo($var, PATHINFO_EXTENSION);
            if ($ext2 == "jpg" | $ext2 == "png" | $ext2 == "gif") {
                $outputBuffer2[] = $var2;
            }
        }
    }
    return $outputBuffer2;
}

$images2 = getFileList2($basePath2 . $folder2);




//!@#!@#!@#!@#!@#!@#!@#!@#!@#!@#!@#!@#!@#!@#!@#!@#!@#!@#!@#!@#!@#!@#!@#!@#!@#!@#!@#!@#!@#!@#!@#!@#!@#
?>


    
		
 <!--thumbnails-->
  <div id="thumbs">  
    <?php
    
    foreach ($images2 as $img2) {
    echo '<div class="thumb"><img src="' . $folder . '/' . $img . '"/></div>';
  
}
//needs to be set in css width="150" height="150"
    ?>
   
 </div>
     </div>
<?php       

if ($debug) print "<p>END</p>";

include 'midSection.php';
?>



    

</body>
</html>
