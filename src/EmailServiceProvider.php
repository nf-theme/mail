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
        if (is_admin()) {
            $this->registerOptionPage();
        }
        $type_channel = get_option('type_channel');

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
        $this->registerAdminPostAction();
    }

    public function registerAdminPostAction()
    {
        add_action('wp_enqueue_scripts', function () {
            wp_enqueue_media();
        });

        add_action('wp_enqueue_scripts', function () {
            wp_enqueue_style(
                'vicoders-notification-style',
                wp_slash(get_stylesheet_directory_uri() . '/mail/assets/dist/app.css'),
                false
            );
            wp_enqueue_script(
                'vicoders-notification-scripts',
                wp_slash(get_stylesheet_directory_uri() . '/mail/assets/dist/app.js'),
                'jquery',
                '1.0',
                true
            );
        });
    }

    public function registerOptionPage()
    {
        ThemeOptionManager::add([
            'name'   => 'For Send Email',
            'fields' => [
                [
                    'label'   => 'Choose a type channel',
                    'name'    => 'type_channel',
                    'type'    => Input::SELECT,
                    'options' => [
                        [
                            'value'    => 'api',
                            'label'    => 'Via Api',
                            'selected' => true,
                        ],
                        [
                            'value'    => 'wp_mail',
                            'label'    => 'WP Mail',
                            'selected' => false,
                        ],
                        [
                            'value'    => 'mailchimp',
                            'label'    => 'MailChimp',
                            'selected' => false,
                        ],
                    ],
                ],
            ],
        ]);

    }

    public function settingForApiChannel() {
        App::bind(\Vicoders\Mail\Channels\Channel::class, \Vicoders\Mail\Channels\ApiChannel::class);
    }

    public function settingForWpMailChannel() {
        App::bind(\Vicoders\Mail\Channels\Channel::class, \Vicoders\Mail\Channels\WpMailChannel::class);
    }
}
