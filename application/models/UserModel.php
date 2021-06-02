<?php

class UserModel extends CI_Model
{
    public function updateProfile($id)
    {
        $data = array(
            'name' =>  htmlspecialchars($this->input->post('name', true)),
            'email' => htmlspecialchars($this->input->post('email', true))
        );
        $this->db->where('id_user', $id);
        $this->db->update('user', $data);
    }

    public function getLastId()
    {
        $query = $this->db->query('SELECT id_ FROM akun ORDER BY id DESC LIMIT 1');
        $result = $query->row_array();
        return $result;
    }

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

    public function getTransactions()
    {
        $dataSession = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        return $this->db->get_where('transaction', ['id_user' => $dataSession['id_user']])->result_array();
    }

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
