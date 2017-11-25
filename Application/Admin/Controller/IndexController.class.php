<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Verify;
class IndexController extends Controller {
    public function index(){

        $article = M('article');
        $list = $article->select();
        $this->assign('list',$list);
        $this->display();
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


    public function shangchuan(){


        $this->display();


    }

    public function excel_runimport(){
        import("Org.Util.PHPExcel");
        $PHPExcel=new \PHPExcel();
        import("Org.Util.PHPExcel.Reader.Excel5");

        if (! empty ( $_FILES ['file_stu'] ['name'] )){
            $tmp_file = $_FILES ['file_stu'] ['tmp_name'];
            $file_types = explode ( ".", $_FILES ['file_stu'] ['name'] );
            $file_type = $file_types [count ( $file_types ) - 1];
            /*判别是不是.xls文件，判别是不是excel文件*/
            if (strtolower ( $file_type ) != "xls"){
                $this->error ( '不是Excel文件，重新上传',U('excel_import'),0);
            }
            /*设置上传路径*/
            $savePath = './Public/excel/';
            /*以时间来命名上传的文件*/
            $str = time ( 'Ymdhis' );
            $file_name = $str . "." . $file_type;
            if (! copy ( $tmp_file, $savePath . $file_name )){
                $this->error ('上传失败',U('excel_import'),0);
            }
            $res = $this->read ( $savePath . $file_name );
            if (!$res){
                $this->error ('数据处理失败失败',U('excel_import'),0);
            }
            var_dump($res);die;
            //spl_autoload_register ( array ('Think', 'autoload' ) );
            foreach ( $res as $k => $v ){
                if ($k != 1){
                    $data ['id'] = $v[0];
                    $data ['name'] = $v[1];
                    $data ['password'] = $v[2];

                    $result = M ('admin')->add ($data);
                    if (!$result){

                        $this->error ('导入数据库失败',U('excel_import'),0);
                    }
                }
            }
            $this->success ('导入数据库成功',U('excel_import'),1);
        }
    }
}