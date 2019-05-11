<?php
/**
 * Created by PhpStorm.
 * User: joaopaulooliveirasantos
 * Date: 2019-05-09
 * Time: 21:09
 */

namespace App\Helper;


class ObjectHelper
{
    public static function IsNullOrEmptyString($str){
        return (!isset($str) || trim($str) === '');
    }

    public static function getQueryStatus($query,$status)
    {
        if($status != '2'){
          return  $query->where('status',$status);
        }
        return $query;
    }

    public static function toMoneyFormat($valor){
      return 'R$ ' . number_format($valor, 2, ',', '.');
    }

    public static function calcularTotalArray($valores){
        $total =0;
        foreach ($valores as $valor){
            $total+= $valor->pivot->valor_venda;;
        }
        return $total;
    }

    public static function getTotalArrayMoneyFormat($valores){
      return  self::toMoneyFormat(self::calcularTotalArray($valores));
    }
}