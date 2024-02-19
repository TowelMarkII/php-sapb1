<DOCTYPE />
<html>

<head>
</head>

<body>
    <h1>PHP SAP B1 library - integration test index</h1>
    <p>Note that the integration tests are dependendent on the Business One Service layer version.
        Each version might use a different code path. This is configured in the SAP_B1SL_VERSION environment variable.
        And is ultimately set in the config->b1sl_version property. This is not the version number in the ../b1s/v2.. url part.        
        <dl>
            <dt>10.00.230</dt>
            <dd>Is the default code path. Uses a different error response structure in SAPException.</dd>
            <dt>10.00.140</dt>
            <dd></dd>
        </dl>
    </p>
    <ul>        
        <li>
            <a href="SAPClient.createSession.test.php">SAPClient.createSession</a>
        </li> 
        <li>
            <a href="SAPClient.getService.Items.test.php">SAPClient.getService("Items")</a>
        </li>
        <li>
            <a href="SAPCLient.getService.Items.SAPException.test.php">SAPClient.getService("Items") : SAPException</a>
        </li>
    </ul>
</body>

</html>