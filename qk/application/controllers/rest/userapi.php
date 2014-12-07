<?php

/**
 * 用户API接口
 * Class Userapi
 */
class Userapi extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        //加载模型类
        $this->load->model('muser');
        //加载自写的JSON辅助类
       // $this->load->helper('json');
        $this->output->set_content_type('Content-Type: application/json; charset=utf-8');

    }

    /**
     * 单个新增用户
     * @return mixed
     */
    public function createUser()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');


        $this->form_validation->set_rules('mobile', 'mobile', 'required');
        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('nickname', 'nickname', 'required');
        $this->form_validation->set_rules('sex', 'sex', 'required');

        if ($this->form_validation->run() === FALSE)
        {
            //验证有错误
            $data['msg']= '提交数据校验失败';
            //转换为JSON字符串
           echo  json_encode($data, JSON_UNESCAPED_UNICODE);

        }
        else
        {
            $data['msg']= 'SUCCESS';
            $data['result']= $this->muser->createUser();
            //转换为JSON字符串
            echo  json_encode($data, JSON_UNESCAPED_UNICODE);

        }

    }


    /**
     * 获取单个用户
     * http://localhost:8088/qk/rest/userapi/getuser/1
     * @param $id
     * @return string
     */
    public function getUser($id)
    {
        $data['result']= $this->muser->getUser($id);
        //转换为JSON字符串
        echo  json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    /**
     * 获取最新注册的前N个用户
     * @param $num
     */
    public function getNewUsers($num)
    {
        $data['result']= $this->muser->getNewUsers($num);
        //转换为JSON字符串
        echo  json_encode($data, JSON_UNESCAPED_UNICODE);
    }



}
?>