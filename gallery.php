<script src="js/jquery-1.11.0.min.js"></script>
<script src="js/lightbox.min.js"></script>
<link rel="stylesheet" href="css/monica.css" media="screen">
<link href="css/lightbox.css" rel="stylesheet" />
<div class="image-row"> 

    <?php
    print '<article id="main">';
    if ($debug)
        print "<p>DEBUG MODE IS ON</p>";

    $query = "SELECT fldName FROM tblImage";
    $results = $dbh->select($query);


/// DISPLAY ///
    $folder = "HumanPics";

    foreach ($results as $row) {
        foreach ($row as $field => $value) {
            if (!is_int($field)) {
                echo '<a class="example-image-link" rel="lightbox" href="' . $folder . '/' . $value . '"data-lightbox="' . $value . '">';
                echo '<img class="' . $folder . '/' . $value . '" src="' . $folder . '/' . $value . '" alt="Humans" />' . "\n";
                echo "</a>";
            }
        }
    }
    if ($debug)
        print "<p>END</p>";
    ?>
</div>

