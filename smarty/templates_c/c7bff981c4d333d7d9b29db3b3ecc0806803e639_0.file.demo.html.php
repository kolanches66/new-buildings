<?php
/* Smarty version 3.1.29, created on 2016-06-20 23:10:26
  from "C:\wamp\www\new_buildings\smarty\demo.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_57685bc2453773_69400389',
  'file_dependency' => 
  array (
    'c7bff981c4d333d7d9b29db3b3ecc0806803e639' => 
    array (
      0 => 'C:\\wamp\\www\\new_buildings\\smarty\\demo.html',
      1 => 1466457025,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57685bc2453773_69400389 ($_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Composer demo</title>
</head>
<body>
	<table class='table'>
		<?php
$_from = $_smarty_tpl->tpl_vars['buildings']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_foo_0_saved = isset($_smarty_tpl->tpl_vars['__smarty_foreach_foo']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_foo'] : false;
$__foreach_foo_0_saved_item = isset($_smarty_tpl->tpl_vars['building']) ? $_smarty_tpl->tpl_vars['building'] : false;
$_smarty_tpl->tpl_vars['building'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['__smarty_foreach_foo'] = new Smarty_Variable(array('index' => -1));
$_smarty_tpl->tpl_vars['building']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['building']->value) {
$_smarty_tpl->tpl_vars['building']->_loop = true;
$_smarty_tpl->tpl_vars['__smarty_foreach_foo']->value['index']++;
$__foreach_foo_0_saved_local_item = $_smarty_tpl->tpl_vars['building'];
?>
		
		<?php if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_foo']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_foo']->value['index'] : null)%1 == 0) {?>
			<tr></tr>
		<?php }?>
		
			<td><?php echo $_smarty_tpl->tpl_vars['building']->value['name'];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['building']->value['location'];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['building']->value['short_description'];?>
</td>
		
		<?php
$_smarty_tpl->tpl_vars['building'] = $__foreach_foo_0_saved_local_item;
}
if ($__foreach_foo_0_saved) {
$_smarty_tpl->tpl_vars['__smarty_foreach_foo'] = $__foreach_foo_0_saved;
}
if ($__foreach_foo_0_saved_item) {
$_smarty_tpl->tpl_vars['building'] = $__foreach_foo_0_saved_item;
}
?>    
	</table>
</body>
</html><?php }
}
