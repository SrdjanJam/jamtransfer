<?php
/* Smarty version 3.1.32, created on 2022-10-25 07:41:31
  from 'c:\wamp\www\jamtransfer\templates\add-style.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_6357770b160733_81382518',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2d24832a246e85f5de94ea3db8f7e5fc9a7e1ef4' => 
    array (
      0 => 'c:\\wamp\\www\\jamtransfer\\templates\\add-style.tpl',
      1 => 1666356703,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6357770b160733_81382518 (Smarty_Internal_Template $_smarty_tpl) {
?>

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
/* ========================================================  */
            

.wrapper-edit{ padding:0px; }

.additional-class{
    position: fixed;
    height: 100vh;
    overflow-y: auto;
}

.nav-header-edit{
    padding: 5px 0 5px 2px;
    background-color: #e4e4e4;
    text-align: center;
    border: 2px solid #4c59ad;
    box-sizing: border-box;
    border-radius: 7px;
}
.nav-header-edit strong{
    color:rgb(16, 20, 83);
    font-family: 'Times New Roman', Times, serif;
}
.nav-header-edit #a-setout{
    text-decoration: underline;
    color: rgb(61, 61, 61);
    padding: 5px 0 5px 2px;
    display: inline-block;
}
.nav-header-edit #a-setout:hover{
    /* color: rgb(71, 88, 184); */
    color: rgb(184, 71, 71);
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

/* ------------------------------------------ */

/* DriversTransfers/templates/index.tpl and AgentsTransfers/templates/index.tpl */

/* Off */
/* .row_e{ 
    padding:0 0 3px 0; 
    font-size:18px; 
} */

.row_e:hover{ background:rgb(229, 229, 240); }

.col-md-4_e{ margin-bottom: 5px; }

/* ------------------------------------------ */
/* Cursor pointer */
.listTile{ cursor:pointer; }

.listTile:hover{ background: rgb(240, 240, 240); }

.listTile:focus{ background: rgb(71, 42, 173); }

/* ------------------------------------------ */
/* Booking/templates */
.book{ color:white; }

.book label{ color:white; }

#selectTo_options a{ color:white; }

#selectFrom_options a { color:white; }

.row-add{ padding:20px; }

.fa-user{ color:white; }
/* ------------------------------------------ */
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

/* ------------------------------------------ */
/* DriverRoutes - ListTemplate.php */
.listTitleEdit{
    cursor:auto;
}

</style><?php }
}
