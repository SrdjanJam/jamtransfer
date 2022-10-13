<?
	$arr_row['id']=99;
	$arr_row['name']="Terminal";
	$arr_all[]=$arr_row;
	

	$smarty->assign('options',$arr_all);
	$smarty->assign('selecttype',true);
?>
<script type="text/x-handlebars-template" id="ItemListTemplate">

	<div class="row">
		<div class="col-sm-1">
			Terminal ID
		</div>							
		<div class="col-sm-8">
			Terminal Name
		</div>	
		<div class="col-md-1">
			Terminal
		</div>				
		<div class="col-sm-2">
			Active
		</div>
	</div>

	{{#each Item}}
		<div>
		
			<div class="row {{color}} pad1em listTile" 
			style="border-top:1px solid #ddd" 
			id="t_{{PlaceID}}">
		
				<div class="col-sm-1">
					{{PlaceID}}
				</div>

				<div class="col-sm-8">
					<strong>{{PlaceNameEN}}</strong>,
					{{CountryNameEN}}
				</div>

				<div class="col-md-1 terminal" data-id="{{PlaceID}}">
					{{yesNoSliderEdit Terminal 'Terminal' }}
				</div>

				<div class="col-sm-2">
					{{#compare PlaceActive ">" 0}}
						<i class="fa fa-circle text-green"></i>
					{{else}}
						<i class="fa fa-circle text-red"></i>
					{{/compare}}
				</div>
			</div>
		</div>

	{{/each}}
	<script>
		$('.terminal input').change(function(){
			var placeid=$(this).parent().attr('data-id');
			var terminal=$(this).val();	
			var base=window.location.origin;
			if (window.location.host=='localhost') base=base+'/jamtransfer';		
			var link = base+'/plugins/DriversTerminals/Save.php';
			var param = "PlaceID="+placeid+"&Terminal="+terminal;
			$.ajax({
				type: 'POST',
				url: link,
				data: param,
			});
		})	
		
	</script>

</script>

	
