
<script type="text/x-handlebars-template" id="v4_PagesEditTemplate">
<form id="v4_PagesEditForm{{ID}}" class="form box box-info" enctype="multipart/form-data" method="post" onsubmit="return false;">
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
					onclick="return editClosev4_Pages('{{ID}}', '<?= $inList ?>');">
					<i class="fa fa-arrow-up"></i>
					</button>
				<? } else { ?>
					<button class="btn btn-danger" title="<?= CANCEL ?>" 
					onclick="return deletev4_Pages('{{ID}}', '<?= $inList ?>');">
					<i class="fa fa-ban"></i>
					</button>
				<? } ?>	
			<? } ?>	
			<button class="btn btn-info" title="<?= SAVE_CHANGES ?>" 
			onclick="return editSavev4_Pages('{{ID}}', '<?= $inList ?>');">
			<i class="ic-disk"></i>
			</button>
			<? if (!$isNew) { ?>
				<button class="btn btn-danger" title="<?= PRINTIT ?>" 
				onclick="return editPrintv4_Pages('{{ID}}', '<?= $inList ?>');">
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
						<label for="Title"><?=TITLE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="Title" id="Title" class="w100" value="{{Title}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="TitleEN"><?=TITLEEN;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="TitleEN" id="TitleEN" class="w100" value="{{TitleEN}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="TitleRU"><?=TITLERU;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="TitleRU" id="TitleRU" class="w100" value="{{TitleRU}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="TitleFR"><?=TITLEFR;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="TitleFR" id="TitleFR" class="w100" value="{{TitleFR}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="TitleDE"><?=TITLEDE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="TitleDE" id="TitleDE" class="w100" value="{{TitleDE}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="TitleIT"><?=TITLEIT;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="TitleIT" id="TitleIT" class="w100" value="{{TitleIT}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="Content"><?=CONTENT;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="Content" id="Content" class="w100" value="{{Content}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="ContentEN"><?=CONTENTEN;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="ContentEN" id="ContentEN" class="w100" value="{{ContentEN}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="ContentRU"><?=CONTENTRU;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="ContentRU" id="ContentRU" class="w100" value="{{ContentRU}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="ContentFR"><?=CONTENTFR;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="ContentFR" id="ContentFR" class="w100" value="{{ContentFR}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="ContentDE"><?=CONTENTDE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="ContentDE" id="ContentDE" class="w100" value="{{ContentDE}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="ContentIT"><?=CONTENTIT;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="ContentIT" id="ContentIT" class="w100" value="{{ContentIT}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="MenuTitle"><?=MENUTITLE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="MenuTitle" id="MenuTitle" class="w100" value="{{MenuTitle}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="MenuTitleEN"><?=MENUTITLEEN;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="MenuTitleEN" id="MenuTitleEN" class="w100" value="{{MenuTitleEN}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="MenuTitleRU"><?=MENUTITLERU;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="MenuTitleRU" id="MenuTitleRU" class="w100" value="{{MenuTitleRU}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="MenuTitleFR"><?=MENUTITLEFR;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="MenuTitleFR" id="MenuTitleFR" class="w100" value="{{MenuTitleFR}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="MenuTitleDE"><?=MENUTITLEDE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="MenuTitleDE" id="MenuTitleDE" class="w100" value="{{MenuTitleDE}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="MenuTitleIT"><?=MENUTITLEIT;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="MenuTitleIT" id="MenuTitleIT" class="w100" value="{{MenuTitleIT}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="LastChange"><?=LASTCHANGE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="LastChange" id="LastChange" class="w100" value="{{LastChange}}">
					</div>
				</div>


			</div>
	    </div>
		    

	<!-- Statuses and messages -->
	<div class="box-footer">
		<? if (!$isNew) { ?>
		<div>
    	<button class="btn btn-default" onclick="return deletev4_Pages('{{ID}}', '<?= $inList ?>');">
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
	