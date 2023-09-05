<script type="text/x-handlebars-template" id="ItemListTemplate">
<div class="row  {{color}} pad1em listTile set-as-edit"  >
	<h3>Set as driver:</h3>

	{{#each Item}}
			<div class="col-md-3 AuthUserID-edit">
				<a  title="Sat as Driver" 
					href="satAsDriver/{{AuthUserID}}"> {{AuthUserID}} - {{AuthUserName}}</a> 
			</div>
	{{/each}}

</div>
</script>