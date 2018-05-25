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
                    $this->resetOptions();
                    break;
                case 'mailchimp':
                    $this->resetOptions();
                    break;
                default:
                    $this->settingForApiChannel();
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
                    'label'   => 'From Email:',
                    'name'    => 'from_email',
                    'type'    => Input::EMAIL
                ],
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
        ThemeOptionManager::add([
            'name'   => 'For Send Email Via Api',
            'fields' => [
                [
                    'label'    => 'Domain Api',
                    'name'     => 'domain_api',
                    'type'     => Input::TEXT,
                    'required' => true,
                ],
            ],
        ]);

        App::bind(\Vicoders\Mail\Channels\Channel::class, \Vicoders\Mail\Channels\ApiChannel::class);
    }

    public function resetOptions() {
        delete_option('domain_api');
    }
}
