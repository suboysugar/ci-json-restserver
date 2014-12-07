<?php
class News_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    /**
     * 更新
     * @param $id
     */
    public function update_news($id){
        $data = array(
            'title' => $this->input->post('title'),
            'slug' => $this->input->post('slug'),
            'text' => $this->input->post('text')
        );

        $this->db->where('id', $id);
        $this->db->update('news', $data);

    }

    /**
     * 删除
     * @param $id
     */
    public function del_news($id){
        $this->db->delete('news', array('id' => $id));
    }

    /**
     * 单个获取
     * @param bool $id
     * @return mixed
     */
    public function get_news($id = FALSE)
    {
        if ($id === FALSE)
        {
            $query = $this->db->get('news');
            return $query->result_array();
        }

        $query = $this->db->get_where('news', array('id' => $id));
        return $query->row_array();
    }

    /**
     *单个新增
     * @return mixed
     */
    public function set_news()
    {

        $data = array(
            'title' => $this->input->post('title'),
            'slug' => $this->input->post('slug'),
            'text' => $this->input->post('text')
        );

        return $this->db->insert('news', $data);
    }

}
?>