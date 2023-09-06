<?php   
		$password = file_get_contents('weby_key.inc', FILE_USE_INCLUDE_PATH);
		$link="https://city-airport-taxis.com/api/getAllBookingsConfirmedPast48?password=".$password;   
		$json = file_get_contents($link);   
		$obj = json_decode($json,true);
		foreach ($obj['data'] as $o) 
		{
			if ($o['reservation_reference']==$_REQUEST['code'])	{
				$n=0;
				print_arr($o,$n);
			}	
		}

		function print_arr($o,$n) {
			$n++;
			foreach ($o as $key=>$r) {
				if (gettype($r)=='array') {
					echo $key." : ";
					echo "<br>";				
					print_arr($r,$n);
				}
				else {
					for ($i = 1; $i<$n; $i++) {
						echo "&nbsp;&nbsp;";
					}	
					echo $key." : ";					
					echo $r;
				}	
				echo "<br>";	
				//$n=$n-1;
			}
		}
			
