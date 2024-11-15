<div class="">
	<div class="row"><strong>
		<div class="col-md-1">
			{$ID}
		</div>			
		<div class="col-md-3">
			{$NAME}
		</div>		
		<div class="col-md-3">
			{$EMAIL}
		</div>			
		<div class="col-md-1">
			{$VEHICLES}
		</div>			
		<div class="col-md-1">
			{$SUBDRIVERS}
		</div>			
		<div class="col-md-1">
			{$ASSIGN}
		</div>			
		<div class="col-md-1">
			{$TRANSFERS} {$ASSIGN}
		</div>			
		<div class="col-md-1">
			{$FUTURE_TRANSFERS}
		</strong></div>
	</div>
	{section name=pom loop=$table}
		<div class="row">
			<div class="col-md-1">
				{$table[pom].DriverID}
			</div>			
			<div class="col-md-3">
				<small class="link" data-link="{$table[pom].Link}">{$table[pom].DriverName}</small>
			</div>			
			<div class="col-md-3">
				<small class="email">{$table[pom].Email}</small>
			</div>			
			<div class="col-md-1">
				{$table[pom].Vehicles}
			</div>			
			<div class="col-md-1">
				{$table[pom].SubDrivers}
			</div>			
			<div class="col-md-1">
				{$table[pom].Assign}
			</div>			
			<div class="col-md-1">
				{$table[pom].TransfersAssign}
			</div>			
			<div class="col-md-1">
				{$table[pom].Transfers}
			</div>
		</div>
	{/section}
	<div class="row"><strong>	
		<div class="col-md-1">
			&nbsp;
		</div>			
		<div class="col-md-6">
			&nbsp;
		</div>			
		<div class="col-md-1">
			{$Vehicles}
		</div>			
		<div class="col-md-1">
			{$SubDrivers}
		</div>			
		<div class="col-md-1">
			{$Assign}
		</div>			
		<div class="col-md-1">
			{$TransfersAssign}
		</div>			
		<div class="col-md-1">
			{$Transfers}
		</strong></div>
	</div>	
</div> 

<script>
	$(".email").click(function(){
		navigator.clipboard.writeText($(this).text());
	})	
	$(".link").click(function(){
		navigator.clipboard.writeText($(this).attr("data-link"));
	})
</script>