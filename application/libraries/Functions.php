<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Functions {

    function randompassword($len) {
        $pass = '';
        $lchar = 0;
        $char = 0;
        for ($i = 0; $i < $len; $i++) {
            while ($char == $lchar) {
                $char = rand(48, 109);
                if ($char > 57)
                    $char += 7;
                if ($char > 90)
                    $char += 6;
            }
            $pass .= chr($char);
            $lchar = $char;
        }
        return $pass;
    }

    function cut_string($string, $length, $start=0) {
        if (strlen($string) <= $length)
            return $string;
        return substr($string, $start, $length) . ' ...';
    }

    function parse_telephone($str_telephone) {
        
        $result = array();

        if(substr($str_telephone, 0, 1) == '+')
                $result['country_code'] = substr($str_telephone, 1, 3 );
        if(substr($str_telephone, 4, 1)=='-')
                $result['area_code']= substr($str_telephone, 5,3);
        if(substr($str_telephone, 8, 1)=='-')
                $result['number']= substr($str_telephone, 9,4);
        
        return $result;
        
    }
    
    function join_telephone($country_code, $area_code, $number){
        return '+'.$country_code.'-'.$area_code.'-'.$number;
    }

}

/* End of file Someclass.php */
