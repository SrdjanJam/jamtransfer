<script type="text/x-handlebars-template" id="ItemListTemplate">
<div class="row  {{color}} pad1em listTile"  >
	{{#each Item}}
		<a  title="Sat as Driver" 
		href="satAsDriver/{{AuthUserID}}">					
			<div class="col-md-1" style="border:1px solid #ddd"> {{AuthUserID}} </div>
			<div class="col-md-2" style="border:1px solid #ddd"> {{AuthUserName}} </div>	
		</a>
	{{/each}}
</div>
</script>