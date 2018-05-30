# Send Email Kit
 > It's an extension kit for our theme https://github.com/hieu-pv/nf-theme 
 
- [Installation](#installation)
- [Configuration](#configuration)
- [Compile asset file](#compiler)
- [Service](#service)
- [Working with local repository](#local-reposoitory)
- [Extension Configuration](#extension-configuration)

 
<a name="installation"></a>
## Installation

### Install package via Composer

```php
composer require vicoders/mail
```

### Set up config
> Open `config/app.php` file and insert a below line: 

```php
"providers"  => [
    //... (Other Provider)
    \Vicoders\Mail\EmailServiceProvider::class
],
``` 

<a name="local-reposoitory"></a>
### Choose type channel
> Login with admin account, click "Theme Configuration" and choose "For Send Email" tab on admin left sidebar.

- Has 3 type:
  + Api
  + wp_mail
  + mailchimp (updating ...)

##### Crazy Way 1: Send to a email
<ul>
    <li>Create Input data</li>
    <li>Get content html template file</li>
    <li>Use data to match with variables into html template </li>
    <li>Set info for Receiver</li>
    <li>And use send email function</li>
</ul>

```php
$data = [
    'name_author' => 'Garung',
    'post_title'  => 'this is title',
    'content'     => 'this is content',
    'link'        => 'http://google.com',
    'site_url'    => site_url(),
];
$email_template = file_get_contents(PATH_HTML_TEMPLATE);

$user = new \Vicoders\Mail\Models\User();
$user->setName('Garung')
->setEmail('email@gmail.com')
->setSubject('Subject email')
->setParams($data);

$email = new \Vicoders\Mail\Email();
$email->send($user, $email_template);
```

<a name="configuration"></a>
##### Crazy Way 2: Send email with more User
> 

<ul>
    <li>Create Input data include more user</li>
    <li>Create Input param</li>
    <li>Get content html template file</li>
    <li>Use data to match with variables into html template </li>
    <li>Set info for an array Receivers</li>
    <li>And use send email function</li>
</ul>

```php
   $user_data = [
	    [
	        'email' => 'daudq.test@gmail.com',
	        'name_singer' => 'garung_1'
	    ],
	    [
	        'email' => 'daudq.test2@gmail.com',
	        'name_singer' => 'garung_2'
	    ]
	];

	$params = [
	    'name_author' => 'Garung 123',
	    'post_title'  => 'this is title 123',
	    'content'     => 'this is content 123',
	    'link'        => 'http://google.com',
	    'site_url'    => site_url(),
	];

	$email_template = file_get_contents(PATH_FILE_HTML_TEMPLATE);

	$users = collect($user_data);
	$convert_users = $users->map(function($item) use ($params){
	    $tmp_user = new \Vicoders\Mail\Models\User();
	    $tmp_user->setName($item['name_singer'])
	    ->setEmail($item['email'])
	    ->setSubject('Subject email')
	    ->setParams($params);
	    return $tmp_user;
	});

	$email = new \Vicoders\Mail\Email();
	$email->multi($convert_users, $email_template);
```

##### Last Mission: 
- Check your email and Relax

