<div class="white center">
	<form action="" method="POST">
		<div class="row">
			<div class="col-md-1">
				<label>On date</label>
			</div>	
			<div class="col-md-2">
				<input class="form-control datepicker" type="text" value="{$requestday}" name="RequestDate">
			</div>	
			<div class="col-md-4">
				<select class="form-control" name="Include" id="Include">
					<option value="1"> With balance great than 0</option>
					<option value="2"> All</option>
				</select>
			</div>
			<div class="col-md-4">
				<button type="submit" class="btn btn-primary edit-btn-primary-subbalance" name="submit">Submit</button>
			</div>	
		</div>	
	</form>
	<div class="row sum-edit-2" style="border-bottom:1px solid #000;">
		<div class="col-md-2 add-direction">
			<strong>ID - Subdriver</strong>
		</div>
		<div class="col-md-1">
			<strong>Deposit </strong>
		</div>
		<div class="col-sm-3 ">
			<div class="col-sm-12 ">
				<strong>Cash (until {$requestday})</strong>				
			</div>
			<div class="col-sm-4 ">
				<strong>Drives</strong>
			</div>	
			<div class="col-sm-4 ">
				<strong>Received</strong>
			</div>		
			<div class="col-sm-4 ">
				<strong>Expenses</strong>
			</div>			

		</div>	
		<div class="col-sm-1 ">
			<strong>Balance</strong>
		</div>				
		<div class="col-sm-3 ">
			<div class="col-sm-12 ">
				<strong>Cash ({$requestday})</strong>
			</div>					
			<div class="col-sm-4 ">
				<strong>Plan</strong>
			</div>				
			<div class="col-sm-4 ">
				<strong>In</strong>
			</div>				
			<div class="col-sm-4 ">
				<strong>Expenses</strong>
			</div>		
		</div>
		<div class="col-sm-1">
			<strong>Unapproved Expenses </strong> 
		</div>
		<div class="col-sm-1 ">
			<strong>Balance total</strong>
		</div>						
	</div>
	
	
	{section name=ind loop=$orders}
		<div class="row sum-edit-2" style="border-bottom:1px solid #000;">

			<div class="col-md-2 pad1em add-direction">
				<strong>{$orders[ind].AuthUserID}</strong> - {$orders[ind].AuthUserRealName}
			</div>

			<div class="col-md-1 pad1em">
				{$orders[ind].Deposit} 
			</div>

			<div class="col-md-1 pad1em">
				{$orders[ind].Primljeno} 
			</div>
	
			<div class="col-md-1 pad1em">
				{$orders[ind].RCash} 
			</div>

			<div class="col-md-1 pad1em">
				{$orders[ind].Trosak} 
			</div>
			
			<div class="col-md-1 pad1em">
				{$orders[ind].Balance} 
			</div>
			
			<div class="col-md-1 pad1em">
				{$orders[ind].CashPlan} 
			</div>
			
			<div class="col-md-1 pad1em">
				{$orders[ind].Primljeno2} 
			</div>
			
			<div class="col-md-1 pad1em">
				{$orders[ind].Trosak3} 				
			</div>
			 
			<div class="col-md-1 pad1em">
				{$orders[ind].Trosak2}
			</div>

			<div class="col-md-1 pad1em">
				{$orders[ind].BalanceT} 
			</div>
			
		</div>	
	{/section}
	
</div>
