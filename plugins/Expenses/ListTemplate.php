<?
$smarty->assign('selectapproved',true);
$smarty->assign('date1',true);
$smarty->assign('date2',true);


?>
<style>
.rotate {
  -moz-transform: rotate(90deg);
  -webkit-transform: rotate(90deg);
  -o-transform: rotate(90deg);
  -ms-transform: rotate(90deg);
  transform: rotate(90deg);
}


/* ------------------------------------------------------------- */
/* Envelop: */
.fa-envelope-edit{
	font-size: 25px !important;
	color: #47afe9;
	
}

.envelop-note{
	padding: 5px;
	background: #b3ccff;
	box-shadow: 2px 1px 6px 2px #888888;
}
/* ------------------------------------------------------------- */

 </style>
  
<script type="text/x-handlebars-template" id="ItemListTemplate">

<div class="nav-tabs-custom nav-tabs-custom-edit">
	<ul class="nav nav-tabs dorder">
					<li class="active"><a href="#tab_1" data-toggle="tab">List</a></li>
					<li><a href="#tab_2" data-toggle="tab">Reporter</a></li>
	</ul>
	<div class="tab-content tab-content-edit">	
		<div class="tab-pane active" id="tab_1">

			<div class="row row-edit">

				<div class="col-md-1">
					<?=ID;?>
				</div>

				<div class="col-md-1">
					<?=DATUM;?>
				</div>

				<div class="col-md-2">
					<?=AUTH_USER_REAL_NAME;?>
				</div>

				<div class="col-md-2">
					<?=EXPANCE_AMOUNT;?>
				</div>
				
				<div class="col-md-2">
					<?=EXPANCE_TITLE;?>
				</div>

				<div class="col-md-1">
					<?=DISPLAYED_KM;?>
				</div>

				<div class="col-md-1">
					<?=NOTE;?>
				</div>		
				
				<div class="col-md-1">
					
				</div>
				
				<div class="col-md-1">
					<?=EXPANCE_APPROVED;?>
				</div>

			</div>

			{{#each Item}}
				<div  onclick="oneItem({{ID}});">
					<div class="row {{color}} pad1em listTile"
					style="border-top:1px solid #ddd"
					id="t_{{ID}}">

							<div class="col-md-1">
								<strong>{{ID}}</strong>
							</div>

							<div class="col-md-1">
								{{Datum}}
							</div>

							<div class="col-md-2">
								{{AuthUserRealName}}
							</div>

							<div class="col-md-2">
								{{ExpanceTitle}}
							</div>

							<div class="col-md-1">
								<img class="expenses-image" src="{{DocumentImage}}" alt="" style="width:30%">
							</div>
							
							<div class="col-md-2">
								{{Amount}}

								{{#compare CurrencyID "==" 1}} EUR {{/compare}}
								{{#compare CurrencyID "==" 2}} HRK {{/compare}}
								{{#compare CurrencyID "==" 3}} CHF {{/compare}}

								{{#compare Card "==" 1}} Card
								{{else}} Cash
								{{/compare}}
							</div>

							<div class="col-md-1">
								{{Description}}
							</div>
							
							<div class="col-md-1">
								{{#if Note}}
									<!-- Previous: -->
									<!-- <i class="fa fa-envelope" aria-hidden="true"></i> -->
									<!-- <div class="yellow" style="display:none;">{{Note}}</div> -->
									
									<i class="fa fa-envelope fa-envelope-edit" aria-hidden="true"></i>
									<div class="envelop-note" style="display:none;">{{Note}}</div>

								{{/if}}
							</div>					
												
							<div class="col-md-1 approved" data-id="{{ID}}">
								{{yesNoSliderEdit Approved 'Approved' }}
							</div>

					</div>

				</div>
			{{/each}}
		</div>

		<!-- Reporter: -->
		<div class="tab-pane" id="tab_2">
			<div id="sum" class="sum-edit">

			</div> <!-- End of #sum -->
		</div>	

	</div>
</div>	
	<script>
		// Previous:
		// $('i').on("mouseenter",function() {
		// 	$(this).next().show();
		// })		
		// $('i').on("mouseout",function() {
		// 	$(this).next().hide();
		// })

		$('i').on("click",function() {
			$(".envelop-note").toggle("slow");
		});


		$('img').on("mouseenter", function() {
			$(this).css('width','800%');
			$(this).css('margin-left','-300%');
		})		
		$('img').on("mouseout", function() {
			$(this).css('width','30%');
			$(this).css('margin-left','0%');			
		})
		$('img').on( "dblclick", function() {
			$(this).toggleClass("rotate");
		})
		$('.approved input').change(function(){
			var id=$(this).parent().attr('data-id');

			var app=$(this).val();
			var base=window.rootbase;

			if (window.location.host=='localhost') base=base+'/jamtransfer';
			var link = base+'/plugins/Expenses/Save.php';
			var param = "id="+id+"&Approved="+app;
			console.log(link+'?'+param);
			$.ajax({
				type: 'POST',
				url: link,
				data: param,
				success: function(data) {
					toastr['success'](window.success);	
				}				
			});
		})	
	</script>

</script>
