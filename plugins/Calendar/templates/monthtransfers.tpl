{* Jquery *}
<script src="https://code.jquery.com/jquery-2.0.2.js"></script>

<script>
$(document).ready(function(){
	if ($(window).width() < 760) {
		// alert('Less than 960');
		$(".small").hide();
		$(".small-mini").show();
		
		
			$('.show-data').hide();
			$('.days').click(function(){
				
				var selector = '#' + $(this).attr('id')+' .show-data';
				
				var grid = '#' + $(this).parent().attr('id');
				var classes=($(grid).attr('class'));
				var x =classes.search("fullscreen");
				
				if(x == -1){
					$(grid).toggleClass('fullscreen');
					$(selector).show();
					$('.close-gi').show();
					$(".small").show();
					$(".small-mini").hide();
				}
			}); // </.days
			$('.close-gi').click(function(){
				var grid = '#' + $(this).parent().attr('id');
				$(grid).toggleClass('fullscreen');
				$('.show-data').hide();
				$('.close-gi').hide();
				$(".small").hide();
				$(".small-mini").show();
			});
			
			
		} // </if $(window).width() < 760
});
		
</script>
<style>
* {
  box-sizing: border-box;
}
body {
  font-family: Arial, Helvetica, sans-serif;
}
.grid-container {
  display: grid;
  grid-gap: 1px;
  grid-template-columns: auto auto auto auto auto auto auto;
  padding: 1px;
  margin: 10px auto;
  background-color: rgba(235, 235, 235, 0.8);;
}
.grid-item {
  background-color: rgba(235, 235, 235, 0.8);
  padding: 5px;
  font-size: 15px;
  text-align: center;
}
.grid-item-2 {
	background:white;
}
.show-data .small{
	font-size:16px;
}
/*///////////////////////////////////////////////////////////*/
/*MEDIA SECTION:*/
@media screen and (max-width:767px) {
	.wrapper{
		padding:0px;
	}
	.body{
		padding:0;
	}
	.fullscreen{
		z-index: 9999; 
		width: 100%; 
		height: 100%; 
		position: fixed; 
		top: 0; 
		left: 0; 
		background:#ffffff;
 	}
	a.close-gi{
		color:rgb(185, 65, 65);
		font-size:35px;
		border:1px solid red;
		padding:5px;
	}
	.grid-item-2{
		overflow-y: auto;
	}
	.days .small{
		color:black;
		font-size:30px;
	}
	.days b{
		font-size:30px;
	}
	.days .small-mini{
		font-size:17px;
	}
	
}
</style>
<div class="grid-container">
	<div class="grid-item" style="background:#FDB5B5">{$dayNames[0]}</div>
	<div class="grid-item" style="background:#f2f2f2">{$dayNames[1]}</div>
	<div class="grid-item" style="background:#f2f2f2">{$dayNames[2]}</div>  
	<div class="grid-item" style="background:#f2f2f2">{$dayNames[3]}</div>
	<div class="grid-item" style="background:#f2f2f2">{$dayNames[4]}</div>
	<div class="grid-item" style="background:#f2f2f2">{$dayNames[5]}</div>  
	<div class="grid-item" style="background:#ABF1A6">{$dayNames[6]}</div>
	<!-- grid-item-2: ================================================================================= -->
	{* First Section *}
	{section name=pom loop=$month_transfers}
		{if $month_transfers[pom].dayofweek eq '0'} 
			{* Old <tr> *}
		{/if}
		{if $month_transfers[pom].dayofweek eq '-1'} 
			{* Old <td></td> *} <div class="grid-item-2"></div>
			{else}
				{* Old *} {* <td class="td" style="background:rgb(206, 203, 23);border:1px solid black;" valign="top" class="cal_cell" {$style}> *}
				<div class="grid-item-2" id="grid{$month_transfers[pom].nom}">
					<div class="days" id="day{$month_transfers[pom].nom}">
						{* <div class="cal_days l"><b>{$month_transfers[pom].nom}</b></div> *}
							<div class="cal_days l"><b>{$month_transfers[pom].nom}</b></div>
									<div class="show-data">
										{* <div class="cal_days l"><b>{$month_transfers[pom].nom}</b></div> *}
										{* <br /> *}
										<small class="small">
											{* Second Section *}
											{section name=pom2 loop=$month_transfers[pom].transfers}
												{if $month_transfers[pom].transfers[pom2].TransferStatus eq '1'} <span class="text-blue"><i class="fa fa-circle-o"></i></span>
													{else if $month_transfers[pom].transfers[pom2].TransferStatus eq '2'} <span class="text-orange"><i class="fa fa-circle-o"></i></span>
													{else if $month_transfers[pom].transfers[pom2].TransferStatus eq '3'} <span style="color: #c00"><i class="fa fa-times-circle"></i></span>
													{else if $month_transfers[pom].transfers[pom2].TransferStatus eq '4'} <span class="text-orange"><i class="fa fa-question-circle"></i></span>
													{else if $month_transfers[pom].transfers[pom2].TransferStatus eq '5'} <span class="text-green"><i class="fa fa-check-circle"></i></span>
													{else} <span style="color: #c00"><i class="fa fa-question"></i></span> 
												{/if}
											
												{if $month_transfers[pom].transfers[pom2].DriverConfStatus eq '1'} <span style="color:#c00"><i class="fa fa-car"></i></span>
													{else if $month_transfers[pom].transfers[pom2].DriverConfStatus eq '2'} <span class="text-orange"><i class="fa fa-info-circle"></i></span>
													{else if $month_transfers[pom].transfers[pom2].DriverConfStatus eq '3'} <span class="text-blue"><i class="fa fa-car"></i></span>
													{else if $month_transfers[pom].transfers[pom2].DriverConfStatus eq '4'} <span style="color:#c00"><i class="fa fa-thumbs-down"></i></span>
													{else if $month_transfers[pom].transfers[pom2].DriverConfStatus eq '5'} <span style="color:#c00"><i class="fa fa-user-times"></i></span>
													{else if $month_transfers[pom].transfers[pom2].DriverConfStatus eq '6'} <span style="color:#c00"><i class="fa fa-black-tie"></i></span>
													{else if $month_transfers[pom].transfers[pom2].DriverConfStatus eq '7'} <span class="text-green"><i class="fa fa-check-square"></i></span>
													{else}
												{/if}
											
												{$month_transfers[pom].transfers[pom2].PickupTime}&rarr;
												<a href="orders/detail/{$month_transfers[pom].transfers[pom2].DetailsID}"
												title="<b>{$month_transfers[pom].transfers[pom2].OrderID}-{$month_transfers[pom].transfers[pom2].TNo} - {$month_transfers[pom].transfers[pom2].PaxName} </b>" 
												data-content="
													<br/>{$FLIGHT_NO}: {$month_transfers[pom].transfers[pom2].FlightNo}
													<br>{$FLIGHT_TIME}: {$month_transfers[pom].transfers[pom2].FlightTime}
													<br/>{$FROM}: {$month_transfers[pom].transfers[pom2].PickupName}
													<br/>{$TO}: {$month_transfers[pom].transfers[pom2].DropName}
													<br/>{$DRIVER}: {$month_transfers[pom].transfers[pom2].DriverName}
													<br/>{$TRANSFER_STATUS}: {$StatusDescription[{$month_transfers[pom].transfers[pom2].TransferStatus}]}
													<br/>{$DriverConfStatus[{$month_transfers[pom].transfers[pom2].DriverConfStatus}]}
												" 
												class="mytooltip">
													{$month_transfers[pom].transfers[pom2].OrderID}-{$month_transfers[pom].transfers[pom2].TNo}
												</a><br/>
												
											{/section} {* / Second Section *}
										</small>
										
									</div> {* / show-date *}
											
									{* <br> *}
							<small class="small">No of transfers: <br>{$month_transfers[pom].noOfTransfers}</small>
							<small class="small-mini" style="display:none;">No of: <br>{$month_transfers[pom].noOfTransfers}</small>
							
					
					</div> {* / days *}
					{* close *}
					<a class="close-gi" data-id ="{$month_transfers[pom].nom}" style="display:none;">Close</a>		
				</div> {* / .grid-item-2 *}  {* old - </td>*}
				
				
				
		{/if} {* / $month_transfers[pom].dayofweek eq '-1' *}
		
		
		{if $month_transfers[pom].dayofweek eq '6'} 
			{* Old *}{*</tr> *}
			{* </div> *}
		{/if}
		
	{/section} {* / First Section *}
	
{* </div> / .grid-container-2 *}
</div> {* / .grid-container *}


<div class="dashboard-legend">
	Transfer status:
	<ul>
		<i class="fa fa-circle-o text-blue"></i> Active |
		<i class="fa fa-circle-o text-orange"></i> Changed |
		<i class="fa fa-question-circle text-orange"></i> Temp |
		<i class="fa fa-times-circle" style="color:#c00"></i> Cancelled |
		<i class="fa fa-check-circle text-green"></i> Completed<br>
	</ul><br>
	Driver confirmation status:
	<ul>
		<i class="fa fa-car" style="color:#c00"></i> No driver |
		<i class="fa fa-info-circle text-orange"></i> Not Confirmed |
		<i class="fa fa-thumbs-up text-blue"></i> Confirmed |
		<i class="fa fa-car text-blue"></i> Ready |
		<i class="fa fa-thumbs-down" style="color:#c00"></i> Declined |
		<i class="fa fa-user-times" style="color:#c00"></i> No-show |
		<i class="fa fa-black-tie" style="color:#c00"></i> Driver error |
		<i class="fa fa-check-square text-green"></i> Completed
	</ul>
</div> {* /.dashboard-legend*}


<script>
{literal}
	$(".mytooltip").popover({trigger:'hover', html:true, placement:'bottom'});
{/literal}	
</script>
