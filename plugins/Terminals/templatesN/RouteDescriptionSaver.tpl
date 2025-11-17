<h2>{if $smarty.request.main eq 1}Main{else}Top{/if} route Description Saver</h2>
<h1>{$terminalname}</h1>
<table>
	<tr>
		<th>ID</th>
		<th>Route</th>
		<th>Km</th>
		<th>Duration</th>
		<th>Link</th>
	</tr>
	{section name=pom loop=$routes}
		<tr>
			<td class='routeid'>{$routes[pom].id}</td>		
			<td>{$routes[pom].name}</td>
			<td>{$routes[pom].km}</td>
			<td>{$routes[pom].duration}</td>
			<td>{$routes[pom].link}</td>
		</tr>
	{/section}
</table>	
<button id="copy" type="button">COPY</button>
<form action="" method="post">
	<fieldset>
		<legend>Route ID</legend>

		<label for="name">Route ID:</label><br>
		<input type="text" id="RouteID" name="RouteID" required><br><br>


	<fieldset>
		<legend>Generated HTML</legend>
		<label for="message">Generated HTML:</label><br>
		<textarea id="HTML" name="HTML" rows="5" cols="100"></textarea><br><br>
	</fieldset>

	<input type="submit" name="submit" value="Submit">
</form>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script>
	$('document').ready(function(){
		$('.routeid').click(function(){
			$('#RouteID').val($(this).html());
		})	
		$('#copy').click(function(){
			var $temp = $("<input>");
			$("body").append($temp);
			$temp.val($('table').text()).select();
			document.execCommand("copy");
			$temp.remove();
		})
	})	
	
</script>