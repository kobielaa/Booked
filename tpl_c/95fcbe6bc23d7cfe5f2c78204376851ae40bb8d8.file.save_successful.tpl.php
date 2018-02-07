<?php /* Smarty version Smarty-3.1.16, created on 2018-01-31 13:19:50
         compiled from "/var/www/booked.altimi.dev/tpl/Ajax/reservation/save_successful.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1206559065a71b46621c4e4-77867046%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '95fcbe6bc23d7cfe5f2c78204376851ae40bb8d8' => 
    array (
      0 => '/var/www/booked.altimi.dev/tpl/Ajax/reservation/save_successful.tpl',
      1 => 1420035436,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1206559065a71b46621c4e4-77867046',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'RequiresApproval' => 0,
    'ReferenceNumber' => 0,
    'Instances' => 0,
    'instance' => 0,
    'Resources' => 0,
    'resource' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_5a71b466231005_54475558',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5a71b466231005_54475558')) {function content_5a71b466231005_54475558($_smarty_tpl) {?>
<div id="reservationCreated" class="reservationResponseMessage">
	<?php if ($_smarty_tpl->tpl_vars['RequiresApproval']->value) {?>
		<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"dialog-warning.png",'id'=>"imgApprovalWarning"),$_smarty_tpl);?>

	<?php } else { ?>
		<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['html_image'][0][0]->PrintImage(array('src'=>"dialog-success.png",'id'=>"imgReservationSuccess"),$_smarty_tpl);?>

	<?php }?>
	<br/>
	<div class="createdMessage"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ReservationCreated'),$_smarty_tpl);?>
</div>
	<div class="referenceNumber"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'YourReferenceNumber','args'=>$_smarty_tpl->tpl_vars['ReferenceNumber']->value),$_smarty_tpl);?>
</div>

	<div class="dates">
		<?php  $_smarty_tpl->tpl_vars['instance'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['instance']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['Instances']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['instance']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['instance']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['instance']->key => $_smarty_tpl->tpl_vars['instance']->value) {
$_smarty_tpl->tpl_vars['instance']->_loop = true;
 $_smarty_tpl->tpl_vars['instance']->iteration++;
 $_smarty_tpl->tpl_vars['instance']->last = $_smarty_tpl->tpl_vars['instance']->iteration === $_smarty_tpl->tpl_vars['instance']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['date_list']['last'] = $_smarty_tpl->tpl_vars['instance']->last;
?>
			<span class="date"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['format_date'][0][0]->FormatDate(array('date'=>$_smarty_tpl->tpl_vars['instance']->value->StartDate()),$_smarty_tpl);?>
<?php if (!$_smarty_tpl->getVariable('smarty')->value['foreach']['date_list']['last']) {?>, <?php }?></span>
		<?php } ?>
	</div>

	<div class="resources">
		<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Resources'),$_smarty_tpl);?>
:
		<?php  $_smarty_tpl->tpl_vars['resource'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['resource']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['Resources']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['resource']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['resource']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['resource']->key => $_smarty_tpl->tpl_vars['resource']->value) {
$_smarty_tpl->tpl_vars['resource']->_loop = true;
 $_smarty_tpl->tpl_vars['resource']->iteration++;
 $_smarty_tpl->tpl_vars['resource']->last = $_smarty_tpl->tpl_vars['resource']->iteration === $_smarty_tpl->tpl_vars['resource']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['resource_list']['last'] = $_smarty_tpl->tpl_vars['resource']->last;
?>
			<span class="resource"><?php echo $_smarty_tpl->tpl_vars['resource']->value->GetName();?>
<?php if (!$_smarty_tpl->getVariable('smarty')->value['foreach']['resource_list']['last']) {?>, <?php }?></span>
		<?php } ?>
	</div>

	<?php if ($_smarty_tpl->tpl_vars['RequiresApproval']->value) {?>
		<div class="approvalMessage"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'ReservationRequiresApproval'),$_smarty_tpl);?>
</div>
	<?php }?>

	<input type="button" id="btnSaveSuccessful" value="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0][0]->SmartyTranslate(array('key'=>'Close'),$_smarty_tpl);?>
" class="button" />

</div><?php }} ?>
