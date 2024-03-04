<pre>
<?
error_reporting(E_ALL);

require_once 'connection.config.php';

use SAPb1\SAPClient;
use SAPb1\SAPException;

$connection->config["b1s_version"] = "v10.00.140";

try {
    $search_itemcode = "15001";

    $sap = SAPClient::createSession($connection->config, $connection->login, $connection->password, $connection->company);
    $items = $sap->getService("Items");
    $result = $items->queryBuilder()
        ->select("ItemCode,ItemName")
        ->find($search_itemcode);
} catch (SAPException $e) {
    echo "SAPException has been thrown" . PHP_EOL;
    echo $e->getMessage();
    echo $e->body;
    die();
} catch (\Throwable $t) {
    echo "Throwable has been thrown" . PHP_EOL;
    echo $t->getMessage();
    die();
}
print_r($result) ?>
</pre>