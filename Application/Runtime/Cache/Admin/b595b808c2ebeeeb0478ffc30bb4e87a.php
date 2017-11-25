<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>查询</title>
</head>
<body>
<form>
<table width="1000" border="1" align="center">
    <div>  <a href="/text/index.php/Admin/Index/add">添加</a></div>
<tr>
   <td>文章id</td>
   <td>文章标题</td>
   <td>文章分类</td>
   <td>文章内容</td>

</tr>
<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
        <td><?php echo ($vo["aid"]); ?></td>
        <td><?php echo ($vo["title"]); ?></td>
        <td><?php echo ($vo["author"]); ?></td>
        <td><?php echo ($vo["content"]); ?></td>
        <td>
            <a href="/text/index.php/Admin/Index/edit/aid/<?php echo ($vo["aid"]); ?>">修改</a>
            <a href="/text/index.php/Admin/Index/del/aid/<?php echo ($vo["aid"]); ?>">删除</a>
        </td>
    </tr><?php endforeach; endif; else: echo "" ;endif; ?>

</table>

</form>

</body>
</html>