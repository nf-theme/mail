<?php

namespace Vicoders\Mail;

use NF\CompileBladeString\Facade\BladeCompiler;
use NF\Facades\App;
use NightFury\Option\Abstracts\Input;
use NightFury\Option\Facades\ThemeOptionManager;
use Vicoders\Mail\Channels\Channel;
use Vicoders\Mail\Facades\View;

class Email
{
    protected $channel;
    public function __construct()
    {
        $this->channel = App::make(Channel::class);
    }

    public function send(User $user, $html_template)
    {
        if(empty($html_template)) {
            $html_template = View::render('template_example', ['site_url' => 'https://vicoders.com']);
        }
        $params = $user->getParams();
        if (!empty($params) && !is_array($params)) {
            throw new \Exception("Parammeters must an array", 2);
        }
        $template = BladeCompiler::compileString($html_template, $params);
        $this->channel->send($user, $template);
    }

    public function multi($users, $html_template) {
        if(empty($html_template)) {
            $html_template = View::render('template_example', ['site_url' => 'https://vicoders.com']);
        }
        $user_first = $users->first();
        $params = $user_first->getParams();
        if (!empty($params) && !is_array($params)) {
            throw new \Exception("Parammeters must an array", 2);
        }
        $template = BladeCompiler::compileString($html_template, $params);
        $users = $users->map(function($item){
            return $item->toArray();
        });
        $this->channel->multi($users, $template);
    }
}
