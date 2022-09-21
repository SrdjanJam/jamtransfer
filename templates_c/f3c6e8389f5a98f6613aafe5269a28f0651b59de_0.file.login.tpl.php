<?php
/* Smarty version 3.1.32, created on 2022-09-20 11:53:25
  from 'C:\wamp\www\jamtransfer\templates\login.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_6329a9b51f78a9_09503986',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f3c6e8389f5a98f6613aafe5269a28f0651b59de' => 
    array (
      0 => 'C:\\wamp\\www\\jamtransfer\\templates\\login.tpl',
      1 => 1663667425,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6329a9b51f78a9_09503986 (Smarty_Internal_Template $_smarty_tpl) {
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

          <h2 class="form-signin-heading">Sign in</h2>
          
          <label for="username" class="sr-only">User name</label>
          
          <input type="text" name="username" id="username" class="form-control" placeholder="User name" required autofocus>
          
          <label for="inputPassword" class="sr-only">Password</label>
          <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>

          <select name="language" id="language" class="form-control">
            <option value='en'>English</option>
            <option value='hr'>Hrvatski</option>
          </select>

          <button class="btn btn-lg btn-primary btn-block" name="Login" type="submit">Sign in</button>

          <?php if ($_smarty_tpl->tpl_vars['error']->value) {?>

            <?php if ($_smarty_tpl->tpl_vars['message']->value == 1) {?>
            <br/><b>Your account has been blocked.</b><br/>
                    Please contact us immediately!
            <?php }?>
    
            <?php if ($_smarty_tpl->tpl_vars['message']->value == 2) {?>
              <br/><b class="lFailed"><?php echo LOGIN_FAILED;?>
</b><br/>
            <?php }?>
    
            <?php if ($_smarty_tpl->tpl_vars['message']->value == 3) {?>
              <br/><b><?php echo USE_BOTH;?>
</b><br/>
            <?php }?>
    
    
          <?php }?>

        </form> <!-- End of form -->

        

    </div> <!-- /.container -->
		    <br><br><br><br>

	</body>
	</html><?php }
}
