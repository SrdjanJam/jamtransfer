<h2>Check Driver on Route</h2>
<h1>{$terminalname}</h1>
<table>
	<tr>
		<th>ID</th>
		<th>Route</th>
		<th>Count</th>
	</tr>
	{section name=pom loop=$routes}
		<tr>
			<td class='routeid'>{$routes[pom].id}</td>		
			<td>{$routes[pom].name}</td>
			<td>{$routes[pom].count}</td>
		</tr>
	{/section}
</table>	

<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script>
	$('document').ready(function(){
	})	
	
</script>