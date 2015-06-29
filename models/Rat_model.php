<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Rat_model extends CI_Model
{
    private $_rat_table;
    public function __construct()
    {
        parent::__construct();
        $this->load->config('rat', TRUE);
        $this->_rat_table = $this->config->item('table_name','rat');
        if(empty($this->_rat_table)) $this->_rat_table = 'rat';
        $this->_verify_table();
    }

    private function _verify_table()
    {
        if(!$this->db->table_exists($this->_rat_table))
        {
            show_error('That rat won\'t squeal a thing because he has no database table set up...');
        }
    }

    public function set_message($insert_data)
    {
        if($this->db->insert($this->_rat_table,$insert_data))
        {
            return TRUE;
        }
        else
        {
            show_error('That rat... you must pop it... or repair the table...');
        }
        return FALSE;
    }

    public function get_messages($where = NULL, $order_by = NULL, $limit = NULL)
    {
        if(isset($where) && !empty($where)) $this->db->where($where);
        if(isset($order_by)) $this->db->order_by($order_by);
        if(isset($limit)) $this->db->limit($limit);
        $query = $this->db->get($this->_rat_table);
        if($query->num_rows()>0)
        {
            return $query->result();
        }
        return FALSE;
    }

    public function delete_messages($where=NULL)
    {
        if(isset($where) && !empty($where)) $this->db->where($where);
        $this->db->delete($this->_rat_table);
        return TRUE;
    }
}
