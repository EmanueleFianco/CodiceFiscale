<?php /* Smarty version Smarty-3.1.13, created on 2015-05-21 10:25:17
         compiled from "smarty-dir/templates/OutputForm.tpl" */ ?>
<?php /*%%SmartyHeaderCode:11507419865541413b9dc811-57929277%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '57886444e000b5ed0f41ee6f9d33081c40f8e388' => 
    array (
      0 => 'smarty-dir/templates/OutputForm.tpl',
      1 => 1432196713,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11507419865541413b9dc811-57929277',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5541413ba4ad69_05336762',
  'variables' => 
  array (
    'persona' => 0,
    'codice' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5541413ba4ad69_05336762')) {function content_5541413ba4ad69_05336762($_smarty_tpl) {?><html>
<head>
	<link type="text/css"
           rel ="stylesheet"
           href= "Utility/graficaoutput.css"
      >
</head>
	<body bgcolor="0099FF">
		<h3 align=center ><b>Risultato</b></h3>
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
		<div id="credits">
		   <p>
		   	  Design and develop by:  Fabio Di Sabatino-Emanuele Fianco-Gioele Cicchini-Federica Caruso.

		   </p>
	</body>
</html><?php }} ?>