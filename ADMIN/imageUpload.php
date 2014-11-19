
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>
    <head><title>File Upload To Database</title></head>


    <?php
    require_once('upload.php');

    /*     * * check if a file was submitted ** */
    if (!isset($_FILES['userfile'])) {
        echo '<p>Please select a file</p>';
    } else {
        try {
            $a = upload();
            /*             * * give praise and thanks to the php gods ** */
            echo '<p>Thank you for submitting</p>';
        } catch (Exception $e) {
            echo '<h4>' . $e->getMessage() . '</h4>';
        }
    }
    
    ?>
    <body>
        <h2>Please Choose a File and click Submit</h2>
        <form enctype="multipart/form-data" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
            <input type="hidden" name="MAX_FILE_SIZE" value="99999999" />
            <input name="userfile" type="file" />
            <input type="submit" value="Submit" />
        </form>

    </body>
</html>

