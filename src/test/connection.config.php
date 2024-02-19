<?
error_reporting(E_ALL);

if (empty(getenv("SAP_HOST"))) {
    echo "No SAP_HOST environment variable configured";
    die();
}

$phar = '../../dist/sapb1.phar';

if (file_exists($phar)) {
    require_once $phar;
} else {
?>
    <h1 style="color: red">Could not find '<?= $phar ?>'. Has the build been kicked off yet?</h1>
<?
    die();
}

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
    "company" => $_ENV["SAP_COMPANY"],
];
