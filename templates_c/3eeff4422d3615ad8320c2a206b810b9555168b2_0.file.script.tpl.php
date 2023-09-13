<?php
/* Smarty version 3.1.32, created on 2023-09-11 09:12:20
  from 'C:\wamp\www\jamtransfer\plugins\Dashboard\templates\script.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_64febdd4e72388_44189073',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3eeff4422d3615ad8320c2a206b810b9555168b2' => 
    array (
      0 => 'C:\\wamp\\www\\jamtransfer\\plugins\\Dashboard\\templates\\script.tpl',
      1 => 1691053427,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_64febdd4e72388_44189073 (Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
>

$('.box-body').hide();

    $(".btn-info").click(function(){
        var name = $(this).attr("data-name");
        $('.'+name).toggle('1000');
        $("i", this).toggleClass("fa fa-plus fa fa-minus");
	});

    // Toggle attribute
    $(".btn-info").attr('title', 'Show').click(function() {
            $(this).toggleClass('checked');
            var title = 'Show';
            if( $(this).hasClass('checked')){
                title = 'Hide';
            }
            $(this).attr('title', title);
        });

<?php echo '</script'; ?>
><?php }
}
