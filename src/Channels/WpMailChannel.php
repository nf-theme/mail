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
        $headers = ['Content-Type: text/html; charset=UTF-8'];
        try {
            wp_mail($user->getEmail(), $user->getSubject(), $html_template, $headers);
        } catch (RequestException $e) {
            throw new \Exception("An error occurred when send email", 400);
        }
    }

    public function multi($users, $html_template)
    {
        $users = $users->toArray();
        if(!empty($users)) {
            foreach ($users as $key => $user) {
                $this->send($user, $html_template);
            }
        }
    }
}
