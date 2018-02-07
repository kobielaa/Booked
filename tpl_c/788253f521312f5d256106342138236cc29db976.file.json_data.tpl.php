<?php /* Smarty version Smarty-3.1.16, created on 2018-01-31 13:19:40
         compiled from "/var/www/booked.altimi.dev/tpl/json_data.tpl" */ ?>
<?php /*%%SmartyHeaderCode:17097160955a71b45c9c16c9-61911599%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '788253f521312f5d256106342138236cc29db976' => 
    array (
      0 => '/var/www/booked.altimi.dev/tpl/json_data.tpl',
      1 => 1420035436,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17097160955a71b45c9c16c9-61911599',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'data' => 0,
    'error' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_5a71b45c9ecc45_51999401',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5a71b45c9ecc45_51999401')) {function content_5a71b45c9ecc45_51999401($_smarty_tpl) {?>
<?php if ($_smarty_tpl->tpl_vars['data']->value!='') {?>
<?php echo $_smarty_tpl->tpl_vars['data']->value;?>

<?php }?>
<?php if ($_smarty_tpl->tpl_vars['error']->value!='') {?>
<?php echo $_smarty_tpl->tpl_vars['error']->value;?>

<?php }?><?php }} ?>
