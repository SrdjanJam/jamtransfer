<script type="text/x-handlebars-template" id="ItemEditTemplate">
<form id="ItemEditForm{{id}}" class="form box box-info" enctype="multipart/form-data" method="post" onsubmit="return false;">
	<div class="box-header">

		<div class="box-tools pull-right">
			
			<span id="statusMessage" class="text-info xl"></span>
			
			<? if (!$isNew) { ?>
				<button class="btn btn-warning" title="<?= CLOSE ?>" 
				onclick="return editCloseItem('{{id}}');">
				<i class="fa fa-close"></i>
				</button>
				{{#compare language '==' " "}}
				<button class="btn btn-danger" title="<?= CANCEL ?>" 
				onclick="return deleteItem('{{id}}');">
				<i class="fa fa-ban"></i>
				</button>
				{{/compare}}
			<? } ?>	
			<button class="btn btn-info" title="<?= SAVE_CHANGES ?>" 
			onclick="return editSaveItem('{{id}}');">
			<i class="fa fa-save"></i>
			</button>			
			<a target='_tab' href='https://api.jamtransfer.com/api/delete-translations-cache?hash=d06161457d4c4b45e57d764c98051d86'>Delete Cache</a>
		</div>
	</div>

	<div class="box-body ">
        <div class="row">
			<div class="col-md-6 col-md-offset-3">
				
				<div class="row">
					<div class="col-md-3">
						<label for="id"><?=ID;?></label>
					</div>
					<div class="col-md-9">
						{{id}}
					</div>
				</div>
				<div class="row">
					<div class="col-md-3">
						<label for="key"><?=KEY;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="key" id="key" class="w100" value="{{key}}"
						 {{#compare language '!=' " "}}<? if (!$isNew) { ?>disabled<? } ?>	{{/compare}}
						>
					</div>
				</div>

				<div class="row {{#compare language '!=' " "}}<? if (!$isNew) { ?>hidden <? } ?>{{/compare}}">
					<div class="col-md-3">
						<label for="Group">Group (api, api/validation, email)</label>
					</div>
					<div class="col-md-9">
						<input type="text" name="group" id="group" class="w100" value="{{group}}">
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-3">
						<label for="text"><?=TEXT;?></label>
					</div>
					<div class="col-md-9">
						<textarea name="text"  <? if (!$isNew) { ?> readonly <? } ?> style="width:100%">{{text_arr.en}}</textarea>
					</div>
				</div>			
				{{#each text_arr}}
				<div class="row {{#compare ../language '!=' @key}}hidden{{/compare}}">
					<div class="col-md-3">
						<label for="text"><?=TEXT;?> {{@key}} {{language}}</label>
					</div>	
					<div class="col-md-9">	
						<textarea name='text_{{@key}}' 
						style="width:100%">{{this}}</textarea>
					</div>	
				</div>	
				{{/each}}
				
				
			</div><!-- End of .box-body -->
	    </div> <!-- End of .row -->
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
	
	</script>
</script>

