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

.right-edit{
	border-bottom: 1px solid #1b8aab;
	font-size: 22px;
	background: #c8dff3;
	padding: 1px 5px;
	border-radius: 5px;
	box-shadow: 2px 1px 3px 0px #6ba4e3;
	/* box-shadow: 2px 1px 3px 0px #4a4848; old */
	text-shadow: #4ba7e1 1px 0 2px;
}

.right-edit a{
	color: #1186e0;
	/* Old:
	color: #0c81e5;
	background: #dbdbdb; 
	*/
}

.right-edit a:hover{
	color: #009efb;
}

.inner-edit{
	border-style: none !important;
}

.icon h4{
	color: cornflowerblue;
}

.grey{
	background-color: #6cd7f3 !important;
}

.green-text{
	color: green !important;
}

.red-text{
	color: red !important;
}

/* Sum edit for report: */
.sum-edit{
	display: flex;
}
.sum-edit div{
	padding: 5px;
	flex-basis: 100%;
	/* text-align: center; */
}

.sum-edit-labels{
	padding: 5px;
}
.sum-edit-labels p{
	margin-bottom: 0;
	color: #626161;
	font-weight: bold;
	direction: rtl;
}

.sum-edit-labels p, .sum-edit-2 div{
	direction: rtl; /* from right to left position*/
}

.sum-edit-2{
	padding: 5px;
}

.sum-edit-2:nth-of-type(2n){
	background: #ebf0f5;
}

.no-style{
	all: unset; /* No style for this element */
}

.add-direction{
	direction: ltr !important;
}

/* -------------------------------- */


 </style>
  
<script type="text/x-handlebars-template" id="ItemListTemplate">

<div class="nav-tabs-custom nav-tabs-custom-edit">
	<ul class="nav nav-tabs dorder">
					<li class="active"><a href="#tab_1" data-toggle="tab">List</a></li>
					<li><a href="#tab_2" data-toggle="tab">SubDriver Balance</a></li>
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

		<!-- SubDriver Balance: -->
		<div class="tab-pane" id="tab_2">
			<div id="sum" class="sum-edit">
				<div class="row" style="border-bottom:1px solid #000;">
					<div class="col-md-2">
						<strong>ID - Subdriver</strong>
					</div>
					<div class="col-md-1">
						<strong>Deposit </strong>
					</div>
					<div class="col-sm-3 ">
						<div class="col-sm-12 ">
							<strong>Cash</strong>				
						</div>
						<div class="col-sm-4 ">
							<strong>Drives</strong>
						</div>	
						<div class="col-sm-4 ">
							<strong>Received</strong>
						</div>		
						<div class="col-sm-4 ">
							<strong>Expenses</strong>
						</div>			

					</div>	
					<div class="col-sm-1 ">
						<strong>Balance</strong>
					</div>				
					<div class="col-sm-3 ">
						<div class="col-sm-12 ">
							<strong>Cash - last day</strong>
						</div>					
						<div class="col-sm-4 ">
							<strong>Plan</strong>
						</div>				
						<div class="col-sm-4 ">
							<strong>In</strong>
						</div>				
						<div class="col-sm-4 ">
							<strong>Expenses</strong>
						</div>		
					</div>
					<div class="col-sm-1">
						<strong>Unapproved Expenses </strong> 
					</div>
					<div class="col-sm-1 ">
						<strong>Balance total</strong>
					</div>						
				</div>
			</div> <!-- End of #sum -->
			{{#each Item2}}
				<div id="sum" class="sum-edit sum-edit-2">
					<div class="add-direction {{#compare Active "==" 1}}green-text{{/compare}} {{#compare Active "!=" 1}}red-text{{/compare}}">
						{{SubDriver}}
					</div>					
					<div>
						{{Depostit}}
					</div>
					<div>
						{{Primljeno}}
					</div>
					<div>
						{{RCash}} 
					</div>
					<div>
						{{Trosak}}  
					</div>					
					<div>
						{{Balance}}  
					</div>
					<div>
						{{CashPlan}} 
					</div>
					<div>
						{{Primljeno2}}  
					</div>
					<div>
						{{Trosak3}}  
					</div>
					<div>
						{{UnapprovedExpenses}} 
					</div>
					<div>
						<b style="color:#0f5b89;">{{BalanceT}}</b> 
					</div>
				</div> <!-- End of #sum -->
			{{/each}}

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
