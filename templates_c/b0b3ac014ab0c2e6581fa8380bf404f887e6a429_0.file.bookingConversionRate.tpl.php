<?php
/* Smarty version 3.1.32, created on 2023-09-11 09:12:20
  from 'C:\wamp\www\jamtransfer\plugins\Dashboard\templates\bookingConversionRate.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_64febdd4ce7be0_53292959',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b0b3ac014ab0c2e6581fa8380bf404f887e6a429' => 
    array (
      0 => 'C:\\wamp\\www\\jamtransfer\\plugins\\Dashboard\\templates\\bookingConversionRate.tpl',
      1 => 1692712367,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_64febdd4ce7be0_53292959 (Smarty_Internal_Template $_smarty_tpl) {
?><style>
	.clock-timepicker{
		width:100%;
	}

	.row.booking-row{
		margin-right: 0;
		margin-left: 0;
	}
</style>

    <!-- get transfer  widget -->
    <div class="box box-info">

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
			<div class="row booking-row">
				<div class="col-md-4">Location</div>
				<div class="col-md-8">
					<input class="form-control" type="text" name="Location" size="5" id="Location" value="" placeholder="Location"> 
					<input type="hidden" name="LocationID" id="LocationID" value="0"> 
					<div id="selectFrom_optionsLocation"  style="max-height:15em;overflow:auto"></div>
				</div>					
			</div>
			
			<div class="row booking-row">
				<div class="col-md-4">Date</div>
				<div class="col-md-4">
					<input class="form-control datepicker" type="text" name="Date1" size="5" id="Date1" value="" placeholder="From"> 
				</div>					
				<div class="col-md-4">
					<input class="form-control datepicker" type="text" name="Date2" size="5" id="Date2" value="" placeholder="To">  
				</div>					
			</div>	

			<!-- <div class="row">
				<div class="col-md-4">Period conversion rate </div>
				<div class="col-md-4">
					<select name="Period" id="Period" class="route-edit">
						<option value="0" disabled selected>Select your option</option>
						<option value="1">Date</option>
						<option value="2">Month</option>
						<option value="3">Year</option>
					</select>
				</div>	
			</div>	!-->

			<button type="button" id="button-rating" class="btn btn-primary conversion-rate" data-toggle="modal" data-target="#conversionRate">
				<i class="fa fa-search"></i>
			</button>			
        </div>
    </div>
	
	<div class="modal fade"  id="conversionRate">
		<div class="modal-dialog modal-dialog-edit" style="width:800px">
			<div class="modal-content">
				<div class="modal-header" style="padding:10px">
					<strong>
						<div class="col-md-4">Booking Step</div>
						<div class="col-md-4">Number</div>
						<div class="col-md-4">%</div>												
					</strong>
				</div>				
				<div class="modal-body" style="padding:10px">
					No data
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary col-md-12 modalbutton" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>		
	
<?php echo '<script'; ?>
>	


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
						$(".Location").click(function(){
							$('#LocationID').val($(this).attr('id'));
							$('#Location').val($(this).text());
							$("#selectFrom_options"+loc).hide("slow");
						})
			
					}						
				}
			})	
		}
	})	

	// option selected
	$( "#button-rating" ).on('click', function(){
		var LocationID=$("#LocationID").val();
		var Date1=$("#Date1").val();
		var Date2=$("#Date2").val();
		var Period=$("#Period").val();
		$(".modal-body").html(bookingRate(LocationID,  Date1, Date2, Period));
	});	
	function bookingRate(LocationID, Date1, Date2, Period) {
		var url = 'api/bookingRate.php?LocationID='+LocationID+'&Date1='+Date1+'&Date2='+Date2+'&Period='+Period+'&callback=';
		var list = '';
		console.log(url);
		$.ajax({
			type: 'POST',
			url: url,
			async: false,
			contentType: "application/json",
			dataType: 'jsonp',

			success: function(data) {
				$.each(data, function(i,val) {
					list += '<div class="row booking-row">';
					list += '<div class="col-md-4">' + val.Step + '</div>';
					list += '<div class="col-md-4">' + val.Number + '</div>';
					list += '<div class="col-md-4">' + val.Percent + '</div>';
					list += '</div>';
				})	
			},
			error: function(data) {
			}
		});
		return list;
	}


<?php echo '</script'; ?>
><?php }
}
