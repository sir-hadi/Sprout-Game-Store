<?php

class AdminModel extends CI_Model
{
    public function getDataDevRequest()
    {
        return $this->db->get('dev_request')->result_array();
    }

    public function getRequestPublishGame()
    {
        return $this->db->get_where('game', ['is_publish' => false])->result_array();
    }

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


    public function listGames($number, $offset)
    {
        return $query = $this->db->get('game', $number, $offset)->result_array();
    }
    public function countGames()
    {
        return $this->db->get('game')->num_rows();
    }

    public function listUsers($number, $offset)
    {
        return $query = $this->db->get('user', $number, $offset)->result_array();
    }
    public function countUsers()
    {
        return $this->db->get('user')->num_rows();
    }

    public function listDevelopers($number, $offset)
    {
        return $query = $this->db->get('developer', $number, $offset)->result_array();
    }
    public function countDevelopers()
    {
        return $this->db->get('developer')->num_rows();
    }

    public function listTransactions($number, $offset)
    {
        return $query = $this->db->get('transaction', $number, $offset)->result_array();
    }
    public function countTransactions()
    {
        return $this->db->get('transaction')->num_rows();
    }

    // public function listUsers()
    // {
    //     $data['users'] = $this->db->get('user')->result_array();
    // }

    // public function listDevelopers()
    // {
    //     $data['developers'] = $this->db->get('developer')->result_array();
    // }

    // public function listTransactions()
    // {
    //     $data['transactions'] = $this->db->get('transaction')->result_array();
    // }
}
