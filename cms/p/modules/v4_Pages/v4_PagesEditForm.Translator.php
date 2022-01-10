
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
		</div>
	</div>

	<div class="box-body ">
        <div class="row">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-3">
						<label for="TitleEN"><?=TITLE.LEN;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="TitleEN" id="TitleEN" class="w100" value="{{TitleEN}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="MenuTitleEN"><?=MENUTITLE.LEN;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="MenuTitleEN" id="MenuTitleEN" class="w100" value="{{MenuTitleEN}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="ContentEN"><?=CONTENT.LEN;?></label>
					</div>
					<div class="col-md-9">
						<textarea name="ContentEN" id="ContentEN" rows="5" 
					class="textarea" cols="50" style="width:100%">{{ContentEN}}</textarea>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="TitleRU"><?=TITLE.LRU;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="TitleRU" id="TitleRU" class="w100" value="{{TitleRU}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="MenuTitleRU"><?=MENUTITLE.LRU;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="MenuTitleRU" id="MenuTitleRU" class="w100" value="{{MenuTitleRU}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="ContentRU"><?=CONTENT.LRU;?></label>
					</div>
					<div class="col-md-9">
						<textarea name="ContentRU" id="ContentRU" rows="5" 
					class="textarea" cols="50" style="width:100%">{{ContentRU}}</textarea>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="TitleFR"><?=TITLE.LFR;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="TitleFR" id="TitleFR" class="w100" value="{{TitleFR}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="MenuTitleFR"><?=MENUTITLE.LFR;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="MenuTitleFR" id="MenuTitleFR" class="w100" value="{{MenuTitleFR}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="ContentFR"><?=CONTENT.LFR;?></label>
					</div>
					<div class="col-md-9">
						<textarea name="ContentFR" id="ContentFR" rows="5" 
					class="textarea" cols="50" style="width:100%">{{ContentFR}}</textarea>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="TitleDE"><?=TITLE.LDE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="TitleDE" id="TitleDE" class="w100" value="{{TitleDE}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="MenuTitleDE"><?=MENUTITLE.LDE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="MenuTitleDE" id="MenuTitleDE" class="w100" value="{{MenuTitleDE}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="ContentDE"><?=CONTENT.LDE;?></label>
					</div>
					<div class="col-md-9">
						<textarea name="ContentDE" id="ContentDE" rows="5" 
					class="textarea" cols="50" style="width:100%">{{ContentDE}}</textarea>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="TitleIT"><?=TITLE.LIT;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="TitleIT" id="TitleIT" class="w100" value="{{TitleIT}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="MenuTitleIT"><?=MENUTITLE.LIT;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="MenuTitleIT" id="MenuTitleIT" class="w100" value="{{MenuTitleIT}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="ContentIT"><?=CONTENT.LIT;?></label>
					</div>
					<div class="col-md-9">
						<textarea name="ContentIT" id="ContentIT" rows="5" 
					class="textarea" cols="50" style="width:100%">{{ContentIT}}</textarea>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="TitleSE"><?=TITLE.LSE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="TitleSE" id="TitleSE" class="w100" value="{{TitleSE}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="MenuTitleSE"><?=MENUTITLE.LSE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="MenuTitleSE" id="MenuTitleSE" class="w100" value="{{MenuTitleSE}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="ContentSE"><?=CONTENT.LSE;?></label>
					</div>
					<div class="col-md-9">
						<textarea name="ContentSE" id="ContentSE" rows="5" 
					class="textarea" cols="50" style="width:100%">{{ContentSE}}</textarea>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="TitleNO"><?=TITLE.LNO;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="TitleNO" id="TitleNO" class="w100" value="{{TitleNO}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="MenuTitleNO"><?=MENUTITLE.LNO;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="MenuTitleNO" id="MenuTitleNO" class="w100" value="{{MenuTitleNO}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="ContentNO"><?=CONTENT.LNO;?></label>
					</div>
					<div class="col-md-9">
						<textarea name="ContentNO" id="ContentNO" rows="5" 
					class="textarea" cols="50" style="width:100%">{{ContentNO}}</textarea>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="TitleES"><?=TITLE.LES;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="TitleES" id="TitleES" class="w100" value="{{TitleES}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="MenuTitleES"><?=MENUTITLE.LES;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="MenuTitleES" id="MenuTitleES" class="w100" value="{{MenuTitleES}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="ContentES"><?=CONTENT.LES;?></label>
					</div>
					<div class="col-md-9">
						<textarea name="ContentES" id="ContentES" rows="5" 
					class="textarea" cols="50" style="width:100%">{{ContentES}}</textarea>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="TitleNL"><?=TITLE.LNL;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="TitleNL" id="TitleNL" class="w100" value="{{TitleNL}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="MenuTitleNL"><?=MENUTITLE.LNL;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="MenuTitleNL" id="MenuTitleNL" class="w100" value="{{MenuTitleNL}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="ContentNL"><?=CONTENT.LNL;?></label>
					</div>
					<div class="col-md-9">
						<textarea name="ContentNL" id="ContentNL" rows="5" 
					class="textarea" cols="50" style="width:100%">{{ContentNL}}</textarea>
					</div>
				</div>
			</div>
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
	
	</script>
</script>
	
