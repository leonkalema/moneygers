<?php
include_once "../include/commonfunctions.php";
openDatabaseConnection();

$output = '';
$month = $_GET['month'];
$year = $_GET['year'];
$urlpart = $_GET['u'];
$type = $_GET['t'];
	
if($month == '' && $year == '') { 
	$time = time();
	$month = date('n',$time);
    $year = date('Y',$time);
}

$date = getdate(mktime(0,0,0,$month,1,$year));
$today = getdate();
$hours = $today['hours'];
$mins = $today['minutes'];
$secs = $today['seconds'];

if(strlen($hours)<2) $hours="0".$hours;
if(strlen($mins)<2) $mins="0".$mins;
if(strlen($secs)<2) $secs="0".$secs;

$days=date("t",mktime(0,0,0,$month,1,$year));
$start = $date['wday']+1;
$name = $date['month'];
$year2 = $date['year'];
$offset = $days + $start - 1;
 
if($month==12) { 
	$next=1; 
	$nexty=$year + 1; 
} else { 
	$next=$month + 1; 
	$nexty=$year; 
}

if($month==1) { 
	$prev=12; 
	$prevy=$year - 1; 
} else { 
	$prev=$month - 1; 
	$prevy=$year; 
}

if($offset <= 28) $weeks=28; 
elseif($offset > 35) $weeks = 42; 
else $weeks = 35; 

$output .= "
<table class='cal' cellspacing='1' width='100%'>
<tr>
	<td colspan='7'>
		<table class='calhead'>
		
		<tr>
			<td>
				<a href='javascript:navigate($prev,$prevy,\"".$urlpart."\",\"$type\")' class='calhead'>&lt;&lt;</a>  
			</td>
			<td align='center'><a href='javascript:navigate(\"\",\"\",\"".$urlpart."\",\"$type\")' class='calhead'>$name $year2</a>
			</td>
			<td align='right'><a href='javascript:navigate($next,$nexty,\"".$urlpart."\",\"$type\")' class='calhead'>&gt;&gt;</a> 
			</td>
		</tr>
		</table>
	</td>
</tr>
<tr class='dayhead'>
	<td>Sun</td>
	<td>Mon</td>
	<td>Tue</td>
	<td>Wed</td>
	<td>Thu</td>
	<td>Fri</td>
	<td>Sat</td>
</tr>";

$col=1;
$cur=1;
$next=0;

for($i=1;$i<=$weeks;$i++) { 
	if($next==3) $next=0;
	if($col==1) $output.="<tr class='dayrow'>"; 
  	
	$output.="<td valign='top' nowrap";
	if(($cur==$today[mday]) && ($name==$today[month])) {
		$output.=" onMouseOver=\"this.className='currdayover'\" onMouseOut=\"this.className='currdayout'\" style='background: #0099CC'>";
	} else {
		$output.=" onMouseOver=\"this.className='dayover'\" onMouseOut=\"this.className='dayout'\">";
	}

	if($i <= ($days+($start-1)) && $i >= $start) {
		$viewdate = $cur."-".$name."-".$year2;
		$output.="<div class='day'>";
		
		$output.="<b style='color: #000000;font-size: 13px;'>";
		
		if($type == "schedule"){
			if(howManyRows("SELECT * FROM guardschedule WHERE dateentered = '".date("Y-m-d",strtotime($viewdate))."'") > 0 && userHasRight($_SESSION['userid'], "144")){
				$output .= "<a href='../operations/schedule.php?d=".encryptValue($viewdate)."'>".$cur."</a>";
			} else {
				$output .= $cur;
			}
		} else if($type == "sitrep"){
			if(howManyRows("SELECT * FROM guardschedule WHERE dateentered = '".date("Y-m-d",strtotime($viewdate))."'") > 0 && userHasRight($_SESSION['userid'], "184")){
				$output .= "<a href='../operations/sitreps.php?d=".encryptValue($viewdate)."'>".$cur."</a>";
			} else {
				$output .= $cur;
			}
		} else {
			$output .= $cur;
		}
		
		
		$output.="</b></div></td>";
		$cur++; 
		$col++; 
		
	} else { 
		$output.="&nbsp;</td>"; 
		$col++; 
	}  
	    
    if($col==8) { 
	    $output.="</tr>"; 
	    $col=1; 
    }
}

$output.="</table>";
  
echo $output;

?>
