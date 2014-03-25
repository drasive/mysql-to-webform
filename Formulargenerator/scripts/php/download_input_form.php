<?php
// TODO:

$name = $_POST['name'];
$server = $_POST['hostname'];
$database = $_POST['database'];
$table = $_POST['table'];
$username = $_POST['username'];
$password = $_POST['password'];

require_once('src\UserInterface\HtmlParameterValidator.php');
require_once('src\UserInterface\HttpHelper.php.php');
require_once('src\BusinessLogic\InputFormGenerator.php');

// Validate parameters
if (!\InputFormGenerator\UserInterface\HtmlParameterValidator::hasValue($name) ||
    !\InputFormGenerator\UserInterface\HtmlParameterValidator::hasValue($server) ||
    !\InputFormGenerator\UserInterface\HtmlParameterValidator::hasValue($database) || 
    !\InputFormGenerator\UserInterface\HtmlParameterValidator::hasValue($table) |
    !\InputFormGenerator\UserInterface\HtmlParameterValidator::hasValue($username)) {
    // TODO: show dat error page and exit
    echo "Shits on fire, yo";
}

$inputForm = \InputFormGenerator\BusinessLogic\InputFormGenerator::generateInputForm($name, $server, $database, $table, $username, $password);
\InputFormGenerator\UserInterface\HttpHelper::uploadToWebbrowser($inputForm, "Formular - $name", 'text/html');
?>