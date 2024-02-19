<?
error_reporting(E_ALL);

require_once 'connection.config.php';

use SAPb1\SAPClient;
use SAPb1\SAPException;

$search_itemcode = "150001";

try {
    $sap = SAPClient::createSession($connection->config, $connection->login, $connection->password, $connection->company);
    $items = $sap->getService("Items");
    $result = $items->queryBuilder()
        ->select("ItemCode,ItemName")
        ->find($search_itemcode);
} catch (SAPException $e) {
    echo $e->getMessage();
}
?>
<pre>
<? print_r($result) ?>
</pre>