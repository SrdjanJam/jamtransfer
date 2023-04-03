<script type="text/x-handlebars-template" id="ItemEditTemplate">
<form id="ItemEditForm{{ID}}" class="form box box-info" enctype="multipart/form-data" method="post" onsubmit="return false;">
	<div class="box-header">

		<div class="box-tools pull-right">
			<span id="statusMessage" class="text-info xl"></span>
			<button class="btn btn-warning" title="<?= CLOSE?>"
				onclick="return editCloseItem('{{ID}}');">
				<i class="fa fa-close"></i>
			</button>
			<button id="save_button" class="btn btn-info" title="<?= SAVE_CHANGES ?>"
				onclick="return editSaveItem('{{ID}}');">
				<i class="fa fa-save"></i>
			</button>
		</div>
	</div>
	
	<div class="box-body ">
        <div class="row">
			<div class="col-md-12">
				<!-- MSG: -->
				<div class="row">
					<div class="col-md-3">
						<label for="PageLink">Page Link</label>
					</div>
					<div class="col-md-9">
						<a target='_blank' href='<?=ROOT_HOME ?>{{PageLink}}'>{{PageLink}}</a>
					</div>
				</div>
				<!-- BODY: -->
				<div class="row">
					<div class="col-md-3">
						<label for="Message"><?=MESSAGE;?></label>
					</div>
					<div class="col-md-9">
						<textarea class="textarea" name="Body" id="Body" cols="40" rows="4"
							style="width:100%">{{Body}}</textarea>
						</div>					
					</div>
				</div>				
				
				<!-- Solver: -->
				<div class="row">
					<div class="col-md-3">
						<label for="Message">Solver</label>
					</div>
					<div class="col-md-9">
						{{userSelect SolverID "91" "SolverID"}}
					</div>
				</div>

				<!-- STATUS: -->
				<div class="row">
					<div class="col-md-3">
						<label for="Status">Solved</label>
					</div>
					<div class="col-md-9 solved">
						{{yesNoSliderEdit Status 'Status' }}						
					</div>
				</div>
				
				<!-- SOLVED TIME: -->
				<div class="row">
					<div class="col-md-3 "><label>Solved Date</label></div>
					<div class="col-md-9">
						<input type="text" name="SolvedDate" class="w75 datepicker" value="{{SolvedDate}}">
					</div>
				</div>	
				
			</div>
	    </div>
</form>
	<script>
		$('.solved input').change(function() {
			$('#save_button').trigger('click');
		})	</script>
</script>

