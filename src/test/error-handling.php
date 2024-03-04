<pre>Error handling included
<?
// Arrange error handling
error_reporting(E_ALL | E_STRICT);

echo "Php version: ".phpversion().PHP_EOL;
echo "Current error reporting level: ".error_reporting().PHP_EOL;
/**
 * Uncaught exception handler.
 */
function handle_exception(Throwable $e)
{
?>
    <div style='text-align: center;'>
        <h2 style='color: rgb(190, 50, 50);'>Exception Occured:</h2>
        <table style='width: 800px; display: inline-block;'>
            <tr style='background-color:rgb(230,230,230);'>
                <th style='width: 80px;'>Type</th>
                <td><?= get_class($e) ?></td>
            </tr>
            <tr style='background-color:rgb(240,240,240);'>
                <th>Message</th>
                <td><?= $e->getMessage() ?></td>
            </tr>
            <tr style='background-color:rgb(230,230,230);'>
                <th>File</th>
                <td><?= $e->getFile() ?></td>
            </tr>
            <tr style='background-color:rgb(240,240,240);'>
                <th>Line</th>
                <td><?= $e->getLine() ?></td>
            </tr>
        </table>
    </div>
<?
    //$message = "Type: " . get_class( $e ) . "; Message: {$e->getMessage()}; File: {$e->getFile()}; Line: {$e->getLine()};";
    //file_put_contents( $config["app_dir"] . "/tmp/logs/exceptions.log", $message . PHP_EOL, FILE_APPEND );
    //header( "Location: {$config["error_page"]}" );
    exit();
}
/*
    int $errno,
    string $errstr,
    string $errfile = ?,
    int $errline = ?,
    array $errcontext = ?
 */
function handle_error($num, $str, $file, $line)
{
    handle_exception(new ErrorException($str, 0, $num, $file, $line));
}


/**
 * Checks for a fatal error, work around for set_error_handler not working on fatal errors.
 * 
 * https://www.php.net/manual/en/function.set-error-handler.php
 * The following error types cannot be handled with a user defined function: 
 * E_ERROR, E_PARSE, E_CORE_ERROR, E_CORE_WARNING, E_COMPILE_ERROR, E_COMPILE_WARNING
 * independent of where they were raised, and most of E_STRICT raised in the file where set_error_handler() is called.
 */
function handle_shutdown()
{
    $error = error_get_last();
    if(!is_null($error)){
        if ($error["type"] == E_ERROR)    
            handle_error($error["type"], $error["message"], $error["file"], $error["line"]);
        else
        ?><pre>Last error on shutdown: <?var_dump($error)?></pre><?
    }
    else {
        ?><pre>No last error on shutdown</pre><?
    }
}

set_error_handler("handle_error");
set_exception_handler("handle_exception");
register_shutdown_function("handle_shutdown");
?>
</pre>