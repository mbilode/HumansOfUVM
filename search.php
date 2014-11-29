<?php
/// FORM VARIABLES //
$search = "";

/// ERROR FLAGS ///
$searchERROR = false;

//// CHECK FOR SUBMIT ////
if (isset($_POST["btnSubmit"])) {

    $debug = false;

    if (isset($_GET["debug"])) { // ONLY do this in a classroom environment
        $debug = true;
    }

    if ($debug)
        print "<p>DEBUG MODE IS ON</p>";

    if (!securityCheck(true)) {
        $msg = "<p>Sorry you cannot access this page. ";
        $msg.= "Security breach detected and reported</p>";
        die($msg);
    }

    /// SANITIZE ///
    $search = htmlentities($_POST["txtSearch"], ENT_QUOTES, "UTF-8");






    //WRITE QUERY!! ///
    
    $query = "SELECT * FROM tblImage WHERE fldCategory = ?";
    $data = array($search);

    $results = $thisDatabase->select($query,$data);

    echo "<font color='red' size='15'> SUBMITTED YO</font>";

    /// DISPLAY ///
    print "<table>";

    $firstTime = true;

    /* since it is associative array display the field names */
    foreach ($results as $row) {
        if ($firstTime) {
            print "<thead><tr>";
            $keys = array_keys($row);

            foreach ($keys as $key) {
                if (!is_int($key)) {
                    //preg_replace(' /(?<! )(?<!^)(?<![A-Z])[A-Z]/', ' $0',  substr($key, 3));
                    print "<th>" . substr($key, 3) . "</th>";
                }
            }
            print "</tr>";
            $firstTime = false;
        }

        /* display the data, the array is both associative and index so we are
         *  skipping the index otherwise records are doubled up */
        print "<tr>";
        foreach ($row as $field => $value) {
            if (!is_int($field)) {
                print "<td>" . $value . "</td>";
            }
        }
        print "</tr>";
    }
    print "</table>";
} else {
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

<?php } ?>


