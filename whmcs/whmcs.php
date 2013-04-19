<?php 

	mysql_connect('localhost', '', '');
	mysql_select_db("");
   mysql_query("SET NAMES 'utf8'");
	
	$all =  array('msetupfee','qsetupfee','ssetupfee','asetupfee','bsetupfee','monthly','quarterly','semiannually','annually','biennially');
	
	$myid = 1;
	
	echo 'start <br />';
	// start 
   foreach ($all as $dbf) {
   	
	   $result1 = mysql_query("
			SELECT *
			FROM `tblpricing`
			WHERE (`".$dbf."` >10000) 
			AND ( `type` != 'domaintransfer' )
			AND ( `type` != 'domainregister' )
			AND ( `type` != 'domainrenew' )
			AND ( `type` != 'product' )
			ORDER BY `tblpricing`.`id` ASC
		");
		
	   
		while($row = mysql_fetch_assoc($result1)) {
		   if($row['id']) {
            
            $a = 1.25;
            
		   	$oldpricing1 = $row[$dbf] * $a;
		   	$oldpricing2 = ceil($oldpricing1);
	         $newpricing = ((int)($oldpricing2/10000))*10000 . '.00';
	         
				mysql_query("
				   UPDATE `nanopa_whmcs`.`tblpricing` 
				   SET `".$dbf."` = ".$newpricing." 
				   WHERE `tblpricing`.`id` = ".$row['id']."
				");
				
				echo $myid . ' - Set ' . $row[$dbf] . ' * ' . $a . ' to ' . $newpricing . '<br />';
				$myid = $myid +1;
			}
		}
   	
   	
   }	
   //end
   echo 'End';
?>