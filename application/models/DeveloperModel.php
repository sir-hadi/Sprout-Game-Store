<?php

class DeveloperModel extends CI_Model
{
    /**
     * Pada kelas ModelDeveloper ini akan mengatur logic yang akan dilakukan pada controller Developer dan semua
     * data yang didapatkan maupun mengirim ke controller maupun view untuk Developer
     * @author Aditya Ramadhan
     * @version 1.0
     * @since 2021 - 02 - 20
     */

    /** 
     * Method tampil_data ini digunakan untuk admin mendapatkan data
     * developer
     */
    public function tampil_data()
    {
        return $this->db->get('developer')->result_array();
    }
    /** 
     * Method tampil_data ini digunakan untuk membuat gameRequest 
     * yang akan dimasukkan kedalam database dengan is_publish bernilai false
     */
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
    /** 
     * Method myPublishedGames ini digunakan untuk mendapatkan data
     * games yang yang sudah dipublish oleh developer yang sedang login
     */
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

    /** 
     * Method getRevenue ini digunakan untuk mendapatkan data
     * revenue berdasarkan games developer yang sudah dibeli 
     */
    public function getRevenue()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    }
}
