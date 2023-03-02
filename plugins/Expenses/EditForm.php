<?

$currency = array(
    '1' => 'EUR',
    '2' => 'HRK',
    '3' => 'CHF');
?>

<style>


.small {
	width: auto;
	height: 25px;
	background-color: #d6edfc;
}
	.large {
	width: 700px;
	height: auto;

	background-color: #fc0;
	margin: 10px auto;
}
.rotate {
  -moz-transform: rotate(90deg);
  -webkit-transform: rotate(90deg);
  -o-transform: rotate(90deg);
  -ms-transform: rotate(90deg);
  transform: rotate(90deg);
}
  </style>

<script type="text/x-handlebars-template" id="ItemEditTemplate">
<form id= "ItemEditForm{{ID}}" class="form box box-info" enctype="multipart/form-data" method="post" onsubmit="return false;">
	<div class="box-header">
		<div class="box-tools pull-right">
			<button class="btn btn-warning" title="<?= CLOSE?>"
			onclick="return editCloseItem('{{ID}}');">
			<i class="fa fa-close"></i>
			</button>
  			<button id="save_button" class="btn btn-info" title="<?= SAVE_CHANGES ?>"
  				onclick="return editSaveItem('{{ID}}');">
  				<i class="fa fa-save"></i>
  			</button>
		</div>
	</div>

	<div class="box-body">
		<div class="row">
			<div class="col-md-6">	
				<div class="row">	
					<div class="col-md-12">	
						<img  src="{{DocumentImage}}" alt="" height="400" width="400">
					</div>
				</div>
			</div>

			<div class="col-md-6">
				<div class="row">
					<div class="col-md-3">
						<label for="Approved">Approved</label>
					</div>
					<div class="col-md-9">
						<large>{{yesNoSliderEdit Approved 'Approved' }}</large>
					</div>
				</div>
				{{#compare ApprovedFuelPrice ">" 0}}
				<div class="row">
					Approved Fuel price:{{ApprovedFuelPrice}}
				</div>		
				{{/compare}}
				<div class="row">
					{{Note}}
				</div>
			</div>
		</div>
	</div>			
</form>


	<script>
		$('img').click(function() {
			$(this).toggleClass("large");
		})
		$('img').dblclick(function() {
			$(this).toggleClass("rotate");
		})
		$('input').change(function() {
			$('#save_button').trigger('click');
		})
	
	</script>
</script>
