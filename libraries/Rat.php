<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rat
{
    private $_store_in;
    private $ci;
    public function __construct()
    {
        $this->ci = & get_instance();
        $this->ci->load->config('rat', TRUE);
        $this->_store_in = $this->ci->config->item('store_in', 'rat');
        if(empty($this->_store_in)) $this->_store_in = 'logs';
        $this->_verify_settings();
    }

    /*
     * log something
     */
    public function tattle($message, $user_id = '0', $code = '0', $date_time = NULL)
    {
        if(is_null($date_time))
        {
            $date_time = date('Y-m-d H:i:s');
        }
        $session_user_id = $this->ci->config->item('session_user_id','rat');
        if(($user_id=='0') && !empty($session_user_id))
        {
            $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '0';
        }

        if($this->_set_message($message,$user_id,$code,$date_time))
        {
            return TRUE;
        }
        else
        {
            show_error('That rat... you must pop it... or repair the library...');
        }
        return FALSE;
    }

    public function wipe($user_id = NULL, $date = NULL)
    {
        if($this->_delete_logs($user_id, $date))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    /*
     * retrieve something
     */
    public function squeal_all($user_id = NULL, $code = NULL, $date = NULL, $order_by = NULL, $limit = NULL)
    {
        return $this->_get_messages($user_id, $code, $date, $order_by, $limit);
    }

    public function squeal_on($user_id,$date = NULL)
    {
        return $this->_get_messages($user_id, $date);
    }

    private function _set_message($message,$user_id,$code,$date_time)
    {
        if($this->_store_in == 'database')
        {
            $insert_data = array(
                'user_id' => $user_id,
                'date_time' => $date_time,
                'code' => $code,
                'message' => $message
            );
            if($this->ci->rat_model->set_message($insert_data))
            {
                return TRUE;
            }
        }
        return FALSE;
    }

    private function _get_messages($user_id = NULL, $code = NULL, $date = NULL, $order_by = NULL, $limit = NULL)
    {
        if($this->_store_in == 'database')
        {
            $where = array();
            if(isset($user_id)) $where['user_id'] = $user_id;
            if(isset($code)) $where['code'] = $code;
            if(isset($date)) $where['date_time'] = $date;
            return $this->ci->rat_model->get_messages($where, $order_by, $limit);
        }
        return FALSE;
    }

    private function _delete_logs($user_id = NULL,$date = NULL)
    {
        $where = array();
        if($this->_store_in == 'database')
        {
            if(isset($user_id)) $where['user_id'] = $user_id;
            if($this->ci->rat_model->delete_messages($where,$date))
            {
                return TRUE;
            }
            return FALSE;
        }
    }

    private function _set_to_file()
    {

    }

    private function _get_from_db()
    {

    }

    private function _get_from_file()
    {

    }

    private function _verify_settings()
    {
        if($this->_store_in == 'database')
        {
            $this->ci->load->model('rat_model');
        }
        else
        {
            exit;
        }
    }
}