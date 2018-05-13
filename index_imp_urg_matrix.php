<?PHP
echo "<LINK rel=\"stylesheet\" href=\"css/main.css\" type=\"text/css\">";
echo "  <style>
                .text_button {
                        border: none;
                        background-color: transparent;
                        padding: 0;
                        text-decoration: underline; 
                        } 
                table {
                    width: 100%;
                    height: 20px;
                }
        </style>
"; 

echo "<TABLE>
					<TR>
						<TD align=\"middle\" bgcolor =\"$color_imp_urg_A\"><div title=\"Important and Urgent\">";
						
		        // echo "		                <a href='whiteBoard.php?JobID=$JobID&Job_imp_urg_set=A&JobType=$JobType&JobToFkUserID= $CurrentlyLoggedInAs&jobNumber=$jobNumber' class=\"link_imp_urg\">A</a>";
		        echo "                          </div>";
						        echo "<form method=\"post\" action=\"./whiteBoard.php\">";
		                                        echo "<input type=\"hidden\" name=\"JobID\" value=\"" . $JobID . "\">";
		                                        echo "<input type=\"hidden\" name=\"Job_imp_urg_set\" value=\"A\">";
		                                        echo "<input type=\"hidden\" name=\"JobType\" value=\"" . $JobType . "\">";
		                                        echo "<input type=\"hidden\" name=\"JobToFkUserID\" value=\"" . $CurrentlyLoggedInAs . "\">";
		                                        echo "<input type=\"hidden\" name=\"jobNumber\" value=\"" . $jobNumber . "\">";
                                                        include("log_in_authentication_form_vars.php");
                                                        echo "<input class=\"text_button\" type=\"submit\" name=\"submit\" title=\"Important and Urgent\" value=\"A\" >";
                                                        echo "</form>";
			echo "                  </TD>
						<TD align=\"middle\" bgcolor =\"$color_imp_urg_B\"><div title=\"Important and Urgent\">";
			// echo "                          <a href='whiteBoard.php?JobID=$JobID&Job_imp_urg_set=B&JobType=$JobType&JobToFkUserID= $CurrentlyLoggedInAs&jobNumber=$jobNumber' class=\"link_imp_urg\">B</a>"; 
			echo "                          </div>";  
						        echo "<form method=\"post\" action=\"./whiteBoard.php\">";
		                                        echo "<input type=\"hidden\" name=\"JobID\" value=\"" . $JobID . "\">";
		                                        echo "<input type=\"hidden\" name=\"Job_imp_urg_set\" value=\"B\">";
		                                        echo "<input type=\"hidden\" name=\"JobType\" value=\"" . $JobType . "\">";
		                                        echo "<input type=\"hidden\" name=\"JobToFkUserID\" value=\"" . $CurrentlyLoggedInAs . "\">";
		                                        echo "<input type=\"hidden\" name=\"jobNumber\" value=\"" . $jobNumber . "\">";
                                                        include("log_in_authentication_form_vars.php");
                                                        echo "<input class=\"text_button\" type=\"submit\" name=\"submit\" title=\"Important but NOT Urgent\" value=\"B\">";
                                                        echo "</form>";
			echo "	                </TD>
					</TR>
					<TR>
						<TD align=\"middle\" bgcolor =\"$color_imp_urg_C\"><div title=\"NOT Important but Urgent\">";
						        echo "<form method=\"post\" action=\"./whiteBoard.php\">";
		                                        echo "<input type=\"hidden\" name=\"JobID\" value=\"" . $JobID . "\">";
		                                        echo "<input type=\"hidden\" name=\"Job_imp_urg_set\" value=\"C\">";
		                                        echo "<input type=\"hidden\" name=\"JobType\" value=\"" . $JobType . "\">";
		                                        echo "<input type=\"hidden\" name=\"JobToFkUserID\" value=\"" . $CurrentlyLoggedInAs . "\">";
		                                        echo "<input type=\"hidden\" name=\"jobNumber\" value=\"" . $jobNumber . "\">";
                                                        include("log_in_authentication_form_vars.php");
                                                        echo "<input class=\"text_button\" type=\"submit\" name=\"submit\" title=\"NOT Important but Urgent\" value=\"C\">";
                                                        echo "</form>";
			// echo "                          <a href='whiteBoard.php?JobID=$JobID&Job_imp_urg_set=C&JobType=$JobType&JobToFkUserID=$CurrentlyLoggedInAs&jobNumber=$jobNumber' class=\"link_imp_urg\">C</a>"; 
			echo "                          </div>";
			echo "	                </TD>
						<TD align=\"middle\" bgcolor =\"$color_imp_urg_D\"><div title=\"NOT Important and NOT Urgent\">";
						        echo "<form method=\"post\" action=\"./whiteBoard.php\">";
		                                        echo "<input type=\"hidden\" name=\"JobID\" value=\"" . $JobID . "\">";
		                                        echo "<input type=\"hidden\" name=\"Job_imp_urg_set\" value=\"D\">";
		                                        echo "<input type=\"hidden\" name=\"JobType\" value=\"" . $JobType . "\">";
		                                        echo "<input type=\"hidden\" name=\"JobToFkUserID\" value=\"" . $CurrentlyLoggedInAs . "\">";
		                                        echo "<input type=\"hidden\" name=\"jobNumber\" value=\"" . $jobNumber . "\">";
                                                        include("log_in_authentication_form_vars.php");
                                                        echo "<input class=\"text_button\" type=\"submit\" name=\"submit\" title=\"NOT Important and NOT Urgent\" value=\"D\">";
                                                        echo "</form>";
			// echo "                  <a href='whiteBoard.php?JobID=$JobID&Job_imp_urg_set=D&JobType=$JobType&JobToFkUserID= $CurrentlyLoggedInAs&jobNumber=$jobNumber' class=\"link_imp_urg\">D</a>"; 
			echo "                          </div>
						</TD>
					</TR>
				</TABLE>";








?>
