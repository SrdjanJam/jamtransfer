
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
		<div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1{{RouteID}}" data-toggle="tab"><?= ROUTE ?></a></li>
                <li><a href="#tab_2{{RouteID}}" data-toggle="tab"><?= SURCHARGES ?></a></li>
            </ul>
			<div class="tab-content">
				<div class="tab-pane active" id="tab_1{{RouteID}}">		
					<div class="row">
						<div class="col-md-6">
							<div class="row">
								<div class="col-md-3">
									<label for="ID"><?=ID;?></label>
								</div>
								<div class="col-md-9">
									<input type="text" name="ID" id="ID" class="w100" value="{{ID}}" readonly>
								</div>
							</div>

							<div class="row">
								<div class="col-md-3">
									<label for="SiteID"><?=SITEID;?></label>
								</div>
								<div class="col-md-9">
									<input type="text" name="SiteID" id="SiteID" class="w100" value="{{SiteID}}" readonly>
								</div>
							</div>

							<div class="row">
								<div class="col-md-3">
									<label for="OwnerID"><?=OWNERID;?></label>
								</div>
								<div class="col-md-9">
									<input type="text" name="OwnerID" id="OwnerID" class="w100" value="{{OwnerID}}" readonly>
								</div>
							</div>

							<div class="row">
								<div class="col-md-3">
									<label for="RouteID"><?=ROUTEID;?></label>
								</div>
								<div class="col-md-9">
									<input type="text" name="RouteID" id="RouteID" class="w100" value="{{RouteID}}" readonly>
								</div>
							</div>

							<div class="row">
								<div class="col-md-3">
									<label for="Active"><?=ACTIVE;?></label>
								</div>
								<div class="col-md-9">
									{{yesNoSelect Active 'Active'}}
								</div>
							</div>

							<div class="row">
								<div class="col-md-3">
									<label for="Approved"><?=APPROVED;?></label>
								</div>
								<div class="col-md-9">
									{{yesNoSelect Approved 'Approved'}}
								</div>
							</div>

							<div class="row">
								<div class="col-md-3">
									<label for="RouteName"><?=ROUTENAME;?></label>
								</div>
								<div class="col-md-9">
									<input type="text" name="RouteName" id="RouteName" class="w100" value="{{RouteName}}" readonly>
								</div>
							</div>

							<div class="row">
								<div class="col-md-3">
									<label for="Km"><?=KM;?></label>
								</div>
								<div class="col-md-9">
									<input type="text" name="Km" id="Km" class="w100" value="{{Km}}" 
										{{#compare Km ">" 0}} readonly {{/compare}}
									>
								</div>
							</div>

							<div class="row">
								<div class="col-md-3">
									<label for="Duration"><?=DURATION;?></label>
								</div>
								<div class="col-md-9">
									<input type="text" name="Duration" id="Duration" class="w100" value="{{Duration}}"
									{{#compare Duration ">" 0}} readonly {{/compare}}
									>
								</div>
							</div>
				
							<div class="row">
								<div class="col-md-3">
									<label for="OneToTwo"><?=ONETOTWO;?></label>
								</div>
								<div class="col-md-9">
									{{yesNoSelect OneToTwo 'OneToTwo'}}
								</div>
							</div>

							<div class="row">
								<div class="col-md-3">
									<label for="TwoToOne"><?=TWOTOONE;?></label>
								</div>
								<div class="col-md-9">
									{{yesNoSelect TwoToOne 'TwoToOne'}}
								</div>
							</div>

						</div>

					</div> {{!-- row --}}				
				</div> {{!-- tab-pane tab_1 --}}
				
				<div class="tab-pane" id="tab_2{{RouteID}}">
					<div class="row">
						<div class="col-md-3">
							<label for="SurCategory"><?=SURCATEGORY;?></label>
						</div>
						<div class="col-md-9">
							<select name="SurCategory" id="SurCategory" class="w100" onchange="routeSurcharges({{ID}});">
								{{#select SurCategory}}
									<option value="1"><?= USE_GLOBAL ?></option>
									<option value="3"><?= ROUTE_SPECIFIC ?></option>
									<option value="0"><?= NO_SURCHARGES ?></option>
								{{/select}}								
							</select>
							
							<input type="hidden" name="SurID" id="SurID" class="w100" value="{{SurID}}">
						</div>
					</div>
					<div id="routeSurcharges{{ID}}"></div>

				</div> {{!-- tab-pane tab_2 --}}
			</div>
		</div>	
	</div>	
</form>


	<script>
		// init 
		//routeSurcharges({{ID}});
	
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
	</script>
</script>

