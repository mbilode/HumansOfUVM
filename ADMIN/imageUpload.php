<?php
include "../top.php";
//include("../nav.php");


$debug = false;
if (isset($_GET["debug"])) { // ONLY do this in a classroom environment
    $debug = true;
}
if ($debug)
    print "<p>DEBUG MODE IS ON</p>";


/// SECURITY VARIABLES // 
$yourURL = $domain . $phpSelf;

/// FORM VARIABLES //
$description = "";
$category = "";
$image = "";
$imageERROR = false;
$MAXLOGOSIZE = 90000000;

if (isset($_POST["btnSubmit"])) {
/*
    if (!securityCheck(true)) {
        $msg = "<p>Sorry you cannot access this page. ";
        $msg.= "Security breach detected and reported</p>";
        die($msg);
    }*/

    //SANITIZE //
    $description = htmlentities($_POST["txtDescription"], ENT_QUOTES, "UTF-8");
    $category = htmlentities($_POST["txtCategory"], ENT_QUOTES, "UTF-8");
    $image = htmlentities($_FILES["imgImage"]["name"], ENT_QUOTES, "UTF-8");

    $errorMsg = array();

    //// CHECK IMAGE ///
    if (!empty($image)) {

        $allowedExts = array("gif", "jpeg", "jpg", "png");
        $temp = explode(".", $_FILES["imgImage"]["name"]);
        $extension = strtolower(end($temp));
        if ((($_FILES["imgImage"]["type"] == "image/gif") || ($_FILES["imgImage"]["type"] == "image/jpeg") || ($_FILES["imgImage"]["type"] == "image/jpg") || ($_FILES["imgImage"]["type"] == "image/pjpeg") || ($_FILES["imgImage"]["type"] == "image/x-png") || ($_FILES["iimgImage"]["type"] == "image/png")) && in_array($extension, $allowedExts)) {
            if ($_FILES["imgImage"]["size"] > $MAXLOGOSIZE) {
                $errorMsg[] = "Error uploading image: <span clsss='black'>" . $_FILES["imgImage"]["name"] . "</span> The size (" . number_format($_FILES["imgImage"]["size"]) . ") is to large (max size is: " . number_format($MAXLOGOSIZE) . ")";
            } else {
                if ($debug) {
                    echo "Upload: " . $_FILES["imgImage"]["name"] . "<br>";
                    echo "Type: " . $_FILES["imgImage"]["type"] . "<br>";
                    echo "Size: " . ($_FILES["imgImage"]["size"] / 1024) . " kB<br>";
                    echo "Temp file: " . $_FILES["imgImage"]["tmp_name"] . "<br>";
                }

                if (file_exists("images/" . $_FILES["imgImage"]["name"])) {
                    $errorMsg[] = "<span clsss='black'>" . $_FILES["imgImage"]["name"] . "</span> already exists. You can just leave it empty or choose a new logo.";
                    $imageERROR = true;
                }
            }
        } else {
            $errorMsg[] = "There was an error uploading your company's logo: <span class='black'>" . $_FILES["imgImage"]["name"] . "</span>. " . $_FILES["imgImage"]["type"] . " file types are not allowed.";
            $imageERROR = true;
        }
    }  // ends image error


    if (!$errorMsg) {
        if ($debug)
            print "<p>Form is valid</p>";
        if (is_uploaded_file($_FILES['imgImage']['tmp_name']) && getimagesize($_FILES['imgImage']['tmp_name']) != false) {
            /*             * *  get the image info. ** */
            $size = getimagesize($_FILES['imgImage']['tmp_name']);
            /*             * * assign our variables ** */
            $type = $size['mime'];
            $imgfp = fopen($_FILES['imgImage']['tmp_name'], 'rb');
            $size = $size[3];
            $name = $_FILES['imgImage']['name'];
            $maxsize = 99999999;
            if ($debug) {
                echo "Upload: " . $_FILES["imgImage"]["name"] . "<br>";
                echo "Type: " . $_FILES["imgImage"]["type"] . "<br>";
                echo "Size: " . ($_FILES["imgImage"]["size"] / 1024) . " kB<br>";
                echo "Temp file: " . $_FILES["imgImage"]["tmp_name"] . "<br>";
            }
            if ($_FILES['imgImage']['size'] < $maxsize) {
                $query = "INSERT INTO tblImage (fldType,fldFile,fldSize,fldName,fldDescription, fnkCategoryId) VALUES (? ,?, ?, ?,?,?)";
                $data = array($type, $imgfp, $size, $name, $description, $category);

                $dbh->insert($query, $data);
            }
        }
        /*if (!empty($_FILES["imgImage"]["tmp_name"])) {
                move_uploaded_file($_FILES["imgImage"]["tmp_name"], "images/" . $_FILES["imgImage"]["name"]);
                if ($debug){
                echo "Stored in: " . "images/" . $_FILES["imgImage"]["name"];}
                $image = $_FILES["imgImage"]["name"];
            }*/
    } //if no error messages
}
?>
<body>
    <link rel="stylesheet" href="../css/monica.css" media="screen">
    
    <h1 class="page-title">Please Choose a File and click Submit</h1>
    <form action="<? print $phpSelf; ?>"
          enctype="multipart/form-data"
          method="post"
          id="frmImage"
          role="form">
        <label for="imgImage">Image</label>
        <input type='file' onchange="readCompURL(this);" tabindex="30" 
               class="element text large<?php if ($imageERROR) echo ' mistake'; ?>" 
               id="imgImage"
               name="imgImage">
        <img id="image" src="#" alt="">
        <input type='hidden' name='MAX_FILE_SIZE' value='<?php print $MAXLOGOSIZE; ?>' >
        <label for="txtDescription" class="required">Description
            <input type="text" id="txtDescription" name="txtDescription"
                   value="<?php print $description; ?>"
                   tabindex="200" maxlength="450" placeholder="Enter blurb"
                   />
        </label>
        <label for="txtCategory" class="required">Category
            <input type="text" id="txtCategory" name="txtCategory"
                   value="<?php print $category; ?>"
                   tabindex="210" maxlength="450" placeholder="Enter Category"
                   />
        </label>

<input type="submit" id="btnSubmit" name="btnSubmit" value="Submit" tabindex="991" class="button btn btn-primary btn-block btn-lg">
    </form>

    
</body>
</html>