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
    protected $domain_api = '';
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
        $from_email = get_option('from_email');
        if (empty($from_email)) {
            throw new \Exception("Please, set email of sender into theme options on admin dashboard", 400);
        }
        $domain_api = get_option('domain_api');
        if (empty($domain_api)) {
            throw new \Exception("Please, set domain api into theme options on admin dashboard", 400);
        }
        $url     = $domain_api . "/api/emails/send";
        $request = [
            'to'      => $user->getEmail(),
            'from'    => $from_email,
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
        $from_email = get_option('from_email');
        if (empty($from_email)) {
            throw new \Exception("Please, set email of sender into theme options on admin dashboard", 400);
        }
        $domain_api = get_option('domain_api');
        if (empty($domain_api)) {
            throw new \Exception("Please, set domain api into theme options on admin dashboard", 400);
        }
        $url     = $domain_api . "/api/emails/bulk";
        $request = [
            'users'   => $users->toArray(),
            'from'    => $from_email,
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
}
