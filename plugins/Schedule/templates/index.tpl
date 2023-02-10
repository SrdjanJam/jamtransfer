<style>

/* Old: */
/* .datepicker {
	width: 10em;
	text-align: center;
}
.picker__frame {
	top: 20% !important;
}
.btn-xs {
	border: 0;
}
hr {
	border-top: 1px solid #eee;
} */

/* .stupac {
	border: solid 1px #ccc;
}
.stupacWrapper {
	margin-top: 12px;
	padding: 0 2px;
}

.blink {
	background-color:red;
	color:white;
	animation: blinker 1s infinite;
}
  
@keyframes blinker {
	from { opacity: 1.0; }
	50% { opacity: 0.5; }
	to { opacity: 1.0; }
}

*/

/* new */
.row-header{
	/* background: rgb(205 216 243);  */ /* Old */
	background-image: linear-gradient(#88b7ed, #d0dff1);
	/* background-image: linear-gradient(#bcc3cb, #d0dff1); Expriment */
	box-shadow: 5px 5px 8px #616060;
	padding: 10px;
	position: sticky;
	top: 0;
    z-index: 5;
    /* margin-left: 0px; 
    margin-right: 0px; */
}
.row-header input{
	margin-bottom: 5px;
}

.row-shedule{
    margin:15px 0 0 0;
	font-size:0.85em !important;
}
.row-shedule .row{
    margin:0;
}

.row .white{
	/* border:1px solid rgb(223 223 223); Old */
	border: 3px solid rgb(136 177 217);
	border-radius:5px;
}

.row .orange{
	background-image: linear-gradient(#88b7ed, #d0dff1);
	color:#474542;
	padding:5px;
	font-size:18px;
	font-family:Georgia, 'Times New Roman', Times, serif;
}

.col-md-edit{
	padding:2px 5px;
}

.sub-card{
	/* background:#e8eef1; old */
	/* background-image: linear-gradient(#d6e6e7, #e6e7e0); old */
	background:#d6e6e7;
	margin:10px;
	padding:5px;
	border-radius:5px;
}
.sub-card .row{
	font-family: Tahoma, Verdana, Geneva, sans-serif;
	padding-top:5px;
}

.col-md-3 input{
	font-weight:bold;
	text-align:center;
}

.col-md-5 select{
	width:100%;
	height:2em;
	margin-top:5px;
}

.red{
	color: white;
}

.blink {
	background-color:red;
	color:white;
	animation: blinker 2s ease 0s infinite normal forwards;
}

@keyframes blinker {
	0% {
		opacity: 1;
	}

	50% {
		opacity: 0.2;
	}

	100% {
		opacity: 1;
	}
}

.fa-user{
	color:#2a2a2a;
}

.add-hiddenInfo{
	/* background: #F5F5F5; */ /* Old */
	background: #eef8f4;
	padding:10px;
}

.sub-card textarea{
	width:100%;
}
.sub-card .row button{
	padding:5px;
	border-radius: 5px;
}

</style>

	<!-- HEADER: -->
	<div class="row row-header">

		<form  action="" method="post" onsubmit="return validate()">
			<div class="col-sm-2">
				<input id="DateFrom" class="datepicker form-control" name="DateFrom" value="{$DateFrom}" style="border:2px solid black;">
			</div>
			<div class="col-sm-2">
				<input id="DateTo" class="datepicker form-control" name="DateTo" value="{$DateTo}" style="border:2px solid black;">
			</div>	
			<div class="col-sm-2">
				<select name="NoColumns" class="form-control">
					<option value="1" {if $NoColumns eq 1}selected{/if}>1 {$COLUMN}</option>
					<option value="2" {if $NoColumns eq 2}selected{/if}>2 {$COLUMN}</option>
					<option value="3" {if $NoColumns eq 3}selected{/if}>3 {$COLUMN}</option>
					<option value="4" {if $NoColumns eq 4}selected{/if}>4 {$COLUMN}</option>
					<option value="6" {if $NoColumns eq 6}selected{/if}>6 {$COLUMN}</option>
					<option value="12" {if $NoColumns eq 12}selected{/if}>12 {$COLUMN}</option>
				</select>		
			</div>			
			<div class="col-sm-2">
				<select name="DriverStatus" class="form-control">
					<option value="0" {if $DriverStatus eq 0}selected{/if}>{$DISPLAY_ALL}</option>
					<option value="1" {if $DriverStatus eq 1}selected{/if}>{$NOT_READY}</option>
					<option value="2" {if $DriverStatus eq 2}selected{/if}>{$READY_FINISHED}</option>
				</select>		
			</div>
			<div class="col-sm-2">
				<button type="submit" class="btn btn-primary">Go</button>
			</div>
		</form> <!-- /form -->
	</div> <!-- /.row -->

	<!-- MAIN CONTENT: -->
	<div class="row row-shedule">

		{section name=pom loop=$sdArray}
			
			<!-- Column one: -->
			<div class="col-md-{$BsColumnWidth} col-md-edit">

				<!-- One card: -->
				<div class="row white shadow border">

					<div class="row orange white-text">
						<strong>{$sdArray[pom].DriverName}</strong>	
						<a href="tel:{$sdArray[pom].Mob}">{$sdArray[pom].Mob}</a>
					</div>

					{if count($ordersArray)}
						{section name=pom2 loop=$ordersArray}

							{if ($sdArray[pom].DriverID eq $ordersArray[pom2].SubDriver) or
								($sdArray[pom].DriverID eq $ordersArray[pom2].SubDriver2) or
								($sdArray[pom].DriverID eq $ordersArray[pom2].SubDriver3) or
								($ordersArray[pom2].SubDriver eq 0 and $sdArray[pom].DriverID eq $smarty.session.UseDriverID)
							}

								{include file='plugins/Schedule/templates/oneTransfer.tpl'}

							{/if}
						
						{/section}

						{else}
							No Choosen Schedule.

					{/if}

				</div>	<!-- /.row white shadow border (One card) -->
					
			</div> {* col-md-{$BsColumnWidth} *}

			
		
		{/section}

	</div> <!-- /.row row-shedule -->
