<?PHP 

function slip() {
        $dbs = new dbSession();
        echo "<H3 style=\"color: #CC3300;\">This version of the Task/Job List is under construction. </H3><FONT style=\"color: #CC3300;\">It is a modification <a class=\"linkPlainInWhiteAreas\" href=\"https://pornel.net/slip/\" target=\"blank\">slip.js</a> intended for mobile devices. It uses HTML5 and javascript to allow drag and drop reordering of task list items and also swipe features. --> To be completed soon. Stay tunned.</FONT><BR>";
        echo "<p id=\"JobID_before\"></p><BR><BR><p id=\"JobID_after\"></p><BR><BR><BR>";
        echo "<B><H3>Task / Job List</H3></B>";
        echo "<p id=\"demo\"></p><BR><p id=\"demo_x\"></p><BR><BR> Spacer<BR>";
	$dbs = new dbSession();
	if ($CurrentlyLoggedInAs == "") {
		$sqlAdjustment = "";
	}else{
		$sqlAdjustment = "AND JobToFkUserID = \"$CurrentlyLoggedInAs\"";
	}
	// echo "<BR> \$sqlAdjustment = $sqlAdjustment";
	$sql = "SELECT * from job WHERE JobStatus = \"Active\" AND JobType = \"WorkShop\" $sqlAdjustment ORDER BY JobPriority DESC";
	// echo "<BR> \$sql = $sql";
	
	$Results = $dbs->getResult($sql);
	
	$aColor = 1;
	$jobNumber = 0;	
	?>
	<!-- <body> --> 
        <ol id="slippylist">
        <?PHP 
        
	while ($row = $dbs->getArray($Results)) {
	        echo "<li class=\"demo-no-reorder\">"; 
	        echo "  <style>
                                table, th, td {
                                border: 1px solid black;
                                }
                        </style>";
	        echo "  <TABLE>
                        <TR>";
	        $JobParent = $row['JobParent'];
	        $JobChild = $row['JobChild'];
	        $JobBranch = $row['JobBranch'];
	        $JobTitle = $row['JobTitle'];
	        $_POST['JobTitle'] = $JobTitle;
	        $JobID = $row['JobID'];
	        
	        $JobFkClientID = $row['JobFkClientID'];
	        $_POST['JobID'] = $JobID;
	        $JobCardNumber = $row['JobCardNumber'];
	        $JobPriority = $row['JobPriority'];
	        $JobImpUrg = $row['JobImpUrg'];
	        $JobStatus = $row['JobStatus'];
	        $JobType = $row['JobType'];
	        $JobToFkUserID = $row['JobToFkUserID'];
	        $dbsClientName = new dbSession();
	        $sql = "SELECT ClientName from client WHERE ClientID = \"$JobFkClientID\" LIMIT 1";
	        $ResultsClient = $dbs->getResult($sql);
	        $rowClient = $dbs->getArray($ResultsClient);
	        $clientName = $rowClient['ClientName'];	
	        
	        $job_tree = $_POST['job_tree'];
	        $JobChild = 0;
                $dbs_find_children = new dbSession();
                $sql_find_children = "SELECT * from job WHERE JobStatus = \"Active\" AND JobType = \"WorkShop\" AND JobParent = \"$JobID\" ORDER BY JobPriority DESC";
                $Results_find_children = $dbs_find_children->getResult($sql_find_children);
                while ($row_find_children = $dbs_find_children->getArray($Results_find_children)) {
                        $JobChild = 1; 
                }
                // echo "<p id=\"JobID\">\$JobID = $JobID</p><BR>";
                if ($JobBranch == 0 && $JobStatus == "Active") {
		
		                               
                if ($JobChild == 1 ) {
                        
                        echo "<TD bgcolor=\"$setColor\" align=\"middle\" width=\"20%\">";
                        echo "<p id=\"JobID\">$JobID</p>";
                        echo "<form method=\"post\" class=\"form-inline\" action=\"./index.php\">";
                        echo "<input type=\"hidden\" name=\"JobID\" value=\"" . $JobID . "\">";
                        echo "<input type=\"hidden\" name=\"JobPriorityUp\" value=\"" . $JobPriority . "\">";
                        echo "<input type=\"hidden\" name=\"JobType\" value=\"" . $JobType . "\">";
                        echo "<input type=\"hidden\" name=\"JobToFkUserID\" value=\"" . $CurrentlyLoggedInAs . "\">";
                        echo "<input type=\"hidden\" name=\"jobNumber\" value=\"" . $jobNumber . "\">";
                        echo "<input type=\"hidden\" name=\"job_tree\" value=\"1\">";
                        echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"branch\">";
                        include("log_in_authentication_form_vars.php");
                        echo "<input class=\"inputA\" type=\"image\" src=\"images/plus.png\" width=\"10\" height=\"10\" title=\"Expand branch.\"  name=\"action\" value=\"CBM\">";
                        echo "</form>";
                        echo "</TD>
                              <TD>";
                        user_button($JobToFkUserID);  // In searchFunctions.php
                        include("index_imp_urg_matrix.php");
                        $job_tree = 0;
                        echo "</TD>";
                } else {
                        echo " <TD>
                                <p id=\"JobID\">$JobID</p>
                              </TD>";
                        echo "<TD bgcolor=\"$setColor\" align=\"middle\" width=\"20%\">$UserFirstname";
                        // echo "$UserFirstname";
                        user_button($JobToFkUserID);
                        include("index_imp_urg_matrix.php");
                        echo "</TD>";
                }

                } elseif ($JobBranch == 1 && $JobStatus == "Active") {
                        if ($JobChild == 1) {
                                echo "<TD bgcolor=\"$setColor\" align=\"middle\" width=\"20%\" >";
                                echo "<p id=\"JobID\">$JobID</p>";
                                echo "<form method=\"post\" class=\"form-inline\" action=\"./index.php\">";
                                echo "<input type=\"hidden\" name=\"JobID\" value=\"" . $JobID . "\">";
                                echo "<input type=\"hidden\" name=\"JobPriorityUp\" value=\"" . $JobPriority . "\">";
                                echo "<input type=\"hidden\" name=\"JobType\" value=\"" . $JobType . "\">";
                                echo "<input type=\"hidden\" name=\"JobToFkUserID\" value=\"" . $CurrentlyLoggedInAs . "\">";
                                echo "<input type=\"hidden\" name=\"jobNumber\" value=\"" . $jobNumber . "\">";
                                echo "<input type=\"hidden\" name=\"OptionCatch\" value=\"branch\">";
                                echo "<input type=\"hidden\" name=\"job_tree\" value=\"0\">";
                                include("log_in_authentication_form_vars.php");
                                echo "<input class=\"inputA\" type=\"image\" src=\"./images/minus.png\" width=\"10\" height=\"10\" title=\"Collapse this branch.\" name=\"action\" value=\"CBM\">";
                                echo "</form>";
                                echo "</TD>
                                      <TD>";
                                user_button($JobToFkUserID);
                                include("index_imp_urg_matrix.php");
                                $job_tree = 1;
                                echo "</TD>";
                        } else {
                                echo "<TD>
                                        <p id=\"JobID\">$JobID</p>
                                      </TD>";
                                echo "<TD bgcolor=\"$setColor\" align=\"middle\" width=\"20%\">$UserFirstname";
                                // echo "$UserFirstname";
                                user_button($JobToFkUserID);
                                include("index_imp_urg_matrix.php");
                                echo "</TD>";
                        }
                } else {
                        $job_tree = 0;
                }
                ?>
                                <TD>
                                        <?PHP client_button($JobFkClientID,$clientName); ?>
                                </TD>
                                        <?PHP
                                        echo "<TD bgcolor=\"$setColor2\"><font face=\"arial\" size=\"3\"><div style=\"white-space: pre-wrap;\">$JobTitle</div></font></TD>";
                                        ?>
                                
                                <TD>
                                        <?PHP job_button($JobID,$JobFkClientID,$JobCardNumber,$JobParent);  ?>
                                </TD>
                                <TD>
                                        <span class="instant">or instantly</span>
                                </TD>
                </TR>
                </TABLE> 
                </li>
                <?PHP 
        }
        ?>
        <li class="demo-no-swipe">hold &amp; reorder <span class="instant">or instantly</span></li>
                    <li>or either</li>
                    <li class="demo-no-swipe demo-no-reorder">or none of them.</li>
                    <li>Can play nicely with:</li>
                    <li>interaction <input type="range"></li>
                    <li style="transform: scaleX(0.97) skewX(-10deg); -webkit-transform: scaleX(0.97) skewX(-10deg)">inline CSS transforms</li>
                    <li class="skewed">stylesheet transforms</li>
                    <li class="demo-allow-select"><span class="demo-no-reorder">and selectable text, even though animating elements with selected text is a bit weird.</span></li>
                    <li>iOS Safari</li>
                    <li>Mobile Chrome</li>
                    <?PHP 
                    $down_right = '&#9495;';
                    $right_flat = '&#9473;';
                    echo "<li>" . $down_right . $right_flat . "thanks</li>";
                    ?>
                    <li>Android Firefox</li>
                    <li>Opera Presto and Blink</li>
                    <li>No dependencies</li>
                </ol>
                
                <script src="slip.js"></script>
                <script>
                    var ol = document.getElementById('slippylist');
                    ol.addEventListener('slip:beforereorder', function(e){
                        if (/demo-no-reorder/.test(e.target.className)) {
                            e.preventDefault();
                        }
                    }, false);

                    ol.addEventListener('slip:beforeswipe', function(e){
                        if (e.target.nodeName == 'INPUT' || /demo-no-swipe/.test(e.target.className)) {
                            e.preventDefault();
                        }
                    }, false);

                    ol.addEventListener('slip:beforewait', function(e){
                        if (e.target.className.indexOf('instant') > -1) e.preventDefault();
                    }, false);

                    ol.addEventListener('slip:afterswipe', function(e){
                        e.target.parentNode.appendChild(e.target);
                    }, false);

                    ol.addEventListener('slip:reorder', function(e){
                        e.target.parentNode.insertBefore(e.target, e.detail.insertBefore);
                        var item_i_am_dragging = e.target.innerHTML;
                        document.getElementById("demo").innerHTML = item_i_am_dragging;
                        return false;
                    }, false);
                    
                    ol.addEventListener('slip:reorder', function(e){
                        e.target.parentNode.insertBefore(e.target, e.detail.insertBefore);
                        var item_i_am_above = e.detail.insertBefore.innerHTML;  // working
                        document.getElementById("demo_x").innerHTML = item_i_am_above;
                        return false;
                    }, false);
                    
                    ol.addEventListener('slip:reorder', function(e){
                        e.target.parentNode.insertBefore(e.target, e.detail.insertBefore);
                        var x = e.detail.insertBefore.innerHTML;
                        var Job_info = x.detail.getElementById("JobID");
                        document.getElementById("JobID_after").innerHTML = Job_info;
                        return false;
                    }, false);
                    
                    ol.addEventListener('slip:reorder', function(e){
                        e.target.parentNode.insertBefore(e.target, e.detail.insertBefore);
                        myElement_before = document.getElementById("JobID");
                        document.getElementById("JobID_before").innerHTML = myElement_before.innerHTML;
                        return false;
                    }, false);

                    new Slip(ol);
                </script>
        <?PHP 
}

?>
