<?php
	
	function getTimeDiff($ref){
		$currdt = new DateTime("now");
		$refdt = new DateTime($ref." +1 day");
		
		$days = $currdt->diff($refdt)->format('%R%a');
 		$resMsg;
		if($days > 0)
			$resMsg = intval($days) . " day(s) remaining";
		else if($days == 0 && (strrpos($days,"+") !== false))
			$resMsg = "Last day";
		else
			$resMsg = "Overtime";
		return $resMsg;
	}
	
?>