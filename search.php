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

    /*if (!securityCheck(true)) {
        $msg = "<p>Sorry you cannot access this page. ";
        $msg.= "Security breach detected and reported</p>";
        die($msg);
    }*/

    /// SANITIZE ///
    $search = htmlentities($_POST["txtSearch"], ENT_QUOTES, "UTF-8");
}

    //QUERY ///

    $query = "SELECT * FROM tblImage WHERE fnkCategoryId = ?";
    $data = array($search);

    $results = $dbh->select($query, $data);

  


    /// DISPLAY ///


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




