<div class="container white">

    <h2>{$connectedAgent}</h2>

    {if isset({$smarty.request.StartDate}) and isset({$smarty.request.EndDate}) and $smarty.request.StartDate gt 0 and $smarty.request.EndDate gt 0}

        {if $smarty.request.NoShow eq 1}<i class="fa fa-plus"></i> No-show{/if}
        {if $smarty.request.DrErr eq 1}<i class="fa fa-plus"></i> Driver Error <br><br>{/if}
        {if $smarty.request.CompletedTransfers eq 1}<i class="fa fa-plus"></i> Completed Transfers Only{/if}
        {if $smarty.request.Sistem eq 1}<i class="fa fa-plus"></i> Sistem{/if}

        <table class="table table-striped" style="white-space: nowrap">

            {section name=index loop=$transfers}

                <tr>

                    <td>
                        {counter}
                    </td>

                    <td style="vertical-align:top">
                        <b class="orderid">{$transfers[index].OrderID} - {$transfers[index].TNo}</b>
                        <br>{$transfers[index].PickupDate}
                    </td>

                    <td>
                        <b>{$transfers[index].PaxName}</b> <br/>
                        Pax:{$transfers[index].PaxNo}
                        VT:{$transfers[index].VehicleType}pax
                    </td>

                    <td>
                        <b>{$transfers[index].PickupName}<br>{$transfers[index].DropName}</b><br/>
                        Driver: <br/>{$transfers[index].DriverID} {$drivers[index]}<br/><br/>
                    </td>
                    
                    <td>
                        {$transfers[index].InvoiceAmount|number_format:2}EUR<br/>

                        {* CSV rows *}
                    </td>
                    
                    <td>
                        <button class='exclude'>Exclude</button>
                    </td>

                </tr>

            {/section}

        </table>

        <br/>Total transfers: {counter}
        | Total Invoice: {$totInv|number_format:2}

        <div align="left">

            {if $smarty.request.pm eq 4}{$proc=agentsWTransfers}{/if}
            {if $smarty.request.pm eq 6}{$proc=agentsWTransfers2}{/if}


            <a href="{$root_home}agentsTransfers/{$smarty.request.StartDate}/{$smarty.request.EndDate}/{$smarty.request.NoShow}/{$smarty.request.DrErr}/{$smarty.request.CompletedTransfers}/{$smarty.request.Sistem}"
            class="btn btn-primary">&larr; Back to Agents List</a>
            <br/>

            {* Ako bude bilo potrebno *}
            {* <input type="submit" class="btn btn-primary" value=" &larr; Back to Agents List" name="reset" /> *}

                <div class="right">
                    <a class="btn btn-danger l" style="color:white !important" id="CreateInvoice"
                    href="{$root_home}agentsTransfers/invoice/{$smarty.request.agentid}/{$smarty.request.StartDate}/{$smarty.request.EndDate}/{$smarty.request.NoShow}/{$smarty.request.DrErr}/{$smarty.request.CompletedTransfers}/{$smarty.request.Sistem}" target="_blank"><i class="fa fa-cogs"></i> Create Invoice</a> &nbsp;&nbsp;
                    <br/><br/>
                </div> {* / .right *}

        </div> {* / align="left" *}

        <hr><h4>Exported to CSV!</h4>

        <small>
            <a href="AgentBalance.csv" class="btn btn-default"><i class="fa fa-download"></i> Download CSV</a>
            You can download CSV file here (or Right-Click->Save).
            <b>File format:</b> UTF-8, semi-colon (;) delimited
        </small>

    {/if}

</div> {* / .container white *}