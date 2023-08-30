<style>

{* TEMPLATES FOLDER: *}

.body-edit{ height:100vh !important; font-size:16px; }

/* Main wrapper: */
.wrapper-edit{ padding:0px; }


/* Sub wrapper: */
.page-wrapper-edit{
    background-image: url(./i/m-assets/white-bg/noise_lines.png) !important;
    display: flex;
    flex-direction: column;
    flex-wrap: nowrap;
    overflow: hidden;
}

/* Sub wrapper 2: */
.white-bg-edit{ 
    background-image: url(./i/m-assets/white-bg/noise_lines.png) !important;
    /* height: 100%; check */
    padding: 10px 30px 10px;
    flex:1;
}

/* Footer */
.footer-edit{
    background: #0089fe1a;
    /* box-shadow: 2px 2px 5px 2px #888888; example */
    border-top: 1px solid #aaaaaa;
    /* border-top: 1px solid #e7eaec; Old */
}
.pull-left-edit{ margin-left:10px; }

.pull-right .btn{
    box-shadow: 2px 2px 2px 1px #888888;
}

.additional-class{ position: fixed; height: 100vh; overflow-y: auto; }

/* Header Main: */
.border-bottom-edit{ padding: 12px 12px 7px 12px; }

.header-edit{ padding: 5px 14px 5px 14px; }

.nav-header-edit{
    background-image: linear-gradient(#9af8077d, #7effba54);
    /* background-image: linear-gradient(#ffdc7eab, #fab80654); old */
    /* background-color: #dbd6ca; Old 2 */
    margin: 0 5px 5px 5px;
    padding: 5px;
    box-sizing: border-box;
    /* border: 2px solid #4c81ad; */
    /* box-shadow: 5px 5px 8px #888888; */
    border-radius: 10px;
    z-index:1;
}
.nav-header-edit #a-setout{ 
    text-decoration: underline; color: #bebcbc; padding: 5px 0 5px 2px; display: block;
}
.nav-header-edit #a-setout:hover{
    background: none;
}
.nav-header-edit-2{
    background-image: linear-gradient(#ffdc7eab, #fab80654);
}

.navbar-header .btn-primary-edit{
    background-color: #3c72bc;
    border-color: #3c72bc;
    margin-left:15px;
    box-shadow: 2px 2px 5px #424181;
}
.navbar-header .btn-primary-edit:hover{
    background-color: #36619f !important; border-color: #3c72bc !important;
}

.cut-name{
    color: rgb(149 198 239);
    /* color:rgb(30 104 166); old */
    font-family: 'Times New Roman', Times, serif;
    text-shadow: 1px 2px #3e3e42;
    /* font-style: italic; */
}
.mini-navbar .nav-header-edit .cut-name{
    overflow:hidden; white-space:nowrap; text-overflow:ellipsis; width:60px; 
}

.mini-navbar .nav-header-edit .cut-name-2{
    overflow:hidden; white-space:nowrap; text-overflow:ellipsis; width:50px; 
}

.nav-header-top-edit{
    background-image: linear-gradient(#ff00002b, #00000030) !important;
    /* background-image: linear-gradient(#ff00002b, #4b494961) !important; old */
    margin: 5px 5px 10px 5px;
    border-radius: 10px;
    /* box-shadow: 5px 5px 16px #232328 inset; */
}

.navbar-static-side{ box-shadow: 5px 5px 8px #888888; }

.small-box, .small-box-footer{
    border-radius: 10px; box-shadow: 5px 5px 8px #616060;
}

.nav-header-edit #set-as{ color: #e0e0e0;}

.nav-header-edit #set-as, #set-as-2{
    font-family: "Open Sans", "Helvetica Neue", Helvetica, Arial, sans-serif;
    /* font-family:Georgia, 'Times New Roman', Times, serif; Old */
}

/* Filters: */
#footer-filters{
	background: #479de929;
	border-radius: 5px;
	padding-right: 5px;
	box-shadow: 3px 3px 4px 0px #3b75b9;
}

/* ====================================================================================== */
/* ListTemplate.php */
#show_items .row-edit{
    color:#179ae6;
    /* color:#3C8DBC; older */
    font-weight:bold;
    padding:10px 0;
    /*text-shadow: 2px 2px 8px #ada3cc; spare */
}

#show_items{
    border: 1px solid #00000026; border-radius: 5px; padding: 15px; background: #c0c0c026; box-shadow: 0px 0px 5px 1px #898989;
}

.row-edit div{ border-right:1px solid rgb(105, 131, 170); }
.row-edit div:last-child{ border-right:none; }

#show_Items .pad1em{
    padding: 2px 0; 
    cursor:pointer;
    border-top:1px solid rgb(179, 179, 179) !important; 
    font-family: Lucida sans-serif;
    font-size: 17px;
}

#show_Items .pad1em div{ border-right:1px solid rgb(187, 187, 187); }
#show_Items .pad1em div:last-child{ border-right:none;}
#show_Items .pad1em:hover{ background: rgb(0 0 0 / 9%); }
#show_Items .h-style:hover{ background: #04656f78 !important; }

.cursor-list{
    cursor: default !important;
}

/* off */
/* .listTitleEdit{ cursor:auto !important; } */
/* .listTile:focus{ background: rgb(71, 42, 173); } */

/* ====================================================================================== */
/* EditForm: */
.box-info, .box-primary{
    background-image: url(./i/m-assets/white-bg/stripes-light.webp) !important;
    box-shadow: 5px 5px 8px #616060;
}
.box-body .row{ margin-bottom: 10px; }
.box-body .row-edit-2{ margin-top:5px; }
.box-body-edit{ background: #6cd7f36b; }
.box-header-edit{ background: #6cd7f36b; color: white; }

/* ------------------------------------------ */
/* pageListHeader.tpl */
.form-group.group-edit{
    display: inline-block;
    width:85%;
}



.itemsheader-edit{
    background: #0eb9f221;
    /* background: #def6fe; Old 1 */
    /* background-image: linear-gradient(#C5D5DC,#CBEAFA); Old 2 */
    box-shadow: 0px 0px 6px 3px #88888894;
    border-radius: 6px;
    padding: 5px 55px 5px 35;

}

.col-md-2-infoShow{ font-weight: 900; }

.btn-xs-edit{
    box-shadow: 2px 2px 4px 1px #436477;
    margin-left: 20px;
    margin-bottom: 10px;
    margin-top: 5px;
    padding: 5px 10px;
}
/* ------------------------------------------------------------------------------- */
/* NAVBAR: */
.navbar-default-edit{
    background-image: url(./i/m-assets/sidebar/dark-honeycomb.png);
}
/* navbar top fixed */
.navbar-static-top-edit{
    background-image: linear-gradient(#00aaff3d, #c0c0c036);
    /* background-image: linear-gradient(to bottom right,#00aaff3d, #c0c0c036); old */
    box-shadow: 0px 0px 6px 3px #88888894;
    border-radius: 6px;
}
.nav-label-edit{
    font-size: 18px;
    /* font-style: italic; Off */
    /*text-shadow: 2px 2px 1px #101010;*/
    /* text-shadow: 2px 2px 1px #494949; Old */
	font-family: 'Font Awesome';
	font-weight: 400;
}
.nav-label-edit-2{
    font-size: 17px !important;
    /*font-style: italic;*/
    /*text-shadow: 2px 2px 1px #101010;*/
	font-family: 'Font Awesome';
	font-weight: 400;
}
#side-menu .edit-fa{ text-shadow: 3px 3px 2px #494949; }
.nav.nav-second-level > li.active a{
    background: #6e6e6e28;
    /* background: #634242; old */
    /* background: #624e4e; old 2 */
}

/* ====================================================================================== */
/* Transfers/Orders */
.row-sticky{
    position: sticky;
    top: 0;
    z-index: 5;
    /* background-color: white; */
    margin-left: 0px;
    margin-right: 0px;
    margin-bottom: 5px;
    color: #0088cc;
    /* background: #a1bdca; */
}

.row .itemsheader-edit{
    background: #00bdfbbd;
    /* background: #00bdfb12; Old */
    border: 1px solid #c5c5c5;
    position: sticky;
    top: 35;
    z-index: 5;
    margin-left: 0px;
    margin-right: 0px;
    padding: 5px;
    box-shadow: 5px 5px 8px #616060;
}
.row .itemsheader-edit .col-md-2{
    border-right: 1px solid #c5c5c5;
}

.row .listTile-edit{
    display: flex;
    /* flex-wrap: wrap; */
    margin-left: 0px;
    margin-right: 0px;
    background:#d9d8d8;
}
.listTile-edit .col-md-2{
    background: #dfebee;
    /* background: #a7d5ed; Old */
    margin: 5px;
    border-radius: 5px;
    box-sizing: border-box;
    box-shadow: 3px 2px 3px 2px #395876;
    /* box-shadow: 5px 5px 8px #616060; old */
    color: #3d3d3d;
}
.listTile-edit .col-md-2:hover{
    background: #bbd5db; /* background: #9bd6f3; Old */
    color: black; /* color: white; Old */
}

.select-top-edit, .select-bottom-edit{
    color: rgb(45 106 183) !important;
    /* color: rgb(1 114 255) !important; old */
    padding:2px;
    border-radius: 5px !important;
    margin-bottom: 2px;
    box-shadow: 2px 2px 4px #3f50a1;
    /* box-shadow: 2px 2px 4px #616060; old */
    font-size: 16px !important;
}

.button-asc-edit, .button-desc-edit{
    box-shadow: 2px 2px 4px #616060;
    background: #7ec2e9;
    border: 1px solid rgb(152, 152, 155);
}

.input-one{ border-radius: 5px !important; }

.select-top-edit, .select-bottom-edit, .button-asc-edit, .button-desc-edit, .input-one{
    outline:none;
    border:2px solid rgb(192, 199, 241);
    font-family: 'Times New Roman', Times, serif;
    color:rgb(59, 59, 66);
}
.select-top-edit:focus, .select-bottom-edit:focus, .button-asc-edit:focus, .button-desc-edit:focus, .input-one:focus{
    outline:none;
    border:2px solid rgb(135, 147, 218);
}

.badge-edit{ color: #054ff3; background: #f9f9f9; }

.btn-default-edit{ color:white !important; }
.btn-default-edit:hover{ color:black !important; }
/* End of Bookings/Orders */
/* ====================================================================================== */
/* Dialog */
.ui-dialog{ /*Global dialog style */
    height: 80% !important;
    overflow-y: auto;
    box-shadow: 0px 0px 5px 2px #4d4d52;
    /* box-shadow: 0px 0px 2px 2px #424181; old */
    top:130px !important;
}

.dialog_help_style .ui-dialog-titlebar { /*Global style */
    background: #c8f9ce; box-shadow: 2px 2px 5px #424181;
}

.dialog_message_style .ui-dialog-titlebar { /*Global style */
    background: #dfd0b5; box-shadow: 2px 2px 5px #424181;
}

.ui-dialog-buttonpane { /*Global style */
    position: absolute; top: 41px; width: 97%; border-width: 0 0 1px 0 !important;
}

.ui-dialog-buttonpane #saved-message{
    margin-right: 100px; border: 2px solid #ffe423; border-radius: 5px;
}

/* ------------------------------------------------------------------------------- */
/* Button */
.button-3 {
  appearance: none;
  background-color: #37b1d2;
  /* background-color: #2e8ba4; old */
  /* background: linear-gradient(177deg, #2ea44f 0%, #58ce79 100%); */
  border: 1px solid rgba(27, 31, 35, .15);
  border-radius: 6px;
  /* box-shadow: rgba(27, 31, 35, .1) 0 1px 0; Old */ 
  box-shadow: 2px 2px 5px #424181;
  box-sizing: border-box;
  color: #fff;
  cursor: pointer;
  display: inline-block;
  font-family: -apple-system,system-ui,"Segoe UI",Helvetica,Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji";
  font-size: 14px;
  font-weight: 600;
  /* line-height: 20px; */
  padding: 6px 16px;
  margin-top: -5px;
  margin-right:5px;
  position: relative;
  text-align: center;
  text-decoration: none;
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
  vertical-align: middle;
  white-space: nowrap;
}

.button-3:hover { background-color: #6cc9e3; /* background-color: #45afcc; old */ }

/* ------------------------------------------ */
/* Textarea */
.textarea{ width:70%; height:200px; resize: none; }

.textarea-dialog{ 
    width: 100% !important; height:20% !important; resize: none; box-sizing: border-box !important; background: #fdfdf4; margin-top: 65px;
}

textarea{ width:90% !important; }
/* ------------------------------------------ */

{* END OF TEMPLATES: ======================================================================================  *}
{* PLUGINS FOLDER: ===============================================================  *}

/* DriversTransfers/templates/index.tpl and AgentsTransfers/templates/index.tpl */
.row_e:hover{ background:rgb(229, 229, 240); }
/* Off */ /* .row_e{ padding:0 0 3px 0; font-size:18px; } */
.col-md-4_e{ margin-bottom: 5px; }

/* Booking/templates */
.book{ color:white; }
.book label{ color:white; }
#selectTo_options a{ color:white; }
#selectFrom_options a { color:white; }
.row-add{ padding:20px; }
.listTile .fa-user{ color:#797373; }

/* Route */
#TerminalID{
	height:20px; z-index:1; width:405px;
}
#TerminalID option:hover{ background: #0088cc; color: white; }

/* Exchange rate, Vat Rate */
.container .shadowLight-edit{
    background: transparent !important;
    margin: 0px;
    padding: 5px;
    border: none !important;
    box-shadow: none;
    cursor: auto;
}

/* Checkbox: */
.row-checkbox-edit input[type=checkbox]{
    display: block;
    cursor: pointer;
    /* appearance: none; */
    background-color: #fff;
    margin: 0;
    font: inherit;
    color: currentColor;
    width: 2.15em;
    height: 2.15em;
    border: 0.15em solid currentColor;
    border-radius: 0.15em;
    transform: translateY(-0.075em);
    box-shadow: 0px 0px 2px 1px #888888;
}

/* Buttons: */
.go-edit, .rate-edit{ box-shadow: 2px 2px 5px 1px #42484d; }

.btn.btn-primary:hover,
.btn.btn-primary:active,
.btn.btn-primary.hover { 
    background: #66bbee; border-color: #367fa9;
}

#pageSelect .btn.btn-primary{ box-shadow: 0px 0px 4px 1px #888888; }

/* ====================================================================================== */

{* END OF PLUGINS FOLDER: ===============================================================  *}
{* ======================================================================================  *}

/* -------------------------------------------------------------------------------------- */
/* SCROLL BAR: */
/* width */
::-webkit-scrollbar { width: 14px;}
/* Track */
::-webkit-scrollbar-track { background: #f1f1f1; margin-right: 5px;}
/* Handle */
::-webkit-scrollbar-thumb { 
    background: #aaa; border: 1px solid #050505;
    /* border: 2px solid #bd6d61c9; Old */
}
/* Handle on hover */
::-webkit-scrollbar-thumb:hover { background: #646363;
}
/* -------------------------------------------------------------------------------------- */

.form-control{ width:100%;}
.form-group { margin-bottom: 0px !important; }

.tab-content-edit{ padding:20px !important; }

.container.white{ width:90% !important; }

/* Calendar: */
.cal_month_edit, .cal_year_edit{
	border: 2px solid #ddd;
    padding: 5px;
    border-radius: 5px;
}

button.searchdrivers, button.conversion-rate{
	box-shadow: 2px 2px 4px 1px #888888 !important;
}


/* *************************************************************************************** */
/* *************************************************************************************** */
/* *************************************************************************************** */
/* *************************************************************************************** */

/* MEDIA SCREEN: */

@media screen and (min-width: 1201px) {
    #show, #hide{
        display: inline-block;
    }
		
}

@media screen and (min-width: 1551px){
    .col-md-2 input[type="number"]{
        width:100%;
    }
}

@media screen (min-width: 1280px) and (max-width: 1549px){

    .clock-timepicker{
		/* width:100% !important; */
		margin: 0;
		padding: 0;
	}
	.clock-timepicker input[type=text]{
		/* width:100% !important; */
		margin: 0;
		padding: 0;
	}

    select{
		/* width:90%; */
		margin-bottom: 5px;
	}

    .col-md-9 input[type="text"]{ margin-bottom: 5px;}

}


/* ===================================== */
@media screen and (max-width: 1550px) {

    /* .row-edit is in #show_items labels: */
    .row-edit div { border-right: none; }

    #show_Items .pad1em div{ border-right: none; }

    /* In footer: */
    .footer-edit{ display: flex; flex-direction: column; text-align: center; }
    .pull-right-edit, .pull-left-edit{ margin:0; }
    .group-edit{ width: 50% !important; }
    .btn-xs-edit{ width:50%; padding: 10px; }
    /* --- */

    .orders-edit [class*="col-"]{
        width: auto !important;
        padding: 5px;
    }

    [class*="col-md"], [class*="col-sm"]{
        width: 100% !important;
        padding: 5px 0;
        text-align: center;
    }
    
    .customer-edit [class*="col-sm"]{
        width: 100% !important;
        padding: 5px 0;
        text-align: center;
    }

    #show, #hide{
        display: inline-block;
    }

    .select-top-edit.addon{
        width:100% !important;
    }

    .datepicker-edit{
        width:100% !important;
    }


    .tab-content-edit{ padding:20px !important; }

    .pad1em{
        flex-direction: column;
    }
    
    [class*="col-"] > *{ 
        float:none !important;
        text-align: center !important;
    }

    [class*="col-"] input[type="text"]{
        text-align: center !important;
    }

    [class*="col-"] span{
        float:none !important;
    }
    
    [class*="col-"] input[type="range"]{ display:inline-block !important;float:none !important;}

    

    .col-md-9 .wysihtml5-toolbar{ 
        display: inline-flex;
    }

    iframe{
        width:90% !important;
    }


    .row{
        margin-left:0;
        margin-right:0;
        padding-left:0;
        padding-right:0;
    }

    .navbar-right {
        float: none !important;
        text-align: center;
    }

    .navbar-left-add{
        display: block !important;
        text-align: center;
    }

    .navbar-left-add .navbar-header{
        display: inline-block !important;
        float: none;
    }

    .navbar-left-add h2{
        margin:0 0 0 10px !important;
    }

    .row-checkbox-edit input[type=checkbox]{
        display: inline-block;
    }

    .container-edit{
        width: 100%;
    }

    #DriverID{
        width:100% !important;
    }

    .input-edit {
        width: 100% !important;
    }

	.input-edit-2{
		display:block;
	}

	.flight-no-edit{
		margin:0 auto 5px;
	}

    .flight-no-edit {
		margin:0 auto 5px;
        width:100%;
	}

    .transfer-duration-edit{
        margin-bottom: 5px;
    }

    /* ---------------------------- */
    /* Filters: */
    #schedule-filters{
		float:none !important;
		margin:0 auto;
        width: fit-content;
	}

    #pageListHeader-filters{
        float:none !important;
		margin:0 auto;
        width: fit-content;
    }

    #footer-filters{
		float:none !important;
		margin:0 auto;
        width: fit-content;
	}

    #wrapp-buttons{
		float:none !important;
		margin:0 auto;
        width: fit-content;
	}

    .filterOlderAdd{
        float:none !important;
        margin-left:0 !important;
        text-align: center;
        padding: 10px !important;
    }
    .filterOlderAdd select{
        margin-bottom: 5px;
    }

    .button-toggle{
		cursor:pointer; font-weight:bold; color: #0584f1; text-shadow: #0584f1 0px 0px 1px;
	}

	.fa-bars-edit{
		font-size: 20px;margin: 5px;color: #0584f1;
	}

	.button-toggle:hover,.fa-bars-edit:hover{
		cursor:pointer; font-weight:bold; color: #0b70c9;
	}

    .col-md-3{
        position: static !important;
    }

    .header-edit{
        overflow-y: auto;
    }

    /* ---------------------------- */

    .filter{
		display: none;
	}

    .sum-edit{
        flex-direction: column;
    }

    .col-md-2-edit{
        padding: 10px;
    }

    .datepicker-edit-2-small{
        width:100% !important;
    }

    .sum-edit div{
		text-align: center;
	}

    .filter	.col-sm-3 b{
		display: block !important;
	}

}


/* ===================================== */
@media (min-width: 768px) and (max-width: 1300px) {
    .ui-dialog{ /*Global dialog style */
        height: 80% !important;
        overflow-y: auto;
        box-shadow: 0px 0px 5px 2px #4d4d52;
        /* box-shadow: 0px 0px 2px 2px #424181; old */
        /* margin-top: 400px; dosen't work */
        top:130px !important;
        width:50% !important;
        left:300px !important;
    }

    .pad1em{
		flex-direction: column;
	}


}

/* ===================================== */
@media (max-width: 900px){
    .table{
        /* display: block !important; */
        overflow-x: auto !important;
        width: 100% !important;
    }

    .table tbody td {
        display: block !important;
        text-align: center !important;
        font-size: 13px;
        border-bottom: 1px dotted #ccc;
        padding:5px;
	
    }

    .table tbody th {
        display: block;
        text-align: center;
        font-size: 13px;
        border-bottom: 1px dotted #ccc;
        padding:5px;
    } 


    form table tbody td {
        display: block !important;
        text-align: center !important;
        font-size: 13px;
        border-bottom: 1px dotted #ccc;
        padding:5px;
	
    }

    form table tbody th {
        display: block;
        text-align: center;
        font-size: 13px;
        border-bottom: 1px dotted #ccc;
        padding:5px;
    }


    /* For invoice: */
    .btn.btn-danger{
        float: none !important;
        margin-top: 5px;
    }

    .pull-right .btn.btn-danger{
        margin-top: 0;
    }

    .left-edit{
        text-align: center;
    }

    .pad4px{
        width:auto !important;
    }

    .total-balance-add{
        text-align: center;
    }

    .right{ 
        float:none !important; text-align:center; 
    }

    .strong-edit{
        display: block;
    }


    .row-third-edit .col-md-3{
		margin-top: 10px;
	}
	.row-third-edit .form-control{
		width:100%;
	}

    /* Spare: */
    /* .col-md-9 select{
        width: -webkit-fill-available;
    } */


}

/* ==================================== */
@media (max-width: 767px)  {
    
    .ui-dialog{ /*Global dialog style */
        height: 80% !important;
        overflow-y: auto;
        box-shadow: 0px 0px 5px 2px #4d4d52;
        /* box-shadow: 0px 0px 2px 2px #424181; old */
        top:130px !important;
        width:60% !important;
    }

    .form-group.group-edit{ width:90%; }

    .expenses-image{
		pointer-events: none; /* Turn off hover effect */

		/* Testing for stretched on mobile: */
		/* height: auto !important; */
        /* object-fit: cover !important; */
	}

    .modal-dialog-edit {
		width: 90% !important;    /* by default its 600px. */
		margin: 30px auto !important;
	}


}


</style>



<script>
    function resize(){
        if($(window).width() < 1400){
            $(".col-md-6").removeClass("col-md-offset-3");
        }
    }
    resize();
    $(window).resize(resize);
</script>