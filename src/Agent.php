<?php

namespace Yuniorhernandez\Agent;

class Agent
{
    protected $agent;

    // construct
    public function __construct()
    {
        $this->agent = $_SERVER['HTTP_USER_AGENT'];
    }

    /*
    |------------------------------------------------------------------
    | Get the user agent.
    |------------------------------------------------------------------
    | @return string|null
    */
    public function getAgent()
    {
        return $this->agent;
    }
 
    /*
    |------------------------------------------------------------------
    | Get the IP address from the server variables.
    |------------------------------------------------------------------
    | @return string|null
    */
    public function getIp()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            //check ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            //to check ip is pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            //get ip address
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        return $ip ?? null;
    }

    /*
    |------------------------------------------------------------------
    | Get the browser name and version from the server variables.
    |------------------------------------------------------------------
    | @return string|null
    */
    public function getBrowser()
    {
        $browser = 'Unknown';

        $browser_array = [
            '/msie/i' => 'Internet Explorer',
            '/firefox/i' => 'Firefox',
            '/safari/i' => 'Safari',
            '/chrome/i' => 'Chrome',
            '/edge/i' => 'Edge',
            '/opera/i' => 'Opera',
            '/netscape/i' => 'Netscape',
            '/maxthon/i' => 'Maxthon',
            '/konqueror/i' => 'Konqueror',
            '/mobile/i' => 'Handheld Browser',
        ];

        foreach ($browser_array as $regex => $value) {
            if (preg_match($regex, $this->agent)) {
                $browser = $value;
            }
        }

        return $browser;
    }

    public function getBrowserVersion()
    {
        $browser = 'Unknown';

        $browser_array = [
            '/msie/i' => 'Internet Explorer',
            '/firefox/i' => 'Firefox',
            '/safari/i' => 'Safari',
            '/chrome/i' => 'Chrome',
            '/edge/i' => 'Edge',
            '/opera/i' => 'Opera',
            '/netscape/i' => 'Netscape',
            '/maxthon/i' => 'Maxthon',
            '/konqueror/i' => 'Konqueror',
            '/mobile/i' => 'Handheld Browser',
        ];

        foreach ($browser_array as $regex => $value) {
            if (preg_match($regex, $this->agent)) {
                $browser = $value;
            }
        }

        $known = ['Version', $browser, 'other'];
        $pattern = '#(?<browser>' . join('|', $known) .
            ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';

        if (!preg_match_all($pattern, $this->agent, $matches)) {
            // we have no matching number just continue
        }

        // see how many we have
        $i = count($matches['browser']);

        if ($i != 1) {
            // we will have two since we are not using 'other' argument yet
            // see if version is before or after the name
            if (strripos($this->agent, 'Version') < strripos($this->agent, $browser)) {
                $version = $matches['version'][0] ?? null;
            } else {
                $version = $matches['version'][1] ?? null;
            }
        } else {
            $version = $matches['version'][0] ?? null;
        }

        return $version ?? 'Unknown';
    }

    /*
    |------------------------------------------------------------------
    | Get the platform name from the server variables.
    |------------------------------------------------------------------
    | @return string|null
    */
    public function getPlatform()
    {
        $platform = 'Unknown';

        $platform_array = [
            '/windows nt 10/i' => 'Windows 10',
            '/windows nt 6.3/i' => 'Windows 8.1',
            '/windows nt 6.2/i' => 'Windows 8',
            '/windows nt 6.1/i' => 'Windows 7',
            '/windows nt 6.0/i' => 'Windows Vista',
            '/windows nt 5.2/i' => 'Windows Server 2003/XP x64',
            '/windows nt 5.1/i' => 'Windows XP',
            '/windows xp/i' => 'Windows XP',
            '/windows nt 5.0/i' => 'Windows 2000',
            '/windows me/i' => 'Windows ME',
            '/win98/i' => 'Windows 98',
            '/win95/i' => 'Windows 95',
            '/win16/i' => 'Windows 3.11',
            '/macintosh|mac os x/i' => 'Mac OS X',
            '/mac_powerpc/i' => 'Mac OS 9',
            '/linux/i' => 'Linux',
            '/ubuntu/i' => 'Ubuntu',
            '/iphone/i' => 'iPhone',
            '/ipod/i' => 'iPod',
            '/ipad/i' => 'iPad',
            '/android/i' => 'Android',
            '/blackberry/i' => 'BlackBerry',
            '/webos/i' => 'Mobile',
        ];

        foreach ($platform_array as $regex => $value) {
            if (preg_match($regex, $this->agent)) {
                $platform = $value;
            }
        }

        return $platform;
    }

    public function getPlatformVersion()
    {
        $platform = 'Unknown';

        $platform_array = [
            '/windows nt 10/i' => 'Windows 10',
            '/windows nt 6.3/i' => 'Windows 8.1',
            '/windows nt 6.2/i' => 'Windows 8',
            '/windows nt 6.1/i' => 'Windows 7',
            '/windows nt 6.0/i' => 'Windows Vista',
            '/windows nt 5.2/i' => 'Windows Server 2003/XP x64',
            '/windows nt 5.1/i' => 'Windows XP',
            '/windows xp/i' => 'Windows XP',
            '/windows nt 5.0/i' => 'Windows 2000',
            '/windows me/i' => 'Windows ME',
            '/win98/i' => 'Windows 98',
            '/win95/i' => 'Windows 95',
            '/win16/i' => 'Windows 3.11',
            '/macintosh|mac os x/i' => 'Mac OS X',
            '/mac_powerpc/i' => 'Mac OS 9',
            '/linux/i' => 'Linux',
            '/ubuntu/i' => 'Ubuntu',
            '/iphone/i' => 'iPhone',
            '/ipod/i' => 'iPod',
            '/ipad/i' => 'iPad',
            '/android/i' => 'Android',
            '/blackberry/i' => 'BlackBerry',
            '/webos/i' => 'Mobile',
        ];

        foreach ($platform_array as $regex => $value) {
            if (preg_match($regex, $this->agent)) {
                $platform = $value;
            }
        }

        $known = [$platform, 'other'];
        $pattern = '#(?<platform>' . join('|', $known) .
            ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';

        if (!preg_match_all($pattern, $this->agent, $matches)) {
            // we have no matching number just continue
        }

        // see how many we have
        $i = count($matches['platform']);

        if ($i != 1) {
            // we will have two since we are not using 'other' argument yet
            // see if version is before or after the name
            if (strripos($this->agent, $platform) < strripos($this->agent, $platform)) {
                $version = $matches['version'][0] ?? null;
            } else {
                $version = $matches['version'][1] ?? null;
            }
        } else {
            $version = $matches['version'][0] ?? null;
        }

        return $version ?? 'Unknown';
    }

    /*
    |------------------------------------------------------------------
    | Get the device name from the server variables.
    |------------------------------------------------------------------
    | @return string|null
    */
    public function getDevice()
    {
        $device = 'Unknown';

        $device_array = [
            '/windows nt 10/i' => 'Desktop',
            '/windows nt 6.3/i' => 'Desktop',
            '/windows nt 6.2/i' => 'Desktop',
            '/windows nt 6.1/i' => 'Desktop',
            '/windows nt 6.0/i' => 'Desktop',
            '/windows nt 5.2/i' => 'Desktop',
            '/windows nt 5.1/i' => 'Desktop',
            '/windows xp/i' => 'Desktop',
            '/windows nt 5.0/i' => 'Desktop',
            '/windows me/i' => 'Desktop',
            '/win98/i' => 'Desktop',
            '/win95/i' => 'Desktop',
            '/win16/i' => 'Desktop',
            '/macintosh|mac os x/i' => 'Desktop',
            '/mac_powerpc/i' => 'Desktop',
            '/linux/i' => 'Desktop',
            '/ubuntu/i' => 'Desktop',
            '/iphone/i' => 'Mobile',
            '/ipod/i' => 'Mobile',
            '/ipad/i' => 'Tablet',
            '/android/i' => 'Mobile',
            '/blackberry/i' => 'Mobile',
            '/webos/i' => 'Mobile',
            '/bot|crawler|spider|crawling|curl|wget/i' => 'Bot',
        ];

        foreach ($device_array as $regex => $value) {
            if (preg_match($regex, $this->agent)) {
                $device = $value;
            }
        }

        return $device;
    }

    public function getDeviceVersion()
    {
        $device = 'Unknown';

        $device_array = [
            '/windows nt 10/i' => 'Desktop',
            '/windows nt 6.3/i' => 'Desktop',
            '/windows nt 6.2/i' => 'Desktop',
            '/windows nt 6.1/i' => 'Desktop',
            '/windows nt 6.0/i' => 'Desktop',
            '/windows nt 5.2/i' => 'Desktop',
            '/windows nt 5.1/i' => 'Desktop',
            '/windows xp/i' => 'Desktop',
            '/windows nt 5.0/i' => 'Desktop',
            '/windows me/i' => 'Desktop',
            '/win98/i' => 'Desktop',
            '/win95/i' => 'Desktop',
            '/win16/i' => 'Desktop',
            '/macintosh|mac os x/i' => 'Desktop',
            '/mac_powerpc/i' => 'Desktop',
            '/linux/i' => 'Desktop',
            '/ubuntu/i' => 'Desktop',
            '/iphone/i' => 'Mobile',
            '/ipod/i' => 'Mobile',
            '/ipad/i' => 'Tablet',
            '/android/i' => 'Mobile',
            '/blackberry/i' => 'Mobile',
            '/webos/i' => 'Mobile',
        ];

        foreach ($device_array as $regex => $value) {
            if (preg_match($regex, $this->agent)) {
                $device = $value;
            }
        }

        $known = [$device, 'other'];
        $pattern = '#(?<device>' . join('|', $known) .
            ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';

        if (!preg_match_all($pattern, $this->agent, $matches)) {
            // we have no matching number just continue
        }

        // see how many we have
        $i = count($matches['device']);

        if ($i != 1) {
            // we will have two since we are not using 'other' argument yet
            // see if version is before or after the name
            if (strripos($this->agent, $device) < strripos($this->agent, $device)) {
                $version = $matches['version'][0] ?? null;
            } else {
                $version = $matches['version'][1] ?? null;
            }

            return $version ?? 'Unknown';

        } else {
            $version = $matches['version'][0] ?? null;
        }

        return $version ?? 'Unknown';
    }

    /*
    |------------------------------------------------------------------
    | Get the language name from the server variables.
    |------------------------------------------------------------------
    | @return array|null
    */
    public function getLanguage()
    {
        $language = 'Unknown Language';

        if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
            $language = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
        }

        // Retornar array de lenguajes buscar los resultdos seprdos por coma o por punto y coma.
        return preg_split('/[,;]/', $language);
    }

    /*
    |------------------------------------------------------------------
    | Get user location
    |------------------------------------------------------------------
    | @return array|null
    */
    public function getLocation()
    {
        $location = [];

        $ip = $this->getIp();
        if ($ip != '127.0.0.1') {
            $location = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
        }
        return $location;
    }

    /*
    |------------------------------------------------------------------
    | Get all results
    |------------------------------------------------------------------
    | @return array|null
    */
    public function getAll()
    {
        return [
            'agent' => $this->getAgent(),
            'ip' => $this->getIp(),
            'browser' => $this->getBrowser(),
            'browser_version' => $this->getBrowserVersion(),
            'platform' => $this->getPlatform(),
            'platform_version' => $this->getPlatformVersion(),
            'device' => $this->getDevice(),
            'device_version' => $this->getDeviceVersion(),
            'language' => $this->getLanguage(),
            'location' => $this->getLocation(),
        ];
    }

    /*
    |------------------------------------------------------------------
    | Is a mobile device?
    |------------------------------------------------------------------
    | @return bool
    */
    public function isMobile()
    {
        return $this->getDevice() == 'Mobile';
    }

    /*
    |------------------------------------------------------------------
    | Is a tablet device?
    |------------------------------------------------------------------
    | @return bool
    */
    public function isTablet()
    {
        return $this->getDevice() == 'Tablet';
    }
    
    /*
    |------------------------------------------------------------------
    | Is a desktop device?
    |------------------------------------------------------------------
    | @return bool
    */
    public function isDesktop()
    {
        return $this->getDevice() == 'Desktop';
    }

    /*
    |------------------------------------------------------------------
    | Is a bot?
    |------------------------------------------------------------------
    | @return bool
    */
    public function isBot()
    {
        return $this->getDevice() == 'Bot';
    }
}
