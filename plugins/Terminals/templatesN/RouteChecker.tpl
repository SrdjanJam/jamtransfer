<h2>{$ROUTE_CHECKER}</h2>
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
