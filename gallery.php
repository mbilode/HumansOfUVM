    
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

if ($debug) print "<p>DEBUG MODE IS ON</p>";


//!@!#!@#!@#!@#!@#!@#!@#!@#!@#!@#!@#!@#!@#!@#!@#!@#!@#!@#!@#!@#!@#!@#!@#!@#!@#!@#!@#!@#!@#!@#!@#!@#!@


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


    
		
<div class="image-row">    
    <?php
    
    foreach ($images as $img) {
    echo '<a rel="lightbox" href="' . $folder . '/' . $img . '" data-lightbox="example-1" title="">';
    echo '<img src="' . $folder . '/' . $img . '" alt="" />' . "\n";
    echo "</a>";
}
//needs to be set in css width="150" height="150"
    ?>
   

   
<?php       

if ($debug) print "<p>END</p>";
?>

</body>
</html>
