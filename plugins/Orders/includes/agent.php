{{#compare tab "==" "agent"}}	
    <div class="row dagent">
        <div class="col-md-3 "><label><?= LEVEL?></label></div>
        <div class="col-md-9">
            {{userLevelSelect details.UserLevelID}}
        </div>
    </div>						
    <div class="row dagent">
        <div class="col-md-3 "><label><?= BOOKED_BY?></label></div>
        <div class="col-md-9">
            <strong>{{userName details.UserID "AuthUserRealName"}}</strong>
            {{userSelect details.UserID "0" "UserIDeX"}}
            
            ({{details.UserID}})

        </div>
    </div>	
    <div class="row dagent">	
        <div class="col-md-3 "><label><?= AGENT?></label></div>
        <div class="col-md-9">
			{{#compare details.AgentID ">" "0"}}<strong>{{userName details.AgentID "AuthUserCompany"}}</strong>{{/compare}}
            {{userSelect details.AgentID "0" "AgentIDeX"}}
            ({{details.AgentID}})
        </div>													
    </div>
    <input type="hidden" name="UserID" id="UserID" value="{{details.UserID}}">		
    <input type="hidden" name="AgentID" id="AgentID" value="{{details.AgentID}}">	
    <input type="hidden" name="UserLevelID" id="UserLevelID"  value="{{details.UserLevelID}}">
    
    {{#compare details.UserLevelID "==" '2'}}
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
{{/compare}}
