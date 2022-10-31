
					{if $smallBoxes} 
						{include file="plugins/Dashboard/templates/smallBoxes.tpl"}
					{/if}					
					{if $translatorPanel} 
						<h2>Translator panel for {$smarty.session.UserRealName}</h2>
					{/if}
					{include file="plugins/Dashboard/templates/emptyRow.tpl"} 			

					<div class="row">
						{if $getOrder}
						<section class="col-lg-6 xconnectedSortable"> 
							{include file="plugins/Dashboard/templates/getOrder.tpl"} 			
						</section><!-- /.Left col -->
						{/if}
						{if $getUnfinishedPayment}						
						<section class="col-lg-6 xconnectedSortable"> 
							{include file="plugins/Dashboard/templates/getUnfinishedPayment.tpl"} 			
						</section>
						{/if}

						{if $actualTransfers}
                        <section class="col-lg-6 xconnectedSortable"> 
							{include file="plugins/Dashboard/templates/actualTransfers.tpl"} 			
                        </section>
						{/if}
						{if $todo}
                        <section class="col-lg-6 xconnectedSortable">
							{include file="plugins/Dashboard/templates/todo.tpl"} 								
                        </section>
						{/if}

						{if $quickEmail}
                        <section class="col-lg-6 xconnectedSortable"> 
							{include file="plugins/Dashboard/templates/quickEmail.tpl"} 
                        </section>
						{/if}
                        <section class="col-lg-6 xconnectedSortable">
                        </section>
                    </div>	        
