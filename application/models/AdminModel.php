<?php

class AdminModel extends CI_Model
{
    /**
     * Pada kelas ModelAdmin ini akan mengatur logic yang akan dilakukan pada controller Admin dan semua
     * data yang didapatkan maupun mengirim ke controller maupun view untuk Admin
     * @author Aditya Ramadhan
     * @version 1.0
     * @since 2021 - 02 - 20
     */


    /** 
     * Method getDataDevRequest ini digunakan untuk admin mendapatkan data
     * DevRequest dari database 
     */
    public function getDataDevRequest()
    {
        return $this->db->get('dev_request')->result_array();
    }
    /** 
     * Method getRequestPublishGame ini digunakan untuk admin mendapatkan data
     * dari database Game yang ispublish nya masih false 
     */
    public function getRequestPublishGame()
    {
        return $this->db->get_where('game', ['is_publish' => false])->result_array();
    }
    /** 
     * Method addNewDeveloper ini digunakan untuk admin menambahkan data
     * developer dan menginputkannya ke database developer
     */
    public function addNewDeveloper()
    {
        $data = array(
            'id_user' => $this->input->post('id_user'),
            'developer_name' => $this->input->post('developer_name'),
            'developer_email' => $this->input->post('developer_email')
        );
        $this->db->insert('developer', $data);
        // $this->db->where('id', $id);
        // $this->db->delete('dev_request');
    }

    /** 
     * Method listGames ini digunakan untuk admin mendapatkan data
     * semua games yang ada di database
     */
    public function listGames($number, $offset)
    {
        return $query = $this->db->get('game', $number, $offset)->result_array();
    }
    /** 
     * Method countGames ini digunakan untuk admin mendapatkan data
     * berdasarkan baris yang mewakilkan jumlah game yang ada dalam database
     */
    public function countGames()
    {
        return $this->db->get('game')->num_rows();
    }
    /** 
     * Method listUsers ini digunakan untuk admin mendapatkan data
     * semua users yang ada di database
     */
    public function listUsers($number, $offset)
    {
        return $query = $this->db->get('user', $number, $offset)->result_array();
    }
    /** 
     * Method countUsers ini digunakan untuk admin mendapatkan data
     * berdasarkan baris yang mewakilkan jumlah user yang ada dalam database
     */
    public function countUsers()
    {
        return $this->db->get('user')->num_rows();
    }
    /** 
     * Method listDevelopers ini digunakan untuk admin mendapatkan data
     * semua Developer yang ada di database
     */
    public function listDevelopers($number, $offset)
    {
        return $query = $this->db->get('developer', $number, $offset)->result_array();
    }
    /** 
     * Method countDevelopers ini digunakan untuk admin mendapatkan data
     * berdasarkan baris yang mewakilkan jumlah Developer yang ada dalam database
     */
    public function countDevelopers()
    {
        return $this->db->get('developer')->num_rows();
    }
    /** 
     * Method listTransactions ini digunakan untuk admin mendapatkan data
     * semua Transaksi yang ada di database
     */
    public function listTransactions($number, $offset)
    {
        return $query = $this->db->get('transaction', $number, $offset)->result_array();
    }
    /** 
     * Method countTransactions ini digunakan untuk admin mendapatkan data
     * berdasarkan baris yang mewakilkan jumlah Transaksi yang ada dalam database
     */
    public function countTransactions()
    {
        return $this->db->get('transaction')->num_rows();
    }
}
