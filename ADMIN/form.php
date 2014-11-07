<?php
include "../top.php";


//// INITIALIZE VARIABLES ////



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

    // example: $classType = htmlentities($_POST["txtClassType"], ENT_QUOTES, "UTF-8");
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
                <legend>Searching for a class: Fall Semester</legend>


                <fieldset class="wrapperTwo">
                    <legend>Enter as many or as few as you would like.</legend>

                    <fieldset class="contact">

                        <label for="txtSubject" class="required">Subject
                            <input type="text" id="txtSubject" name="txtSubject"
                                   value="<?php print $subject; ?>"
                                   tabindex="100" maxlength="45" placeholder="Subject"
                                   onfocus="this.select()"
                                   autofocus>
                        </label>
                        <label for="txtNumber" class="required">Number
                            <input type="text" id="txtNumber" name="txtNumber"
                                   value="<?php print $number; ?>"
                                   tabindex="200" maxlength="45" placeholder="number"
                                   onfocus="this.select()"
                                   autofocus>
                        </label>
                        <label for="lstBuildings">Building
                            <select id="lstBuildings"
                                    name="lstBuildings"
                                    tabindex="300" >
 
                                <option selected="" value=""></option>
                                <option value="31 SPR">31 SPR</option>
                                <option value="481 MN">481 MN</option>
                                <option value="617 MN">617 MN</option>
                                <option value="70S WL">70S WL</option>
                                <option value="AIKEN">AIKEN</option>
                                <option value="ALLEN">ALLEN</option>
                                <option value="ANGELL">ANGELL</option>
                                <option value="BLLNGS">BLLNGS</option>
                                <option value="COOK">COOK</option>
                                <option value="CPW">CPW</option>
                                <option value="DELEHA">DELEHA</option>
                                <option value="DEWEY">DEWEY</option>
                                <option value="FAHC">FAHC</option>
                                <option value="FLEMIN">FLEMIN</option>
                                <option value="GIVN">GIVN</option>
                                <option value="GIVN C">GIVN C</option>
                                <option value="GUTRSN">GUTRSN</option>
                                <option value="HARRIS">HARRIS</option>
                                <option value="HILLS">HILLS</option>
                                <option value="HSRF">HSRF</option>
                                <option value="JEFFRD">JEFFRD</option>
                                <option value="JERCHO">JERCHO</option>
                                <option value="KALKIN">KALKIN</option>
                                <option value="L/L CM">L/L CM</option>
                                <option value="L/L-A">L/L-A</option>
                                <option value="L/L-B">L/L-B</option>
                                <option value="L/L-D">L/L-D</option>
                                <option value="LAFAYE">LAFAYE</option>
                                <option value="MANN">MANN</option>
                                <option value="MARSH">MARSH</option>
                                <option value="ML SCI">ML SCI</option>
                                <option value="MORRIL">MORRIL</option>
                                <option value="MRC">MRC</option>
                                <option value="MRC-CO">MRC-CO</option>
                                <option value="MUSIC">MUSIC</option>
                                <option value="OFFCMP">OFFCMP</option>
                                <option value="OLDMIL">OLDMIL</option>
                                <option value="OMANEX">OMANEX</option>
                                <option value="ONCMP">ONCMP</option>
                                <option value="ONLINE">ONLINE</option>
                                <option value="PATGYM">PATGYM</option>
                                <option value="PERKIN">PERKIN</option>
                                <option value="POMERO">POMERO</option>
                                <option value="ROWELL">ROWELL</option>
                                <option value="RT THR">RT THR</option>
                                <option value="SOUTHW">SOUTHW</option>
                                <option value="STAFFO">STAFFO</option>
                                <option value="TERRIL">TERRIL</option>
                                <option value="TORREY">TORREY</option>
                                <option value="UHTN">UHTN</option>
                                <option value="UHTN23">UHTN23</option>
                                <option value="UHTS">UHTS</option>
                                <option value="UHTS23">UHTS23</option>
                                <option value="VOTEY">VOTEY</option>
                                <option value="WATERM">WATERM</option>
                                <option value="WHEELR">WHEELR</option>
                                <option value="WILLMS">WILLMS</option>
                             
                            </select>
                        </label>
                        <label for="txtStartTime" class="required">Start Time
                            <input type="text" id="txtStartTime" name="txtStartTime"
                                   value="<?php print $startTime; ?>"
                                   tabindex="400" maxlength="45" placeholder="start time"
                                   onfocus="this.select()"
                                   autofocus>
                        </label>
                        <label for="txtProfessor" class="required">Professor
                            <input type="text" id="txtProfessor" name="txtProfessor"
                                   value="<?php print $professor; ?>"
                                   tabindex="500" maxlength="45" placeholder="professor"
                                   onfocus="this.select()"
                                   autofocus>
                        </label>
                        <!--
                        <label for="txtClassType" class="required">Class Type
                            <input type="text" id="txtClassType" name="txtClassType"
                                   value="<?php print $classType; ?>"
                                   tabindex="600" maxlength="45" placeholder="class type"
                                   onfocus="this.select()"
                                   autofocus>
                        </label> -->


                    </fieldset> <!-- ends contact -->
                    <fieldset class="buttons">
                        <legend></legend>
                        <input type="submit" id="btnSubmit" name="btnSubmit" value="Find a class" tabindex="900" class="button">
                    </fieldset> <!-- ends buttons -->

                </fieldset> <!-- ends wrapper Two -->

            </fieldset> <!-- Ends Wrapper -->

        </form>
<?php } ?>
</article>


<?php include "../footer.php"; ?>
</body>
</html> 


