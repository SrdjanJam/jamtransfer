	<style>
		table {
			border: 1px solid black;
		}


		td, th {
			border: 1px solid black;
			text-align: center;
		}	
	</style>
    <div class="box box-info">
        <div class="box-header">
            <i class="fa fa-credit-card"></i>
            <h3 class="box-title">{UNFINISHED_ONLINE_PAYMENT}</h3>
		</div>	
		<div class="box-body">
	<table><tr><th>{NUMBER_KEY}</th><th>{NAME}</th><th>{EMAIL}</th><th>{TIME}</th><th>{EUR}</th><!--<th>Status</th>!--></tr>
	{section name=index loop=$payments}
	<tr>
		<td>&shy; {$payments[index].MOrderKey}  </td>
		<td>&shy; {$payments[index].MPaxFirstName} {$payments[index].MPaxLastName} </td>
		<td>&shy; {$payments[index].MPaxEmail} </td>
		<td>&shy; {$payments[index].MOrderDate} {$payments[index].MOrderTime} </td>
		<td>&shy; {$payments[index].MPayNow} </td>
		<!--<td>&shy; {$payments.MPaymentStatus} </td>!-->
	</tr>			
	{/section}
	</table>
		</div>
	</div>	