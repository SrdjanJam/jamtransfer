<style>
/* Old: */
	/* .selectable-edit{
		margin-left:0 !important;
		margin-right:0 !important;
	}
	.blue-123{
		color: blue;
	}	
	.green-123{
		color: green;
	}	
	.red-123{
		color: red;
	}
	.route-edit{
		padding: 5px;
    	border-radius: 5px;
		box-shadow: 0px 0px 4px 1px #888888;
		width: 100%;
	} */

	.clock-timepicker{
		width:100%;
	}
</style>

    <!-- get transfer  widget -->
    <div class="box box-info">

		{* Spare: *}
		{* <input type="hidden" name="loc" id="loc" value=""> *}

        <div class="box-header">
			<div class="pull-right box-tools">

				<button class="btn btn-info btn-sm" data-name="booking-conversation"><i class="fa fa-plus"></i></button>
                
                <button class="btn btn-info btn-sm" data-widget='remove' 
                data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                
            </div><!-- /. tools -->

            <i class="fa fa-file"></i>
            <h3 class="box-title">Booking conversion rate</h3>
        </div>
        <div class="box-body booking-conversation">
			<div class="row">
				<div class="col-md-4">Location</div>
				<div class="col-md-8">
					<input class="form-control" type="text" name="Location" size="5" id="Location" value="" placeholder="Location"> 
					<div id="selectFrom_optionsLocation"  style="max-height:15em;overflow:auto"></div>
				</div>					
			</div>
			
			<div class="row">
				<div class="col-md-4">Date</div>
				<div class="col-md-4">
					<input class="form-control datepicker" type="text" name="Date" size="5" id="Date" value="" placeholder="From"> 
				</div>					
				<div class="col-md-4">
					<input class="form-control datepicker" type="text" name="Date2" size="5" id="Date2" value="" placeholder="To">  
				</div>					
			</div>	

			<div class="row">
				<div class="col-md-4">Period conversion rate </div>
				<div class="col-md-4">
					<select name="Route" id="Route" class="route-edit">
						<option value="" disabled selected>Select your option</option>
						<option value="1">Date</option>
						<option value="2">Month</option>
						<option value="3">Year</option>
					</select>
				</div>	
			</div>	

			<button type="button" id="button-find" class="btn btn-primary conversion-rate" data-toggle="modal" data-target="#conversionRate">
				<i class="fa fa-search"></i>
			</button>			
        </div>
    </div>
	
	<div class="modal fade"  id="conversionRate">
		<div class="modal-dialog" style="width:800px">
			<div class="modal-content">
				<div class="modal-header" style="padding:10px">
					<strong>
						<div class="col-md-1">Booking Step</div>
						<div class="col-md-3">Number</div>
						<div class="col-md-1 right">%</div>												
					</strong>
				</div>				
				<div class="modal-body" style="padding:10px">
					No routes
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary col-md-12 modalbutton" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>		
	
<script>	
{literal}

	$('#Location').on('click keyup', function(event) {
		var loc=$(this).attr('id').replace("Name", "");
		var html = '';
		query = $(this).val();			
		if (query.length > 2) {	
			$.ajax({
				url:  './api/getFromPlacesEdgeN.php',
				type: 'GET',
				dataType: 'jsonp',
				data: {
					qry : query
				},
				error: function() {
					//callback();
				},
				success: function(res) {
					if(res.length > 0) {
						$.each( res, function( index, item ){
							html +='<button class="Location" id="'+ item.ID +
								'" data-name="'+item.Place+'">'+
								item.Place +
								'</button><br>';
						});

						// data received
						$("#selectFrom_options"+loc).show("slow");
						$("#selectFrom_options"+loc).html(html);

						// option selected
						$( "#button-find" ).on('click', function(){
							var Location=$("#Location").val();
							var Date=$("#Date").val();
							var Date2=$("#Date2").val();
							var Route=$("#Route").val();
							if ( Date!=="" && Date2!=="") {
								$(".modal-body").html(bookingRate(Location,  Date, Date2, Route));
								$(".mytooltip").popover({trigger:'hover', html:true, placement:'bottom'});	
							}	
						});				
					}						
				}
			})	
		}
	})	

	
	function bookingRate(Location, Date, Date2, Route) {
		var url = 'api/bookingRate.php?Location='+Location+'&Date='+Date+'&Date2='+Date2+'&Route='+Route+'&callback=';
		var list = '';
		var funcArgs = '';
		console.log(url);
		$.ajax({
			type: 'POST',
			url: url,
			async: false,
			contentType: "application/json",
			dataType: 'jsonp',

			success: function(data) {
				var list = data;
			},
			error: function(data) {
				console.log('Error:');
				console.log(data);
			}
		});
		return list;
	}

{/literal}
</script>