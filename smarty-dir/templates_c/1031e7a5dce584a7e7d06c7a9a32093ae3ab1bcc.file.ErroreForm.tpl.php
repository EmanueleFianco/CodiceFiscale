<?php /* Smarty version Smarty-3.1.13, created on 2015-05-16 17:46:18
         compiled from "smarty-dir/templates/ErroreForm.tpl" */ ?>
<?php /*%%SmartyHeaderCode:15487486255557664a6af782-35241268%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1031e7a5dce584a7e7d06c7a9a32093ae3ab1bcc' => 
    array (
      0 => 'smarty-dir/templates/ErroreForm.tpl',
      1 => 1431791127,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '15487486255557664a6af782-35241268',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'e' => 0,
    'visite' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5557664a8c4b66_36801429',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5557664a8c4b66_36801429')) {function content_5557664a8c4b66_36801429($_smarty_tpl) {?><html>
	<body bgcolor="0099FF">
		<h3 align=center > <?php echo $_smarty_tpl->tpl_vars['e']->value->getMessage();?>
 </h3>
		<h3 align=center>Calcolo Codice Fiscale</h3>
		<form action="elabora_input_form.php" method="post" enctype = "multipart/form-data">
			<table >
				<tr>
					<td>Nome</td>
					<td><input type="text" name="nome"><br></td>
				</tr>
				<tr>
					<td>Cognome</td>
					<td><input type="text" name="cognome"><br></td>
				</tr>
				<tr>
					<td>Data dd/mm/yy</td>
					<td><input type="text" name="data" size=10 maxlength=10><br></td>
				</tr>
				<tr>
					<td>Sesso</td>
					<td align="center">
						F<input type="radio" name="sesso" value="F" checked>
						M<input type="radio" name="sesso" value="M">
					</td>
				</tr>
				<tr>
					<td>Provincia</td>
					<td><input type="text" name="provincia" size=2 maxlength=2><br></td>
				</tr>
				<tr>
					<td>Comune</td>
					<td><input type="text" name="comune"><br></td>
				</tr>
				<tr>
					<td>Aggiunta file <br> prioritario rispetto  <br> a form </td>
					<td><input type="file" name="file"></td>
				</tr>
				 <tr>
					<td>Visita numero: &nbsp</td>
				     <td><b><?php echo $_smarty_tpl->tpl_vars['visite']->value;?>
</b></td>
				</tr>  
			 	<tr>
					<td align =center><input type="submit"></td>
				</tr>
			</table>
		</form>
	</body>
</html><?php }} ?>