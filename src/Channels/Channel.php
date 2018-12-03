<?php 
namespace NF\Mail\Channels;

use NF\Mail\Interfaces\ChannelInterface;
use NF\Mail\Models\User;
/**
 * 
 */
interface Channel extends ChannelInterface
{
	/**
     * [send description]
     * @param  NF\Mail\Models\User $user    User model
     * @param  string $html_template [description]
     * @return [type]                [description]
     */
    public function send($users, $html_template);

    /**
     * [config Config host and relate]
     * @param  array  $config [description]
     * @return [type]         [description]
     */
    public function setConfig($config = []);
}