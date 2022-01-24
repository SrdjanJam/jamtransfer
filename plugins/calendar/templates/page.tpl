<div class="row-fluid">
<div class="container box box-info">
    <div class="box-header">
        <i class="fa fa-calendar"></i>
        <div class="box-title">Calendar</div>
    </div><!-- /.box-header -->
	<div class="col-md-1" style="width:99% !important;">


		<div class="dp_content">
			<div align="center">
				<form action="<?=$_SERVER['PHP_SELF'];?>" method="POST">
				<br>
			    <select name="cal_month" id="cal_month" onchange="calendar_month()">
					{html_options values=$month_val selected=$month_sel output=$month_out}
			    </select>
			    <select name="cal_year"  id="cal_year" onchange="calendar_year()">
					{html_options values=$year_val selected=$year_sel output=$year_out}
			    </select>
			    </form>
	        </div>


	        <div id="cal" align="center">
			</div>
			<br/><br/>

		</div>


	</div>
</div>
</div>
<br>

	        <script type="text/javascript">
			{literal}
	            $.get('plugins/calendar/calendar.php',
	                function(data) {
	                $('#cal').html(data);
	                });
				
				function calendar_year() {
					$.get('plugins/calendar/calendar.php', 
						{
					cal_year: this.value, cal_month: $('#cal_month').val()
						},
					function(data) {
					  $('#cal').html(data);
					});
					$('#xMonth').val(this.value);
				}				
				function calendar_month() {
					$.get('plugins/calendar/calendar.php', 
					{cal_month: this.value, cal_year: $('#cal_year').val()},
					function(data) {
					$('#cal').html(data);
					});
					$('#xMonth').val(this.value);
				}	
			{/literal}		
	        </script>