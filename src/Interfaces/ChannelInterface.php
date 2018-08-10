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
    public function send($users, $html_template);

    /**
     * [setConfig description]
     * @param array $config [description]
     */
    public function setConfig($config = []);
}
