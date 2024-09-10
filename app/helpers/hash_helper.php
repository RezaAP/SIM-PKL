<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hash {
    static public function make($string = '')
    {
        return password_hash($string,PASSWORD_BCRYPT);
    }
    static public function check($string,$hash)
    {
        return password_verify($string,$hash);
    }
}