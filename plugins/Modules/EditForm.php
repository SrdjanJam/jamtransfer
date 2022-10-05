
<script type="text/x-handlebars-template" id="ItemEditTemplate">
<form id="ItemEditForm{{ModulID}}" class="form box box-info" enctype="multipart/form-data" method="post" onsubmit="return false;">
	<div class="box-header">
		<div class="box-tools pull-right">
			
			<span id="statusMessage" class="text-info xl"></span>
			
			<? if (!$isNew) { ?>
				<button class="btn btn-warning" title="<?= CLOSE?>" 
				onclick="return editCloseItem('{{ModulID}}');">
				<i class="fa fa-close"></i>
				</button>

				<button class="btn btn-danger" title="<?= CANCEL ?>" 
				onclick="return deleteItem('{{ModulID}}');">
				<i class="fa fa-ban"></i>
				</button>
			<? } ?>	
			<button class="btn btn-info" title="<?= SAVE_CHANGES ?>" 
			onclick="return editSaveItem('{{ModulID}}');">
			<i class="fa fa-save"></i>
			</button>
		</div>
	</div>

	<div class="box-body ">
        <div class="row">
			<div class="col-md-12">

				<input type="hidden" name="ID" id="ID" class="w100" value="{{ID}}">


				<div class="row">
					<div class="col-md-3">
						<label for="Name"><?=NAME;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="Name" id="Name" class="w100" value="{{Name}}">
					</div>
				</div>				
				<div class="row">
					<div class="col-md-3">
						<label for="Code"><?=CODE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="Code" id="Code" class="w100" value="{{Code}}">
					</div>
				</div>				
				<div class="row">
					<div class="col-md-3">
						<label for="Base"><?=Base;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="Base" id="Base" class="w100" value="{{Base}}">
					</div>
				</div>					
				<div class="row">
					<div class="col-md-3">
						<label for="Parent"><?=ParentID;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="ParentID" id="ParentID" class="w100" value="{{ParentID}}">
					</div>
				</div>					
				<div class="row">
					<div class="col-md-3">
						<label for="Parent"><?=MenuOrder;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="MenuOrder" id="MenuOrder" class="w100" value="{{MenuOrder}}">
					</div>
				</div>					
				<div class="row">
					<div class="col-md-3">
						<label for="Parent"><?=Icon;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="Icon" id="Icon" class="w100" value="{{Icon}}">
					</div>
				</div>					
				<div class="row">
					<div class="col-md-3">
						<label for="Parent"><?=Active;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="Active" id="Active" class="w100" value="{{Active}}">
					</div>
				</div>				


				<div class="row">
					<div class="col-md-3">
						<label for="Description"><?=Description;?></label>
					</div>
					<div class="col-md-9">
						<textarea name="Description" id="Description" rows="15" 
					class="textarea" style="width:100%">{{Description}}</textarea>
					</div>
				</div>



			</div>
	    </div>
		    

	<!-- Statuses and messages -->
	<div class="box-footer">

	</div>
	
	<input type="hidden" name="LastChange" id="LastChange"  value="<?= date("Y-m-d H:i:s") ?>">
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
	
