<?php
/* Smarty version 3.1.32, created on 2024-07-10 14:30:12
  from '/home/taxifrom/wis.taxifrom.com/plugins/SubDriverPanel/templates/sign.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_668e7ed4307b76_17506265',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9db898532938798f1bce255550a7570e59199031' => 
    array (
      0 => '/home/taxifrom/wis.taxifrom.com/plugins/SubDriverPanel/templates/sign.tpl',
      1 => 1720614610,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_668e7ed4307b76_17506265 (Smarty_Internal_Template $_smarty_tpl) {
?><!-- visak botun za natrag
<small style="font-size:2em; margin-left:2em">
	<a href="index.php?p=details&id=<?php echo '<?=';?> $_REQUEST['id']<?php echo '?>';?>">
		<i class="fa fa-navicon"></i>
	</a>
</small>
-->

<style>
body {
	padding: 0 !important;
	text-align: center;
}
#PaxName {
	display: block;
	width: 100%;
	position: fixed;
	top: 50%; left: 50%;
	transform: translate(-50%,-50%);
	font-weight: bolder;
}
</style>


<div>
	<img src="<?php echo $_smarty_tpl->tpl_vars['ROOT_HOME']->value;?>
i/logo_horN.png" width="250px">
	<br>
	<span id="PaxName" style="font-size: <?php echo $_smarty_tpl->tpl_vars['size']->value;?>
em;"><?php echo $_smarty_tpl->tpl_vars['paxname']->value;?>
</span>
</div>

<?php echo '<script'; ?>
>
	document.getElementsByClassName("navbar")[0].style.display = "none";
<?php echo '</script'; ?>
>

<?php }
}
