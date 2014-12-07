<?php
class News extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('news_model');
    }

    public function index()
    {
        $data['news'] = $this->news_model->get_news();
        $data['title'] = 'News archive';

        $this->load->view('templates/header', $data);
        $this->load->view('news/index', $data);
        $this->load->view('templates/footer');
    }

    /**
     * 更新
     * @param $id
     */
    public function update($id){
        //加载表单辅助类和校验辅助类
        $this->load->helper('form');
        $this->load->library('form_validation');
        //取隐藏域;PHP开发Tips：如果想要判断两个字符串是否相等，使用 === 而不是 ==。
        $flag = $this->input->post('flag');
        //更新并保存到数据库
        if("TRUE" === $flag ){
            $data['title'] = 'Update a news item';
            //表单验证，非空校验
            $this->form_validation->set_rules('title', '标题', 'required');
            $this->form_validation->set_rules('slug', 'Slug', 'required');
            $this->form_validation->set_rules('text', '内容', 'required');
            //表单验证结果是FALSE
            if ($this->form_validation->run() === FALSE)
            {
                $this->load->view('templates/header', $data);
                $this->load->view('news/create');
                $this->load->view('templates/footer');

            }
            else
            {
                $data['info'] = '更新成功';
                $this->news_model->update_news($id);
                //往视图里面传递数据
                $this->load->view('news/success', $data);
            }

        }else{
            //跳转到更新页面，无数据库保存
            $data['news_item'] = $this->news_model->get_news($id);

            if (empty($data['news_item']))
            {
                show_404();
            }

            $this->load->view('news/update', $data);

        }


    }

    /**
     * 删除
     * @param $id
     */
    public function delete($id){
        $this->news_model->del_news($id);
        $data['info'] = '删除成功';
        $this->load->view('news/success', $data);
    }

    /**
     * 查看
     * @param $id
     */
    public function view($id)
    {
        $data['news_item'] = $this->news_model->get_news($id);

        if (empty($data['news_item']))
        {
            show_404();
        }

        $data['title'] = $data['news_item']['title'];

        $this->load->view('templates/header', $data);
        $this->load->view('news/view', $data);
        $this->load->view('templates/footer');
    }

    /**
     * 创建
     */
    public function create()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = 'Create a news item';

        $this->form_validation->set_rules('title', '标题', 'required');
        $this->form_validation->set_rules('slug', 'Slug', 'required');
        $this->form_validation->set_rules('text', '内容', 'required');

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header', $data);
            $this->load->view('news/create');
            $this->load->view('templates/footer');

        }
        else
        {
            $data['info'] = '创建成功';
            $this->news_model->set_news();
            //往视图里面传递数据
            $this->load->view('news/success', $data);
        }
    }

}
?>