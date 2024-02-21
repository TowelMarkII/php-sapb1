<?php

namespace SAPb1;

class Config
{

    private $config = [];
    private string $latestSupported = "v10.00.210";
    public readonly B1SVersion $b1s_version;

    /**
     * Initializes a new instance of Config.
     */
    public function __construct(array $config)
    {
        $this->config = $config;

        $this->configVersionedIncludes();
    }

    private function configVersionedIncludes()
    {
        $this->b1s_version = new B1SVersion($this->get("b1s_version", $this->latestSupported));
        $compare = (new B1SVersion($this->latestSupported))->compare($this->b1s_version);
        
        if ($compare == B1SVersion::OLDER) {
            // if the version is older than $latestSupported, use the previous version
            // which is v10.00.140.
            include_once "v10.00.140/SAPException.php";
        } else {
            // if the version is newer or equal to $latestSupported than v10.00.140, use the default/latest
            include_once "SAPException.php";
        }
    }


    /**
     * Gets the full URL to the service.
     */
    public function getServiceUrl(string $serviceName): string
    {
        $scheme = $this->get('https') === true ? 'https' : 'http';
        return $scheme . '://' . $this->get('host') . ':' .  $this->get('port', 50000) . '/b1s/v' . $this->get('version', 2) . '/' . $serviceName;
    }

    /**
     * Gets an array of SSL options.
     */
    public function getSSLOptions(): array
    {
        return $this->get('sslOptions', []);
    }

    /**
     * Gets the Config as an array.
     */
    public function toArray(): array
    {
        return $this->config;
    }

    private function get(string $name, $default = null)
    {
        if (array_key_exists($name, $this->config)) {
            return $this->config[$name];
        }
        return $default;
    }
}
?>