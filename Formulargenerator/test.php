<?php
//namespace FormGenerator;

// TODO: Update access levels of classes/ methods
// TODO: Make methods static

require_once('src\BusinessLogic\InputFormGenerator.php');
require_once('src\UserInterface\HtmlParameterValidation.php');

$name = $_POST['formName'];
$server = $_POST['hostname'];
$database = $_POST['database'];
$table = $_POST['table'];
$username = $_POST['username'];
$password = $_POST['password'];

if (!\InputFormGenerator\UserInterface\HtmlParameterValidation::hasValue($name)) {
    // TODO: some error
}
if (!\InputFormGenerator\UserInterface\HtmlParameterValidation::hasValue($server)) {
    // TODO: some error
}
if (!\InputFormGenerator\UserInterface\HtmlParameterValidation::hasValue($database)) {
    // TODO: some error
}
if (!\InputFormGenerator\UserInterface\HtmlParameterValidation::hasValue($table)) {
    // TODO: some error
}
if (!\InputFormGenerator\UserInterface\HtmlParameterValidation::hasValue($username)) {
    // TODO: some error
}
// TODO: RegEx tests?

$inputFormGenerator = new \InputFormGenerator\BusinessLogic\InputFormGenerator();
echo $inputFormGenerator->generateInputForm($name, $server, $database, $table, $username, $password);



echo '<br /><br /><hr /><h3 style="color: #0C0;">Executed successfully</h3>';

?>