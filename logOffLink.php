<?PHP
/**
 *	desc;	The search button at the top of most pages.
 *  note:
 *  by:     7rocks.com
 *  file:	logOffLink.php
 *	auth:	Dion Patelis (owner)
 *	date:	26 Feb 2012 - Dion Patelis
 *	last:	26 Feb 2012 - Dion Patelis
 */

echo "<form method=\"post\" action=\"./index.php\">";
echo "<input type=\"hidden\" name=\"fieldName\" value=\"ClientName\">";

//echo "  (ie : 'trac' in the word 'Contractors')";
$SearchClientName = "";
// echo "<input tabindex=\"1\" type=\"text\" class\"narrow\" style=\"height: 23px; width: 94px; line-height: none;\" placeholder=\"Search contact\" name=\"SearchClientName\" value=\"\">";
echo "<input tabindex=\"1\" type=\"text\" placeholder=\"Search contact\" name=\"SearchClientName\" value=\"\">";

$login_name = $_POST['name'];
$login_pass = $_POST['pass'];
$login_UserID = $row['UserID'];

echo "<input type=\"hidden\" name=\"AddMessageTermination\" value=\"1\">";
echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"SearchClient\">";
echo "<input type=\"hidden\" name=\"user_authenticated\" value=\"$user_authenticated\">";
echo "<input type=\"hidden\" name=\"login_instance_token\" value=\"$login_instance_token\">";
echo "<input type=\"hidden\" name=\"name\" value=\"$login_name\">";
echo "<input type=\"hidden\" name=\"pass\" value=\"$login_pass\">";
echo "<input type=\"hidden\" name=\"login_UserID\" value=\"$login_UserID\">";
echo "<input tabindex=\"2\"  type=\"submit\" class=\"top_buttons\" style=\"padding: 0px 10px;\" name=\"Submit\" value=\"Go\">";
?>
<?PHP
echo "</form>";



