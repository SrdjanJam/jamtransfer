
<script type="text/x-handlebars-template" id="ItemEditTemplate">
<form id="ItemEditForm{{ID}}" class="form box box-info" enctype="multipart/form-data" method="post" onsubmit="return false;">
	<div class="box-header">
		<div class="box-tools pull-right">
			
			<span id="statusMessage" class="text-info xl"></span>
			
			<? if (!$isNew) { ?>
				<button class="btn btn-warning" title="<?= CLOSE?>" 
				onclick="return editCloseItem('{{ID}}');">
				<i class="fa fa-close"></i>
				</button>

				<button class="btn btn-danger" title="<?= CANCEL ?>" 
				onclick="return deleteItem('{{ID}}');">
				<i class="fa fa-ban"></i>
				</button>
			<? } ?>	
			<button class="btn btn-info" title="<?= SAVE_CHANGES ?>" 
			onclick="return editSaveItem('{{ID}}');">
			<i class="fa fa-save"></i>
			</button>
		</div>
	</div>

	<div class="box-body ">
        <div class="row">
			<div class="col-md-6">				
				<div class="row">
					<div class="col-md-2">
						<label for="Active"><?=ACTIVE;?></label>
					</div>
					<div class="col-md-10">
						<select class="w100" name="Active"  value="{{Active}}">
							<option value="0" {{#compare Active "==" 0}} selected {{/compare}}>Not Active</option>
							<option value="1" {{#compare Active "==" 1}} selected {{/compare}}>Expense</option>
							<option value="2" {{#compare Active "==" 2}} selected {{/compare}}>Activity</option>
						</select>					
					</div>
				</div>				
				<div class="row">
					<div class="col-md-2">
						<label for="Title"><?=TITLE;?></label>
					</div>
					<div class="col-md-10">
						<input type="text" name="Title" id="Title" class="w100" value="{{Title}}">
					</div>
				</div>
				<div class="row">
					<div class="col-md-2">
						<label for="Title"><?=RECIEVER_ID;?></label>
					</div>
					<div class="col-md-10">
						<input type="text" name="ReciverID" id="Title" class="w100" value="{{ReciverID}}">
					</div>
				</div>
				<div class="row">
					<div class="col-md-2">
						<label for="DisplayOrder"><?=DISPLAY_ORDER;?></label>
					</div>
					<div class="col-md-10">
						<input type="text" name="DisplayOrder" id="DisplayOrder" class="w100" value="{{DisplayOrder}}">
					</div>
				</div>
			</div>	
			<div class="col-md-6">
				{{#each checklist}}
					<div class="row">
						<div class="col-md-3">
							<label for="Description">{{title}}</label>
						</div>	
						<div class="col-md-3">
							<input type="checkbox" name="check{{id}}" style="height: 0.8em" value="1" 
							{{#each ../rq_arr}}
								{{#compare rqid "==" ../id }}
									checked
								{{/compare}}	
							{{/each}}
							> 
						</div>		
					</div>	
				{{/each}}	
			</div>
	    </div>
	</div>	
</form>


	<script>
		// uklanja ikonu Saved - statusMessage sa ekrana
		$("form").change(function(){
			$("#statusMessage").html('');
		});
	
	</script>
</script>
	
