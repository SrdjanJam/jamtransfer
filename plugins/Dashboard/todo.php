<script type="text/x-handlebars-template" id="todoTemplate">

    <div class="box box-primary">
        <div class="box-header">
            <i class="ion ion-clipboard"></i>
            <h3 class="box-title"><?=TO_DO_LIST;?></h3>
            <!-- tools box -->
            <div class="pull-right box-tools">
                
                <button class="btn btn-info btn-sm" data-name="to-do"><i class="fa fa-plus"></i></button>
                
                <button class="btn btn-warning btn-sm" data-widget='remove' 
                data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                
            </div><!-- /. tools -->                                    
        </div>
        <div class="box-body to-do">
            <ul class="todo-list">
                {{#each todoItems}}
                <li data-id="{{ID}}" class="{{done}}">

                    <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                    </span>  

                    <input type="checkbox"  class="icheckbox_minimal simple"
                    onclick="toggleCompleted(this,'{{ID}}');"/>

                    <span class="text" id="taskText{{ID}}">{{task}}</span>
                    
                    <small class="label label-info pull-right">
                        <i class="fa fa-clock-o"></i> {{fromNow dateTime}} 
                    </small>
                    

                    <div id="tools{{ID}}" class="tools">
                        <i class="fa fa-edit" onclick="editItem('{{ID}}');"></i>
                        <i class="fa fa-trash-o" onclick="todoItem('delete','{{ID}}');"></i>
                        <i class="fa fa-save" style="display:none" onclick="saveItem('{{ID}}');"></i>
                    </div>
                </li>
                {{/each}}
            </ul>
            
            <div class="box-footer clearfix no-border">
                <input type="text" name="newItem" id="newItem" class="w100 form-control" style="width:300px;"
                placeholder="New Item Text">

                <button class="btn btn-default pull-right plus" onclick="todoItem('add','');" >
                    <i class="fa fa-plus"></i> <?=SAVE;?>
                </button>
                                                    
                <button class="btn btn-default btn-xs" style="margin-top:5px;" onclick="todoItem('deleteCompleted','');" >
                    <i class="fa fa-times"></i> <?=DELETE_COMPLETED;?>
                </button>
                

            </div>

        </div>


    </div>


    </script>


