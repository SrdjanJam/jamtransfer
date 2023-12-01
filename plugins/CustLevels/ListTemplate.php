<script type="text/x-handlebars-template" id="ItemListTemplate">

	<div class="row row-edit">
		<!-- LevelID: -->
		<div class="col-md-1">
			LevelID
		</div>
		<!-- LevelName: -->
		<div class="col-md-2">
			LevelName
		</div>	
		<!-- CountRange: -->
		<div class="col-md-2">
			CountRange
		</div>
		<!-- ValueRange: -->
		<div class="col-md-2">
			ValueRange
		</div>
		<!-- Discount: -->
		<div class="col-md-2">
			Discount
		</div>		
				
	</div>

	{{#each Item}}
		<div onclick="oneItem({{LevelID}});">
		
			<div class="row {{color}} pad1em listTile cursor-list" 
			style="border-top:1px solid #ddd" 
			id="t_{{LevelID}}">
				<form>
					<!-- LevelID: -->
					<input type="hidden" name="LevelID" class="LevelID"  value="{{LevelID}}">
					<div class="col-md-1">
						<strong>{{LevelID}}</strong>
					</div>
					<!-- LevelName: -->
					<div class="col-md-2">
						<input type="text" name="LevelName" id="LevelName" value="{{LevelName}}" data-id="{{LevelID}}">
					</div>
					<!-- CountRange: -->
					<div class="col-md-2">
						<input type="text" name="CountRange" id="CountRange" value="{{CountRange}}" data-id="{{LevelID}}">
					</div>
					<!-- ValueRange: -->
					<div class="col-md-2">
						<input type="text" name="ValueRange" id="ValueRange" value="{{ValueRange}}" data-id="{{LevelID}}">
					</div>
					<!-- Discount: -->
					<div class="col-md-2">
						<input type="text" name="Discount" id="Discount" value="{{Discount}}" data-id="{{LevelID}}">
					</div>
				</form>					
					
			</div>
		</div>

	{{/each}}

	<script>
		$('input').change(function(){
			var base=window.location.origin;
			if (window.location.host=='localhost') base=base+'/jamtransfer';		
			var link = base+'/plugins/CustLevels/Save.php';

			var id=$(this).attr("data-id");
			var param = $("#t_"+id).find("form").serialize();
			
			console.log(link+'?'+param);
			$.ajax({
				type: 'POST',
				url: link,
				data: param,
				success: function(data) {
					$('#t_ .LevelID').val(data);
					toastr['success'](window.success);	
				}				
			});
			
		});
	</script>


</script>
	
