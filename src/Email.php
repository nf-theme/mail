<?php

namespace NF\Mail;

use NF\CompileBladeString\Facade\BladeCompiler;
use NF\Facades\App;
use NightFury\Option\Abstracts\Input;
use NightFury\Option\Facades\ThemeOptionManager;
use NF\Mail\Channels\Channel;
use NF\Mail\Facades\View;

class Email
{
    /**
     * [$config description]
     * @var array
     */
    protected $config = [];

    /**
     * [$channel description]
     * @var string
     */
    protected $channel;

    public function __construct($config = [])
    {
        $this->config = $config;
        $this->channel = App::make(Channel::class);
    }

    public function send($users, $html_template)
    {
        if(empty($html_template)) {
            $html_template = View::render('template_example', ['site_url' => 'https://vicoders.com']);
        }
        $params = $users[0]->getParams();
        if (!empty($params) && !is_array($params)) {
            throw new \Exception("Parammeters must an array", 2);
        }
        $template = BladeCompiler::compileString($html_template, $params);
        $this->channel->setConfig($this->config)->send($users, $template);
    }
}
