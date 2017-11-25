<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Verify;
class LoginController extends Controller {
    public function index(){

        $this->display();
    }


    public function login(){

            $Verify= new \Think\Verify();//掉方法
           // var_dump($Verify->check($_POST["yzm"]));//输出在该验证码的常量如果为true成功 为false失败
            // 判断提交方式
            if (IS_POST) {
                // 实例化Login对象
                $login = M('admin');

                // 组合查询条件
                $where = array();
                $where['name'] = I('post.name');
                $where['password'] = I('post.password');
                $result = $login->where($where)->field('id,name,password')->find();
                // 验证用户名 对比 密码
                if ($result && $result['password'] == I('post.password') && $Verify->check($_POST["yzm"])) {
                    // 存储session
                    session('uid', $result['id']);          // 当前用户id
                    session('username', $result['name']);   // 当前用户名

                    $this->success('登录成功,正跳转至系统首页...', U('Index/index'));
                } else {
                    $this->error('登录失败,用户名或密码不正确!');
                }
        }

    }


    public function login_api(){

        $Verify= new \Think\Verify();//掉方法
        // var_dump($Verify->check($_POST["yzm"]));//输出在该验证码的常量如果为true成功 为false失败
        // 判断提交方式
        if (IS_POST) {

            $name = I('post.name','');
            $password = I('post.password','');
            if(!$name || !$password){
                $result = array(
                    'flag' => 'error',
                    'msg' => '姓名或密码未填写',
                    'data'=>'3'
                );
                print json_encode($result,JSON_UNESCAPED_UNICODE);
                die();
            }


            // 实例化Login对象
            $login = M('admin');

            // 组合查询条件
            $where = array();
            $where['name'] = I('post.name');
            $where['password'] = I('post.password');
            $result = $login->where($where)->field('id,name,password')->find();
            // 验证用户名 对比 密码
            if ($result && $result['password'] == I('post.password') && $Verify->check($_POST["yzm"])) {
                // 存储session
                session('uid', $result['id']);          // 当前用户id
                session('username', $result['name']);   // 当前用户名

                $result = array(
                    'flag' => 'success',
                    'msg' => '登录成功',
                    'data'=>'1'
                );
                print json_encode($result,JSON_UNESCAPED_UNICODE);
                die();
                //$this->success('登录成功,正跳转至系统首页...', U('Index/index'));
            } else {
              //  $this->error('登录失败,用户名或密码不正确!');
                $result = array(
                    'flag' => 'error',
                    'msg' => '登录失败',
                    'data'=>'2'
                );
                print json_encode($result,JSON_UNESCAPED_UNICODE);
                die();
            }
        }
        else{
            $result = array(
                'flag' => 'error',
                'msg' => '请求错误',
                'data'=>'4'
            );
            print json_encode($result,JSON_UNESCAPED_UNICODE);
            die;
        }

    }

    public function add(){
        $list=M('article');
        //echo  $list->getLastSql();

        if(IS_POST){
            $date = array(
                'title'=>I('post.title'),
                'author'=>I('post.author'),
                'content'=>I('post.content'),
            );

            if($list->add($date)){
                echo '添加成功';die;
            }else{
                echo '添加失败';die;
            }

        }
        $this->display();


    }

    public function edit(){
        $aid = I('get.aid');
        $list=M('article');
        //echo  $list->getLastSql();

        if($aid){
            $lists =  $list ->where("aid=$aid")->find();

          //  echo  $list->getLastSql();
            $this->assign('list',$lists);


        }

        if(IS_POST){
            $aid = I('post.aid');
            $date = array(
                'title'=>I('post.title'),
                'author'=>I('post.author'),
                'content'=>I('post.content'),
            );
            if($list ->where("aid=$aid")->save($date)){
                echo '更新成功';die;
            }else{
                echo '更新失败';die;
            }

        }
        $this->display();


    }
    public function del(){

        $aid = I('get.aid');

        $article = D('article');

          if($aid){
              $ti = $article->where("aid = $aid")->delete();
                if($ti){
                    $this->assign('res','删除成功');
                }
                else{
                    $this->assign('res','删除失败');
                }
          }else{
              $this->assign('res','ID不对');
          }
          $this->display();
    }

    public function verify_img()
    {
        $config=array(
            'imageW'=>120,
            'imageH'=>40,    //高
            'fontSize'=>15,
            'fontttf'=>'4.ttf',
            'length'=>4
        );

        $verify = new Verify($config);

        $verify->entry();  //输出验证码
    }
    public function upload(){

        $list=M('article');
        if(IS_POST){
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize   =     3145728 ;// 设置附件上传大小
            $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            $upload->rootPath  =     './Uploads/'; // 设置附件上传根目录
            $upload->savePath  =     ''; // 设置附件上传（子）目录
            // 上传文件
            $info   =   $upload->uploadOne($_FILES['photo']);

            if(!$info) {// 上传错误提示错误信息
                $this->error($upload->getError());
            }else{// 上传成功

                $date['content'] = $info['savename'];
                $list ->where("aid=18")->save($date);
                $this->success('上传成功！');
            }


        }

    }
}