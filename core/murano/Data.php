<?php
namespace core\murano;
use DateTime;

class Data {

    /**
     * Data
     * Padrao
     *
     * @var string
     * @var string
     */
  public static function date($data, $padrao = 'd/m/Y H:i'){

    return date( $padrao , strtotime($data));

  }

   /**
     * Data
     * Padrao
     *
     * @var string
     * @var string
     */
    public static function save($data, $padrao = 'Y-m-d H:i:s'){

      return date( $padrao , strtotime($data));
  
    }

     /**
     * Data
     * Padrao
     * Tipo 1, 2 e 3
     *
     * @var string
     * @var string
     * @var int
     */
    public static function diferenca($data, $tipo = 1, $diferenca = null){

      if(!$diferenca){
        $diferenca = date('Y-m-d');
      }

      $date1 = new DateTime($data);
      $date2 = new DateTime($diferenca);
      $interval = $date1->diff($date2);

      if($tipo == 1){

        if($interval->y == 0){

          if($interval->m == 0){
            return $interval->d."d"; 
          }

          return $interval->m."m ".$interval->d."d"; 
        }

        return $interval->y . "a " . $interval->m."m  ".$interval->d."d"; 

      }else if($tipo == 2){

        if($interval->y == 0){
          return $interval->m."m"; 
        }

        return $interval->y . "a " . $interval->m."m"; 

      }elseif($tipo == 3){

        return $interval->y . "a"; 

      }
      
  
    }
  
    
}
