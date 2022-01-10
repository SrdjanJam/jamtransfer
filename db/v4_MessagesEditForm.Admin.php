
<script type="text/x-handlebars-template" id="v4_MessagesEditTemplate">
<form id="v4_MessagesEditForm{{ID}}" class="form box box-info" enctype="multipart/form-data" method="post" onsubmit="return false;">
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
					onclick="return editClosev4_Messages('{{ID}}', '<?= $inList ?>');">
					<i class="fa fa-arrow-up"></i>
					</button>
				<? } else { ?>
					<button class="btn btn-danger" title="<?= CANCEL ?>" 
					onclick="return deletev4_Messages('{{ID}}', '<?= $inList ?>');">
					<i class="fa fa-ban"></i>
					</button>
				<? } ?>	
			<? } ?>	
			<button class="btn btn-info" title="<?= SAVE_CHANGES ?>" 
			onclick="return editSavev4_Messages('{{ID}}', '<?= $inList ?>');">
			<i class="ic-disk"></i>
			</button>
			<? if (!$isNew) { ?>
				<button class="btn btn-danger" title="<?= PRINTIT ?>" 
				onclick="return editPrintv4_Messages('{{ID}}', '<?= $inList ?>');">
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
						<label for="MsgFrom"><?=MSGFROM;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="MsgFrom" id="MsgFrom" class="w100" value="{{MsgFrom}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="FromName"><?=FROMNAME;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="FromName" id="FromName" class="w100" value="{{FromName}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="Msg"><?=MSG;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="Msg" id="Msg" class="w100" value="{{Msg}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="Body"><?=BODY;?></label>
					</div>
					<div class="col-md-9">
						<textarea name="Body" id="Body" rows="5" 
					class="textarea" cols="50" style="width:100%">{{Body}}</textarea>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="UserID"><?=USERID;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="UserID" id="UserID" class="w100" value="{{UserID}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="DateTime"><?=DATETIME;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="DateTime" id="DateTime" class="w100" value="{{DateTime}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="UserLevel"><?=USERLEVEL;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="UserLevel" id="UserLevel" class="w100" value="{{UserLevel}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="Status"><?=STATUS;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="Status" id="Status" class="w100" value="{{Status}}">
					</div>
				</div>


			</div>
	    </div>
		    

	<!-- Statuses and messages -->
	<div class="box-footer">
		<? if (!$isNew) { ?>
		<div>
    	<button class="btn btn-default" onclick="return deletev4_Messages('{{ID}}', '<?= $inList ?>');">
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
	