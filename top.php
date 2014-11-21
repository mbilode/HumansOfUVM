<!DOCTYPE html>
<html lang="en">
  
    <head>
        <title>Form</title>
        <meta charset="utf-8">
        <meta name="author" content="Michelle Marin, Monica Bilodeau">
        <meta name="description" content="Inspired by all of us - this project seeks to capture and share the daily beauty in the people of the UVM community.">

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!--[if lt IE 9]>
        <script src="//html5shim.googlecode.com/sin/trunk/html5.js"></script>
        <![endif]-->

        <link rel="stylesheet" href="css/monica.css" type="text/css" media="screen">

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

        if ($debug) {
            print "<p>Domain" . $domain;
            print "<p>php Self" . $phpSelf;
            print "<p>Path Parts<pre>";
            print_r($path_parts);
            print "</pre>";
        }

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
