# Send Email Kit
 > It's an extension kit for our theme https://github.com/hieu-pv/nf-theme 


 
<a name="installation"></a>
### Installation
```php
composer require nf/mail
```

### Configuration

##### 1. Open `config/app.php` file and insert a below line: 

```php
"providers"  => [
    ... (Other Provider)
    \NF\Mail\EmailServiceProvider::class
],
``` 

##### 2. Insert and Update `wp-config.php` file:
```php
define('SENDMAIL_DRIVER', 'wp_mail'); // api, wp_mail, mailchimp (updating). Default is wp_mail
```

- If ```SENDMAIL_DRIVER``` is ```api```, insert 2 constants to `wp-config.php`: 
```php
define('EMAIL_USERNAME', '<username>');
define('EMAIL_PASSWORD', '<password>');
```

#### Choose type channel
> Login with admin account, click "Theme Configuration" and choose "For Send Email" tab
- Has 3 type:
  + Api
  + wp_mail
  + mailchimp (updating ...)

<a name="configuration"></a>
##### Crazy Way: Send email with one or more

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
	        'email' => 'cus_email@gmail.com',
	        'name'  => 'Name 1'
	    ],
	    [
	        'email' => 'cus_email@gmail.com',
	        'name'  => 'Name 2'
	    ]
	];

	$config = [
		'apiuri'          => '<send email api url>'
	];
	$params = [
	    'variables_1' => 'value_1',
	    'variables_2' => 'value_2',
	];
	$subject = 'No subject';
	$app_id  = 1; 
	$user_id = 1; 

	$email_template = file_get_contents(PATH_FILE_HTML_TEMPLATE);

	$users = collect($user_data);
	$users = $users->map(function($item) use ($params, $subject, $app_id, $user_id){
	    $tmp_user = new \NF\Mail\Models\User();
	    $tmp_user->setName($item['name'])
	             ->setTo($item['email'])
	             ->setAppId($app_id)
	             ->setUserId($user_id)
	             ->setSubject($subject)
	             ->setParams($params);
	    return $tmp_user;
	});

	$email = new \NF\Mail\Email($config);
	$email->send($users, $email_template);
```
> </strong>Note - Options for Config</strong>: 
```
Expand Options:
- mail_host
- mail_port, 
- mail_from, 
- mail_name, 
- mail_username, 
- mail_password, 
- mail_encryption
```
##### Last Mission: 
- Check receiver email
