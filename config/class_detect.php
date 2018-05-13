<?PHP

//***********************************************************************************************
//********************************************************************************* TITLE - START
/**
*	file:	class_detect.php
*	auth:	Dion Patelis (owner)
*	desc;	Class to detect which device and browser the user is using.
*	date:	30th July 2013 - Dion Patelis
*	last:	30th July 2013  - Dion Patelis
*/
//********************************************************************************** TITLE - END
//**********************************************************************************************

class detect { 
	
	var $current_device;
	var $mybox_width;
	var $job_board_col_1;
	var $job_board_User;
	var $job_board_Priority;
	var $job_board_Client;
	var $job_board_job_title;
	var $job_board_JID;
	var $cols_for_textarea;
	var $branch_spacer_total_from_class;
	var $branch_increment_from_class;
	var $job_title_length_divisor;
	//For jobBoard.php
	var $jd_col_2;
	var $jd_col_3;
	var $jd_col_5;
	var $jd_col_6;
	var $jd_cols_for_textarea;
	
	
	function my_current_device_is() {
		
		if(strstr($_SERVER['HTTP_USER_AGENT'],'iPhone') || strstr($_SERVER['HTTP_USER_AGENT'],'iPod'))
		{
			echo "<LINK rel=stylesheet href=\"css/smart_phone.css\" type=\"text/css\">";
			$this->current_device = "<FONT class=\"headerA\">iphone or ipad</FONT><BR>";
		} else {
			echo "<LINK rel=stylesheet href=\"css/main.css\" type=\"text/css\">";
			$this->current_device = "<FONT class=\"headerA\">You're using a normal browser.</FONT>";
		}
		
		
	}
	
	function my_box() {
		
		if(strstr($_SERVER['HTTP_USER_AGENT'],'iPhone') || strstr($_SERVER['HTTP_USER_AGENT'],'iPod'))
		{
			$this->mybox_width = "310";
			$this->job_board_col_1 = "45";
			$this->job_board_User = "45";
			$this->job_board_Priority = "45";
			$this->job_board_Client = "45";
			$this->job_board_job_title = "100";
			$this->job_board_JID = "45";
			$this->cols_for_textarea = "13";
			$this->branch_spacer_total_from_class = 1;
			$this->branch_increment_from_class = 1;
			$this->job_title_length_divisor = 13;  // This line sets the width of the textarea on the jobboard.
			$this->job_details_textarea_cols = 25;
			
			// For jobdetails.php
			$this->jd_col_2 = "10%";
			$this->jd_col_3 = "10%";
			$this->jd_col_5 = "10%";
			$this->jd_col_6 = "30%";
			$this->jd_cols_for_textarea = "18";
			
		} else {
			
			$this->mybox_width = "684";
			$this->job_board_col_1 = "75";
			$this->job_board_User = "75";
			$this->job_board_Priority = "75";
			$this->job_board_Client = "75";
			$this->job_board_job_title = "300";
			$this->job_board_JID = "75";
			$this->cols_for_textarea = "57";
			$this->branch_spacer_total_from_class = 3;
			$this->branch_increment_from_class = 5;
			$this->job_title_length_divisor = 63;
			$this->job_details_textarea_cols = 25; 
			// For jobdetails.php
			$this->jd_col_2 = "10%";
			$this->jd_col_3 = "10%";
			$this->jd_col_5 = "10%";
			$this->jd_col_6 = "30%";
			$this->jd_cols_for_textarea = "18";
			
		}
		
		
	}
}



?>
