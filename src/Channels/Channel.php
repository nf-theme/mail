<?php 
namespace Vicoders\Mail\Channels;

use Vicoders\Mail\Interfaces\ChannelInterface;
use Vicoders\Mail\Models\User;
/**
 * 
 */
interface Channel extends ChannelInterface
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
     * @param  array $users         an array User Object
     * @param  string $html_template [description]
     * @return [type]                [description]
     */
    public function multi($users, $html_template);

    /**
     * [config Config host and relate]
     * @param  array  $config [description]
     * @return [type]         [description]
     */
    public function setConfig($config = []);
}