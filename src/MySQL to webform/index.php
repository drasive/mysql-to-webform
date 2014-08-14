<!DOCTYPE html>

<html>
<head>
    <meta charset="UTF-8" />
    <meta name="author" content="Dimitri Vranken" />

    <title>Formular-Generator</title>
    <link rel="shortcut icon" href="media/icons/form.ico" />

    <script src="http://code.jquery.com/jquery.js"></script>

    <script src="js/bootstrap.min.js"></script>
    <link href="style/css/bootstrap.css" rel="stylesheet" media="screen" />

    <link href="style/css/custom.min.css" rel="stylesheet" />
    <script src="js/style.js" type="text/javascript"></script>

    <script src="js/jquery.cookies.min.js" type="text/javascript"></script>
    <script src="js/storage.js" type="text/javascript"></script>
</head>
<body>
    <?php
    require_once('php/BusinessLogic/ConfigurationReader.php');
    
    $debug = false;
    if (DimitriVranken\MySQL_to_webform\BusinessLogic\ConfigurationReader::getDebugMode()) {
        $debug = true;
    }
    
    // Input validation
    $validateUserInput = isset($_POST['validate_user_input']);
    
    if ($validateUserInput) {
        // Get parameters
        $name = $_POST['name'];
        $server = $_POST['hostname'];
        $database = $_POST['database'];
        $table = $_POST['table'];
        $username = $_POST['username'];
        $password = $_POST['password'];
    }
    ?>

    <?php require('includes/warnings.inc.php'); ?>
    <?php require('includes/navigation.inc.html'); ?>

    <div class="content">
        <div class="title-box text-center">
            <h1>Formular-Generator</h1>
        </div>
        <div class="container">
            <aside class="hidden-xs col-sm-6 col-md-6 col-lg-6">
                <article>
                    <h2>Wilkommen beim Formular-Generator</h2>
                    <p class="lead">
                        Der Formular-Generator unterstützt Sie in Ihrer Aufgabe Nutzereingaben für eine MySql Datenbank zu erfassen.
                    </p>
                    <p class="lead">
                        Geben Sie einfach die erforderlichen Informationen ein und lassen Sie ein HTML5 Formular generieren.
                    </p>
                    <p class="lead">
                        Zur <a href="media/pdfs/manual.pdf" target="_blank">Kurzanleitung</a>.
                    </p>
                </article>
            </aside>
            <div class="col-xs-12 col-sm-5 col-md-4 col-lg-4 pull-right">
                <form method="post" style="padding-bottom: 70px;" name="generate_input_form" id="generate_input_form">
                    <div class="input-group">
                        <label class="input-header" for="name">Formularname</label>
                        <input value="<?php if ($validateUserInput) {echo $name;} else if ($debug) {echo 'Test';} ?>" type="text" id="name" name="name" placeholder=" z. B.: Lieferanten (mit Adresse)" maxlength="64" required="" pattern="^[^\s][a-zA-Z0-9_\-() ]{0,64}$" title="Der Name des zu generierenden Formulares. Erlaubte Zeichen: a-z, A-Z, 0-9, '_', '-', '(', ')' und ' ' (Leerzeichen)" class="input" spellcheck="true" />
                    </div>
                    <br />
                    <div class="input-group">
                        <label class="input-header" for="hostname">Hostname</label>
                        <input value="<?php if ($validateUserInput) {echo $server;} else if ($debug) {echo 'localhost';} ?>" type="text" id="hostname" name="hostname" placeholder=" z. B.: 192.168.0.1" onchange="saveUserInput('hostname');" maxlength="256" required="" pattern="^((([a-zA-Z0-9]|[a-zA-Z0-9][a-zA-Z0-9\-]*[a-zA-Z0-9])\.)*([A-Za-z0-9]|[A-Za-z0-9][A-Za-z0-9\-]*[A-Za-z0-9])|(([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5]))$" title="Der Name des Hosts, auf dem sich die zu verwendende Datenbank befindet. Erlaubte Zeichen: Hostname oder IP-Adresse des Hosts" class="input" />
                    </div>
                    <div class="input-group">
                        <label class="input-header" for="database">Datenbank</label>
                        <input value="<?php if ($validateUserInput) {echo $database;} else if ($debug) {echo 'formulargenerator';} ?>" type="text" id="database" name="database" placeholder=" z. B.: Lieferservice" onchange="saveUserInput('database');" maxlength="256" required="" pattern="^[^\s].{0,256}$" title="Der Name der MySql Datenbank, in der sich die zu verwendende Tabelle befindet" class="input" />
                    </div>
                    <div class="input-group">
                        <label class="input-header" for="table">Tabelle</label>
                        <input value="<?php if ($validateUserInput) {echo $table;} else if ($debug) {echo 'input_not_required';} ?>" type="text" id="table" name="table" placeholder=" z. B.: Lieferanten" maxlength="256" required="" pattern="^[^\s].{0,256}$" title="Der Name der Datenbanktabelle, aus der das Eingabeformular generiert werden soll" class="input" />
                    </div>
                    <div class="input-group">
                        <label class="input-header" for="username">Benutzername</label>
                        <input value="<?php if ($validateUserInput) {echo $username;} else if ($debug) {echo 'root';} ?>" type="text" id="username" name="username" placeholder=" z. B.: root" onchange="saveUserInput('username');" maxlength="256" required="" pattern="^[^\s].{0,256}$" title="Der Benutzername für den Zugriff auf die angegebene Datenbank" class="input" />
                    </div>
                    <div class="input-group">
                        <label class="input-header" for="password">Passwort</label>
                        <input value="<?php if ($validateUserInput) {echo $password;} ?>" type="password" id="password" name="password" maxlength="256" title="Das Passwort für den Zugriff auf die angegebene Datenbank" class="input" />
                    </div>

                    <input type="submit" name="validate_user_input" value="Formular generieren" title="Eingabeformular generieren, welches auf den Spalten der angegebenen Datenbanktabelle basiert" class="submit" />
                </form>

                <p class="warning">
                    <?php
                    require_once('php/UserInterface/HttpParameterValidator.php');
                    require_once('php/Data/MySqlDatabaseReader.php');

                    $startInputFormGeneration = false;

                    if ($validateUserInput) {
                        // Validate form input
                        $isUserInputValid = false;
                        if (!\DimitriVranken\MySQL_to_webform\UserInterface\HttpParameterValidator::hasValue($name)) {
                            outputMissingInformationErrorMessage('Formularname');
                        }
                        else if (!\DimitriVranken\MySQL_to_webform\UserInterface\HttpParameterValidator::hasValue($server)) {
                            outputMissingInformationErrorMessage('Hostname');
                        }
                        else if (!\DimitriVranken\MySQL_to_webform\UserInterface\HttpParameterValidator::hasValue($database)) {
                            outputMissingInformationErrorMessage('Datenbankname');
                        }
                        else if (!\DimitriVranken\MySQL_to_webform\UserInterface\HttpParameterValidator::hasValue($table)) {
                            outputMissingInformationErrorMessage('Tabellenname');
                        }
                        else if (!\DimitriVranken\MySQL_to_webform\UserInterface\HttpParameterValidator::hasValue($username)) {
                            outputMissingInformationErrorMessage('Benutzername');
                        }
                        else {
                            $isUserInputValid = true;
                        }
                        if (!$isUserInputValid) {
                            return;
                        }

                        // Validate database connection
                        $isDatabaseConnectionValid = false;
                        $mySqlDatabaseReader = new \DimitriVranken\MySQL_to_webform\Data\MySqlDatabaseReader($server, $database, $username, $password);
                        if (!$mySqlDatabaseReader->canConnect()) {
                            outputInvalidDatabaseConnectionParameterErrorMessage('Es kann keine Verbindung zur Datenbank hergestellt werden.');
                        }
                        else if (!$mySqlDatabaseReader->doesTableExist($table)) {
                            outputInvalidDatabaseConnectionParameterErrorMessage('Die angegebene Datenbanktabelle kann nicht gefunden werden.');
                        }
                        else {
                            $isDatabaseConnectionValid = true;
                        }
                        if (!$isDatabaseConnectionValid) {
                            return;
                        }

                        $startInputFormGeneration = true;
                    }

                    // Methods
                    /**
                     * Fehler ausgeben, dass eine Information fehlt.
                     */
                    function outputMissingInformationErrorMessage($missingInformation) {
                        echo "Es wurde kein $missingInformation angegeben!";
                    }

                    /**
                     * Fehler ausgeben, dass eine Parameter für die Verbindung zur Datenbank inkorrekt ist.
                     */
                    function outputInvalidDatabaseConnectionParameterErrorMessage($error) {
                        echo "$error<br />
                              Überprüfen Sie die Verbindungsparameter.";
                    }
                    ?>
                </p>


                <form action="view_input_form.php" method="post" name="view_input_form" id="view_input_form">
                    <?php
                    if ($startInputFormGeneration) {
                        // Prepeare a hidden form for a HTTP post to the form-generation page
                        
                        // Source: http://stackoverflow.com/questions/5576619/php-redirect-with-post-data                        
                        foreach ($_POST as $httpPostVariableName => $httpPostVariableValue) {
                            echo "<input type='hidden' name='" . htmlentities($httpPostVariableName)."' value='" . htmlentities($httpPostVariableValue) . "'>\n";
                        }
                    }
                    ?>
                </form>

                <?php
                if ($startInputFormGeneration) {
                    // Execute the HTTP post to the form-generation page
                    echo '<script type="text/javascript">
                              document.forms["view_input_form"].submit();
                          </script>';
                }
                ?>
            </div>
        </div>
    </div>

    <?php require('includes/footer.inc.html'); ?>

    <!--
        ================================================== Scripts
    -->
    <script type="text/javascript">
        setActiveNavigationLink('nav_form_generator');
    </script>

    <?php
    if (!$validateUserInput && !$debug) {
        echo '<script type="text/javascript">
                  loadUserInput("hostname");
                  loadUserInput("database");
                  loadUserInput("username");
              </script>';
    }
    ?>

</body>
</html>
