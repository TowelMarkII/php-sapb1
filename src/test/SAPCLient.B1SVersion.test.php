<?
/*
    PHP Parse error:
        syntax error,
        unexpected 'string' (T_STRING),
        expecting variable (T_VARIABLE) in phar:///home/admin/domains/deli-nova.net/crons/sapb1.phar/B1SVersion.php on line 11
*/
require_once 'connection.config.php';

use SAPb1\Config;

// The issue lies in the config->b1s_version
// This causes the setting to be improperly parsed in the config
$connection = (object)[
    "config" => [
        "host" => $_ENV["SAP_HOST"],
        "port" => $_ENV["SAP_PORT"],
        "https" => strtolower($_ENV["SAP_SSL"]) == "true",
        "sslOptions" => [
            "verify_peer" => false,
            "verify_peer_name" => false
        ],
        "version" => 2
    ],
    "login" => $_ENV["SAP_LOGIN"],
    "password" => $_ENV["SAP_PASSWORD"],
    "company" => $_ENV["SAP_COMPANY"]
];

$test_passed = false;
try {
    // Assert that the exception is not thrown    
    $under_test = new Config($connection->config);
    echo $under_test->b1s_version;
    $test_passed = true;
} catch (Throwable $t) {
    echo "Throwable caught".PHP_EOL;
    echo $t->getMessage();
    throw $t;
}
?>
<pre>
    Test passed: <?= $test_passed ?>
</pre>