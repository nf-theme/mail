<?php

namespace Vicoders\Mail\Channels;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Vicoders\Mail\Channels\Channel;
use Vicoders\Mail\Models\User;

/**
 *
 */
class WpMailChannel implements Channel
{
    /**
     * [$config description]
     * @var array
     */
    protected $config = [];

    public function __construct() {}

    /**
     * [send description]
     * @param  String $template html template
     * @param  array  $data     [description]
     * @return [type]           [description]
     */
    public function send($users, $html_template)
    {
        try {
            $headers = ['Content-Type: text/html; charset=UTF-8'];
            $users = $users->toArray();
            if(!empty($users)) {
                foreach ($users as $key => $user) {
                    wp_mail($user->getTo(), $user->getSubject(), $html_template, $headers);
                }
            }
        } catch (RequestException $e) {
            throw new \Exception("An error occurred when send email", 400);
        }
    }

    public function setConfig($config = []) {
        $this->config = $config;
        return $this;
    }
}
