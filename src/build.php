<?
error_reporting(E_ALL);
$phar = "../dist/sapb1.phar";
?>
<DOCTYPE />
<html>

<head>
</head>

<body>
    <h1>PHP SAP B1 library - build</h1>
    <p>Builds the /dist/sapb1.phar from the /src/SAPB1 folder</p>
    <pre>
        <?
        echo PHP_EOL;
        if (!file_exists("../dist")) {
            echo "Dist folder not found, will be created" . PHP_EOL;
            mkdir("../dist");
        } else {
            echo "Dist folder found" . PHP_EOL;
        }

        if (file_exists($phar)) {
            echo "The current $phar will be deleted" . PHP_EOL;
            unlink($phar);
        }
        echo "A new $phar will be created" . PHP_EOL;
        try {
            $pharfile = new Phar($phar);
            $pharfile->buildFromDirectory('SAPB1');
            $pharfile->setDefaultStub(index: 'index.php', webIndex: 'index.php');

            echo "A new $phar has been built." . PHP_EOL;
        } catch (\Throwable $th) {
            echo "Something went wrong with the $phar" . PHP_EOL;
            var_export($th);
        }
        if (file_exists($phar)) {
            ob_start();
            $includeable = "includeable" . PHP_EOL;
            echo "Testing if $phar is $includeable";
            include $phar;
            $ob = ob_get_contents();
            if (substr($ob, strlen($ob) - strlen($includeable), strlen($includeable)) == $includeable) {
                echo "The $phar is includeable (or this includeability test is wrong)" . PHP_EOL;
            } else {
                echo "The $phar is NOT includeable. You need to fix something (or this includeability test is wrong)" . PHP_EOL;
            }
        }
        ?>
    </pre>
</body>

</html>