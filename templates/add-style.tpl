
{* Default: *}

{* templates/index.tpl *}
<style type="text/css" media="print">

    body {
        font-family: 'Roboto', sans-serif;
        font-size: 10px !important;
        scroll-behavior: smooth;
    }
    .nav, .footer { display:none; }
    @page { margin: 0.5cm; }
    @media print {
        div [class*='col-'] { display: table-cell !important; }
        div [class*='row'] { display: table-row !important; width: 100%; }
        div [class*='grid'] { display: table-row !important; width: 100%; }
        div [class*='w25'] { display: inline-block !important; width: 30%; }
        div [class*='w75'] { display: inline-block !important; width: 69%; }
        div [class*='w100'] { display: inline-block !important; width: 99%; }
        button, .btn { display:none; }
    }
    .badge {
        background-color: white;
        color: black;
        padding: 4px 8px;
        text-align: center;
        border-radius: 5px;
    }


</style>
<style type="text/css" >
    /* Default: */
    .content {
        height: 100%;
        overflow: hidden;
        display: grid;

    }

    .header {
        grid-row: 1; 
    }
    .body{
        grid-row: 2;
        padding: 10px;
        overflow-y: auto;
        overflow-x: hidden;
    }
    .footer{
        grid-row: 3;
    }

</style>
{* End of default: *}


{* TEMPLATES FOLDER: *}
<style>

.wrapper-edit{ padding:0px; }
.white-bg-edit{ padding-bottom:30px;  background-image: linear-gradient(#f6f7f9, #dee6ed);}

.additional-class{
    position: fixed;
    height: 100vh;
    overflow-y: auto;
}

.nav-header-edit{
    background-color: #e4e4e4;
    margin: 0 5px 5px 5px;
    padding: 5px;
    box-sizing: border-box;
    border: 2px solid #4c81ad;
    box-shadow: 5px 5px 8px #888888;
    border-radius: 10px;
    z-index:1;
}
.nav-header-edit #a-setout{
    text-decoration: underline;
    color: rgb(122 122 122);
    padding: 5px 0 5px 2px;
    display: block;
}
.nav-header-edit #a-setout:hover{
    color: rgb(184, 126, 71);
    background: none;
}

.navbar-header .btn-primary-edit{
    background-color: #3c72bc;
    border-color: #3c72bc;
    margin-left:15px;
    box-shadow: 2px 2px 5px #424181;
}
.navbar-header .btn-primary-edit:hover{
    background-color: #36619f;
    border-color: #3c72bc;
}

.cut-name{
    color:rgb(30 104 166);
    font-family: 'Times New Roman', Times, serif;
    text-shadow: 1px 1px #3e3e42;
    /* font-style: italic; */
}
.mini-navbar .nav-header-edit .cut-name{
    overflow:hidden; 
    white-space:nowrap; 
    text-overflow:ellipsis; 
    width:60px; 
}

.mini-navbar .nav-header-edit .cut-name-2{
    overflow:hidden; 
    white-space:nowrap; 
    text-overflow:ellipsis; 
    width:60px; 
}

.nav-header-top-edit{
    background: #476092;
    margin: 5px 5px 10px 5px;
    border-radius: 10px;
    box-shadow: 5px 5px 16px #424181 inset;
}

.navbar-static-side{ box-shadow: 5px 5px 8px #888888; }

.small-box, .small-box-footer{
    border-radius: 10px;
    box-shadow: 5px 5px 8px #616060;
}

.box-info, .box-primary{ box-shadow: 5px 5px 8px #616060; }

.nav-header-edit #set-as{ color: #545050;}
.nav-header-edit #set-as, #set-as-2{ font-family:Georgia, 'Times New Roman', Times, serif; }


/* pageListHeader.tpl */
.form-group.group-edit{
    display: inline-block;
    width:70%;
}
@media screen and (max-width:1000px){
    .form-group.group-edit{
        width:90%;
    }
    
}


{* END OF TEMPLATES: *}
/* ------------------------------------------ */


{* PLUGINS FOLDER: *}

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
.fa-user{ color:white; }





/* Route */
#TerminalID{
	height:20px;
	z-index:1;
	width:405px;
}
#TerminalID option:hover{
    background: #0088cc;
    color: white;
}


/* ListTemplate.php */
#show_items .row-edit{
    color:#3C8DBC;
    font-weight:bold;
    padding:5px 0;
}


/* Bookings/Orders */
.row-sticky{
    position: sticky;
    top: 0;
    z-index: 5;
    background-color: white;
    margin-left: 0px;
    margin-right: 0px;
    color: #0088cc;
    /* background: #a1bdca; */
}

.row .itemsheader-edit{
    background: #dadbebc0;
    border: 1px solid #c5c5c5;
    position: sticky;
    top: 20;
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
    margin-left: 0px;
    margin-right: 0px;
    background:#d9d8d8;
}
.listTile-edit .col-md-2{
    background: #86bbd6;
    margin: 5px;
    border-radius: 5px;
    box-sizing: border-box;
    box-shadow: 5px 5px 8px #616060;
}
.listTile-edit .col-md-2:hover{
    background: #9fc7db;
}

.box-header-edit{
    background: #3f67b9;
    color: white;
}
.box-body-edit{ background: #3f67b9; }

.select-top-edit{
    color:rgb(78 66 66);
    padding:2px;
    border-radius: 5px !important;
    margin-bottom: 2px;
    box-shadow: 2px 2px 4px #616060 inset;
}
.select-bottom-edit{
    color:rgb(78 66 66);
    padding:2px;
    border-radius: 5px !important;
    margin-top: 2px;
    box-shadow: 2px 2px 4px #616060 inset;
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
    color:rgb(59, 59, 66) !important;
}
.select-top-edit:focus, .select-bottom-edit:focus, .button-asc-edit:focus, .button-desc-edit:focus, .input-one:focus{
    outline:none;
    border:2px solid rgb(135, 147, 218);
}

.badge-edit{
    color: #054ff3;
    background: #f9f9f9;
}

.btn-default-edit{
    color:white !important;
}
.btn-default-edit:hover{
    color:black !important;
}

{* END OF PLUGINS FOLDER: =====================  *}

/* Cursor pointer */
.listTile{ cursor:pointer;}
.listTile:hover{ background: rgb(229 229 231); }
/* off */
/* .listTile:focus{ background: rgb(71, 42, 173); } */

/* DriverRoutes - ListTemplate.php */
.listTitleEdit{ cursor:auto !important; }

/* Navbar Side */
.navbar-default-edit{ 
    background-image: linear-gradient(#333a42, #3e576e); 
}

/* navbar top fixed */
.navbar-static-top-edit{
    background-image: linear-gradient(to bottom right, silver, #cceeff);
}

/* Footer */
.footer-edit{
    background-image: linear-gradient(to bottom right, silver, #cceeff);
}
.pull-left-edit{ margin-left:10px; }
.pull-right-edit{ margin-right:20px; }




</style>