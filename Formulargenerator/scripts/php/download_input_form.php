<?php
// TODO:

$name = $_POST['name'];
$server = $_POST['hostname'];
$database = $_POST['database'];
$table = $_POST['table'];
$username = $_POST['username'];
$password = $_POST['password'];

require_once('src\UserInterface\HttpParameterValidator.php');
require_once('src\UserInterface\HttpHelper.php.php');
require_once('src\BusinessLogic\InputFormGenerator.php');

// Validate parameters
if (!\InputFormGenerator\UserInterface\HttpParameterValidator::hasValue($name) ||
    !\InputFormGenerator\UserInterface\HttpParameterValidator::hasValue($server) ||
    !\InputFormGenerator\UserInterface\HttpParameterValidator::hasValue($database) || 
    !\InputFormGenerator\UserInterface\HttpParameterValidator::hasValue($table) |
    !\InputFormGenerator\UserInterface\HttpParameterValidator::hasValue($username)) {
    // TODO: show dat error page and exit
    echo "Shits on fire, yo";
}

$inputForm = \InputFormGenerator\BusinessLogic\InputFormGenerator::generateInputForm($name, $server, $database, $table, $username, $password);
\InputFormGenerator\UserInterface\HttpHelper::uploadToWebbrowser($inputForm, "Formular - $name", 'text/html');
?>