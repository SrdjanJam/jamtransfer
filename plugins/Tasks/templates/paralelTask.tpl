	<table>
		<tr>
			<th>
				Title
			</th>
			{section name=pom loop=$list_all}
				<th>
					{$list_all[pom].datum}
				</th>		
			{/section}	
		</tr>
		{section name=pom2 loop=$checklist}
			<tr>
				<td>
					{$checklist[pom2].title}
				</td>
				{section name=pom loop=$list_all}
					<td>
						<img width='100' src='{$checklist[pom2].photo[{$list_all[pom].id}]}'/>
					</td>		
				{/section}			
			</tr>	
		{/section}	
	</table>	

