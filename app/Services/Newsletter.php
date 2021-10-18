<?php
namespace App\Services;

use MailchimpMarketing\ApiClient;

class newsletter{
    public function subscribe(String $email){
        $mailchimp = new ApiClient();

        $mailchimp->setConfig([
            'apiKey' => config('services.mailchimp.key'),
            'server' => 'us5'
        ]);
        return $response = $mailchimp->lists->addListMember("8417658cd1", [
            'email_address' => $email,
            'status'=> 'subscribed'
        ]);
    }
}
