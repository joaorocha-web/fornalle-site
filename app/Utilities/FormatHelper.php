<?php 
namespace App\Utilities;

class FormatHelper{
    public static function money($number){
        return $number = number_format($number, 2, ',','.');
    }
}