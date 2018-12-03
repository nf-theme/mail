<?php

namespace NF\Mail\Channels;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use NF\Mail\Channels\Channel;
use NF\Mail\Models\User;

/**
 *
 */
class ApiChannel implements Channel
{
    /**
     * [$config description]
     * @var array
     */
    protected $config = [];

    public function __construct()
    {}

    /**
     * [send description]
     * @param  String $template html template
     * @param  array  $data     [description]
     * @return [type]           [description]
     */
    public function send($users, $html_template)
    {
        $tmp_users = $users->map(function ($item) {
            return $item->formatUser();
        });
        $domain_api = $this->config['apiuri'];
        if (empty($domain_api)) {
            throw new \Exception("Please, set domain api into theme options !", 400);
        }
        $url     = $domain_api . "/api/emails/send";
        $request = [
            'domain'  => $_SERVER['SERVER_NAME'],
            'app_id'  => $users[0]->getAppId(),
            'user_id' => $users[0]->getUserId(),
            'args'    => [
                'config' => $this->config,
                'data'   => [
                    'users'   => $tmp_users,
                    'cc'      => $users[0]->getCc(),
                    'bcc'     => $users[0]->getBcc(),
                    'html'    => $html_template,
                    'subject' => $users[0]->getSubject(),
                ],
            ],
        ];
        \NF\Facades\Log::info($request);
        $client = new Client();
        try {
            $res = $client->request('POST', $url, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization'     => base64_encode(EMAIL_USERNAME . ':' . EMAIL_PASSWORD)
                ],
                'json'    => $request,
            ]);
            $body = $res->getBody();
        } catch (RequestException $e) {
            echo \GuzzleHttp\Psr7\str($e->getRequest());
            if ($e->hasResponse()) {
                echo \GuzzleHttp\Psr7\str($e->getResponse());
            }
            die;
        }
    }

    public function setConfig($config = [])
    {
        $this->config = $config;
        return $this;
    }
}
