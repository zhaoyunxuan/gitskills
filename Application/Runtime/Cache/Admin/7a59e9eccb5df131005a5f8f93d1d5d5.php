<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>文件上传</title>
</head>
<body>
<form enctype="multipart/form-data" method="post" action="/text/index.php/Admin/Index/excel_runimport">


    <input type="file" name="wenjian" />
    <input type="submit" value="提交" />


</form>
</body>
</html>