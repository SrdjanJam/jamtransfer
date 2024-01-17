<?
	$arr_row['id']=1;
	$arr_row['name']="Expence";
	$arr_all[]=$arr_row;		
	$arr_row['id']=2;
	$arr_row['name']="Tasks";
	$arr_all[]=$arr_row;
	$smarty->assign('options',$arr_all);
	$smarty->assign('selecttype',true);
?>	
<script type="text/x-handlebars-template" id="ItemListTemplate">

	<div class="row row-edit">
		
		<div class="col-md-1">
			<?=REQUEST_ID;?>
		</div>

		<div class="col-md-2">
			<?=REQUEST_TITLE;?>
		</div>

		<div class="col-md-1" style="font-size: 15px;">
			<?=DISPLAY_ORDER;?>
		</div>

		<div class="col-md-3">
			<?=ACTIVE;?>
		</div>

		<div class="col-md-3">
			<?=TITLE;?>
		</div>

		<div class="col-md-1">
			<?=DELETE;?>
		</div>
					
	</div>

	{{#each Item}}
		<div  onclick="oneItem({{ID}});">
		
			<div class="row {{color}} pad1em listTile cursor-list" 
			style="border-top:1px solid #ddd" 
			id="t_{{ID}}">
		
				<div class="col-md-1">
					<strong>{{ID}}</strong>
				</div>

				<div class="col-md-2">
					{{Title}}
				</div>

				<div class="col-md-1 displayorder">
					<input type="text" name="DisplayOrder" id="DisplayOrder" value="{{DisplayOrder}}" data-id="{{ID}}" style="width: -webkit-fill-available;">
				</div>

				<!-- RequestType This method is in the Jquery file: -->
				<div class="col-md-3 surcategory">
					<span>{{RequestType Active ID}}</span>
				</div>

				<div class="col-md-3 title">
					<input type="text" name="Title" id="Title" class="w100" value="{{Title}}" data-id="{{ID}}" style="width: -webkit-fill-available;">
				</div>

				<div class="col-md-1">
					<button type="button" class="b-delete" style="color:red;" title="delete" data-id="{{ID}}">
						<i class="fas fa-trash-alt"></i>
					</button>
				</div>

			</div>
		</div>

	{{/each}}


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
		// surcategory:
		$('.surcategory input').change(function(){
			var surcategory=$(this).val();
			var id=$(this).attr('data-id');
			var base=window.rootbase;
			if (window.location.host=='localhost') base=base;		
			var link = base+'plugins/Request/Save.php';
			var param = "RequestID="+id+"&Active="+surcategory;
			console.log(link+'?'+param);
			$.ajax({
				type: 'POST',
				url: link,
				data: param,
				success: function(data) {
        			toastr['success'](window.success);		
    			}
			});
		})
		// title:
		$('.title input').change(function(){
			var title=$(this).val();
			var id=$(this).attr('data-id');
			var base=window.rootbase;
			if (window.location.host=='localhost') base=base;		
			var link = base+'plugins/Request/Save.php';
			var param = "RequestID="+id+"&Title="+title;
			console.log(link+'?'+param);
			$.ajax({
				type: 'POST',
				url: link,
				data: param,
				success: function(data) {
        			toastr['success'](window.success);		
    			}
			});
		})
		// displayorder:
		$('.displayorder input').change(function(){
			var displayorder=$(this).val();
			var id=$(this).attr('data-id');
			var base=window.rootbase;
			if (window.location.host=='localhost') base=base;		
			var link = base+'plugins/Request/Save.php';
			var param = "RequestID="+id+"&DisplayOrder="+displayorder;
			console.log(link+'?'+param);
			$.ajax({
				type: 'POST',
				url: link,
				data: param,
				success: function(data) {
        			toastr['success'](window.success);		
    			}
			});
		})
		// Delete:
		$('.b-delete').click(function(){
			if (confirm("Are you sure to delete this row?")) {

				var base=window.rootbase;
				if (window.location.host=='localhost') base=base;

				var link = base+'plugins/Request/Delete.php';
				var param = "id="+ $(this).attr('data-id');
				console.log(link+'?'+param);
				
				$.ajax({
					type: 'POST',
					url: link,
					data: param,
					success: function(data) {
						$('#t_ .ID').val(data);
						toastr['success'](window.delete);
					}				
				});
				// Hide div row:
				$(this).parent().parent().hide(500);
			}
			return false;
		});

</script>


</script>
	
