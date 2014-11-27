







<script src="js/jquery-1.11.0.min.js"></script>
	<script src="js/lightbox.min.js"></script>
        
        <link href="css/lightbox.css" rel="stylesheet" />





<?php
print '<article id="main">';
if ($debug) print "<p>DEBUG MODE IS ON</p>";

$folder = "HumanPics";

// Automatically set up PATH
//
// $domain = "https://www.uvm.edu" or http://www.uvm.edu;



/*
 * this functions gets a list of all the image files in variable url
 * however the url cannot have an index file
 * 
 */

function getFileList($url) {
    $outputBuffer = array();
//print "<p>url: " . $url;
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


?>	
<div class="image-row">  
    <?php

    
    
    foreach ($images as $img) {
        
        
       // data-lightbox="cs-fair">\n<img class="img-thumbnail" src="HumanPics/pic' + i + '.jpg" alt="CS Fair 2013" />\n</a>
    echo '<a class="example-image-link" rel="lightbox" href="' . $folder . '/' . $img . '"data-lightbox="'. $img .'">';
    echo '<img class="' . $folder . '/' . $img . '" src="' . $folder . '/' . $img . '" alt="Humans" />' . "\n";
    echo "</a>";
}


if ($debug) print "<p>END</p>";
    ?>
</div>
   </div>

   
   