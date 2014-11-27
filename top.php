<!DOCTYPE html>
<html lang="en">
  
    <head>
        <title>Humans of UVM</title>
        <meta charset="utf-8">
        <meta name="author" content="Michelle Marin, Monica Bilodeau">
        <meta name="description" content="Inspired by all of us - this project seeks to capture and share the daily beauty in the people of the UVM community.">

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!--[if lt IE 9]>
        <script src="//html5shim.googlecode.com/sin/trunk/html5.js"></script>
        <![endif]-->
        
        
        <script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>

        <link rel="stylesheet" href="css/monica.css" media="screen">
        

        <?php
        $debug = false;

// %^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// PATH SETUP
//
//  $domain = "https://www.uvm.edu" or http://www.uvm.edu;

        $domain = "http://";
        if (isset($_SERVER['HTTPS'])) {
            if ($_SERVER['HTTPS']) {
                $domain = "https://";
            }
        }

        $server = htmlentities($_SERVER['SERVER_NAME'], ENT_QUOTES, "UTF-8");

        $domain .= $server;

        $phpSelf = htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES, "UTF-8");

        $path_parts = pathinfo($phpSelf);
        
        $basePath = $domain . $path_parts['dirname'] . "/";

        if ($debug) {
            print "<p>Domain" . $domain;
            print "<p>php Self" . $phpSelf;
            print "<p>Path Parts<pre>";
            print_r($path_parts);
            print "</pre>";
        }
        
        
        if ($path_parts['filename'] == "home.php") {
            ?>
            <script src="js/jquery-1.11.0.min.js"></script>
            <script src="js/lightbox.min.js"></script>
            <link href="css/lightbox.css" rel="stylesheet" />
            <link href="css/screen.css" rel="stylesheet" />
            <?php
        } // end if for photo gallery page

        
        /// LIBRARIES ////
        /* 
         // i dont think we need this //
        require_once('lib/security.php');

        

            include "lib/validation-functions.php";
            include "lib/mail-message.php"; */
        
        //// CONNECT TO DATABASE ////

        require_once('database/myDatabase.php');

        $dbUserName = get_current_user() . '_writer';
        $whichPass = "w"; //flag for which one to use.
        $dbName = strtoupper(get_current_user()) . '_HUMANS_UVM';

        $thisDatabase = new myDatabase($dbUserName, $whichPass, $dbName);
        ?>	

    </head>
    <!-- //// BODY //// -->

    <?php
    print '<body id="' . $path_parts['filename'] . '">';

    include "header.php";
    ?>
