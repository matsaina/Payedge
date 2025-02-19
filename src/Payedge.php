<?php

namespace edgecloud\payedge;

class payedge
{
    protected ?string $api_url = "https://payedge.co.ke/api/v1/initiate";
    protected ?string $query_url = "https://payedge.co.ke/api/v1/query";

    public function __construct(protected $api_key, protected $link_id)
    {
        $this->api_key = $api_key;
        $this->link_id = $link_id;
    }

    public function initiate($msisdn, $amount, $callback)
    {
        $data = [
            "msisdn" => $msisdn,
            "amount" => $amount,
            "callback" => $callback
        ];
        return self::handle($data, $this->api_url);
    }

    public function query($checkout_id)
    {
        $data = [
            "CheckoutRequestId" => $checkout_id,
        ];
        return self::handle($data, $this->query_url);
    }


    private function handle($data, $url)
    {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => [
                "Content-Type: application/json",
                "User-Agent: insomnia/2023.5.8",
                "apikey: $this->api_key",
                "linkid: $this->link_id"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            return json_decode($response);
        }
    }


}