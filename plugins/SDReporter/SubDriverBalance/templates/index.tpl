<div class="white center">


	{if !isset($smarty.post.all)}
		<form action="" method="POST">
			<input type="submit" name='all' value='ALL'/> 
		</form>
	{/if}		
	<div class="row" style="border-bottom:1px solid #000;">
		<div class="col-md-2">
			<strong>ID - Subdriver</strong>
		</div>
		<div class="col-md-1">
			<strong>Deposit </strong>
		</div>
		<div class="col-sm-3 ">
			<div class="col-sm-12 ">
				<strong>Cash (until {$today})</strong>				
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
				<strong>Cash ({$today})</strong>
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
		<div class="row" style="border-bottom:1px solid #000;">

			<div class="col-md-2 pad1em">
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
