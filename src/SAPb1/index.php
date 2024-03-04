<?
if (version_compare("8.1.0", PHP_VERSION) >= 0)
    throw new Exception("Version of php should be at least 8.1.0. You are running php version " . PHP_VERSION . ". The version is not supported by this release of php-sapb1 library.");

// require the base classes
require_once 'B1SVersion.php';
require_once 'Config.php';
require_once 'Query.php';
require_once 'Request.php';
require_once 'Response.php';
require_once 'SAPClient.php';
require_once 'Service.php';

// require the filters
require_once 'Filters/index.php';