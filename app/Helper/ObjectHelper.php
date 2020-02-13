<?php
/**
 * Created by PhpStorm.
 * User: joaopaulooliveirasantos
 * Date: 2019-05-09
 * Time: 21:09
 */

namespace App\Helper;


use App\Models\User;
use Illuminate\Support\Facades\Auth;

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

    public static function currentUserIsAdmin(){
      $user = User::query()->where('id',Auth::user()->getAuthIdentifier())->get();
      return $user->first()->isAdmin();
    }

    public static function isOwner($id){
        return $id === Auth::user()->getAuthIdentifier();
    }

    public  static  function porcentage($value, $totalValue){
        return number_format($value * 100 / $totalValue,2);
    }

    public  static  function formatEndereco($endereco)
    {
        return $endereco != null ? $endereco->logradouro . ' ' . $endereco->complemento . ', ' . $endereco->bairro . ', ' . $endereco->localidade . ', '
            . $endereco->uf . ', ' . $endereco->cep : '';
    }
}
