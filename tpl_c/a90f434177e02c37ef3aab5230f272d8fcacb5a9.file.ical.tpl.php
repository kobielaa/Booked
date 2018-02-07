<?php /* Smarty version Smarty-3.1.16, created on 2018-01-31 14:02:52
         compiled from "/var/www/booked.altimi/tpl/Export/ical.tpl" */ ?>
<?php /*%%SmartyHeaderCode:934451115a71be7ca4ca76-28773011%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a90f434177e02c37ef3aab5230f272d8fcacb5a9' => 
    array (
      0 => '/var/www/booked.altimi/tpl/Export/ical.tpl',
      1 => 1420035436,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '934451115a71be7ca4ca76-28773011',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'bookedVersion' => 0,
    'Reservations' => 0,
    'reservation' => 0,
    'ScriptUrl' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_5a71be7ca75c70_02410773',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5a71be7ca75c70_02410773')) {function content_5a71be7ca75c70_02410773($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_regex_replace')) include '/var/www/booked.altimi/lib/Common/../../lib/external/Smarty/plugins/modifier.regex_replace.php';
?>
BEGIN:VCALENDAR
VERSION:2.0
METHOD:REQUEST
PRODID:-//BookedScheduler//NONSGML <?php echo $_smarty_tpl->tpl_vars['bookedVersion']->value;?>
//EN
<?php  $_smarty_tpl->tpl_vars['reservation'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['reservation']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['Reservations']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['reservation']->key => $_smarty_tpl->tpl_vars['reservation']->value) {
$_smarty_tpl->tpl_vars['reservation']->_loop = true;
?>
BEGIN:VEVENT
CLASS:PUBLIC
CREATED:<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formatdate'][0][0]->FormatDate(array('date'=>$_smarty_tpl->tpl_vars['reservation']->value->DateCreated,'key'=>'ical'),$_smarty_tpl);?>

DESCRIPTION:<?php echo smarty_modifier_regex_replace($_smarty_tpl->tpl_vars['reservation']->value->Description,"/\r\n|\n|\r/m","\n ");?>

DTSTAMP:<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formatdate'][0][0]->FormatDate(array('date'=>$_smarty_tpl->tpl_vars['reservation']->value->DateCreated,'key'=>'ical'),$_smarty_tpl);?>

DTSTART:<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formatdate'][0][0]->FormatDate(array('date'=>$_smarty_tpl->tpl_vars['reservation']->value->DateStart,'key'=>'ical'),$_smarty_tpl);?>

DTEND:<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['formatdate'][0][0]->FormatDate(array('date'=>$_smarty_tpl->tpl_vars['reservation']->value->DateEnd,'key'=>'ical'),$_smarty_tpl);?>

LOCATION:<?php echo $_smarty_tpl->tpl_vars['reservation']->value->Location;?>

ORGANIZER;CN=<?php echo $_smarty_tpl->tpl_vars['reservation']->value->Organizer;?>
:MAILTO:<?php echo $_smarty_tpl->tpl_vars['reservation']->value->OrganizerEmail;?>

<?php if ($_smarty_tpl->tpl_vars['reservation']->value->RecurRule!='') {?>
RRULE:<?php echo $_smarty_tpl->tpl_vars['reservation']->value->RecurRule;?>

<?php }?>
SUMMARY:<?php echo $_smarty_tpl->tpl_vars['reservation']->value->Summary;?>

UID:<?php echo $_smarty_tpl->tpl_vars['reservation']->value->ReferenceNumber;?>
&<?php echo $_smarty_tpl->tpl_vars['ScriptUrl']->value;?>

SEQUENCE:0
URL:<?php echo $_smarty_tpl->tpl_vars['reservation']->value->ReservationUrl;?>

X-MICROSOFT-CDO-BUSYSTATUS:BUSY
END:VEVENT
<?php } ?>
<?php if ($_smarty_tpl->tpl_vars['reservation']->value->StartReminder!=null) {?>
BEGIN:VALARM
TRIGGER;RELATED=START:-PT<?php echo $_smarty_tpl->tpl_vars['reservation']->value->StartReminder->MinutesPrior();?>
M
ACTION:DISPLAY
DESCRIPTION:<?php echo $_smarty_tpl->tpl_vars['reservation']->value->Summary;?>

END:VALARM
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['reservation']->value->EndReminder!=null) {?>
BEGIN:VALARM
TRIGGER;RELATED=END:-PT<?php echo $_smarty_tpl->tpl_vars['reservation']->value->EndReminder->MinutesPrior();?>
M
ACTION:DISPLAY
DESCRIPTION:<?php echo $_smarty_tpl->tpl_vars['reservation']->value->Summary;?>

END:VALARM
<?php }?>
END:VCALENDAR<?php }} ?>
