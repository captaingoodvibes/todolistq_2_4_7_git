<?PHP 
function file_browse() {
        $JobID = $_POST['JobID'];
	$JobFkClientID = $_POST['ClientID'];
        echo "<form action=\"index.php\" method=\"post\" enctype=\"multipart/form-data\">";
        echo "Select image to upload:";
        echo "<input type=\"file\" name=\"fileToUpload\" id=\"fileToUpload\">";
        echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"upload\">";
        echo "<input type=\"hidden\" name=\"JobID\" value=\"" . $JobID . "\">";
        echo "<input type=\"hidden\" name=\"ClientID\" value=\"" . $JobFkClientID . "\">";
        echo "<input type=\"hidden\" name=\"JobCardNumber\" value=\"" . $JobCardNumber . "\">";
        echo "<input type=\"hidden\" name=\"JobParent\" value=\"" . $JobParent . "\">";
        include("log_in_authentication_form_vars.php");
        echo "<input type=\"submit\" value=\"Upload Image\" name=\"submit\">
        </form>";
}
function upload() {
        $JobID = $_POST['JobID'];
	$JobFkClientID = $_POST['ClientID'];
        echo "In the upload() function.<BR>";
        //**********************************************************************************************
        //***************************************************************** DEBUG VARIABLES HERE - START
        $turn_this_debug_on = 1;
        if ($turn_this_debug_on == 1) {
                include("debug_array.php");
        }
        //******************************************************************* DEBUG VARIABLES HERE - END
        //**********************************************************************************************
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        /**
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }
        */


        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        } 

         // Check file size 500000 = 500kb
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        } 
        /**
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" && $imageFileType != "JPG" && $imageFileType != "PNG" && $imageFileType != "JPEG"
        && $imageFileType != "GIF") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        } 
        */

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your fileo.";
            }
        }
}
?>
