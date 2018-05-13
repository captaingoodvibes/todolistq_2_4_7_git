<?PHP
$dir = "uploads/";

// Open a directory, and read its contents
if (is_dir($dir)){
  if ($dh = opendir($dir)){
    while (($file = readdir($dh)) !== false){
      //echo "filename:" . $file . "<br>";
      echo "<a href=\"uploads/$file\" target=\"blank\">$file</a><BR>";
    }
    closedir($dh);
  }
}
?>
