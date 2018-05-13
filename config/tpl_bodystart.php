<?php
        if ($bg) {
                $bgcolor = $bg;
        } else {
                $bgcolor = "#79a3db";
        }
        if ($lm) {
                $lmargin = $lm;
        } else {
                $lmargin = "20";
        }
        if ($mh) {
                $mheight = $mh;
        } else {
                $mheight = "0";
        }
        if ($mw) {
                $mwidth = $mw;
        } else {
                $mwidth = "0";
        }
        if ($tm) {
                $tmargin = $tm;
        } else {
                $tmargin = "10";
        }
        
        /*$debugMsg .= "page vars title=$title, bgcolor=$bgcolor, 
leftmargin=$lmargin, marginheight=$mheight, marginwidth=$mwidth, 
topmargin=$tmargin<br />\n";*/
        
        // start body, also includes debug code
?>
        <body bgcolor="<?php echo $bgcolor; ?>" leftmargin="<?php echo 
$lmargin; ?>" marginheight="<?php echo $mheight; ?>" marginwidth="<?php 
echo $mwidth; ?>" topmargin="<?php echo $tmargin; ?>">
               
 
