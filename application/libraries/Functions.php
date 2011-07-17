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
        switch (strlen($str_telephone)) {
            case 10: // number format 5922161611
                return array(
                    'country_code' => substr($str_telephone, 0, 3),
                    'area_code' => substr($str_telephone, 3, 3),
                    'number' => substr($str_telephone, 6, 4));
            case 13 : // number format +592-216-1611
                return array(
                    'country_code' => substr($str_telephone, 1, 3),
                    'area_code' => substr($str_telephone, 5, 3),
                    'number' => substr($str_telephone, 9, 4));
            case 12: // number format 592-216-1611
                return array(
                    'country_code' => substr($str_telephone, 0, 3),
                    'area_code' => substr($str_telephone, 4, 3),
                    'number' => substr($str_telephone, 8, 4));
        }
    }
    
    function join_telephone($country_code, $area_code, $number){
        return '+'.$country_code.'-'.$area_code.'-'.$number;
    }

}

/* End of file Someclass.php */
