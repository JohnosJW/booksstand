INSTALLATION
------------

### Install via Composer

You can then install this project template using the following command:

~~~
php composer.phar create-project --prefer-dist --stability=dev yiisoft/yii2-app-basic basic
~~~

So, this application contains RBAC access control. On Githab my app has all need files! 

#####NOTE: This command only if you cleared @app/rbac folder - For install using the following command:
~~~
php yii rbac/init
~~~

Now you should be able to access the application through the following URL, assuming `basic` is the directory
directly under the Web root.

~~~
http://localhost/basic/web/
~~~

CONFIGURATION
-------------

### Database

Edit the file `config/db.php` with real data, for example:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=yii2basic',
    'username' => 'root',
    'password' => '1234',
    'charset' => 'utf8',
];
```

After please  using the following command:

~~~
php yii migrate/up
~~~

**NOTES:**
- Yii won't create the database for you, this has to be done manually before you can access it.
- Check and edit the other files in the `config/` directory to customize your application as required.

####For tests this app, please create new account from Sign Up menu.