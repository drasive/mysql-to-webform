<?php
//namespace FormGenerator;

// TODO: Update access levels of classes/ methods
// TODO: Make methods static

require_once('src\BusinessLogic\InputFormGenerator.php');

echo \InputFormGenerator\BusinessLogic\InputFormGenerator::generateInputForm($name, $server, $database, $table, $username, $password);

echo '<br /><br /><hr /><h3 style="color: #0C0;">Executed successfully</h3>';

?>