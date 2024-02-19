<?
error_reporting(E_ALL);
$phar = "../dist/sapb1.phar";
?>
<DOCTYPE />
<html>

<head>
</head>

<body>
    <h1>PHP SAP B1 library - unbuild</h1>
    <p>Extracts the $phar specified in $phar variable to the /dist/sapb1 folder for e.g. inspection.</p>
    <p>
        <?
        if (!file_exists("../dist")) {
            echo "Dist folder not found, will be created";
            mkdir("../dist");
        } else {

            echo "Dist folder found";
        }
        $phar = new Phar($phar);
        $phar->extractTo('../dist/sapb1');
        ?>
    </p>
</body>

</html>