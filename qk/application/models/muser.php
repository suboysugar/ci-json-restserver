<?php
class MUser extends CI_Model {

    public function __construct()
    {
        //加载数据库配置
        $this->load->database();
    }

    /**
     * 单个新增用户
     * @return mixed
     */
    public function createUser()
    {
        $data = array(
            'name' => $this->input->post('name'),
            'nickname' => $this->input->post('nickname'),
            'mobile' => $this->input->post('mobile'),
            'sex' => $this->input->post('sex'),
            'create_date' => $this->input->post('create_date')
        );

        return $this->db->insert('user', $data);
    }

    /**
     * 获取单个用户
     * @param $id
     */
    public function getUser($id)
    {
        $query = $this->db->get_where('user', array('id' => $id));
        //row_array取一行数据;result_array取多行数据
        return $query->row_array();

    }

    /**
     * 获取最新注册的前N个用户
     * @param $num
     * @return mixed
     */
    public function getNewUsers($num)
    {
        $this->db->limit($num);
        $this->db->order_by("create_date", "desc");
        $query = $this->db->get('user');
        //返回多行
        return $query->result_array();
    }

}
?>