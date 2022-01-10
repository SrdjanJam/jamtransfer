
<script type="text/x-handlebars-template" id="v4_TodoListEditTemplate">
<form id="v4_TodoListEditForm{{ID}}" class="form box box-info" enctype="multipart/form-data" method="post" onsubmit="return false;">
	<div class="box-header">
		<div class="box-title">
			<? if ($isNew) { ?>
				<h3><?= NNEW ?></h3>
			<? } else { ?>
				<h3><?= EDIT ?> - {{ID}}</h3>
			<? } ?>
		</div>
		<div class="box-tools pull-right">
			
			<span id="statusMessage" class="text-info xl"></span>
			
			<? if (!$isNew) { ?>
				<? if ($inList=='true') { ?>
					<button class="btn" title="<?= CLOSE?>" 
					onclick="return editClosev4_TodoList('{{ID}}', '<?= $inList ?>');">
					<i class="fa fa-arrow-up"></i>
					</button>
				<? } else { ?>
					<button class="btn btn-danger" title="<?= CANCEL ?>" 
					onclick="return deletev4_TodoList('{{ID}}', '<?= $inList ?>');">
					<i class="fa fa-ban"></i>
					</button>
				<? } ?>	
			<? } ?>	
			<button class="btn btn-info" title="<?= SAVE_CHANGES ?>" 
			onclick="return editSavev4_TodoList('{{ID}}', '<?= $inList ?>');">
			<i class="ic-disk"></i>
			</button>
			<? if (!$isNew) { ?>
				<button class="btn btn-danger" title="<?= PRINTIT ?>" 
				onclick="return editPrintv4_TodoList('{{ID}}', '<?= $inList ?>');">
				<i class="ic-print"></i>
				</button>
			<? } ?>	
		</div>
	</div>

	<div class="box-body ">
        <div class="row">
			<div class="col-md-6">
				<div class="row">
					<div class="col-md-3">
						<label for="ID"><?=ID;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="ID" id="ID" class="w100" value="{{ID}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="OwnerID"><?=OWNERID;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="OwnerID" id="OwnerID" class="w100" value="{{OwnerID}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="Task"><?=TASK;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="Task" id="Task" class="w100" value="{{Task}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="DateAdded"><?=DATEADDED;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="DateAdded" id="DateAdded" class="w100" value="{{DateAdded}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="TimeAdded"><?=TIMEADDED;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="TimeAdded" id="TimeAdded" class="w100" value="{{TimeAdded}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="Completed"><?=COMPLETED;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="Completed" id="Completed" class="w100" value="{{Completed}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="DateCompleted"><?=DATECOMPLETED;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="DateCompleted" id="DateCompleted" class="w100" value="{{DateCompleted}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="TimeCompleted"><?=TIMECOMPLETED;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="TimeCompleted" id="TimeCompleted" class="w100" value="{{TimeCompleted}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="SortOrder"><?=SORTORDER;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="SortOrder" id="SortOrder" class="w100" value="{{SortOrder}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="GroupID"><?=GROUPID;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="GroupID" id="GroupID" class="w100" value="{{GroupID}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="ShareWithGroup"><?=SHAREWITHGROUP;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="ShareWithGroup" id="ShareWithGroup" class="w100" value="{{ShareWithGroup}}">
					</div>
				</div>


			</div>
	    </div>
		    

	<!-- Statuses and messages -->
	<div class="box-footer">
		<? if (!$isNew) { ?>
		<div>
    	<button class="btn btn-default" onclick="return deletev4_TodoList('{{ID}}', '<?= $inList ?>');">
    		<i class="ic-cancel-circle"></i> <?= DELETE ?>
    	</button>
    	</div>
    	<? } ?>

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
	
	</script>
</script>
	