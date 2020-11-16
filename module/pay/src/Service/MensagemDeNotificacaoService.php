<?php
namespace pay\Service;

class MensagemDeNotificacaoService
{

    private function doCurl()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://run.mocky.io/v3/b19f7b9f-9cbf-4fc6-ad22-dc30601aec04",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }
    
    public function enviarMensagem()
    {
        $response = $this->doCurl();
        $response = json_decode($response, true);
        if($response['message'] == 'Enviado'){
            return true;
        }
        return false;
    }
}