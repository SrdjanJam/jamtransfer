{if $noOfTransfers4 gt 0}
<div class="box light-green">
	<div class="inner">
		<h3 class="box-title">{UNASSIGNED_TRANSFERS}</h3><br>

		{section name=pom loop=$details4}
			<div class='row'>
				<div class="col-sm-2">
					<small>{$details4[pom].OrderID}-{$details4[pom].TNo}</small> 
				</div>	
				<div class="col-sm-2">			
					<strong>{$details4[pom].PickupDate} {$details4[pom].PickupTime}</strong>
				</div>			
				<div class="col-sm-6">			
					<strong>{$details4[pom].PickupName} - {$details4[pom].DropName}</strong>
				</div>	
				<div  class="col-sm-2">
					<a href='{$ROOT_WEB}/distribution/{$details4[pom].PickupDate}' class="btn btn-primary mac" >
						{$ASSIGN}
					</a>
				</div>	
			</div>
		{/section}	
		<br><small style="font-size:14px">No of transfers: {$noOfTransfers4}</small>
	</div>
<br>
{/if}	