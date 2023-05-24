
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
			<div class="col-md-6">

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
						<label for="Base"><?=BASE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="Base" id="Base" class="w100" value="{{Base}}">
					</div>
				</div>					
				<div class="row">
					<div class="col-md-3">
						<label for="Parent"><?=PARENT_ID;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="ParentID" id="ParentID" class="w100" value="{{ParentID}}">
					</div>
				</div>					
				<div class="row">
					<div class="col-md-3">
						<label for="Parent"><?=MENUORDER;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="MenuOrder" id="MenuOrder" class="w100" value="{{MenuOrder}}">
					</div>
				</div>					
				<div class="row">
					<div class="col-md-3">
						<label for="Parent"><?=ICON;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="Icon" id="Icon" class="w100" value="{{Icon}}">
					</div>
				</div>					
				<div class="row">
					<div class="col-md-3">
						<label for="IsNew"><?=IS_NEW_ENTRY;?></label>
					</div>
					<div class="col-md-9">
						{{yesNoSliderEdit IsNew 'IsNew' }}
					</div>
				</div>				
				<div class="row">
					<div class="col-md-3">
						<label for="Phase"><?=PHASE;?></label>
					</div>
					<div class="col-md-9">
						<input type="number" name="Phase" id="Phase" class="w1" value="{{Phase}}">
					</div>
				</div>					
				<div class="row">
					<div class="col-md-3">
						<label for="Parent"><?=ACTIVE;?></label>
					</div>
					<div class="col-md-9">
						{{yesNoSliderEdit Active 'Active' }}
					</div>
				</div>				
			</div>
			<div class="col-md-6">
				<div class="row">
					<div class="col-md-3 "><label><?= LEVEL ?></label></div>
					<div class="col-md-9 checking">
						{{userLevelCheck AuthLevelID}}
					</div>
				</div>				
				<div class="row">
					<input type="hidden" name="levels" id="levels" value='{{Levels}}'/>
				</div>
			</div>
		</div>	
		<div class="row">
			<div class="col-md-3">
				<label for="Description"><?=DESCRIPTION;?></label>
			</div>
			<div class="col-md-9">
				<textarea name="Description" id="Description" rows="15" 
			class="textarea" style="width:100%">{{Description}}</textarea>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3">
				<label for="Help" style="color:green;"><?=HELP;?></label>
			</div>
			<div class="col-md-9">
				<textarea name="Help" id="Help" rows="15" 
			class="textarea" style="width:100%;background:#ecf5ec;">{{Help}}</textarea>
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
		var levels = $("#levels").val().split(',');
		$.each(levels , function(index, val) { 
			$('*[data-id="'+val+'"]').prop('checked', true);
		});
		$('.level').click(function(){
			var xl='';
			$('.level').each (function() { 
				if ($(this).prop('checked')) {
					xl=xl+$(this).attr('data-id')+',';
				}	
			});
			xl=xl.substring(0,xl.length - 1);
			$("#levels").val(xl);
		})
		
	</script>
</script>
	
