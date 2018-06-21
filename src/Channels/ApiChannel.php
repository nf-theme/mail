<?php

namespace Vicoders\Mail\Channels;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Vicoders\Mail\Channels\Channel;
use Vicoders\Mail\Models\User;

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
    public function send(User $user, $html_template)
    {
        $domain_api = $this->config['domain_api'];
        $mail_from = $this->config['mail_from'];
        if(empty($mail_from)) {
            $mail_from = '';
        }
        if (empty($domain_api)) {
            throw new \Exception("Please, set domain api into theme options !", 400);
        }
        $url     = $domain_api . "/api/emails/send";
        $request = [
            'to'      => $user->getTo(),
            'from'    => $mail_from,
            'html'    => $html_template,
            'subject' => $user->getSubject(),
            'data'    => $user->getParams(),
        ];
        $client = new Client();
        try {
            $res  = $client->request('POST', $url, ['json' => $request]);
            $body = $res->getBody();
        } catch (RequestException $e) {
            echo \GuzzleHttp\Psr7\str($e->getRequest());
            if ($e->hasResponse()) {
                echo \GuzzleHttp\Psr7\str($e->getResponse());
            }
            die;
        }
    }

    public function multi($users, $html_template)
    {
        $users = $users->map(function($item){
            return $item->toArray();
        });
        $domain_api = $this->config['domain_api'];
        $mail_from = $this->config['mail_from'];
        if (empty($domain_api)) {
            throw new \Exception("Please, set domain api into theme options !", 400);
        }
        $url     = $domain_api . "/api/emails/bulk";
        $request = [
            'users'   => $users->toArray(),
            'from'    => $mail_from,
            'html'    => $html_template,
            'subject' => $users->first()['subject'],
        ];
        $client = new Client();
        try {
            $res  = $client->request('POST', $url, ['json' => $request]);
            $body = $res->getBody();
        } catch (RequestException $e) {
            echo \GuzzleHttp\Psr7\str($e->getRequest());
            if ($e->hasResponse()) {
                echo \GuzzleHttp\Psr7\str($e->getResponse());
            }
            die;
        }
    }

    public function setConfig($config = []) {
        $this->config = $config;
        return $this;
    }
}
