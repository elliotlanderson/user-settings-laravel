<?php

namespace App\Helpers;

use Twilio\Exceptions\TwilioException;
use Twilio\Rest\Client;

class TwilioHelper
{
    protected $TWILIO_ACCOUNT_SID;

    protected $TWILIO_AUTH_TOKEN;

    protected $TWILIO_PHONE_NUMBER;


    protected $client;

    public function __construct()
    {
        $this->TWILIO_ACCOUNT_SID = env('TWILIO_ACCOUNT_SID');
        $this->TWILIO_AUTH_TOKEN = env('TWILIO_AUTH_TOKEN');
        $this->TWILIO_PHONE_NUMBER = env('TWILIO_NUMBER');

        $this->client = new Client($this->TWILIO_ACCOUNT_SID, $this->TWILIO_AUTH_TOKEN);

    }

    public function send($phoneNumber, $message)
    {
        try {
            $this->client->messages->create(
                $phoneNumber,
                [
                    'from' => $this->TWILIO_PHONE_NUMBER,
                    'body' => $message
                ]
            );
        }
        catch (\Exception $e) {
            throw new TwilioException('Could not send message');
        }
    }
}