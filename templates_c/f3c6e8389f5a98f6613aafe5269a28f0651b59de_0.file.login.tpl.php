<?php
/* Smarty version 3.1.32, created on 2023-09-11 07:11:58
  from 'C:\wamp\www\jamtransfer\templates\login.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_64febdbeeb6486_42787278',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f3c6e8389f5a98f6613aafe5269a28f0651b59de' => 
    array (
      0 => 'C:\\wamp\\www\\jamtransfer\\templates\\login.tpl',
      1 => 1685094532,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_64febdbeeb6486_42787278 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
	<html style="background: transparent  url('i/header/121.jpg') center fixed;background-size:cover;">
	<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
	<link rel="stylesheet" href="css/theme.css" type="text/css" />

	<style>

      .shadow{
        -webkit-box-shadow: 0px 0px 16px 0px rgba(50, 50, 50, 0.75);
        -moz-box-shadow:    0px 0px 16px 0px rgba(50, 50, 50, 0.75);
        box-shadow:         0px 0px 16px 0px rgba(50, 50, 50, 0.75);
      }
      .form-signin {
        max-width: 330px;
        padding: 15px;
        margin: 0 auto;
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin .checkbox {
        font-weight: normal;
      }
      .form-signin .form-control {
        position: relative;
        height: auto;
        -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
                box-sizing: border-box;
        padding: 10px;
        font-size: 16px;
      }
      .form-signin .form-control:focus {
        z-index: 2;
      }
      .form-signin input[type="email"] {
        margin-bottom: -1px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
      }
      .form-signin input[type="password"] {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
      }

      form b{
        font-size:20px;
      }
      form b.lFailed{
        color:rgb(207, 48, 48);
      }
    
      /* @media screen: */
      @media screen and (max-width:767px) {

        .form-signin {
          width: 100%;
          padding: 0;
          /* margin: 0; */
        }


      }

  </style>


	</head>

	<body style="background:transparent;display:block">

    <div class="container">
        <br><br><br><br>

        <!-- Form: -->
        <form class="form-signin" method="post" action="login.php">

          <h2 class="form-signin-heading"><?php echo $_smarty_tpl->tpl_vars['SIGN_IN']->value;?>
</h2>
          
          <label for="username" class="sr-only"><?php echo $_smarty_tpl->tpl_vars['USER_NAME']->value;?>
</label>
          
          <input type="text" name="username" id="username" class="form-control" placeholder="User name" required autofocus>
          
          <label for="inputPassword" class="sr-only"><?php echo $_smarty_tpl->tpl_vars['PASSWORD']->value;?>
</label>
          <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
          
		  <?php if (!$_smarty_tpl->tpl_vars['LOCAL']->value) {?>
		  <label for="inputPasswordT" class="sr-only"><?php echo $_smarty_tpl->tpl_vars['PASSWORD_FOR_TEST']->value;?>
</label>
          <input type="password" name="passwordT" id="passwordT" class="form-control" placeholder="Password for test" required>
		  <?php }?>
		  
		
          <select name="language" id="language" class="form-control">
            <option value='en'>English</option>
            <option value='fr'>Français</option>
          </select>
		  

          <button class="btn btn-lg btn-primary btn-block" name="Login" type="submit"><?php echo $_smarty_tpl->tpl_vars['SIGN_IN']->value;?>
</button>

          <?php if ($_smarty_tpl->tpl_vars['error']->value) {?>

            <?php if ($_smarty_tpl->tpl_vars['message']->value == 1) {?>
            <br/><b><?php echo $_smarty_tpl->tpl_vars['YOUR_ACCOUT_HAS_BEEN_BLOCKED']->value;?>
</b><br/>
                    <?php echo $_smarty_tpl->tpl_vars['PLEASE_CONTACT_US_IMMEDIATELY']->value;?>

            <?php }?>
    
            <?php if ($_smarty_tpl->tpl_vars['message']->value == 2) {?>
              <br/><b class="lFailed"><?php echo $_smarty_tpl->tpl_vars['LOGIN_FAILED']->value;?>
</b><br/>
            <?php }?>
    
            <?php if ($_smarty_tpl->tpl_vars['message']->value == 3) {?>
              <br/><b><?php echo $_smarty_tpl->tpl_vars['USE_BOTH']->value;?>
</b><br/>
            <?php }?>
    
    
          <?php }?>

        </form> <!-- End of form -->

        

    </div> <!-- /.container -->
		    <br><br><br><br>

	</body>
	</html><?php }
}
