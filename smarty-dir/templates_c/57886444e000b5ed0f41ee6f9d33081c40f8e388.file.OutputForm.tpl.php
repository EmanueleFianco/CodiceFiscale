<?php /* Smarty version Smarty-3.1.13, created on 2015-04-22 18:22:07
         compiled from "smarty-dir/templates/OutputForm.tpl" */ ?>
<?php /*%%SmartyHeaderCode:20849181635537caafef82e7-92518431%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '57886444e000b5ed0f41ee6f9d33081c40f8e388' => 
    array (
      0 => 'smarty-dir/templates/OutputForm.tpl',
      1 => 1429719025,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20849181635537caafef82e7-92518431',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'persona' => 0,
    'codice' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5537cab0026537_47486077',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5537cab0026537_47486077')) {function content_5537cab0026537_47486077($_smarty_tpl) {?><html>
	<body bgcolor="0099FF">
		<h3 align=center >Risultato</h5>
		<table>
			<tr>
				<td>Nome &nbsp</td>
				<td> <?php echo $_smarty_tpl->tpl_vars['persona']->value->getNome();?>
 <br></td>
			</tr>
			<tr>
				<td>Cognome &nbsp</td>
				<td> <?php echo $_smarty_tpl->tpl_vars['persona']->value->getCognome();?>
 <br></td>
			</tr>
			<tr>
				<td>Data dd/mm/yy &nbsp </td>
				<td> <?php echo $_smarty_tpl->tpl_vars['persona']->value->getNascita()->format('d/m/Y');?>
 <br></td>
			</tr>
			<tr>
				<td>Sesso M/F &nbsp</td>
				<td> <?php echo $_smarty_tpl->tpl_vars['persona']->value->getSesso();?>
 <br></td>
			</tr>
			<tr>
				<td>Provincia &nbsp</td>
				<td> <?php echo $_smarty_tpl->tpl_vars['persona']->value->getComune()->getProvincia();?>
 <br></td>
			</tr>
			<tr>
				<td>Comune &nbsp</td>
				<td> <?php echo $_smarty_tpl->tpl_vars['persona']->value->getComune()->getCitta();?>
 <br></td>
			</tr>
			<tr>
				<td>Codice Fiscale &nbsp</td>
				<td> <?php echo $_smarty_tpl->tpl_vars['codice']->value->getCodice();?>
 <br></td>
			</tr>
		</table>
	</body>
</html><?php }} ?>