<script>

function resize(){

	if ($(window).width() < 760) {

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
	else{
		$('.show-data').show();
		$(".small").show();
		$(".small-mini").hide();
		$('.close-gi').hide();
		$('.grid-item-2').removeClass('fullscreen');
	}

} // End of resize function


// Call the ready function:
$(document).ready(function(){
	resize();
	$(window).resize(resize);
});

		
</script>


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
	{section name=pom loop=$month_logs}
		{if $month_logs[pom].dayofweek eq '0'} 
			{* Old <tr> *}
		{/if}
		{if $month_logs[pom].dayofweek eq '-1'} 
			{* Old <td></td> *} <div class="grid-item-2"></div>
			{else}
				{* Old *} {* <td class="td" style="background:rgb(206, 203, 23);border:1px solid black;" valign="top" class="cal_cell" {$style}> *}
				<div class="grid-item-2" id="grid{$month_logs[pom].nom}">
					<div class="days" id="day{$month_logs[pom].nom}">
						{* <div class="cal_days l"><b>{$month_logs[pom].nom}</b></div> *}
							<div class="cal_days l">
								<b>{$month_logs[pom].nom}</b> 
								{if $smarty.session.AuthLevelID eq '31' or isset($smarty.session.UseDriverID)}
									<a target='_blank' href='{$root_home}distribution/{$month_logs[pom].date}'>{$DISTRIBUTION}</a>
								{/if}	
							</div>
									<div class="show-data">
										{* <div class="cal_days l"><b>{$month_logs[pom].nom}</b></div> *}
										{* <br /> *}
										<small class="small">
											{* Second Section *}
											{section name=pom2 loop=$month_logs[pom].logs}

												<small><a href=""
													title="<b>{$month_logs[pom].logs[pom2].User}</b>" 
													data-content="
														<br/>Time: {$month_logs[pom].logs[pom2].Time}{$month_logs[pom].logs[pom2].TimeOff}
														<br>Location: {$month_logs[pom].logs[pom2].Place}
													" 
													class="mytooltip">
														{$month_logs[pom].logs[pom2].User}
												</a></small> {$month_logs[pom].logs[pom2].Time}{$month_logs[pom].logs[pom2].TimeOff}<br>					
												
											{/section} {* / Second Section *}
										</small>
										
									</div> {* / show-date *}
											
									{* <br> *}
							<small class="small-mini" style="display:none;">{NO_OF} <br>{$month_logs[pom].noOfLogs}</small>
							
					
					</div> {* / days *}
					{* close *}
					<a class="close-gi" data-id ="{$month_logs[pom].nom}" style="display:none;">{$CLOSE}</a>		
				</div> {* / .grid-item-2 *}  {* old - </td>*}
				
				
				
		{/if} {* / $month_logs[pom].dayofweek eq '-1' *}
		
		
		{if $month_logs[pom].dayofweek eq '6'} 
			{* Old *}{*</tr> *}
			{* </div> *}
		{/if}
		
	{/section} {* / First Section *}
	
{* </div> / .grid-container-2 *}
</div> {* / .grid-container *}





<script>
{literal}
	$(".mytooltip").popover({trigger:'hover', html:true, placement:'bottom'});
{/literal}	
</script>
