<!-- <DIV align="center">
	<table id="Table_01" align="center" >
	<TR>
		<TD style="background:url(images/spacer.gif)" height="2"></TD>
	</TR>
	<TR>
		<TD> -->

<!-- -------------------------------------------------------------------- -->
<!-- Put this Mybox2 line back in if you want curvey corners. Screen redraw 
is slower though.
Hence why it has been removed. About 4seconds as opposed to 7 or 8 seconds 
when yo have many jobs on the job board. Cheers D-->
			<!--<div class="myBox2" align="centre"> -->
<!-- -------------------------------------------------------------------- -->

			<!-- <div class="myBox2" align="centre"> -->
			
			<!-- <div class="container" style="border-radius: 4px; border: 1px solid #bbb; padding: 8px;"> -->
			
			
			<?PHP
			// echo "\$user_authenticated = $user_authenticated<BR>";
			if ($user_authenticated  == 0){
			        // echo "<div class=\"container\">";
			        echo "<div class=\"container_with_border\">";
			}else{
			        echo "<div class=\"container_with_border\">";
			}
			
			?>
