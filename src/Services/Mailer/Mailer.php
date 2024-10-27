<?php


namespace App\Services\Mailer;


use GuzzleHttp\Client;

class Mailer
{
    private $client;
    public function __construct(Client $client)
    {
        $this->client=$client;
    }
    public function sendMail(string $to,string $message,string $subject,string $fromName='AMDIE'){

        try {
            $response=$this->client->get("http://mailsend.@amdie.gov.ma/?to=$to&message=$message&subject=$subject&from=notif-crm@amdie.gov.ma&fromName=$fromName");

            if($response->getStatusCode()=="200" && $response->getReasonPhrase()=="OK") return true;

            return false;
        } catch (\Throwable $th) {
            
            /* Le mail n'a pas été envoyé */
            return false;
        }
    }
}
