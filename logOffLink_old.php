<!-- <div class="myBox2" align="centre"> -->

                
                <?PHP 
                //echo "<font class=\"generalFontOnWhite\">";
                echo "<form method=\"post\" action=\"./index.php\">";
                echo "<input type=\"hidden\" name=\"fieldName\" value=\"ClientName\">";
                /**echo "<span class=\"generalFontOnWhite\">Search ";
                echo "Search";
                echo "<select tabindex=\"3\" name=\"fieldName\" size=\"2\">";
                // echo "<OPTION value=\"\">";
                echo "<OPTION value=\"ClientID\">ID";
                echo "<OPTION value=\"ClientName\" SELECTED >Name";
                echo "<OPTION value=\"ClientContactName\">Contact";
                echo "<OPTION value=\"ClientName2\">Contact 2";
                echo "<OPTION value=\"ClientType\">Type";
                echo "<OPTION value=\"ClientDate\">Date";
                echo "<OPTION value=\"ClientPriority\">Priority";
                echo "<OPTION value=\"ClientAddress1\">Address 1";
                echo "<OPTION value=\"ClientAddress2\">Address 2";
                echo "<OPTION value=\"ClientCity\">City";
                echo "<OPTION value=\"ClientState\">State";
                echo "<OPTION value=\"ClientPostcode\">Postcode";
                echo "<OPTION value=\"ClientPhone1\">Phone 1";
                echo "<OPTION value=\"ClientPhone12\">Phone 2";
                echo "<OPTION value=\"ClientFax\">Fax";
                echo "<OPTION value=\"ClientEmail\">Email";
                echo "<OPTION value=\"ClientUrl\">Url";
                echo "<OPTION value=\"ClientCity\">City";
                echo "</SELECT>"; */
                // Client Name 
                
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
                echo "<input tabindex=\"2\"  type=\"submit\" name=\"Submit\" value=\"Go\">";
                ?>
                <!-- <img src="images/spacer.gif" width="185" height="0" alt="" FACE="Arial" SIZE="" COLOR="white"> -->
                <?PHP
                // echo $_SESSION['loginMsg'];
                echo "</form>"; 



