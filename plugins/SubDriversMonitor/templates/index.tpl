
	<div class="row row-eq-height">
		{section name=pom loop=$sdArray}
			{*if $sdArray[pom].Mob && $sdArray[pom].Vehicle*}
			<!-- Column one: -->
			<div class="col-lg-3 col-md-4" style="border-style: solid; border-color: gray;">				
				<!-- One card: -->
				<strong>{$sdArray[pom].DriverName}</strong>	
				<br><a href="tel:{$sdArray[pom].Mob}">{$sdArray[pom].Mob}</a>
				<br>{$sdArray[pom].Vehicle}
				<br><i class="{$sdArray[pom].IconPositon}" aria-hidden="true"></i> <small>{$sdArray[pom].Device}<br>{$sdArray[pom].Location}</small><br>
				{if $sdArray[pom].foundlocation}<iframe src="https://maps.google.com/maps?q={$sdArray[pom].Lat},{$sdArray[pom].Lng} &z=8&output=embed"  frameborder="0" style="border:0"></iframe>{/if}
				<br>
			</div>
			{*/if*}
		{/section}
	</div>
	
