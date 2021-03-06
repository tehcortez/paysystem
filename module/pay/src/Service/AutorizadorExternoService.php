<?php
namespace pay\Service;

class AutorizadorExternoService
{

    private function doCurl()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://run.mocky.io/v3/8fafdd68-a090-496f-8c9a-3442cf30dae6",
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
    
    public function autorizado()
    {
        $response = $this->doCurl();
        $response = json_decode($response, true);
        if($response['message'] == 'Autorizado'){
            return true;
        }
        return false;
    }
}
