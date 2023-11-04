<?php

/**
 * Send WhatsApp template message directly by calling HTTP endpoint.
 *
 * For your convenience, environment variables are already pre-populated with your account data
 * like authentication, base URL and phone number.
 *
 * Send WhatsApp API reference: https://www.infobip.com/docs/api#channels/whatsapp/send-whatsapp-template-message
 *
 * Please find detailed information in the readme file.
 */

require '../../vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

$client = new Client([
    'base_uri' => "https://6g94wd.api.infobip.com/",
    'headers' => [
        'Authorization' => "App 8045e9da36ac8883b4edae3a9a44bd02-8f2ae133-0493-4d7a-b32e-b939949e2f65",
        'Content-Type' => 'application/json',
        'Accept' => 'application/json',
    ]
]);

$response = $client->request(
    'POST',
    'whatsapp/1/message/template',
    [
        RequestOptions::JSON => [
            'messages' => [
                [
                    'from' => '447860099299',
                    'to' => "573123350607",
                    'content' => [
                        'templateName' => 'registration_success',
                        'templateData' => [
                            'body' => [
                                'placeholders' => ['sender', 'message', 'delivered', 'testing']
                            ],
                            'header' => [
                                'type' => 'IMAGE',
                                'mediaUrl' => 'https://api.infobip.com/ott/1/media/infobipLogo',
                            ],
                            'buttons' => [
                                ['type' => 'QUICK_REPLY', 'parameter' => 'yes-payload'],
                                ['type' => 'QUICK_REPLY', 'parameter' => 'no-payload'],
                                ['type' => 'QUICK_REPLY', 'parameter' => 'later-payload']
                            ]
                        ],
                        'language' => 'en',
                    ],
                ]
            ]
        ],
    ]
);

echo("HTTP code: " . $response->getStatusCode() . PHP_EOL);
echo("Response body: " . $response->getBody()->getContents() . PHP_EOL);
