<?php
namespace Vicoders\Mail;

use Illuminate\Support\ServiceProvider;
use NF\Facades\App;
use NightFury\Option\Abstracts\Input;
use NightFury\Option\Facades\ThemeOptionManager;

class EmailServiceProvider extends ServiceProvider
{
    public function register()
    {
        $type_channel = defined('SENDMAIL_DRIVER') ? SENDMAIL_DRIVER : 'wp_mail';
        if(!empty($type_channel)) {
            switch ($type_channel) {
                case 'api':
                    $this->settingForApiChannel();
                    break;
                case 'wp_mail':
                    $this->settingForWpMailChannel();
                    break;
                case 'mailchimp':
                    break;
                default:
                    $this->settingForWpMailChannel();
                    break;
            }
        }
    }

    public function settingForApiChannel() {
        App::bind(\Vicoders\Mail\Channels\Channel::class, \Vicoders\Mail\Channels\ApiChannel::class);
    }

    public function settingForWpMailChannel() {
        App::bind(\Vicoders\Mail\Channels\Channel::class, \Vicoders\Mail\Channels\WpMailChannel::class);
    }
}
