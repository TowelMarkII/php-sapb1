<?
error_reporting(E_ALL);

require_once 'connection.config.php';

use SAPb1\SAPClient;
use SAPb1\SAPException;

try {

    $sap = SAPClient::createSession($connection->config, $connection->login, $connection->password, $connection->company);
    $result = $sap->getSession();    
} catch (SAPException $e) {
    echo $e->getMessage();
}
?>
<pre>
<? print_r($result) ?>
</pre>