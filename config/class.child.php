<?PHP

	class child {  
	
		var $jchild;
		var $child_msg;
		var $JobParent_up;
		var $JobChild;
		var $got_babies;
		var $jobStatus;
		var $action_status;
		var $JobParent;
		
		function job_complete($JobID) {
			//**********************************************************************************************
			//********************************************************************** DEBUG VARIABLES HERE - START
				$debug = $_POST['debug'];
				$debugMsg .= "In the class job_complete the \$JobID = $JobID<BR>";
				include("config/debug.php");
			//********************************************************************** DEBUG VARIABLES HERE - END
			//**********************************************************************************************
			$dbs_comp = new dbSession();
			$sql_comp = "UPDATE job SET JobStatus='Job Complete' WHERE JobID = '$JobID'";
			if ($dbs_comp->getResult($sql_comp)) {
					// $this->jobStatus = "Card Edited in class to say job -$JobID- is complete.";
					$this->jobStatus = "Job $JobID complete.<BR>";
					//**********************************************************************************************
					//********************************************************************** DEBUG VARIABLES HERE - START
						$turn_this_debug_on = 0;
                                                if ($turn_this_debug_on == 1) {
						        $debugMsg .= "Card Edited in class to say -$JobID- is complete.";
						include("config/debug.php");
						}
					//********************************************************************** DEBUG VARIABLES HERE - END
					//**********************************************************************************************
				} else {
					$this->jobStatus = $dbs_comp->printError();
					echo "<BR>Didn\'t work";
				}
		
		}
		function make_action_saying_the_job_is_complete($JobID, $ClientID, $UserID, $JobTitle, $StartTime) {
			//**********************************************************************************************
			//********************************************************************** DEBUG VARIABLES HERE - START
				$turn_this_debug_on = 0;
                                                if ($turn_this_debug_on == 1) {
				$debugMsg .= "In the class child-->make_action_saying_the_job_is_complete the \$JobID = $JobID<BR>";
				include("config/debug.php");
				}
			//********************************************************************** DEBUG VARIABLES HERE - END
			//**********************************************************************************************
			$dbs_comp = new dbSession();
			$ActionText = "Job finished (ticked from Job Board) - $JobTitle";
			// $sql_comp = "INSERT INTO action SET JobStatus='Job Complete' WHERE JobID = '$JobID'";
			$sql_comp = "INSERT INTO action (ActionFkJobID, ActionFkClientID, ActionFromFkUserID, ActionText, ActionDateSecs) VALUES ('$JobID', '$ClientID', '$UserID', '$ActionText', '$StartTime')";
			if ($dbs_comp->getResult($sql_comp)) {
					// $this->action_status = "Action added in class child-->make_action_saying_the_job_is_complete to say job -$JobID- had an action added.";
					$this->action_status = "Action added to say job $JobID complete.";
					//**********************************************************************************************
					//********************************************************************** DEBUG VARIABLES HERE - START
						$turn_this_debug_on = 0;
                                                if ($turn_this_debug_on == 1) {
						        $debugMsg .= "Action added in class child-->make_action_saying_the_job_is_complete to say -$JobID- is had an action added.";
						        include("config/debug.php");
						}
					//********************************************************************** DEBUG VARIABLES HERE - END
					//**********************************************************************************************
				} else {
					$this->action_status = $dbs_comp->printError();
					echo "<BR>Didn\'t work";
				}
		
		}
		function find_parent($JobID) {  
			// echo "\$JobID == $JobID in class<BR>";
			$dbs_up = new dbSession();
			$sql_up = "SELECT * from job WHERE JobID = $JobID"; 
			echo $sql_up . "<BR>"; 
			$Results_up = $dbs_up->getResult($sql_up);
			while ($row = $dbs_up->getArray($Results_up)) {
					$this->JobParent_up = $row['JobParent'];
			}
		}
		
		function check_if_job_has_babies($JobParent) {
			$dbs_babe = new dbSession();
			$sql_babe = "SELECT JobParent from job WHERE JobParent = $JobParent"; 
			$Results_babe = $dbs_babe->getResult($sql_babe);
			while ($row = $dbs_babe->getArray($Results_babe)) {
					//$this->got_babies = $row['JobChild'];
					if (empty($number_of_children)) {
						$number_of_children = 1;
					}
					$JobParent = $row['JobParent'];
					// $this->got_babies = $JobParent;
					$this->got_babies = $number_of_children;
					// echo "<BR>In clss JobParent = " . $row['JobParent'];
					$number_of_children = $number_of_children + 1;
			}
			// echo "Job $JobParent has $number_of_children sub jobs attached to it.<BR>";
			
		}
		
		function advise_parent_babies_died($JobParent) {
			// echo "In class the $JobParent";
			$dbsa = new dbSession();
			$sqla = "UPDATE job SET JobChild = 0 WHERE JobID = '$JobParent'";
			if ($dbsa->getResult($sqla)) {
					$this->got_babies = "Card Edited in class to advise the parent that children exist.<BR>";
				} else {
					$this->got_babies = $dbs->printError();
					echo "<BR>$msg";
					echo "<BR>Didn\'t work";
				}
		
		}
		
		
		function advise_parent_of_children($JobParent) {
			$dbsa = new dbSession();
			$sqla = "UPDATE job SET JobChild = 1 WHERE JobID = '$JobParent'";
			if ($dbsa->getResult($sqla)) {
					$this->jchild = "Card Edited in class to advise the parent that children exist.<BR>";
				} else {
					$this->jchild = $dbs->printError();
					echo "<BR>$msg";
					echo "<BR>Didn\'t work";
				}
			
		
		}
		 
		 
		 function add_delete_parent($JobParent, $JobID, $JobParent_up) {  
			
			$dbs = new dbSession();
			// echo "\$JobParent == $JobParent<BR>";
			// echo "\$JobParent_up == $JobParent_up<BR>";
			$this->child_msg = "The child message";
			
			if ($JobParent == 0 || $JobParent == "") {
				$JobChild = 0;
				$JobParent = $JobParent_up;
			
			} else {
				$JobChild = 1;
			
			}
			// echo "\$JobChild  == $JobChild .<BR>";
			$sql = "UPDATE job SET JobChild = '$JobChild' WHERE JobID = '$JobParent'";  
			// echo $sql . "<BR>";
			if ($dbs->getResult($sql)) {
					$this->jchild = "Card Edited in class.";
					// echo "In CLass";
					echo "<BR><FONT FACE=\"arial\" SIZE=\"4\" COLOR=\"#339900\">$msg</FONT>";
					if (empty($AddMessageTermination)) {
						echo "<LINK rel=stylesheet href=\"css/main.css\" type=\"text/css\">";
						// echo "<A href=\"index.php\">   Home</A>";
						Main();
						LocEndCallAddAction();
						ShowActions();
						//exit;
					}
					
				} else {
					$this->jchild = $dbs->printError();
					echo "<BR>$msg";
					echo "<BR>Didn\'t work";
				}
		
		
		
		
		
		}  


		function ShowFutureDate($iAddDays=0){  
			$this->sTime = gmdate("d-m-Y H:i:s", strtotime("+" . $iAddDays . " days"));    
		}  
	
	} 
	// 1079 1098

?>
