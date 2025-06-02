<div class="row-fluid">
	<div class="">
		<div class="col-md-1" style="width:99% !important;">
			<div class="dp_content">
				<div align="center">
					<strong style="float: right;">{$ALL}</strong>
					<input id="all" onchange="calendar()" style="width: 50px; float: right;" type="range" max="1" min="0" step="1" value="0"/>

					<select name="cal_month" id="cal_month" class="cal_month_edit" onchange="calendar()">
						{html_options values=$month_val selected=$month_sel output=$month_out}
					</select>
					<select name="cal_year"  id="cal_year" class="cal_year_edit" onchange="calendar()">
						{html_options values=$year_val selected=$year_sel output=$year_out}
					</select>
				</div>
				<div id="cal" align="center">
					{* Glavni sadrzaj ukljucen ovde *}
						{* 
							<table></table>
							<div class="dashboard-legend"></div>
							<script></script>
						*}
				</div>
				<br/><br/>
			</div>
		</div>
	</div>
</div>



<script type="text/javascript">
{literal}
	calendar();
	function calendar() {
		$.get(
			'plugins/CalendarUB/calendar.php', 
			{cal_month: $('#cal_month').val(), cal_year: $('#cal_year').val(), all:$('#all').val()},
			function(data) {
				$('#cal').html(data);
			}
		);
		$('#xMonth').val($('#cal_month').val());
	}	
{/literal}	
</script>