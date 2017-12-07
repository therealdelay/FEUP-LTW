<?php
	
	function getTimeDiff($ref){
		$currdt = new DateTime("now");
		$refdt = new DateTime($ref);
		
		$days = $currdt->diff($refdt)->format('%R%a');
		//echo $days;
 		$resMsg;
		if($days > 0)
			$resMsg = intval($days) . " day(s) remaining";
		else
			$resMsg = "FODEU.";
		return $resMsg;
	}
	
?>