<?PHP
/*
echo "\$login_instance_token in topindex = $login_instance_token <br>";
echo "\$User_db_token in topindex  = $User_db_token <br>";
echo "\$User_db_token_POST in topindex  = " .  $_POST[$User_db_token] . "<br>"; */
$login_instance_token = $_POST['login_instance_token'];
if (empty($login_instance_token)) {
    $login_instance_token = 1;
    $_POST['login_instance_token'] = $login_instance_token;
}
$User_db_token = $_POST['User_db_token'];
//*************************************************************************************************
//******************************************************************** DEBUG VARIABLES HERE - START
$turn_this_debug_on = 1;
if ($turn_this_debug_on == 1) {
    // $debug = $_POST['debug'];
    $debugMsg .= "<font class=\"generalFontOnWhite\"><BR>********************************************************************<BR>";
    $debugMsg .= "Debug vars within topIndex002.php<BR>";
    $debugMsg .= "\$_POST['page_load'] = " . $_POST['page_load'] . "<BR>";
    $debugMsg .= "\$_POST['ClientID'] = " . $_POST['ClientID'] . "<BR>";
    $debugMsg .= "\$_POST['login_instance_token'] = " . $_POST['login_instance_token'] . "<BR>";
    $debugMsg .= "\$_POST['User_db_token'] = " . $_POST['User_db_token'] . "<BR>";
    $debugMsg .= "\$_POST['name'] = " . $_POST['name'] . "<BR>";
    $debugMsg .= "\$_POST['pass'] = " . $_POST['pass'] . "<BR>";
    $debugMsg .= "\$user_authenticated = $user_authenticated<BR>";
    $debugMsg .= "\$OptionCatch = $OptionCatch<BR><BR>";
    $debugMsg .= "\$_POST[\'OptionCatch\'] = " . $POST['OptionCatch'] . "<BR>";
    $debugMsg .= "********************************************************************<BR></font>";
    include("config/debug.php");
}
//********************************************************************** DEBUG VARIABLES HERE - END
//*************************************************************************************************
$line001DistanceFromTop = "8";
$line002DistanceFromTop = "4";
//$line002DistanceFromTop = "2";
$line003DistanceFromTop = "20";
$line004DistanceFromTop = "10";
$leftDistanceForHeaderLinks = "2";
$leftDistanceForHeaderLinks002 = "110";
$leftDistanceForHeaderLinks003 = "163";
$leftDistanceForHeaderLinks004 = "500";
$line001Class = "LinkB";
$line002Class = "LinkB";
$titles = "titles";


$StartTime = time();
$ClientID = $_GET['id'];
$JobID = $_GET['JobID'];
$JobCardNumber = $_GET['JobCardNumber'];
$name = $_GET['name'];
include("config/class_detect.php");
$box_vars = new detect;
$box_vars->my_box();
$mybox_width = $box_vars->mybox_width;
$mybox_width = 280;

?>




<div class="container">
    <div class="row">
        <div class="one.column column general_font_on_dark" style="border-radius: 4px; margin-top: 1%; background: url(images/back_test5_tiger.png);">
            <!-- <h2>Basic Page</h2>
            <p style="padding: 13px;">hwungaroo tml page is a placeholder with the
            CSS, font and favicon. It's just waiting for you to
            add some content! If you need some help hit u.</p> -->
            <a href="#"><img src="./images/201600510_web_logo001_quartz_alpha3.gif" width="30" height="30" style="padding: 5px;" alt=""></a>
            <!--
            //**********************************************************************************************
            //********************************************************************** LINE ONE - START
            -->			<FONT>
                <img src="images/spacer.gif" width="<?PHP echo "$leftDistanceForHeaderLinks"; ?>" height="35" alt="">
                <span class="<?PHP echo "$titles"; ?>" href="./dc001.php" style="position: absolute; top:<?PHP echo "$line001DistanceFromTop"; ?>px;" >
	<?PHP


    $dbs = new dbSession();
    $sql = "SELECT * from config WHERE ConfigID = 1 LIMIT 0, 30";

    $Results = $dbs->getResult($sql);

    while ($row = $dbs->getArray($Results)) {

        $ProgramTitle = $row[ConfigProgramTitle];
    }
    $ProgramTitle = $_POST['ProgramTitle'];

    // echo "$ProgramTitle";
    ?>
	</span>
            </FONT>

            <!--
            //********************************************************************** LINE ONE - END
            //**********************************************************************************************


            //**********************************************************************************************
            //********************************************************************** LINE TWO - START
            -->
            <?PHP /**
            //--------------------------------------------------------
            //-------------------------------------------- UN - START
            // Check if a user has logged in properly
            //--------------------------------------------
            if (isset($_POST['name'])){
            include("sessionIncForm002.php");
            }
            //-------------------------------------------- UN - END
            //--------------------------------------------------------
            if($_SESSION['peopleLoggedIn'] == 1)  {
            //echo "logged in here<br>";
            ?>

            <?PHP
            } */
            ?>
            <!--
            //********************************************************************** LINE THREE - END
            //**********************************************************************************************
            -->

        </div>

        <?PHP /**
        //--------------------------------------------------------
        //-------------------------------------------- UN - START
        // Check if a user has logged in properly
        //--------------------------------------------
        if (isset($_POST['name'])){
        include("sessionIncForm002.php");
        } */
        //-------------------------------------------- UN - END
        //--------------------------------------------------------
        if($User_db_token == $login_instance_token)  {
        //echo "logged in here<br>";

        ?>

        <div id="myslidemenu" class="jqueryslidemenu" >


            <ul>
                <li><font color="#0099FF"><img src="images/spacer.gif" width="50" height="0" alt="">.</font></li>
                <li><B><a href="#" class="type2" ><?PHP // echo "$ProgramTitle";?></a></B></li>
                <li><font color="#0099FF"><img src="images/spacer.gif" width="0" height="0" alt=""></font></li>
                <li><a href="#">Main</a>
                    <ul>
                        <li><a href="#">
                                <!-- <a href="./whiteBoard.php" FACE="Arial" SIZE="" COLOR="white">Job Board <?PHP echo "$login_instance_token"; ?>doo dah</a> -->
                                <!-- <a href="./whiteBoard.php" FACE="Arial" SIZE="" COLOR="white">  -->
                                <?PHP
                                echo "<form method=\"post\" action=\"./whiteBoard.php\">";
                                echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"whiteBoard\">";
                                include ("log_in_authentication_form_vars.php");
                                echo "<input class=\"top_buttons\"  type=\"submit\" name=\"action\" value=\"ToDo's\">";
                                echo "</form>";
                                ?>
                            </a>
                        </li>
                        <li><a href="#">
                                <!-- <a href="./history_01.php">History</a>
                                <a href="./history_01.php" FACE="Arial" SIZE="" COLOR="white"> -->
                                <?PHP
                                echo "<form method=\"post\" action=\"./index.php\">";
                                echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"history_list\">";
                                include ("log_in_authentication_form_vars.php");
                                echo "<input class=\"top_buttons\" type=\"submit\" name=\"action\" value=\"History\">";
                                echo "</form>";
                                ?>
                            </a>

                        </li>
                        <li><a href="#">
                                <!-- <a href="./history_01.php">History</a>
                                <a href="./user_add.php" FACE="Arial" SIZE="" COLOR="white"> -->
                                <?PHP
                                echo "<form method=\"post\" action=\"./index.php\">";
                                // echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"show_users\">";
                                echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"list_users\">";
                                include ("log_in_authentication_form_vars.php");
                                echo "<input class=\"top_buttons\" type=\"submit\" name=\"action\" value=\"List Users\">";
                                echo "</form>";
                                ?>
                            </a>
                        </li>
                    </ul>
                </li>
                <li><a href="#">Add</a>
                    <ul>
                        <li><a href="#">
                                <!-- <a href="./index.php" FACE="Arial" SIZE="" COLOR="white"> -->
                                <?PHP
                                //echo "$login_instance_token...$user_authenticated";
                                echo "<form method=\"post\" action=\"./index.php\">";
                                echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"AddClient\">";
                                include ("log_in_authentication_form_vars.php");
                                echo "<input class=\"top_buttons\" type=\"submit\" name=\"action\" value=\"Client\">";
                                echo "</form>";
                                ?>
                            </a>
                        </li>
                        <li><a href="#">
                                <!-- <a href="./addJob3.php?OptionCatch=AddJob&StartTime=<?PHP echo "$StartTime";?>&ClientName=<?PHP echo "$name";?>&ClientID=<?PHP echo "$ClientID";?>"></a>
                <a href="./addJob3.php" FACE="Arial" SIZE="" COLOR="white"> -->
                                <?PHP
                                echo "<form method=\"post\" action=\"./index.php\">";
                                echo "<input type=\"hidden\" name=\"ClientID\" value=\"" . $_POST['ClientID'] . "\">";
                                echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"add_job\">";
                                include ("log_in_authentication_form_vars.php");
                                echo "<input class=\"top_buttons\" type=\"submit\" name=\"action\" value=\"Job\">";
                                echo "</form>";
                                ?>
                            </a>
                        </li>
                        <li><a href="#">
                                <!-- <A href="./addReminder.php?JobID=<?PHP echo "$JobID";?>&JobCardNumber=<?PHP echo "$JobCardNumber";?>&StartTime=<?PHP echo "$StartTime";?>&ClientID=<?PHP echo "$ClientID";?>" FACE="Arial" SIZE="" COLOR="white">Reminder</a>
	        <a href="./addReminder.php" FACE="Arial" SIZE="" COLOR="white"> -->
                                <?PHP
                                // echo "\$_POST['JobID'] = " . $_POST['JobID'];
                                echo "<form method=\"post\" action=\"./index.php\">";
                                echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"add_reminder\">";
                                echo "<input type=\"hidden\" name=\"ClientID\" value=\"" . $_POST['ClientID'] . "\">";
                                echo "<input type=\"hidden\" name=\"JobID\" value=\"" . $_POST['JobID'] . "\">";
                                include ("log_in_authentication_form_vars.php");
                                echo "<input class=\"top_buttons\" type=\"submit\" name=\"action\" value=\"Reminder\">";
                                echo "</form>";
                                ?>
                            </a>
                        </li>
                        <li><a href="#">
                                <!-- <a href="./user_add.php" FACE="Arial" SIZE="" COLOR="white">  -->
                                <?PHP
                                echo "<form method=\"post\" action=\"./index.php\">";
                                echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"add_user\">";
                                include ("log_in_authentication_form_vars.php");
                                echo "<input class=\"top_buttons\" type=\"submit\" name=\"action\" value=\"User\">";
                                echo "</form>";
                                ?>
                            </a>
                        </li>
                    </ul>
                </li>
                <li><a href="#">DB</a>
                    <ul>
                        <li><a href="#">
                                <!-- <a href="./index.php" FACE="Arial" SIZE="" COLOR="white"> -->
                                <?PHP
                                //echo "$login_instance_token...$user_authenticated";
                                echo "<form method=\"post\" action=\"./index.php\">";
                                echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"backup_db\">";
                                include ("log_in_authentication_form_vars.php");
                                echo "<input class=\"top_buttons\" type=\"submit\" name=\"action\" value=\"Backup\">";
                                echo "</form>";
                                ?>
                            </a>
                        </li>
                        <li><a href="#">
                                <!-- <a href="./addJob3.php?OptionCatch=AddJob&StartTime=<?PHP echo "$StartTime";?>&ClientName=<?PHP echo "$name";?>&ClientID=<?PHP echo "$ClientID";?>"></a>
                <a href="./addJob3.php" FACE="Arial" SIZE="" COLOR="white"> -->
                                <?PHP
                                echo "<form method=\"post\" action=\"./index.php\">";
                                echo "<input type=\"hidden\" name=\"ClientID\" value=\"" . $_POST['ClientID'] . "\">";
                                echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"restore_db\">";
                                include ("log_in_authentication_form_vars.php");
                                echo "<input class=\"top_buttons\" type=\"submit\" name=\"action\" value=\"Restore\">";
                                echo "</form>";
                                ?>
                            </a>
                        </li>
                    </ul>
                </li>
                <li><font color="#0099FF"><img src="images/spacer.gif" width="5" height="0" alt="">.</font></li>
                <li><a href="#">
                        <!-- <a href="./config.php" FACE="Arial" SIZE="" COLOR="white">  -->
                        <?PHP
                        $conf_button = 0;

                        // Logged in menu here.
                        if ($conf_button == 1){
                            echo "<form method=\"post\" action=\"./config.php\">";
                            include ("log_in_authentication_form_vars.php");
                            echo "<input class=\"top_buttons\" type=\"submit\" name=\"action\" value=\"Config\">";
                            echo "</form>";
                        }
                        ?>
                    </a>
                </li>
                <br style="clear: left" />
                <?PHP
                }





                elseif ($User_db_token != $login_instance_token)





                {
                ?>
                <div id="myslidemenu" class="jqueryslidemenu" >
                    <ul>
                        <li><font color="#0099FF"><img src="images/spacer.gif" width="50" height="0" alt="">.</font></li>
                        <li><B><a href="#" class="type2" ><?PHP // echo "$ProgramTitle";?></a></B></li>
                        <li><font color="#0099FF"><img src="images/spacer.gif" width="0" height="0" alt=""></font></li>
                        <li><a href="#">Main</a>
                            <ul>
                                <li><a href="#">
                                        <?PHP
                                        echo "<form method=\"post\" action=\"./whiteBoard.php\">";
                                        echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"whiteBoard_public\">";
                                        include ("log_in_authentication_form_vars.php");
                                        echo "<input class=\"top_buttons\"  type=\"submit\" name=\"action\" value=\"ToDo's\">";
                                        echo "</form>";
                                        ?>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <br style="clear: left" />
                        <?PHP
                        }
                        ?>
                </div>
        </div>
    </div>
