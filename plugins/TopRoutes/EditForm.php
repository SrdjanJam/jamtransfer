<script type="text/x-handlebars-template" id="ItemEditTemplate">
<form id="ItemEditForm{{TopRouteID}}" class="form box box-info" enctype="multipart/form-data" method="post" onsubmit="return false;">
	<div class="box-header">

		<div class="box-tools pull-right">
			
			<span id="statusMessage" class="text-info xl"></span>
			
			<? if (!$isNew) { ?>

				<button class="btn btn-warning" title="<?= CLOSE?>"
					onclick="return editCloseItem('{{ID}}');">
					<i class="fa fa-close"></i>
				</button>

				<? } ?>	

				<button class="btn btn-info" title="<?= SAVE_CHANGES ?>"
					onclick="return editSaveItem('{{TopRouteID}}');">
					<i class="fa fa-save"></i>
				</button>

		</div>
	</div>
	
	<div class="box-body ">
        <div class="row">
			<div class="col-md-12">
				<!-- TOP_ROUTE_ID: -->
				<div class="row">
					<div class="col-md-3">
						<label for="TopRouteID"><?=TOP_ROUTE_ID;?></label>
					</div>
					<div class="col-md-9">
						{{TopRouteID}}
					</div>
				</div>
				<!-- MAIN: -->
				<div class="row">
					<div class="col-md-3">
						<label for="Main"><?=MAIN;?></label>
					</div>
					<div class="col-md-9 Main data-id="{{Main}}">
						{{yesNoSliderEdit Main 'Main' }}
					</div>
				</div>
				<!-- DESCRIPTION: -->

				<div class="row">
					<div class="col-md-3">
						<label for="text"><?=DESCRIPTION;?></label>
					</div>
					<div class="col-md-9">
						{{des_arr.en}}
						<!--<textarea name="des"  style="resize:none;width:100%;min-height:200px;">{{des_arr.en}}</textarea>!-->
					</div>
				</div>					
				{{#each des_arr}}
				<div class="row {{#compare ../language '!=' @key}}hidden{{/compare}}">
					<div class="col-md-3">
						<label for="text"><?=DESCRIPTION;?> {{@key}} {{language}}</label>
					</div>	
					<div class="col-md-9">	
						<textarea name='des_{{@key}}' style="resize:none;width:100%;min-height:200px;" >{{this}}</textarea>
					</div>	
				</div>	
				{{/each}}

				
			</div>
	    </div>
		   
</form>

	<script>

		//bootstrap WYSIHTML5 - text editor
		$(".textarea").wysihtml5({
				"font-styles": true, //Font styling, e.g. h1, h2, etc. Default true
				"emphasis": true, //Italics, bold, etc. Default true
				"lists": true, //(Un)ordered lists, e.g. Bullets, Numbers. Default true
				"html": true, //Button which allows you to edit the generated HTML. Default false
				"link": true, //Button to insert a link. Default true
				"image": true, //Button to insert an image. Default true,
				"color": true //Button to change color of font 
				
		});
		
		// uklanja ikonu Saved - statusMessage sa ekrana
		$("form").change(function(){
			$("#statusMessage").html('');
		});
	
	
		$("#PlaceNameEN").keyup(function(){
			var place = $("#PlaceNameEN").val();
			$("#PlaceNameSEO").val( getSlug( place , '+') );
		});
		
		$("#PlaceCountry").change(function(){
			$("#CountryNameEN").val( $("#PlaceCountry option:selected").text());
		});
	</script>
</script>

