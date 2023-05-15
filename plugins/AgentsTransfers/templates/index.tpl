{include file="{$root}/templates/add-style.tpl"}

<div class="container white">

    <div class="agent-invoice">
        <h2>New Agent Invoice</h2>
    </div>

    {if isset($smarty.request.StartDate) && isset($smarty.request.EndDate) }
        

        
        {$smarty.request.StartDate}{$smarty.request.EndDate}<br>
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

                {* Checkbox: *}
                <div class="row-checkbox-edit">

                    <div class="row"><div class="col-md-12"><hr/></div></div>

                    <div class="row">
                        <div class="col-md-2">
                            <label><b>Sistems</b></label>
                        </div>
                        <div class="col-md-2">
                            <div>Sistem</div> <input type="checkbox" name="Sistem" value="1">
                        </div>
                    </div>

                    <div class="row"><div class="col-md-12"><hr/></div></div>

                    <div class="row">
                        <div class="col-md-2">
                            <label><b>Include</b></label>
                        </div>
                        <div class="col-md-2">
                            <div>No-show</div><input type="checkbox" name="NoShow" value="1">
                        </div>
                        <div class="col-md-2">
                            <div>Driver error</div><input type="checkbox" name="DrErr" value="1">
                        </div>
                        <div class="col-md-4">
                            <div>Completed transfers only</div><input type="checkbox" name="CompletedTransfers" value="1">
                        </div>
                    </div>

                    <div class="row">
                        <!-- select all boxes -->
                        <div class="col-md-1 col-md-offset-1">
                            <div style="color:rgb(21 85 229);">Check All</div><input type="checkbox" name="select-all" id="select-all" />
                        </div>	
                    </div>

                </div> <!-- End of .row-checkbox-edit -->

                <div class="row">
                    <div class="col-md-4 col-md-offset-2">
                        <br>
                        <button class="btn btn-primary go-edit" type="submit" name="Submit" value="1">Go</button>
                        <br><br>
                    </div>
                </div>

            </form>

    {/if}


</div>

<script>
	// Listen for click on toggle checkbox
	$(document).ready(function(){
		$('#select-all').click(function(event) {   
			if(this.checked) {
				// Iterate each checkbox
				$(':checkbox').each(function() {
					this.checked = true;                        
				});
			} else {
				$(':checkbox').each(function() {
					this.checked = false;                       
				});
			}
		});

        // Resize:
		function resize(){
			if($(window).width() < 1400){
				$(".col-md-1").removeClass("col-md-offset-1");
				$(".col-md-4").removeClass("col-md-offset-2");
			}
    	}

		resize();
		$(window).resize(resize);


	});
</script>
