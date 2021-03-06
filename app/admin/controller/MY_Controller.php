<?php
/**
 * Created by PhpStorm.
 * User: brady
 * Date: 2018/5/18
 * Time: 10:48
 */

namespace app\admin\controller;


use think\Controller;

class MY_Controller extends Controller
{
    public $admin_info;
    public $error_code;
    public function _initialize()
    {
        if(session('?admin_info')){
            $this->_admin_info = session('admin_info');
        } else {
            $this->redirect('login/index', 302);
        }

        $this->error_code = config('error_code');
    }

    protected $code = [

    ];


    public function success_response($code=0,$data=[])
    {
        header('Content-type: application/json'); //json
        $msg = '成功';
        echo json_encode(['success' => true,'code'=>$code, 'msg' => $msg,'data'=>$data]);
        exit();
    }

    public function error_response($code=0,$data=[])
    {
        header('Content-type: application/json'); //json
        if(isset($this->error_code[$code])){
            $msg = $this->error_code[$code];
        } else {
            if(is_numeric($code)){
                $msg = '未知错误';
            } else {
                $msg = $code;
            }
        }
        echo json_encode(['success' => false, 'msg' => $msg,'data'=>$data]);
        exit();
    }
}