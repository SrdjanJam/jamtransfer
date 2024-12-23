<html>
<body>

<style>
	div {
		border-collapse: collapse;
	}
	input {
		width: 100px;
		text-align: center;
	}
	.selected {
		background-color: #e0e0e0;
	}
</style>


<form action="" method="POST">
<div class="container">
	<button class="btn btn-success pull-right" type="submit" name="submit" id="Save">{$SAVE}</button>	
	<div class="row">
		<div class="col-md-1">
		</div>
		{section name=pom1 loop=$days}
			<div class="col-md-1">
				{$days[pom1]}
			</div>
		{/section}
	</div>	
	{assign var=i value=0}
	{section name=ind loop=$cell}
		<div class="row">
			<div class="col-md-1">
				{$hours[ind]}
			</div>
			{assign var=j value=0}
			{section name=ind2 loop=$cell[ind]}
				<div class="col-md-1">
					<input data-x="{$j}" data-y="{$i}" class="form-control cell" name="cell[{$i}][{$j}]" type="text" value="{$cell[ind][ind2]}">
				</div>
				{assign var=j value=$j+1}	
			{/section}
		</div>
		{assign var=i value=$i+1}
	{/section}
</div>

</form>
</body>
<script>
$('document').ready(function() {
	let copiedValue = null;
	let startCell = null;
	let endCell = null;
	
	// Handle cell selection
	$('.cell').on('mousedown', function(e) {
		// Clear previous selections
		$('.cell').removeClass('selected');
		
		// Mark current cell as start of selection
		var startCell = $(this);
		startCell.addClass('selected');
		var startX=startCell.attr("data-x");
		var startY=startCell.attr("data-y");
		
		// Track mouse movement for range selection
		$('.cell').on('mousemove', function() {
			var endCell = $(this);
			
			// Clear all previous selections
			$('.cell').removeClass('selected');
			var endX=endCell.attr("data-x");
			var endY=endCell.attr("data-y");
			var x1 = Math.min(startX, endX);
			var x2 = Math.max(startX, endX);
			var y1 = Math.min(startY, endY);
			var y2 = Math.max(startY, endY);
			$('.cell').each(function(){
				if (
					$(this).attr('data-x')<x1 ||
					$(this).attr('data-x')>x2 ||						
					$(this).attr('data-y')<y1 ||
					$(this).attr('data-y')>y2 
				) {
					var not=true;	
				} else	{ 
					$(this).addClass('selected');
				}
			})

		});		
	});		
	// Stop mouse tracking when mouse up
	$('.cell').on('mouseup', function() {
		$('.cell').off('mousemove');
	});			
	// Copy functionality (Ctrl+C)
	$('.cell').on('keydown', function(e) {
		if (e.ctrlKey && e.key === 'c') {
			let selectedCells = $('.cell.selected');
			
			if (selectedCells.length > 0) {
				// For single cell
				if (selectedCells.length === 1) {
					copiedValue = selectedCells.first().val();
				} 
				// For multiple cells
				else {
					// Collect values in a 2D array
					copiedValue = [];
					let currentRow = [];
					let lastRowIndex = -1;
					
					selectedCells.each(function() {
						let rowIndex = $(this).attr("data-y");
						
						if (rowIndex !== lastRowIndex && lastRowIndex !== -1) {
							copiedValue.push(currentRow);
							currentRow = [];
						}
						
						currentRow.push($(this).val());
						lastRowIndex = rowIndex;
					});
					
					// Add last row
					if (currentRow.length > 0) {
						copiedValue.push(currentRow);
					}
				}
				e.preventDefault();
			}
		}
	});
	// Paste functionality (Ctrl+V)
	$('.cell').on('keydown', function(e) {
		if (e.ctrlKey && e.key === 'v') {
			let selectedCells = $('.cell.selected');
			if (copiedValue !== null && selectedCells.length > 0) {
				// Single value paste
				if (typeof copiedValue === 'string') {
					selectedCells.val(copiedValue);
				} 
				// 2D array paste
				else if (Array.isArray(copiedValue)) {
					let startRow = parseInt(selectedCells.first().attr("data-y"));
					let startCol = parseInt(selectedCells.first().attr("data-x"));
					
				
					copiedValue.forEach((row, rowOffset) => {
						row.forEach((value, colOffset) => {
							let targetRow = startRow + rowOffset;

							let targetCol = startCol + colOffset;
							// Ensure we don't go out of bounds
							if (targetRow < 24 && targetCol<7) {
								$('.cell').each(function(){
									if ($(this).attr('data-x')==targetCol && $(this).attr('data-y')==targetRow) $(this).val(value);
								})
							}
						});
					});
				}
				e.preventDefault();
			}
		}
	});		
	
	
})
</script>
</html>