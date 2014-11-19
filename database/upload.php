<?php
/**
 *
 * the upload function
 * 
 * @access public
 *
 * @return void
 *
 */
function upload(){
/*** check if a file was uploaded ***/
if(is_uploaded_file($_FILES['userfile']['tmp_name']) && getimagesize($_FILES['imgImage']['tmp_name']) != false)
    {
    /***  get the image info. ***/
    $size = getimagesize($_FILES['userfile']['tmp_name']);
    /*** assign our variables ***/
    $type = $size['mime'];
    $imgfp = fopen($_FILES['userfile']['tmp_name'], 'rb');
    $size = $size[3];
    $name = $_FILES['userfile']['name'];
    $maxsize = 99999999;
    if ($debug) {
                    echo "Upload: " . $_FILES["userfile"]["name"] . "<br>";
                    echo "Type: " . $_FILES["userfile"]["type"] . "<br>";
                    echo "Size: " . ($_FILES["userfile"]["size"] / 1024) . " kB<br>";
                    echo "Temp file: " . $_FILES["userfile"]["tmp_name"] . "<br>";
                }

    /***  check the file is less than the maximum file size ***/
    if($_FILES['userfile']['size'] < $maxsize )
        {
        /*** connect to db ***/
        /*require_once('myDatabase.php');

        $dbUserName = get_current_user() . '_writer';
        $whichPass = "w"; //flag for which one to use.
        $dbName = strtoupper(get_current_user()) . '_HUMANS_UVM';*/

       // $dbh = new myDatabase($dbUserName, $whichPass, $dbName);
        $query = "INSERT INTO tblImage (image_type ,image, image_size, image_name) VALUES (? ,?, ?, ?)";
        $data = array($type,$imgfp,$size,$name);
        $dbh->insert($query,$data);
                /*** set the error mode ***/
                //$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            /*** our sql query ***/
        /*$stmt = $dbh->prepare("INSERT INTO testblob (image_type ,image, image_size, image_name) VALUES (? ,?, ?, ?)");

        /*** bind the params **
        $stmt->bindParam(1, $type);
        $stmt->bindParam(2, $imgfp, PDO::PARAM_LOB);
        $stmt->bindParam(3, $size);
        $stmt->bindParam(4, $name);

        /*** execute the query **
        $stmt->execute();*/
        }
    else
        {
        /*** throw an exception is image is not of type ***/
        throw new Exception("File Size Error");
        }
    }
else
    {
    // if the file is not less than the maximum allowed, print an error
    throw new Exception("Unsupported Image Format!");
    }
}
?>