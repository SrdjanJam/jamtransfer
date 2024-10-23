{if $noOfTransfers3 gt 0}
<div class="box light-green">
	<div class="inner">
		<h3 class="box-title">{$TODAY}&{$TOMORROW}</h3><br>

		{section name=pom loop=$details3}
			<div class='row'>
				<div class="col-sm-2">
					<small>{$details3[pom].OrderID}-{$details3[pom].TNo}</small> 
				</div>	
				<div class="col-sm-2">			
					<strong>{$details3[pom].PickupDate} {$details3[pom].PickupTime}</strong>
				</div>			
				<div class="col-sm-6">			
					<strong>{$details3[pom].PickupName} - {$details3[pom].DropName}</strong>
				</div>	
				<div  class="col-sm-2">
					<a href='orders/detail/{$details3[pom].DetailsID}' class="btn btn-primary mac" >
						{$VIEW_TRANSFER}
					</a>
				</div>	
			</div>
		{/section}	
		<br><small style="font-size:14px">No of transfers: {$noOfTransfers3}</small>
	</div>
<br>
{/if}	