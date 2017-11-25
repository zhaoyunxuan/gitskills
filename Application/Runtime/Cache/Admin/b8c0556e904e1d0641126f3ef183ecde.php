<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>添加</title>
</head>
<body>
<form method="post" action="/text/index.php/Admin/Index/add"  >
    文章标题 <input type="text" name="title" value="<?php echo ($list["title"]); ?>"></br>
    文章分类 <input type="text" name="author" value="<?php echo ($list["author"]); ?>"></br>
    文章内容 <input type="text" name="content" value="<?php echo ($list["content"]); ?>"></br>
<input type="submit" value="提交">
</form>

</body>
</html>