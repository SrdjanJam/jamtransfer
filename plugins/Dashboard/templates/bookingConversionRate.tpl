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

		<input type="hidden" name="loc" id="loc" value="">

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
				<div class="col-md-4">Date & Time</div>
				<div class="col-md-4">
					<input class="form-control datepicker" type="text" name="Date" size="5" id="Date" value="" placeholder="From"> 
				</div>					
				<div class="col-md-4">
					<input class="form-control timepicker" type="text" name="Time" size="5" id="Time" value="" placeholder="To"> 
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

			<button type="button" class="btn btn-primary conversion-rate" data-toggle="modal" data-target="#conversionRate">
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
						$(".Location").click(function(){
							$("#Location").val($(this).attr('data-name'));
							$("#"+loc+"ID").val($(this).attr('id'));
							var fid=$(this).attr('id');
							$("#selectFrom_options"+loc).hide("slow");
					
							
						});						
					}						
				}
			})	
		}
	})	

	
	function listDrivers(RouteID,  PickupDate, PickupTime) {
		var url = 'api/getCarsAjax.php?RouteID='+RouteID+'&TransferDate='+PickupDate+'&TransferTime='+PickupTime+'&type=2'+'&callback=';
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
				$.each(data, function(i,val) {
					var surcharges ='';
					if (val.NightPrice>0) surcharges = '<br>Night: '+val.NightPrice;
					if (val.MonPrice>0) surcharges += '<br>Monday: '+ val.MonPrice;
					if (val.TuePrice>0) surcharges += '<br>Tueday: '+ val.TuePrice;
					if (val.WedPrice>0) surcharges += '<br>Wednesday: '+ val.WedPrice;
					if (val.ThuPrice>0) surcharges += '<br>Thusday: '+ val.ThuPrice;
					if (val.FriPrice>0) surcharges += '<br>Friday: '+ val.FriPrice;
					if (val.SatPrice>0) surcharges += '<br>Saterday: '+  val.SatPrice;
					if (val.SunPrice>0) surcharges += '<br>Sunday: '+ val.SunPrice;
					if (val.S1Price>0) surcharges += '<br>Season1: '+  val.S1Price;
					if (val.S2Price>0) surcharges += '<br>Season2: '+  val.S2Price;
					if (val.S3Price>0) surcharges += '<br>Season3: '+  val.S3Price;
					if (val.S4Price>0) surcharges += '<br>Season4: '+  val.S4Price;
					if (val.S5Price>0) surcharges += '<br>Season5: '+  val.S5Price;
					if (val.S6Price>0) surcharges += '<br>Season6: '+  val.S6Price;
					if (val.S7Price>0) surcharges += '<br>Season7: '+  val.S7Price;
					if (val.S8Price>0) surcharges += '<br>Season8: '+  val.S8Price;
					if (val.S9Price>0) surcharges += '<br>Season9: '+  val.S9Price;
					if (val.S10Price>0) surcharges += '<br>Season10: '+ val.S10Price;
					if (val.SpecialDatesPrice>0) surcharges += '<br>Special Date: '+ val.SpecialDatesPrice;
					if (val.StatusCompany!="") var select='red-123';					
					else var select='';
					list += '<div class="row selectable selectable-edit '+select+'">';
					list += '<div class="col-md-3">' + val.DriverCompany + val.StatusCompany + '</div>';
					list += '<div class="col-md-1">' + val.VehicleTypeID + '</div>';
					list += '<div class="col-md-1 right">' + val.DriversPrice + '</div>';	   /* Neto */					
					list += '<div title="Surcharges" data-content="' + surcharges + '" class="col-md-1 right mytooltip">' + val.AddToPrice + '</div>';		  /* Additions */
					list += '<div class="col-md-1 right">' + val.Provision + '</div>';		  /* Provision */
					list += '<div class="col-md-2 right">' + val.FinalPrice + '</div>';		 /* FinalPrice */
					list += '<div class="col-md-1 right">' + val.Provision2 + '</div>';		  /* Provision */
					list += '<div class="col-md-2 right">' + val.FinalPrice2 + '</div>';		 /* FinalPrice */
					list += '</div>';
				});
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