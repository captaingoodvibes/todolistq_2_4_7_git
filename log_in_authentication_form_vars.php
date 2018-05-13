<?PHP
$user_authenticated = $_POST['user_authenticated'];
$login_instance_token = $_POST['login_instance_token'];
echo "<input type=\"hidden\" name=\"name\" value=\"" . $_POST['name'] . "\" >";
echo "<input type=\"hidden\" name=\"pass\" value=\"" . $_POST['pass'] . "\" >";
echo "<input type=\"hidden\" name=\"user_authenticated\" value=\"$user_authenticated\">";
echo "<input type=\"hidden\" name=\"login_instance_token\" value=\"$login_instance_token\">";
//echo "<input type=\"hidden\" name=\"ClientID\" value=\"" . $_POST['ClientID'] . "\">";
?>
