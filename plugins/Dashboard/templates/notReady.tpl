	<style>
		table {
			border: 1px red;
		}
		td, th {
			border: 1px solid black;
			text-align: center;
		}	
	</style>
{if $noOfTransfersNR gt 0}	
    <div class="box box-info">
        <div class="box-header">
            <h4 class="box-title red">Jam group NOT READY today and tomorrow <span class="white"> ({$noOfTransfersNR})&nbsp; </span></h4>
			<div class="pull-right box-tools">
				<button class="btn btn-info btn-sm" data-name="not-ready" data-name2="test"><i class="fa fa-plus"></i></button>
				<button class="btn btn-warning btn-sm" data-widget='remove' 
				data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
			</div><!-- /. tools -->		
		</div>	
		<div class="box-body not-ready" style="font-size:90%; height:120px;  overflow: scroll;">	
			{$data_notready}
		</div>		
	</div>	
{/if}	
