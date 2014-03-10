<?php //namespace FormGenerator;

require_once('src\String.php');
require_once('src\Data\MySqlDatabaseReader.php');
require_once('src\BusinessLogic\InputElementTypes.php');
//require_once('src\BusinessLogic\InputElementSpecification.php');
require_once('src\BusinessLogic\HtmlTagGenerator.php');
require_once('src\UserInterface\HtmlParameterValidation.php');

//
//
// -------------------------------------------------------------------------------------------------------------Fucking \
//
//
class InputElementSpecification {

    // Private variables
    private $name;
    private $required;
    private $defaultValue;
    private $type;          
    private $maximumLength;
    private $options;

    // Public properties
    public function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

    // Public constructors
    function __construct($name, $required, $defaultValue, $type, $maximumLength, $options = null) {
        $this->name = $name;
        $this->required = $required;
        $this->defaultValue = $defaultValue;
        $this->type = $type;
        $this->maximumLength = $maximumLength;
        $this->options = $options;
    }

}

//
//
// -------------------------------------------------------------------------------------------------------------Fucking \BusinessLogic
//
//
class InputFormGenerator {
    
    function generateInputForm($name, $server, $database, $table, $username, $password) {
        $mySqlDatabaseReader = new InputFormGenerator\Data\MySqlDatabaseReader($server, $database, $username, $password);
        if ($mySqlDatabaseReader->canConnectToDatabase()) {
            echo '<h3>Info</h3>';
            echo 'Connection succesfull<br /><br />';
            
            // TODO: Check if table exists
            $result = $mySqlDatabaseReader->executeSelect("SELECT *
                                                           FROM $table
                                                           LIMIT 0, 0");
            $fields = mysql_num_fields($result);
            $fields2 = array(bla, shit);
            
            echo '<h3>Table</h3>';
            echo '<table cellpadding="5">
                      <tr>
                          <th>Name</th>
                          <th>Type</th>
                          <th>Length</th>
                          <th>Default</th>
                          <th>Flags</th>
                      </tr>';
            for ($i=0; $i < $fields; $i++) {
                echo '<tr>';
                
                $name  = mysql_field_name($result, $i);
                $type  = mysql_field_type($result, $i);
                $len   = mysql_field_len($result, $i);
                $flags = mysql_field_flags($result, $i);
                
                echo '<td>' . $name . '</td>';
                echo '<td>' . $type . '</td>';
                echo '<td>' . $len . '</td>';
                echo '<td>' . '[PH]' . '</td>';
                echo '<td>' . $flags . '</td>';
                
                echo '</tr>'; 
            }
            echo '</table>';
            
            echo '<h3>Input element specifications</h3>';
            $specifications = array();
            for ($i=0; $i < $fields; $i++) {      
                $name  = strtolower(mysql_field_name($result, $i));
                $type  = strtolower(mysql_field_type($result, $i));
                $len   = strtolower(mysql_field_len($result, $i));
                $flags = explode(' ', strtolower(mysql_field_flags($result, $i)));
                $required = in_array('not_null', $flags);
                
                if (in_array('primary_key', $flags)) {
                    continue;
                }
                switch ($type) {
                    case "string":
                        if (in_array('enum', $flags)) {
                            if (InputFormGenerator\String::endsWith($name, '_r')) {
                                $specification = new InputElementSpecification($name, $required, 'DEFAULT_VALUE', InputFormGenerator\BusinessLogic\InputElementTypes::radiobuttons, $len, 'OPTIONS');
                            } else if (InputFormGenerator\String::endsWith($name, '_s')) {
                                $specification = new InputElementSpecification($name, $required, 'DEFAULT_VALUE', InputFormGenerator\BusinessLogic\InputElementTypes::select, $len, 'OPTIONS');
                            }
                            else {
                                // TODO: Error
                            }
                        }
                        else {
                            $specification = new InputElementSpecification($name, $required, 'DEFAULT_VALUE', InputFormGenerator\BusinessLogic\InputElementTypes::text, $len);
                            
                            // TODO: Implement subtypes
                            
                            //if (endsWith($name, 'PH')) {
                            
                            //} else if (endsWith($name, 'PH')) {
                            
                            //}
                            //else {
                            //     // TODO: Error
                            //}
                        }
                        break;
                    case "int":
                        if ($len == 1 && in_array('unsigned', $flags)) {
                            $specification = new InputElementSpecification($name, $required, 'DEFAULT_VALUE', InputFormGenerator\BusinessLogic\InputElementTypes::checkbox, $len);
                        }
                        else {
                            $specification = new InputElementSpecification($name, $required, 'DEFAULT_VALUE', InputFormGenerator\BusinessLogic\InputElementTypes::number, $len);
                        }
                        break;                    
                    default:
                    // TODO: error
                }
                array_push($specifications, $specification);
            }            
            echo '<table cellpadding="5">
                      <tr>
                          <th>Name</th>
                          <th>Required</th>
                          <th>Default</th>
                          <th>Type</th>
                          <th>max length</th>
                          <th>Options</th>
                      </tr>';
            foreach ($specifications as $specification) {  
                echo '<tr>';
                
                echo '<td>' . $specification->name . '</td>';
                echo '<td>' . $specification->required . '</td>';
                echo '<td>' . $specification->defaultValue . '</td>';
                echo '<td>' . $specification->type . '</td>';
                echo '<td>' . $specification->maximumLength . '</td>';
                echo '<td>' . $specification->options . '</td>';
                
                echo '</tr>'; 
            }
            echo '</table>';
            
            
            // Fette trennung hier nd so
            
            
            echo '<h3>Input elements</h3>';
            $inputElements = array();
            $htmlTagGenerator = new InputFormGenerator\BusinessLogic\HtmlTagGenerator();
            foreach ($specifications as $specification) {
                if ($specification->type < 100) {
                    $inputElement = $htmlTagGenerator->generateInput($specification->name,$specification->required, $specification->defaultValue, $specification->type, $specification->maximumLength);
                }
                else {
                    switch ($specification->type) {
                        case 100:
                            $inputElement = $htmlTagGenerator->generateTextarea($specification->name,$specification->required, $specification->defaultValue, $specification->maximumLength);
                            break;
                        case 101:
                            $inputElement = $htmlTagGenerator->generateRadiobuttons($specification->name,$specification->required, $specification->defaultValue, $specification->options);
                            break;
                        case 102:
                            $inputElement = $htmlTagGenerator->generateSelect($specification->name,$specification->required, $specification->defaultValue, $specification->options);
                            break;
                        default:
                        // TODO: handle this bs
                    }
                }
                
                array_push($inputElements, $inputElement);
            }
            echo '<table cellpadding="5">';
            foreach ($inputElements as $inputElement) {  
                echo "<tr><td>$inputElement</tr></td>";
            }
            echo '</table>';
            
            
            
            //$form = $htmlTagGenerator->generateFormStart('', 'post');
        }
        else {
            echo 'Connection failed<br />';
        }      
    }
    
}

// FUCKING BULLSHIT --- FUCKING BULLSHIT --- FUCKING BULLSHIT --- FUCKING BULLSHIT --- FUCKING BULLSHIT --- FUCKING BULLSHIT --- FUCKING BULLSHIT --- FUCKING BULLSHIT
// FUCKING BULLSHIT --- FUCKING BULLSHIT --- FUCKING BULLSHIT --- FUCKING BULLSHIT --- FUCKING BULLSHIT --- FUCKING BULLSHIT --- FUCKING BULLSHIT --- FUCKING BULLSHIT
// FUCKING BULLSHIT --- FUCKING BULLSHIT --- FUCKING BULLSHIT --- FUCKING BULLSHIT --- FUCKING BULLSHIT --- FUCKING BULLSHIT --- FUCKING BULLSHIT --- FUCKING BULLSHIT

// Fucking interface class
$name = $_POST['formName'];
$server = $_POST['hostname'];
$database = $_POST['database'];
$table = $_POST['table'];
$username = $_POST['username'];
$password = $_POST['password'];

if (!InputFormGenerator\UserInterface\HtmlParameterValidation::hasValue($name)) {
    // TODO: some error
}
if (!InputFormGenerator\UserInterface\HtmlParameterValidation::hasValue($server)) {
    // TODO: some error
}
if (!InputFormGenerator\UserInterface\HtmlParameterValidation::hasValue($database)) {
    // TODO: some error
}
if (!InputFormGenerator\UserInterface\HtmlParameterValidation::hasValue($table)) {
    // TODO: some error
}
if (!InputFormGenerator\UserInterface\HtmlParameterValidation::hasValue($username)) {
    // TODO: some error
}
// TODO: RegEx tests?

$inputFormGenerator = new InputFormGenerator();
echo $inputFormGenerator->generateInputForm($name, $server, $database, $table, $username, $password);



echo '<br /><br /><hr /><h3 style="color: #0C0;">Executed successfully</h3>';

?>