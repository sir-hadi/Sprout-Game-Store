<?php

class Model_game extends CI_Model
{
    /**
     * Pada kelas ModelGame ini akan mengatur logic yang akan dilakukan pada controller Developer,User,Admin dan semua
     * data yang didapatkan maupun mengirim ke controller maupun view untuk Developer, User, dan Admin
     * @author Aditya Ramadhan
     * @version 1.0
     * @since 2021 - 02 - 20
     */

    /** 
     * Method tampil_data ini digunakan untuk admin mendapatkan data
     * game dari database
     */
    public function tampil_data()
    {
        return $this->db->get('game')->result_array();
    }
    /** 
     * Method find ini digunakan untuk mendapatkan data
     * atau menemukan suatu game_id yang sedang diakses
     */
    public function find($id)
    {
        $result = $this->db->where('game_id', $id)
            ->limit(1)
            ->get('game');
        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return array();
        }
    }
}
