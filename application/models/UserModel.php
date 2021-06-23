<?php
/**
 * UserModel mengatur semua function yang langsung akan mengakses
 * kepada database, dimana akan di atur semua  data yang terkait user
 * 
 * @author Abdullah Hadi
 * @version 1.2
 * @since 2021-06-15
 */

class UserModel extends CI_Model
{
    /**
     * Melakukan Update profile berdasarkan id user
     * dapat mengupdate nama dan email user
     */
    public function updateProfile($id)
    {
        $data = array(
            'name' =>  htmlspecialchars($this->input->post('name', true)),
            'email' => htmlspecialchars($this->input->post('email', true))
        );
        $this->db->where('id_user', $id);
        $this->db->update('user', $data);
    }

    /**
     * mengambil id user terakhir
     */
    public function getLastId()
    {
        $query = $this->db->query('SELECT id_ FROM akun ORDER BY id DESC LIMIT 1');
        $result = $query->row_array();
        return $result;
    }

    /**
     * Memasukan game yang terpilih ke table transaksi
     * yang menandakan game terbeli
     */
    public function buyNewGame()
    {
        $dataSession = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $id_user = $dataSession['id_user'];
        $email = $dataSession['email'];
        $purchase_day = date("d F Y", strtotime("now"));
        date_default_timezone_set('Asia/Jakarta');
        $time = date("H:i:s", strtotime("now"));

        $data = array(
            'game_id' => $this->input->post('game_id'),
            'id_user' => $id_user,
            'email' => $email,
            'date' => $purchase_day,
            'time' => $time
        );
        $this->db->insert('transaction', $data);
    }

    /**
     * Mengambil table transaksi dengan kondisi data yang di
     * tampilkan ada data transaksi milik user
     * disini terlihat pada function get_where yang paramaternya
     * kita masukan id user
     */
    public function getTransactions()
    {
        $dataSession = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        return $this->db->get_where('transaction', ['id_user' => $dataSession['id_user']])->result_array();
    }

    /**
     * memasukan user ke dalam table dev request
     */
    public function devRequest()
    {
        $data = array(
            'name' => $this->input->post('name'),
            'id_user' => $this->input->post('id_user'),
            'email' => $this->input->post('email'),
            'status' => false
        );
        $this->db->insert('dev_request', $data);
    }
}
