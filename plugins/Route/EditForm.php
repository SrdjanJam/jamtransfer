<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js" integrity="sha512-NqYds8su6jivy1/WLoW8x1tZMRD7/1ZfhWG/jcRQLOzV1k1rIODCpMgoBnar5QXshKJGV7vi0LXLNXPoFsM5Zg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script type="text/x-handlebars-template" id="ItemEditTemplate">
<form id="ItemEditForm{{RouteID}}" class="form box box-info" enctype="multipart/form-data" method="post" onsubmit="return false;">
	<div class="box-header">
		<div class="box-tools pull-right">
			
			<span id="statusMessage" class="text-info xl"></span>
			
			<? if (!$isNew) { ?>
				<button class="btn btn-warning" title="<?= CLOSE?>" 
				onclick="return editCloseItem('{{RouteID}}');">
				<i class="fa fa-close"></i>
				</button>

				<button class="btn btn-danger" title="<?= CANCEL ?>" 
				onclick="return deleteItem('{{RouteID}}');">
				<i class="fa fa-ban"></i>
				</button>
			<? } ?>	
			<button class="btn btn-info" title="<?= SAVE_CHANGES ?>" 
			onclick="return editSaveItem('{{RouteID}}');">
			<i class="fa fa-save"></i>
			</button>			
		</div>
	</div>

	<div class="box-body ">
        <div class="row">
			<div class="col-md-12 ">
				<div class="row hidden">
					<div class="col-md-3">
						<label for="OwnerID"><?=OWNERID;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="OwnerID" id="OwnerID" class="w100" value="{{OwnerID}}" readonly>
					</div>
				</div>

				<div class="row hidden">
					<div class="col-md-3">
						<label for="RouteID"><?=ROUTEID;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="RouteID" id="RouteID" class="w100" value="{{RouteID}}" readonly>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="FromID"><?=FROM;?></label>
					</div>
					<div class="col-md-9">
						{{placeSelect FromID 'FromID'}}
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="ToID"><?=TO;?></label>
					</div>
					<div class="col-md-9">
						{{placeSelect ToID 'ToID'}}
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="Approved"><?=APPROVED;?></label>
					</div>
					<div class="col-md-9">
						{{yesNoSliderEdit Approved 'Approved'}}
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="TopRoute">Top Route</label>
					</div>
					<div class="col-md-9">
						{{yesNoSliderEdit TopRoute 'TopRoute' }}
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-3">
						<label for="ToID"><?=TERMINAL;?></label>
					</div>

					<div class="col-md-9 readonly">
						<!-- Show Select: -->
						{{placeSelect TerminalID 'TerminalID'}}
					</div>

				</div>
				
				<div class="row hidden">
					<div class="col-md-3">
						<label for="RouteName"><?=ROUTENAME;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="RouteName" id="RouteName" class="w100" value="{{RouteName}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="Km"><?=KM;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="Km" id="Km" class="w100" value="{{Km}}">
					</div>
				</div>
				<div class="row">
					<div class="col-md-3">
						<label for="Duration"><?=DURATION;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="Duration" id="Duration" class="w100" value="{{Duration}}">
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
		
		$("#FromID").change(function(){
			var from = $("#FromID option:selected").text();
			var to   = $("#ToID option:selected").text();
			$("#RouteName").val(from + ' - ' + to);
		
		});
		$("#ToID").change(function(){
			var from = $("#FromID option:selected").text();
			var to   = $("#ToID option:selected").text();
			$("#RouteName").val(from + ' - ' + to);
		
		});	

		
		surTerminals(); // New route

		function surTerminals() {
			var fID=$("#FromID option:selected").val();
			var tID=$("#ToID option:selected").val();
			var base=window.location.origin;
			if (window.location.host=='localhost') base=base+'/jamtransfer';

			var link = base+'/plugins/Route/SurTerminals.php?fID='+fID+'&tID='+tID;
			var param = 'fID='+fID+'&tID='+tID;
			var $t = $(this);
			console.log(link+'?'+param);

			$('#TerminalID option').hide(); // All terminals hide

			$.ajax({
				type: 'POST',
				url: link,
				data: param,
				async: false,
				dataType: 'jsonp',

				success: function(data) {
					
					$.each(data, function(i,val) {
						$('#TerminalID option[value="'+val+'"]').show();
					});

					if (data){
						$("#TerminalID").focus(function () {
							this.size=10;
							$(this).css({"height":"auto", "position":"absolute"});
						});

						$("#TerminalID").blur(function () {
							this.size=1;
							$(this).css({"height":"20px", "position":"inherit"});
						});

					}else{
						$("#TerminalID option").text("No Terminals...");
						$("#TerminalID").css({'color':'#ff6666','font-weight':'bold'});
					}
					
					
				} // Exit success: function

			}); // End of ajax request


		} // End of surTerminals()	
		
	</script>
</script>

