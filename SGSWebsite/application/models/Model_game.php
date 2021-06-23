<?php

class Model_game extends CI_Model
{
    public function tampil_data()
    {
        return $this->db->get('game')->result_array();
    }

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
