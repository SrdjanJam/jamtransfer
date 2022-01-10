
<script type="text/x-handlebars-template" id="countryEditTemplate">
<form id="countryEditForm{{CountryID}}" class="form box box-info" enctype="multipart/form-data" method="post" onsubmit="return false;">
	<div class="box-header">
		<div class="box-title">
			<h3><?= EDIT ?> - {{CountryName}}</h3>
		</div>
		<div class="box-tools pull-right">
			
			<span id="statusMessage" class="text-info xl"></span>
			
			<? if ($inList=='true') { ?>
				<button class="btn btn-warning" title="<?= CLOSE ?>" 
				onclick="return editCloseCountry('{{CountryID}}', '<?= $inList ?>');">
				<i class="ic-close"></i>
				</button>
			<? } ?>

			<button class="btn btn-info" title="<?= SAVE_CHANGES ?>" 
			onclick="return editSaveCountry('{{CountryID}}', '<?= $inList ?>');">
			<i class="ic-disk"></i>
			</button>
		</div>
	</div>

	<div class="box-body ">
        <div class="row">
	        <div class="col-md-12">
			    <div class="row">
			    	<div class="col-md-3 "><label><?= ID ?></label></div>
				    <div class="col-md-9">
					      <strong>{{CountryID}}</strong> 
				    </div>
				</div>

			    <div class="row">
				    <div class="col-md-3 "><label><?= COUNTRY_NAME ?></label></div>
				    <div class="col-md-9">
				    	<input type="text"  name="CountryName" class="w100" value="{{CountryName}}"
				    	<?= READ_ONLY_FLD ?> required>
				    </div>
			    </div>

			    <div class="row">
				    <div class="col-md-3 "><label><?= COUNTRY_NAME_RU ?></label></div>
				    <div class="col-md-9">
				    	<input id="CountryNameRU" name="CountryNameRU" type="text"  class="w100"
				    	 value="{{CountryNameRU}}"
				    	<?= READ_ONLY_FLD ?> required>
				    </div>
			    </div>

				<div class="row">
				    <div class="col-md-3 "><label><?= NOTE ?></label></div>
				    <div class="col-md-9">
				    	<textarea class="textarea" name="CountryDesc" id="CountryDesc" cols="40" rows="8"
				    	 style="width:100%">
				    		{{{CountryDesc}}}
				    	</textarea><br>
				    </div>
				    
			    </div>

		    </div>
	    </div>
		    
</form>


	<script>

		//bootstrap WYSIHTML5 - text editor
		$(".textarea").wysihtml5({
				"font-styles": false, //Font styling, e.g. h1, h2, etc. Default true
				"emphasis": true, //Italics, bold, etc. Default true
				"lists": false, //(Un)ordered lists, e.g. Bullets, Numbers. Default true
				"html": false, //Button which allows you to edit the generated HTML. Default false
				"link": true, //Button to insert a link. Default true
				"image": false, //Button to insert an image. Default true,
				"color": false //Button to change color of font 
				
		});
		
		// uklanja ikonu Saved - statusMessage sa ekrana
		$("form").change(function(){
			$("#statusMessage").html('');
		});
		
	
	</script>
</script>


