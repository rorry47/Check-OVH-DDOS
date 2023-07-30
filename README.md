# Check-OVH-DDOS
PHP script to check DDOS status 

# Installation
Install this wrapper and integrate it inside your PHP application with Composer:

```bash
composer require ovh/ovh
```

More fow this: https://github.com/ovh/php-ovh/

# Settings

In file index.php add your applicationKey\applicationSecret\endpoint\consumerKey:
```php
<?php
require __DIR__ . '/vendor/autoload.php';
use \Ovh\Api;

// Api credentials can be retrieved from the urls specified in the "Supported endpoints" section below.
$ovh = new Api($applicationKey,
                $applicationSecret,
                $endpoint,
                $consumerKey);
echo 'Welcome '.$ovh->get('/me')['firstname'];
```

In file index.php add your servers in:
```php
// Defining a list of servers
$array_servers = array(
    'server1.example.com',
    'server2.example.com',
    'server3.example.com',
    'server4.example.com'
);
```
Domains or subdomains that you register must be resolved from OVH IP addresses, because it checks IP addresses and displays information exclusively on them.

---
The result will be something like this:

<img src="https://gcdnb.pbrd.co/images/ohfsg31pESMq.png">
