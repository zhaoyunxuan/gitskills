<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>登录</title>
</head>
<body>
<form method="post" action="/text/index.php/Admin/Login/login">

    <div>
        用户名<input type="text" name="name">
    </div>
    <div>
        密码<input type="password" name="password">
    </div>
    <div>
        验证码<input type="text" name="yzm"><img src="<?php echo U('Login/verify_img');?>" />
    </div>
    <div>
            <input type="submit" value="提交">
    </div>

</form>
<form method="post" action="/text/index.php/Admin/Login/upload" enctype="multipart/form-data" >
    <input type='file'  name='photo'>
<input type="submit" value="提交">
</form>
</body>
</html>