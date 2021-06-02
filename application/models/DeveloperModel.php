<?php

class DeveloperModel extends CI_Model
{
    public function tampil_data()
    {
        return $this->db->get('developer')->result_array();
    }

    public function makeGameRequest()
    {
        $data = array(
            'developer_id' => $this->input->post('developer_id'),
            'gameName' => $this->input->post('gameName'),
            'price' => $this->input->post('price'),
            'description' => $this->input->post('description'),
            'image' => 'default.jpg',
            'is_publish' => false
        );
        $this->db->insert('game', $data);
    }

    public function myPublishedGames()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->db->select('*');
        $this->db->from('game');
        $this->db->join('developer', 'developer.developer_id = game.developer_id');
        $condition = "developer.id_user = " . $data['user']['id_user'];
        $this->db->where($condition);
        return $this->db->get()->result_array(); //data Array

    }

    public function getRevenue()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    }
}
