<?php 

namespace App\Http\Traits;

use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

/**
 * Super Pay Api Request
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com )
 */
trait SuperPayApiRequest
{
    /**
     * MakePayment.
     *
     * @param array $data
     * @return array|bool
     */
    public function makePayment(array $data)
    {
        $url = "https://superpay.view.agentur-loop.com/pay";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,"https://superpay.view.agentur-loop.com/pay");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);

        if($response) {
            return json_decode($response);
        }

        return false;
    }
}