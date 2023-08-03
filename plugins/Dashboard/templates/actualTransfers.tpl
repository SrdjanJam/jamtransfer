	<style>
		table {
			border: 1px solid black;
		}


		td, th {
			border: 1px solid black;
			text-align: center;
		}
	</style>
	
    <div class="box box-info">
        <div class="box-header">
            <i class="fa fa-road"></i>
            <h3 class="box-title">{$ACTUAL_TRANSFERS} {$timeStart} - {$timeEnd} ({$today})</h3>

			<div class="pull-right box-tools">

                <button class="btn btn-info btn-sm" data-name="actual-transfers"><i class="fa fa-plus"></i></button>
                
                <button class="btn btn-info btn-sm" data-widget='remove' 
                data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
								
            </div><!-- /. tools -->
			
		</div>	
	<div class="box-body actual-transfers" style="overflow-y: auto; max-height: 300px;">	
		{$data}
	</div>

<script>
{literal}
	$(".mytooltip").popover({trigger:'hover', html:true, placement:'bottom'});
{/literal}
</script>