<style>
	.selectable-edit{
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
	}
</style>

    <!-- get transfer  widget -->
    <div class="box box-info">
        <div class="box-header">

			<div class="pull-right box-tools">

				<button class="btn btn-info btn-sm" data-name="get-route-prices"><i class="fa fa-plus"></i></button>
                
                <button class="btn btn-warning btn-sm" data-widget='remove' 
                data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                
            </div><!-- /. tools -->

            <i class="fa fa-road"></i>
            <h3 class="box-title">Get route prices</h3>

        </div>
        <div class="box-body get-route-prices">
			<div class="row">
				<div class="col-md-3">Pickup location</div>
				<div class="col-md-9">
					<input class="form-control" type="text" name="PickupName" size="5" id="PickupName" value=""> 
					<div id="selectFrom_optionsPickup"  style="max-height:15em;overflow:auto"></div>
				</div>					
			</div>
			<div class="row">
				<div class="col-md-3">Route to</div>
				<div class="col-md-5">
					<select name="Route" id="Route" class="route-edit">
						<option value="-1"><?= NO_ROUTE ?></option>
					</select>
				</div>	
			</div>	
			<div class="row">
				<div class="col-md-3">Date & Time</div>
				<div class="col-md-5">
					<input class="form-control datepicker" type="text" name="Date" size="5" id="Date" value=""> 
				</div>					
				<div class="col-md-4">
					<input class="form-control timepicker" type="text" name="Time" size="5" id="Time" value=""> 
				</div>					
			</div>		
			<button type="button" id="button-find" class="btn btn-primary searchdrivers" data-toggle="modal" data-target="#routeDriversModal">
				<i class="fa fa-search"></i>
			</button>			
        </div>
    </div>
	
	<div class="modal fade"  id="routeDriversModal">
		<div class="modal-dialog" style="width:800px">
			<div class="modal-content">
				<div class="modal-header" style="padding:10px">
					<strong>
					<div class="col-md-3">Driver Company</div>
					<div class="col-md-1">Type</div>
					<div class="col-md-1 right">Neto</div>												
					<div class="col-md-1 right">Adds</div>
					<div class="col-md-1 right">Provision (%)</div>
					<div class="col-md-2 right">Final</div>
					<div class="col-md-1 right">Provision2 (%)</div>
					<div class="col-md-2 right">Final2</div>
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

	$('#PickupName').on('click keyup', function(event) {
		 if($(this).val() == "") {
			if($(this).attr('id') == "PickupName") $('#PickupID').val(0);
		}
		var clicked_id='#'+$(this).attr('id');

		var loc=$(this).attr('id').replace("Name", "");
		var html = '';
		query = $(clicked_id).val();			
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
					$("#Route").html('');
					if(res.length > 0) {
						$.each( res, function( index, item ){
							html +='<button class="PickupName" id="'+ item.ID +
								'" data-name="'+item.Place+'">'+
								item.Place +
								'</button><br>';
						});
						// data received
						$("#selectFrom_options"+loc).show("slow");
						$("#selectFrom_options"+loc).html(html);

						// option selected
						$(".PickupName").click(function(){
							$(clicked_id).val($(this).attr('data-name'));
							$("#"+loc+"ID").val($(this).attr('id'));
							var fid=$(this).attr('id');
							$("#selectFrom_options"+loc).hide("slow");
							$.ajax({
								url:  './api/getToPlacesEdge.php',
								type: 'GET',
								dataType: 'jsonp',
								data: {
									fid : fid
								},
								error: function() {
									//callback();
								},
								success: function(res) {
									$.each(res, function(index, element) {
										console.log(element.RouteName)
										$("#Route").append(
											'<option data-toid="'+element.ToID+'" value="'+element.ID+'">'+element.ToPlace+'</option>'
										)	
									});				
									console.log (res);
								}
							})		
							
						});						
					}						
				}
			})	
		}
	})	

	
	$( "#button-find" ).on('click', function(){
		var RouteID=$("#Route").val();
		var Date=$("#Date").val();
		var Time=$("#Time").val();
		if ( Date!=="" && Time!=="") {
			$(".modal-body").html(listDrivers(RouteID,  Date, Time));
			$(".mytooltip").popover({trigger:'hover', html:true, placement:'bottom'});	
		}	
	});	
	
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
					if (val.NightPrice!=0) surcharges = '<br>Night: '+val.NightPrice;
					if (val.MonPrice!=0) surcharges += '<br>Monday: '+ val.MonPrice;
					if (val.TuePrice!=0) surcharges += '<br>Tueday: '+ val.TuePrice;
					if (val.WedPrice!=0) surcharges += '<br>Wednesday: '+ val.WedPrice;
					if (val.ThuPrice!=0) surcharges += '<br>Thusday: '+ val.ThuPrice;
					if (val.FriPrice!=0) surcharges += '<br>Friday: '+ val.FriPrice;
					if (val.SatPrice!=0) surcharges += '<br>Saterday: '+  val.SatPrice;
					if (val.SunPrice!=0) surcharges += '<br>Sunday: '+ val.SunPrice;
					if (val.S1Price!=0) surcharges += '<br>Season1: '+  val.S1Price;
					if (val.S2Price!=0) surcharges += '<br>Season2: '+  val.S2Price;
					if (val.S3Price!=0) surcharges += '<br>Season3: '+  val.S3Price;
					if (val.S4Price!=0) surcharges += '<br>Season4: '+  val.S4Price;
					if (val.S5Price!=0) surcharges += '<br>Season5: '+  val.S5Price;
					if (val.S6Price!=0) surcharges += '<br>Season6: '+  val.S6Price;
					if (val.S7Price!=0) surcharges += '<br>Season7: '+  val.S7Price;
					if (val.S8Price!=0) surcharges += '<br>Season8: '+  val.S8Price;
					if (val.S9Price!=0) surcharges += '<br>Season9: '+  val.S9Price;
					if (val.S10Price!=0) surcharges += '<br>Season10: '+ val.S10Price;
					if (val.SpecialDatesPrice!=0) surcharges += '<br>Special Date: '+ val.SpecialDatesPrice;
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