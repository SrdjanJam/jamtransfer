<?php
/* Smarty version 3.1.32, created on 2022-10-14 13:12:16
  from 'c:\wamp\www\jamtransfer\templates\add-style.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_63494410a0e435_59358433',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2d24832a246e85f5de94ea3db8f7e5fc9a7e1ef4' => 
    array (
      0 => 'c:\\wamp\\www\\jamtransfer\\templates\\add-style.tpl',
      1 => 1665745672,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63494410a0e435_59358433 (Smarty_Internal_Template $_smarty_tpl) {
?><style>

/* templates/index.tpl */
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
    color: rgb(71, 88, 184);
    background: none;
}

/* ------------------------------------------ */
/* DriversTransfers/templates/index.tpl and AgentsTransfers/templates/index.tpl */

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

.white-bg{ padding:10px 0 20px 0; }

.container{ padding:10px 0 20px 0; }

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

</style><?php }
}
