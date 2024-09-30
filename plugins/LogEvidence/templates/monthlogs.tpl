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
						<div class="cal_days l">
							<b>{$month_logs[pom].nom}</b> 
							{if $smarty.session.AuthLevelID eq '31' or isset($smarty.session.UseDriverID)}
								<a target='_blank' href='{$root_home}distribution/{$month_logs[pom].date}'>{$DISTRIBUTION}</a>
							{/if}	
						</div>
						<div class="show-data">
							<small class="small">
								{* Second Section *}
								{section name=pom2 loop=$month_logs[pom].logs}

									<small><a target="_blank" href="https://wis.jamtransfer.com/satAsDriver/{$month_logs[pom].logs[pom2].AuthUserID}"
										title="<b>{$month_logs[pom].logs[pom2].User}</b>" 
										data-content="
											<br/>Time: {$month_logs[pom].logs[pom2].Time}-{$month_logs[pom].logs[pom2].TimeOff}
											<br>Location: {$month_logs[pom].logs[pom2].Place}
										" 
										class="mytooltip {$month_logs[pom].logs[pom2].CMScolor}">
											{$month_logs[pom].logs[pom2].User}
									</a></small> 
										<span class="{$month_logs[pom].logs[pom2].TimeColor}">{$month_logs[pom].logs[pom2].Time}</span>-
										<span class="{$month_logs[pom].logs[pom2].TimeOffColor}">{$month_logs[pom].logs[pom2].TimeOff}</span><br>					
										<hr>
								{/section} {* / Second Section *}
							</small>
						</div> {* / show-date *}
											
									{* <br> *}
						<small class="small-mini" style="display:none;">{NO_OF} <br>{$month_logs[pom].noOfLogs}</small>
						{if $smarty.request.level_id==1 or isset($smarty.session.UseDriverID)}
						<button type="button" class="monthlogs btn btn-primary btn-primary-edit" data-toggle="modal" data-target="#owh{$month_logs[pom].date}"
						data-date="{$month_logs[pom].date}">
							Working Hours 
						</button>
						<div class="modal fade"  id="owh{$month_logs[pom].date}">
							<div class="modal-dialog" style="width: fit-content;">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
										<h4 class="modal-title">Working Hours {$month_logs[pom].date}</h4>
									</div>
									<div class="modal-body modal-body-edit" style="padding:10px">
									
									{section name=pom3 loop=$office_users}
										<div class="row">
											<div class="col-md-3">
												{$office_users[pom3].name}
											</div>											
											<div class="col-md-2">
												{$office_users[pom3].level}
											</div>											
											<div class="col-md-2 col-md-2-timepicker">
												<input class="begin timepicker timepicker-edit form-control" type='text' name='begin' id='begin{$office_users[pom3].id}{$month_logs[pom].date}' value=''/>
											</div>											
											<div class="col-md-2 col-md-2-timepicker">
												<input class="end timepicker timepicker-edit form-control"  type='text' name='end' id='end{$office_users[pom3].id}{$month_logs[pom].date}' value=''/>
											</div>	
											<div>
												<input type='hidden' name='userid' class='userid' id='userid' value='{$office_users[pom3].id}'/>
												<input type='hidden' name='date' class='date' id='date' value='{$month_logs[pom].date}'/>
											</div>
											{if !isset($smarty.session.UseDriverID)}
											<div class="col-md-2">
												<select class="shift form-control" name="shift" id="shift">
													<option value="0"
														data-begin=""
														data-end=""
													>Shifts</option>
													{section name=pom4 loop=$office_shifts}
													<option 
														value="{$office_shifts[pom4].id}"
														data-begin="{$office_shifts[pom4].begin}"
														data-end="{$office_shifts[pom4].end}"
														data-date="{$month_logs[pom].date}"
														data-userid="{$office_users[pom3].id}"
													>{$office_shifts[pom4].name}</option>
													{/section}
												</select>
											</div>
											{/if}
											<div class="col-md-1">
												<i class="delete fa fa-trash" aria-hidden="true"
													data-date="{$month_logs[pom].date}"
													data-userid="{$office_users[pom3].id}"
												></i>
											</div>
										</div>	
									{/section}
									</div>
								</div>
							</div>
						</div>	
						{/if}		
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

	// timepicker:
	$('.timepicker').click(function(){
		$(this).clockTimePicker();
	});
	//$('.timepicker').clockTimePicker();

{/literal}
</script>


<script>
function resize(){

	if ($(window).width() < 760) {

		// $(".btn.btn-primary-edit").replaceWith("<button class='.btn-primary-edit'>WH</button>");
		$(".monthlogs.btn.btn-primary-edit").text("WH");
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
		$(".monthlogs.btn.btn-primary-edit").text("Working Hours");
	}

} // End of resize function


// Call the ready function:
$(document).ready(function(){
	resize();
	$(window).resize(resize);
});

$(".shift").change(function(){
	var begin=$(this).find('option:selected').attr('data-begin');
	var end=$(this).find('option:selected').attr('data-end');
	var date=$(this).find('option:selected').attr('data-date');
	var userid=$(this).find('option:selected').attr('data-userid');
	var idbegin="#begin"+userid+date;
	$(idbegin).val(begin);
	var idend="#end"+userid+date;
	$(idend).val(end);
	var param="begin="+begin+"&end="+end+"&date="+date+"&userid="+userid;
	saveShift(param)
})

$(".timepicker").change(function(){	
	var begin=$(this).parent().parent().parent().find('.begin').val();
	var end=$(this).parent().parent().parent().find('.end').val();
	var userid=$(this).parent().parent().parent().find('.userid').val();
	var date=$(this).parent().parent().parent().find('.date').val();
	var param="begin="+begin+"&end="+end+"&date="+date+"&userid="+userid;
	saveShift(param);
})

$( ".monthlogs" ).on('click', function(){
	var date=$(this).attr("data-date");
	var link = './plugins/LogEvidence/getShift.php';
	var url=link+'?date='+date;	
	console.log(url);
	$.ajax({
		type: 'GET',
		url: url,
	    async: false,
	    contentType: "application/json",
		success: function(data) {
			 $.each(JSON.parse(data), function(i, item) {
				id='#begin'+item.userid+date;
				$(id).val(item.begin);				
				id='#end'+item.userid+date;
				$(id).val(item.end);
			 });
		}
	});

})

$( ".delete" ).on('click', function(){
	id='#begin'+$(this).attr('data-userid')+$(this).attr('data-date');
	$(id).val("");	
	id='#end'+$(this).attr('data-userid')+$(this).attr('data-date');
	$(id).val("");	
	var param="begin=&end=&date="+$(this).attr('data-date')+"&userid="+$(this).attr('data-userid');
	saveShift(param);
})
function saveShift(param) {
	var link = './plugins/LogEvidence/saveShift.php';
	var url=link+'?'+param;
	console.log(link+'?'+param);
	$.ajax({
		type: 'GET',
		url: (url),
		data: param,
		success: function(data) {
			toastr['success'](window.success);	
		}				
	});

}

</script>