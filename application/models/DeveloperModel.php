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
        // $this->db->where('usergame', ['id_user' => $data['user']['id_user']]);
        $this->db->where($condition);
        return $this->db->get()->result_array(); //data Array
        // $data['developer'] = $this->db->get_where('developer', ['id_user' => $data['user']['id_user']])->row_array();
    }

    // public function countGameSold($id)
    // {
    //     $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    //     $this->db->select('transaction.game_id');
    //     $this->db->from('transaction');
    //     $this->db->join('game', 'transaction.game_id = game.game_id');
    //     // $this->db->join('developer', 'game.developer_id = developer.developer_id');
    //     $condition = "game.game_id = " . $id;
    //     $this->db->where($condition);
    //     // $this->db->groupBy('game.game_id');
    //     return $this->db->get()->row_array(); //->num_rows(); //data Array
    // }

    public function getRevenue()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    }
}
