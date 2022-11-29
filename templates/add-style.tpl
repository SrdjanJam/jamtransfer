
{* Default: *}

{* templates/index.tpl *}
<style type="text/css" media="print">

    body {
        font-family: 'Roboto', sans-serif;
        font-size: 10px !important;
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

{* MY SEPARATE AREA: *}

{* templates/index.tpl *}
<style>

.wrapper-edit{ padding:0px; }
.white-bg-edit{ padding-bottom:30px; }

.additional-class{
    position: fixed;
    height: 100vh;
    overflow-y: auto;
}

.nav-header-edit{
    padding: 5px;
    background-color: #e4e4e4;
    /* text-align: center; */
    box-sizing: border-box;
    border: 2px solid #4c81ad;
    box-shadow: 5px 5px 8px #888888;
    border-radius: 10px;
    z-index:1;
}
.nav-header-edit #a-setout{
    text-decoration: underline;
    color: rgb(116, 113, 113);
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
}
.navbar-header .btn-primary-edit:hover{
    background-color: #36619f;
    border-color: #3c72bc;
}

.cut-name{
    color:rgb(30 104 166);
    font-family: 'Times New Roman', Times, serif;
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

{* END OF templates/index.tpl *}

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

/* PLUGINS FOLDER: */

/* DriversTransfers/templates/index.tpl and AgentsTransfers/templates/index.tpl */
.row_e:hover{ background:rgb(229, 229, 240); }
/* Off */ /* .row_e{ padding:0 0 3px 0; font-size:18px; } */
.col-md-4_e{ margin-bottom: 5px; }
/* ------------------------------------------ */
/* Booking/templates */
.book{ color:white; }
.book label{ color:white; }
#selectTo_options a{ color:white; }
#selectFrom_options a { color:white; }
.row-add{ padding:20px; }
.fa-user{ color:white; }
/* ------------------------------------------ */
/* DriverRoutes - ListTemplate.php */
.listTitleEdit{ cursor:auto; }
/* ------------------------------------------- */
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
/* --------------------------------------------- */
/* ListTemplate.php */
#show_items .row-edit{
    color:#3C8DBC;
    font-weight:bold;
    padding:5px 0;
}

/* Cursor pointer */
.listTile{ cursor:pointer;}
.listTile:hover{ background: rgb(240, 240, 240); }
/* off */
/* .listTile:focus{ background: rgb(71, 42, 173); } */


</style>