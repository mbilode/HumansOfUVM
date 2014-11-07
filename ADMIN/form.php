<?php
include "../top.php";


//// INITIALIZE VARIABLES ////
$image = "";
$text = "";


//// CHECK FOR SUBMIT ////

if (isset($_POST["btnSubmit"])) {
    
    ////// should we have debug??? ////
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

    /// SANITIVE DATA (htmlentities) ///////

    $image = htmlentities($_POST["txtImage"], ENT_QUOTES, "UTF-8");
    $text = htmlentities($_POST["txtText"], ENT_QUOTES, "UTF-8");

}
?>
<article id="main">

<?php
if (isset($_POST["btnSubmit"])) {
    //// QUERY ////

    
    
    
    //// DISPLAY ////

        //this is BOBs display, not 100% how it works ///
    $numberRecords = count($results);

    print "<h2>Total Records: " . $numberRecords . "</h2>";
    //print "<h3>SQL: " . $query . "</h3>";

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
              id="frmRegister">

            <fieldset class="wrapper">
                <legend>ADMIN</legend>


                <fieldset class="wrapperTwo">
                    <legend>Submit new image:</legend>

                    <fieldset class="contact">

                        <label for="txtImage" class="required">Image
                            <input type="text" id="txtImage" name="txtImage"
                                   value="<?php print $image; ?>"
                                   tabindex="100" maxlength="45" placeholder=" Image path"
                                   onfocus="this.select()"
                                   autofocus>
                        </label>
                        <label for="txtText" class="required">Text
                            <input type="text" id="txtText" name="txtText"
                                   value="<?php print $text; ?>"
                                   tabindex="200" maxlength="450" placeholder="Enter blurb"
                                   onfocus="this.select()"
                                   autofocus>
                        </label>
   

                    </fieldset> <!-- ends contact -->
                    <fieldset class="buttons">
                        <legend></legend>
                        <input type="submit" id="btnSubmit" name="btnSubmit" value="Submit" tabindex="900" class="button">
                    </fieldset> <!-- ends buttons -->

                </fieldset> <!-- ends wrapper Two -->

            </fieldset> <!-- Ends Wrapper -->

        </form>
<?php } ?>
</article>


<?php include "../footer.php"; ?>
</body>
</html> 


