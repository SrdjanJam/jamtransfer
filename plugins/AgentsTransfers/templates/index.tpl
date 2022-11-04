{include file="{$root}/templates/add-style.tpl"}

<div class="container white">
    <h2>New Agent Invoice</h2>

    {if isset($smarty.request.NoShow) }

        
        {$smarty.request.$StartDate}{$smarty.request.$EndDate}<br>
        {if $smarty.request.NoShow eq 1}<i class="fa fa-plus"></i> No-show{/if}
        {if $smarty.request.DrErr eq 1}<i class="fa fa-plus"></i> Driver Error{/if}
        {if $smarty.request.CompletedTransfers eq 1}<i class="fa fa-plus"></i> Completed Transfers Only{/if}
        {if $smarty.request.Sistem  eq 1}<i class="fa fa-plus"></i> Sistem{/if}
        <br><br>

        <div class="row" style="font-weight:bold">

            <div class="col-md-1 text-right">
                ID
            </div>
            <div class="col-md-9">
                Agent
            </div>

        </div>
	
        {section name=index loop=$user}
            {* Agents List *}
            <div class="row row_e" style="border-bottom: 1px solid #ccc">    
                <div class="col-md-1 text-right">{$user[index].AuthUserID}</div>
                <a href="{$root_home}agentsTransfers/agentsBalance/{$user[index].AuthUserID}/{$smarty.request.StartDate}/{$smarty.request.EndDate}/{$smarty.request.Sistem}/{$smarty.request.NoShow}/{$smarty.request.DrErr}/{$smarty.request.CompletedTransfers}">
                    <div class="col-md-9 col_e">{$user[index].AuthUserCompany} {$connectedUserNamePlus[index]}</div>
                </a>
                
            </div>
            
        {/section}
		
        {else}

            <form action="" method="post">

                <div class="row">
                    <div class="col-md-2">
                        <label>Start Date</label>
                    </div>
                    <div class="col-md-4 col-md-4_e">
                        <input type="text" name="StartDate" class="form-control datepicker">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-2">
                        <label>End Date</label>
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="EndDate" class="form-control datepicker">
                    </div>
                </div>

                <div class="row"><div class="col-md-12"><hr/></div></div>

                <div class="row">
                    <div class="col-md-2">
                        <label><b>Sistems</b></label>
                    </div>
                    <div class="col-md-4">
                        Sistem <input type="checkbox" name="Sistem" class="form-control" value="1">
                    </div>
                </div>

                <div class="row"><div class="col-md-12"><hr/></div></div>

                <div class="row">
                    <div class="col-md-2">
                        <label><b>Include</b></label>
                    </div>
                    <div class="col-md-3">
                        No-show <input type="checkbox" name="NoShow" class="form-control" value="1">
                    </div>
                    <div class="col-md-3">
                        Driver error <input type="checkbox" name="DrErr" class="form-control" value="1">
                    </div>
                    <div class="col-md-4">
                        Completed transfers only <input type="checkbox" name="CompletedTransfers" class="form-control" value="1">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 col-md-offset-2">
                        <br>
                        <button class="btn btn-primary" type="submit" name="Submit" value="1">Go</button>
                        <br><br>
                    </div>
                </div>

            </form>

    {/if}


</div>


