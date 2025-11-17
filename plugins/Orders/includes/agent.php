{{#compare tab "==" "agent"}}	
    <!---<div class="row dagent">
        <div class="col-md-3 "><label><?= LEVEL?></label></div>
        <div class="col-md-9">
            {{userLevelSelect details.UserLevelID}}
        </div>
    </div>!--->							
    <div class="row dagent booked_by">
        <div class="col-md-1 "><label><?= BOOKED_BY?></label></div>
        <div class="col-md-2">{{userLevelSelect ""}}</div>		
        <div class="col-md-9">
            <strong>{{userName details.UserID "AuthUserRealName"}}</strong>
            {{userSelect details.UserID "0" "UserIDeX"}}
            ({{details.UserID}})

        </div>
    </div>
    <div class="row dagent booked_for">	
        <div class="col-md-1 "><label><?= BOOKED_FOR?></label></div>
        <div class="col-md-2">{{userLevelSelect details.UserLevelID}}</div>
        <div class="col-md-9">
			<strong>{{userName details.AgentID "AuthUserCompany"}}</strong>
            {{userSelect details.AgentID "0" "AgentIDeX"}}
            ({{details.AgentID}})
        </div>					
	</div>
	<div class="row dagent">	
		{{#compare details.CustomerID ">" "0"}}
        <div class="col-md-1 "><label><?= CUSTOMER?></label></div>
        <div class="col-md-11">
			<strong>{{custName details.CustomerID "CustName"}}</strong>
            ({{details.CustomerID}})
        </div>					
		{{/compare}}						
    </div>
    <input type="hidden" name="UserID" id="UserID" value="{{details.UserID}}">		
    <input type="hidden" name="AgentID" id="AgentID" value="{{details.AgentID}}">	
    <input type="hidden" name="UserLevelID" id="UserLevelID"  value="{{details.UserLevelID}}">
    <div class="row dagent">
        <div class="col-md-3 "><label><?= AGENT_REFERENCE ?></label></div>
        <div class="col-md-6">
            <input name="MConfirmFile" id="MConfirmFile" value="{{master.MConfirmFile}}"/> 
        </div>
        {{#compare details.AgentID "==" '1711'}}
        <div class="col-md-3 "><a target="_blank" href="https://wis.jamtransfer.com/plugins/Orders/getJSON.php?code={{master.MConfirmFile}}">WEBY API</a></div>							
        {{/compare}}
    </div>	
{{/compare}}
