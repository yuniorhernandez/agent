# User Agent

Obtain information about your users such as IP, browsing information, operating system information and an approximate location of the users.

## Installation

Use the package manager [composer](https://getcomposer.org/download/) to install foobar.


```php
composer require yuniorhernandez/agent
```

## Usage

```php
<?php
namespace App\Http\Controllers;

use Yuniorhernandez\Agent\Facades\Agent;

class UserAgenteController extends Controller
{
    public function index()
    {
        //Returns an array with all the information.
        $agent = Agent::getAll();

        return view('user-agent',['agent' => $agent]);
    }
}
```
```php
// Returns a string with: 'HTTP_USER_AGENT'
$user_agent = Agent::getAgent();
```
```php
// Returns a string with the user's IP.
$user_ip = Agent::getIp();
```
```php
// Returns a string with the user's Browser.
$user_browser = Agent::getBrowser();
```
```php
// Returns a string with the user's Browser version.
$user_browser_version = Agent::getBrowserVersion();
```
```php
// Returns a string with the user's Browser.
$user_platform = Agent::getPlatform();
```
```php
// Returns a string with the user's Browser version.
$user_user_platform_version = Agent::getPlatformVersion();
```
```php
// Returns a string with the user's Device.
$user_device = Agent::getDevice();
```
```php
// Returns a string with the user's Device version.
$user_device_version = Agent::getDeviceVersion();
```
```php
// Returns an array with the user's Language.
$user_languagege = Agent::language();
```
```php
// getAll() Retorna un array con toda informacion recolectada del usuario.
// agent, ip, browser, browser_version, platform, platform_version,  device, device_version, language, location.
$agent = Agent::getAll();
```
```php
// Added new functions.
// isMobile(), isTablet(), isDesktop() and isBot()
// @return bool
if(Agent::isBot())
{
    //Action if the visitor is a bot.
}
```

## Contributing

Pull requests are welcome. For major changes, please open an issue first
to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License

[MIT](https://choosealicense.com/licenses/mit/)
