<?php
namespace Vicoders\Mail\Interfaces;

use Vicoders\Mail\Models\User;

interface ChannelInterface
{
    /**
     * [send description]
     * @param  Vicoders\Mail\Models\User $user    User model
     * @param  string $html_template [description]
     * @return [type]                [description]
     */
    public function send(User $user, $html_template);

    /**
     * [multi description]
     * @param  array $users         an array of User Objects
     * @param  string $html_template [description]
     * @return [type]                [description]
     */
    public function multi($users, $html_template);

    /**
     * [setConfig description]
     * @param array $config [description]
     */
    public function setConfig($config = []);
}
