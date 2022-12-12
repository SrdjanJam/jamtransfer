<style>

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
}	 */

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

/* new */
.row-header{
	background: rgb(205 216 243);
	padding: 10px;
}

.row-shedule{
    margin:15px 0 0 0;
	font-size:0.85em !important;
}
.row-shedule .row{
    margin:0;
}

.row-white{
	border:1px solid rgb(190, 190, 190);
	border-radius:5px;
}

.row .orange{
	color:#474542;
	padding:5px;
	font-size:18px;
}

.col-md-edit{
	padding:2px 5px;
}

.sub-card{
	background:#e0f1f8;
	margin:10px;
	padding:10px;
	border-radius:5px;
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

</style>

	<!-- HEADER: -->
	<div class="row row-header">
		<div class="col-sm-3">	
			<button class="btn" onclick="hideChecked()">{$DISPLAY_NOT_CHECKED}</button>
			<button class="btn" onclick="displayAll()">{$DISPLAY_ALL}</button>
		</div>

		<form  action="" method="post" onsubmit="return validate()">
			<div class="col-sm-3">
				From
				<input id="DateFrom" class="datepicker" name="DateFrom" value="{$DateFrom}">
			</div>
			<div class="col-sm-3">
				to
				<input id="DateTo" class="datepicker" name="DateTo" value="{$DateTo}">
			</div>	
			<div class="col-sm-3">
				with
				<select name="NoColumns">
					<option value="1" {if $NoColumns eq 1}selected{/if}>1</option>
					<option value="2" {if $NoColumns eq 2}selected{/if}>2</option>
					<option value="3" {if $NoColumns eq 3}selected{/if}>3</option>
					<option value="4" {if $NoColumns eq 4}selected{/if}>4</option>
					<option value="6" {if $NoColumns eq 6}selected{/if}>6</option>
					<option value="12" {if $NoColumns eq 12}selected{/if}>12</option>
				</select>
				columns
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
				<div class="row-white shadow border">

					<div class="row orange white-text">
						<strong>{$sdArray[pom].DriverName}</strong>	
					</div>

					{section name=pom2 loop=$ordersArray}

						{if ($sdArray[pom].DriverID eq $ordersArray[pom2].SubDriver) or
							($sdArray[pom].DriverID eq $ordersArray[pom2].SubDriver2) or
							($sdArray[pom].DriverID eq $ordersArray[pom2].SubDriver3)}

							<!-- Sub card: -->
							<div class="sub-card">
								{* row first *}
								<div class="row"> <!-- TRANSFER -->
									<span>

										{if $ordersArray[pom2].UserLevelID eq '2'}
											<i class='fa fa-user-secret'></i>
												{if $ordersArray[pom2].Image ne ""}
													<img src='i/agents/{$ordersArray[pom2].Image}'>	 
													<b>{$ordersArray[pom2].AuthUserRealName}</b>
												{/if}
										{/if}

									</span>					
									<strong>
										<a href="orders/detail/{$ordersArray[pom2].DetailsID}" target="_blank">
											{$ordersArray[pom2].MOrderKey}-{$ordersArray[pom2].OrderID}-{$ordersArray[pom2].TNo}
										</a>
									</strong>
								</div>

								<!-- row second -->	
								<div class="row">
									<h4>{$ordersArray[pom2].PickupName} - {$ordersArray[pom2].DropName}</h4>

									{if $ordersArray[pom2].flightTimeConflict}
										<span class='blink'>{$FLIGHT_TIME_CONFLICT}</span>
										{$ordersArray[pom2].FlightTime}
									{/if}

									{$ordersArray[pom2].changedIcon}
									
								</div>

								<!-- row third -->	
								<div class="row">

									<div class="col-md-3">
										{* {$ordersArray[pom2].changedIcon} *} {* premesteno *}
											<input type="text" class="timepicker w100 form-control {$ordersArray[pom2].color}" id="SubPickupTime_{$ordersArray[pom2].DetailsID}"
											name="SubPickupTime_{$ordersArray[pom2].DetailsID}"
											value="{$ordersArray[pom2].SubPickupTime}" onchange="saveTransfer({$ordersArray[pom2].DetailsID},0)"
												>
										
									</div>
								
									<div class="col-md-3">
										<input type="text" class="w100 form-control {$ordersArray[pom2].color2}"  id="PickupTimeX_{$ordersArray[pom2].DetailsID}"
											name="PickupTimeX_{$ordersArray[pom2].DetailsID}"
											value="{$ordersArray[pom2].PickupTime}" 
											/>
									</div>
									<!-- info icons -->
									<div class="col-md-3 small align-middle">
										<div>
											<i class="fa fa-user"></i>&nbsp;&nbsp;{$ordersArray[pom2].PaxNo}
										</div>

										<div>
											<i class="fa fa-car {$ordersArray[pom2].carColor} pad4px"></i> 

											{$ordersArray[pom2].VehicleTypeName}
											{if $ordersArray[pom2].VehiclesNo gt 1} x {$ordersArray[pom2].VehiclesNo} {/if}

											<br>
										</div>
									</div>

									<div class="col-md-3">
										<div>
											<i class="fa fa-clock-o"></i>
											<input type="text" name="TransferDuration_{$ordersArray[pom2].DetailsID}" 
											id="TransferDuration_{$ordersArray[pom2].DetailsID}" class="form-control" size="2" value="{$ordersArray[pom2].TransferDuration}" 
											title="Transfer duration"  onchange="saveTransfer({$ordersArray[pom2].DetailsID},0)">
										</div>	
										<div>
											{if $ordersArray[pom2].extras ne ''}<i class="fa fa-cubes red-text"></i>{/if}
										</div>
									</div>

								</div> <!-- /.row -->

								<!-- row forth -->					
								<div class="row" style="line-height:140%">
									<div class="col-md-5">
										<select class="subdriver1" data-id="{$ordersArray[pom2].DetailsID}"
										id="SubDriver_{$ordersArray[pom2].DetailsID}" name="SubDriver_{$ordersArray[pom2].DetailsID}" onchange="saveTransfer({$ordersArray[pom2].DetailsID},0)">
											<option value='0'> --- </option>
											{section name=pom3 loop=$sddArray}
												<option value="{$sddArray[pom3].DriverID}" data-mob="{$sddArray[pom3].Mob}";
												{if $sddArray[pom3].DriverID eq $ordersArray[pom2].SubDriver}
													selected
												{/if}	
												>{$sddArray[pom3].DriverName}</option>';
											{/section}	
										</select>
									</div>
								</div>
								
								{* Hidden or not: *}
								<div class="row {if  $ordersArray[pom2].SubDriver2 eq 0}hidden{/if}" style="line-height:140%">
									<div class="col-md-5">
										<select class="subdriver1" data-id="{$ordersArray[pom2].DetailsID}"
										id="SubDriver_{$ordersArray[pom2].DetailsID}" name="SubDriver_{$ordersArray[pom2].DetailsID}" onchange="saveTransfer({$ordersArray[pom2].DetailsID},0)">
											<option value='0'> --- </option>
											{section name=pom3 loop=$sddArray}
												<option value="{$sddArray[pom3].DriverID}" data-mob="{$sddArray[pom3].Mob}";
												{if $sddArray[pom3].DriverID eq $ordersArray[pom2].SubDriver2}
													selected
												{/if}	
												>{$sddArray[pom3].DriverName}</option>';
											{/section}	
										</select>
									</div>
								</div>

								{* Hidden or not: *}
								<div class="row {if  $ordersArray[pom2].SubDriver3 eq 0}hidden{/if}" style="line-height:140%">
									<div class="col-md-5">
										<select class="subdriver1" data-id="{$ordersArray[pom2].DetailsID}"
										id="SubDriver_{$ordersArray[pom2].DetailsID}" name="SubDriver_{$ordersArray[pom2].DetailsID}" onchange="saveTransfer({$ordersArray[pom2].DetailsID},0)">
											<option value='0'> --- </option>
											{section name=pom3 loop=$sddArray}
												<option value="{$sddArray[pom3].DriverID}" data-mob="{$sddArray[pom3].Mob}";
												{if $sddArray[pom3].DriverID eq $ordersArray[pom2].SubDriver3}
													selected
												{/if}	
												>{$sddArray[pom3].DriverName}</option>';
											{/section}	
										</select>
									</div>
								</div>
							
							</div> <!-- /.sub-card -->

						{/if}
					
					{/section}

				</div>	<!-- /.row white shadow border (One card) -->
					
			</div> {* col-md-{$BsColumnWidth} *}

			
		
		{/section}

	</div> <!-- /.row row-shedule -->
