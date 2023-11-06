<style>


	.row.booking-row{
		margin-right: 0;
		margin-left: 0;
	}
</style>

    <!-- get transfer  widget -->
    <div class="box box-info">

        <div class="box-header">
			<div class="pull-right box-tools">

				<button class="btn btn-info btn-sm" data-name="calculate-provision"><i class="fa fa-plus"></i></button>
                
                <button class="btn btn-warning btn-sm" data-widget='remove' 
                data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                
            </div><!-- /. tools -->

            <i class="fa fa-money"></i>
            <h3 class="box-title">Calculate Provision</h3>
        </div>
        <div class="box-body calculate-provision">
			<h4>by formula y=25.5-0.0125x+0.00000242x2</h4>
			<h4>minimum provision 10%, minimum absolute provision 10Eur</h4>
		
			<div class="row booking-row">
				<div class="col-md-6">
					Basic price <input class="form-control" type="text" name="Price" size="5" id="Price" value="" placeholder="Price"> 
				</div>
				<div class="col-md-6">
					Calculated provision <input class="form-control" type="text" name="Provision" size="5" id="Provision" value="" disabled placeholder="Provision"> 
				</div>					
			</div>
        </div>
    </div>
	
	
<script>	
{literal}
	$('#Price').on('change', function() {
		var price = $(this).val();
		$.ajax({
			url:  './api/calculateProvision.php',
			type: 'GET',
			data: {
				price : price
			},

			success: function(data) {
				$('#Provision').val(data);
			}
		})	
		
	})	
{/literal}
</script>