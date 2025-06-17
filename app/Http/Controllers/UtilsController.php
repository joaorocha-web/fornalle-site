<?php 
namespace App\Http\Controllers;

class Utils extends Controller{
    public function getNumberFormatedToMoney($number){
        return $number = number_format($number, ',','.');
    }
}