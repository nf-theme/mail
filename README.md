# Send Email Kit
 > It's an extension kit for our theme https://github.com/hieu-pv/nf-theme 


 
<a name="installation"></a>
### Installation
```php
composer require vicoders/mail
```

### Configuration
> Open `config/app.php` file and insert a below line: 

```php
"providers"  => [
    ... (Other Provider)
    \Vicoders\Mail\EmailServiceProvider::class
],
``` 

#### Choose type channel
> Login with admin account, click "Theme Configuration" and choose "For Send Email" tab
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

<strong>Example:<strong>
```php
$data = [
    'variables_1' => 'value_1',
    'variables_2' => 'value_2',
];

$config = [
	'domain_api'      => 'http://domain_api.com', // if use send email via API
	'mail_host'       => 'smtp.gmail.com',
	'mail_port'       => '587',
	'mail_from'       => 'mail_from@gmail.com',
    'mail_name'       => 'Garung ABC',
	'mail_username'   => 'MAIL_YOUR_USERNAME',
	'mail_password'   => 'MAIL_YOUR_PASSWORD',
	'mail_encryption' => 'tls' // default is tls
];

$email_template = file_get_contents(PATH_HTML_TEMPLATE);

$user = new \Vicoders\Mail\Models\User();
$user->setName('Garung')
     ->setTo('email_to@gmail.com')
     ->setFrom('email_from@gmail.com')
     ->setSubject('Subject email')
     ->setParams($data);

$email = new \Vicoders\Mail\Email($config);
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

<strong>Example:<strong>
```php
   $user_data = [
	    [
	        'to'   => 'cus_email@gmail.com',
	        'from' => 'your_email@gmail.com',
	        'name' => 'Name 1'
	    ],
	    [
	        'to'   => 'cus_email@gmail.com',
	        'from' => 'your_email@gmail.com',
	        'name' => 'Name 2'
	    ]
	];

	$config = [
		'domain_api'      => 'http://domain_api.com', // if use send email via API
		'mail_host'       => 'smtp.gmail.com',
		'mail_port'       => '587',
		'mail_username'   => 'MAIL_YOUR_USERNAME',
		'mail_password'   => 'MAIL_YOUR_PASSWORD',
		'mail_encryption' => 'tls' // default is tls
	];

	$params = [
	    'variables_1' => 'value_1',
	    'variables_2' => 'value_2',
	];

	$email_template = file_get_contents(PATH_FILE_HTML_TEMPLATE);

	$users = collect($user_data);
	$convert_users = $users->map(function($item) use ($params){
	    $tmp_user = new \Vicoders\Mail\Models\User();
	    $tmp_user->setName($item['name'])
	             ->setTo($item['to'])
	             ->setFrom($item['from'])
	             ->setSubject('Subject email')
	             ->setParams($params);
	    return $tmp_user;
	});

	$email = new \Vicoders\Mail\Email($config);
	$email->multi($convert_users, $email_template);
```

##### Last Mission: 
- Check receiver email

