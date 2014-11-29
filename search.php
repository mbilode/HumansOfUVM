<script src="js/jquery-1.11.0.min.js"></script>
<script src="js/lightbox.min.js"></script>

<link href="css/lightbox.css" rel="stylesheet" />
<div class="image-row"> 
    <?php

/// FORM VARIABLES //
    $search = "";


//// CHECK FOR SUBMIT ////
    if (isset($_POST["btnSubmit"])) {

        $debug = false;

        if (isset($_GET["debug"])) { // ONLY do this in a classroom environment
            $debug = true;
        }

        if ($debug)
            print "<p>DEBUG MODE IS ON</p>";

        /* if (!securityCheck(true)) {
          $msg = "<p>Sorry you cannot access this page. ";
          $msg.= "Security breach detected and reported</p>";
          die($msg);
          } */

        /// SANITIZE ///
        $search = htmlentities($_POST["txtSearch"], ENT_QUOTES, "UTF-8");
    }

    //QUERY ///

    $query = "SELECT fldName FROM tblImage WHERE fnkCategoryId LIKE ?";
    $data = array($search);

    $results = $dbh->select($query, $data);
    //print_r($results);

    ?>
    <form action="<?php print $phpSelf; ?>"
          method="post"
          id="frmSearch">



        <label for="txtSearch" class="required">
            <input type="text" id="txtSearch" name="txtSearch"
                   value="<?php print $search; ?>"
                   tabindex="100" maxlength="45" placeholder="Search"
                   onfocus="this.select()"
                   autofocus>
            <input type="submit" id="btnSubmit" name="btnSubmit" value="Search" tabindex="900" class="button">
        </label>

    </form>
    <?php
    /// DISPLAY ///
    $folder = "HumanPics";

foreach ($results as $row) {
    foreach ($row as $field => $value) {
            if (!is_int($field)) {
                echo '<a class="example-image-link" rel="lightbox" href="' . $folder . '/' . $value . '"data-lightbox="'. $value .'">';
    echo '<img class="' . $folder . '/' . $value . '" src="' . $folder . '/' . $value . '" alt="Humans" />' . "\n";
    echo "</a>";
            }
        }
}
?>




