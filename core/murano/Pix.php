<?php
namespace core\murano;

use Mpdf\Mpdf;
use \src\models\Config;

class Pix {

    public static function gerar($valor, $empresa, $tipo, $numero, $email, $access_token = ''){

        $curl = curl_init();

        $dados["transaction_amount"]                    = floatval($valor);
        $dados["description"]                           = "Mensalidade SmarterLar - ".$empresa;
        $dados["external_reference"]                    = "2";
        $dados["payment_method_id"]                     = "pix";
        $dados["notification_url"]                      = "https://www.smarterlar.net/admin/pagamento/notificacao";
        $dados["payer"]["email"]                        = $email;
        $dados["payer"]["first_name"]                   = "Test";
        $dados["payer"]["last_name"]                    = "User";
        
        $dados["payer"]["identification"]["type"]       = $tipo;
        $dados["payer"]["identification"]["number"]     = $numero;
        
        $dados["payer"]["address"]["zip_code"]          = "06233200";
        $dados["payer"]["address"]["street_name"]       = "Av. das Nações Unidas";
        $dados["payer"]["address"]["street_number"]     = "3003";
        $dados["payer"]["address"]["neighborhood"]      = "Bonfim";
        $dados["payer"]["address"]["city"]              = "Osasco";
        $dados["payer"]["address"]["federal_unit"]      = "SP";

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.mercadopago.com/v1/payments',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($dados),
        CURLOPT_HTTPHEADER => array(
            'accept: application/json',
            'content-type: application/json',
            'Authorization: Bearer '.$access_token
        ),
        ));
        $response = curl_exec($curl);
        $resultado = json_decode($response);
        return($resultado);
        curl_close($curl);

    }

    public static function boleto($valor, $empresa, $tipo, $numero, $email, $names, $access_token = ''){
        $nome = self::dividir_texto($names, 2);

        $curl = curl_init();
    
        $dados["external_reference"]                    = '1';
        $dados["transaction_amount"]                    = floatval($valor);
        $dados["description"]                           = "Mensalidade SmarterLar - ".$empresa;
        $dados["payment_method_id"]                     = "bolbradesco";
        $dados["notification_url"]                      = "https://www.smarterlar.net/admin/pagamento/notificacao";
        $dados["payer"]["email"]                        = $email;
        $dados["payer"]["first_name"]                   = $nome[0];
        $dados["payer"]["last_name"]                    = $nome[1];
        
        $dados["payer"]["identification"]["type"]       = $tipo;
        $dados["payer"]["identification"]["number"]     = $numero;
        
        $dados["payer"]["address"]["zip_code"]          = "06233200";
        $dados["payer"]["address"]["street_name"]       = "Av. das Nações Unidas";
        $dados["payer"]["address"]["street_number"]     = "3003";
        $dados["payer"]["address"]["neighborhood"]      = "Bonfim";
        $dados["payer"]["address"]["city"]              = "Osasco";
        $dados["payer"]["address"]["federal_unit"]      = "SP";

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.mercadopago.com/v1/payments',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($dados),
        CURLOPT_HTTPHEADER => array(
            'accept: application/json',
            'content-type: application/json',
            'Authorization: Bearer '.$access_token
        ),
        ));
        $response = curl_exec($curl);
        $resultado = json_decode($response);
        //var_dump($response);
        curl_close($curl);
        return $resultado;
    }

    public static function notifica($id, $access_token = ''){
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.mercadopago.com/v1/payments/'.$id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'accept: application/json',
            'content-type: application/json',
            'Authorization: Bearer '.$access_token
        ),
        ));
        $response = curl_exec($curl);
        //var_dump($response);
        $resultado = json_decode($response);
        curl_close($curl);
        return $resultado;
        
    }

    public static function dividir_texto($texto, $count_itens)
    {
        $array_retorno = array();
        if (!empty($texto))
        {
            $partes = explode(' ', $texto); 
            $div = ceil((count($partes)) / $count_itens);
            $items = array_chunk($partes, $div);
            foreach($items as $item)
            {
                $array_retorno[] = implode(' ', $item);
            }
        }
        return $array_retorno;
    }

}