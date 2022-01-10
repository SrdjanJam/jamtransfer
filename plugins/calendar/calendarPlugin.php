<?
	@session_start();
	if (!$_SESSION['UserAuthorized']) die('Bye, bye');
?>

<div class="row-fluid">
<div class="container box box-info">
    <div class="box-header">
        <i class="fa fa-calendar"></i>
        <div class="box-title">Calendar</div>
    </div><!-- /.box-header -->
	<div class="col-md-1" style="width:99% !important;">


		<div class="dp_content">
	        <?
			# Init Values - this month, this year
			//$cMonth = date("m"); $cYear=date("Y");

			if (!isset($_REQUEST["cal_month"]))
			{
				if (!isset($_SESSION["cal_month"])) $cMonth = date("m");
				else {
					$cMonth = $_SESSION["cal_month"];
				}
			}
			else
			{
				$_SESSION['cal_month'] = $_REQUEST["cal_month"];
				$cMonth = $_REQUEST["cal_month"];
			}

			if (!isset($_REQUEST["cal_year"]))
			{
				if (!isset($_SESSION["cal_year"])) $cYear = date("Y");
				else {
					$cYear = $_SESSION["cal_year"];
				}

			}
			else
			{
				$_SESSION['cal_year'] = $_REQUEST["cal_year"];
				$cYear = $_REQUEST["cal_year"];
			}


			?>
			<div align="center">
				<form action="<?=$_SERVER['PHP_SELF'];?>" method="POST">
				<br>
			    <select name="cal_month" id="cal_month"
			        onchange="//$('#cal').html('<img src=\'../i/loading.gif\'/>');
			                    $.get('cms/p/modules/calendar.php', 
			                    {cal_month: this.value, cal_year: $('#cal_year').val()},
			                    function(data) {
			                    $('#cal').html(data);
			                    });
			                    $('#xMonth').val(this.value);
			                    ">
			        <?
			        for ($i=1; $i<13; $i++)
			        {
			            $selected = '';
			            if ($i == $cMonth) $selected = ' selected="selected" ';
			            echo '<option value="' . ($i) . '"' . $selected . '>'  . $monthNames[$i-1] .
			                 '</option>';
			        }
			        ?>
			    </select>

			    <select name="cal_year"  id="cal_year"
			        onchange="//$('#cal').html('<img src=\'../i/loading.gif\'/>');
			                $.get('cms/p/modules/calendar.php', 
			                {cal_year: this.value, cal_month: $('#cal_month').val()},
			                function(data) {
			                  $('#cal').html(data);
			                });
			                $('#xMonth').val(this.value);
			                ">

			        <?
			        for ($i=date("Y")-2; $i<date("Y")+5; $i++)
			        {
			            $selected = '';
			            if ($i == $cYear) $selected = ' selected="selected" ';
			            echo '<option value="' . $i . '"' . $selected . '>' . $i . '</option>';
			        }
			        ?>

			    </select>

			    </form>
	        </div>
	        <script type="text/javascript">
	            //$('#cal').html('<img src=\'../i/loading.gif\'/>');
	            $.get('plugins/calendar/calendar.php',
	                function(data) {
	                $('#cal').html(data);
	                });
	        </script>

	        <div id="cal" align="center"></div>
			<br/><br/>

		</div>


	</div>
</div>
</div>
<br>
