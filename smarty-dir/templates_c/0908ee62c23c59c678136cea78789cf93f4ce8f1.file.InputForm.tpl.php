<?php /* Smarty version Smarty-3.1.13, created on 2015-04-29 22:40:44
         compiled from "smarty-dir/templates/InputForm.tpl" */ ?>
<?php /*%%SmartyHeaderCode:70804718255414116b6ec77-80293330%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0908ee62c23c59c678136cea78789cf93f4ce8f1' => 
    array (
      0 => 'smarty-dir/templates/InputForm.tpl',
      1 => 1430340006,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '70804718255414116b6ec77-80293330',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_55414116bb3b90_24807693',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55414116bb3b90_24807693')) {function content_55414116bb3b90_24807693($_smarty_tpl) {?><html>
	<body bgcolor="0099FF">
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
					<td>Data dd/mm/yyyy</td>
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
                    <td><a target="_blank" href="file_esempio.php">Esempio file utile..</a></td>
				</tr>              
			 	<tr>
					<td align =center><input type="submit" value="Invia richiesta"></td>
				</tr>
			</table>
		</form>
	</body>
</html> 
<?php }} ?>