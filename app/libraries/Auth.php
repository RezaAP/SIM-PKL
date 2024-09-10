<?php

class Auth {

    static public function check()
    {
        $CI =& get_instance();
        $status = false;
        if($CI->session->userdata('auth_session_id'))
        {
            $status = true;
        }
        return $status;
    }

    static public function login($data)
    {
        $CI =& get_instance();

        $sessData = [];

        foreach((array)$data as $key => $value)
        {
            $sessData['auth_session_'.$key] = $value;
        }

        $CI->session->set_userdata($sessData);
        return 'OK';
    }

    static public function logout()
    {
        $CI =& get_instance();
        $CI->session->sess_destroy();
    }

    static public function id()
    {
        $CI =& get_instance(); 
        return $CI->session->userdata('auth_session_id');
    }

    static public function user()
    {
        $CI =& get_instance(); 
        $id = $CI->session->userdata('auth_session_id');
        return $CI->user->find($id);
    }



}