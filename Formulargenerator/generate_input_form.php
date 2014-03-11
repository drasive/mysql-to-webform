<!DOCTYPE html>

<html>
<head>
    <meta charset="UTF-8" />
    <meta name="author" content="Dimitri Vranken" />

    <title>Formular-Generator</title>
    <link rel="shortcut icon" href="/media/icons/form.ico">

    <script src="http://code.jquery.com/jquery.js"></script>

    <script src="/scripts/js/bootstrap.min.js"></script>
    <link href="/style/css/bootstrap.css" rel="stylesheet" media="screen" />

    <link href="/style/css/style.css" rel="stylesheet" />
    <script src="/scripts/js/style.js" type="text/javascript"></script>

    <script src="/scripts/js/jquery.cookies.js" type="text/javascript"></script>
    <script src="/scripts/js/storage.js" type="text/javascript"></script>
</head>
<body>
    <?php
    $validateForm = isset($_POST['submit']);
    
    if($validateForm){
        $name = $_POST['formName'];
        $server = $_POST['hostname'];
        $database = $_POST['database'];
        $table = $_POST['table'];
        $username = $_POST['username'];
        $password = $_POST['password'];
    }
    ?>

    <?php require('/includes/warnings.inc.php'); ?>
    <?php require('/includes/navigation.inc.html'); ?>

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
                        Zur <a href="">Kurzanleitung</a>.
                    </p>
                </article>
            </aside>
            <div class="col-xs-12 col-sm-5 col-md-4 col-lg-4 pull-right">
                <form method="post" style="padding-bottom: 70px;">
                    <div class="input-group">
                        <label class="input-header" for="formName">Formularname</label>
                        <input value="<?php if ($validateForm) {echo $name;} else {echo 'Test';} ?>" type="text" id="formName" name="formName" maxlength="64" required pattern="^[^\s][a-zA-Z0-9_\- ]{0,64}$" title="Der Name des zu generierenden Formulares. Erlaubte Zeichen: a-z, A-Z, 0-9, '_', '-' und ' ' (Leerzeichen)" class="input" spellcheck="true" />
                    </div>
                    <br />
                    <div class="input-group">
                        <label class="input-header" for="hostname">Hostname</label>
                        <input value="<?php if ($validateForm) {echo $server;} else {echo 'localhost';} ?>" type="text" id="hostname" name="hostname" onchange="saveUserInput('hostname');" maxlength="256" required pattern="^((([a-zA-Z0-9]|[a-zA-Z0-9][a-zA-Z0-9\-]*[a-zA-Z0-9])\.)*([A-Za-z0-9]|[A-Za-z0-9][A-Za-z0-9\-]*[A-Za-z0-9])|(([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5]))$" title="Der Name des Hosts, auf dem sich die zu verwendende Datenbank befindet. Erlaubte Zeichen: Hostname oder IP-Adresse des Hosts" class="input" />
                    </div>
                    <div class="input-group">
                        <label class="input-header" for="database">Datenbank</label>
                        <input value="<?php if ($validateForm) {echo $database;} else {echo 'formulargenerator';} ?>" type="text" id="database" name="database" onchange="saveUserInput('database');" maxlength="256" required pattern="^[^\s].{0,256}$" title="Der Name der MySql Datenbank, in der sich die zu verwendende Tabelle befindet" class="input" />
                    </div>
                    <div class="input-group">
                        <label class="input-header" for="table">Tabelle</label>
                        <input value="<?php if ($validateForm) {echo $table;} else {echo 'input';} ?>" type="text" id="table" name="table" maxlength="256" required pattern="^[^\s].{0,256}$" title="Der Name der Datenbanktabelle, aus der das Eingabeformular generiert werden soll" class="input" />
                    </div>
                    <div class="input-group">
                        <label class="input-header" for="username">Benutzername</label>
                        <input value="<?php if ($validateForm) {echo $username;} else {echo 'root';} ?>" type="text" id="username" name="username" onchange="saveUserInput('username');" maxlength="256" required pattern="^[^\s].{0,256}$" title="Der Benutzername für den Zugriff auf die angegebene Datenbank" class="input" />
                    </div>
                    <div class="input-group">
                        <label class="input-header" for="password">Passwort</label>
                        <input value="<?php if ($validateForm) {echo $password;} ?>" type="password" id="password" name="password" maxlength="256" title="Das Passwort für den Zugriff auf die angegebene Datenbank" class="input" />
                    </div>

                    <input type="submit" name="submit" value="Formular generieren" title="Eingabeformular generieren, welches auf den Spalten der angegebenen Datenbanktabelle basiert" class="submit" />
                </form>

                <p class="warning">
                    <?php
                    require_once('src\UserInterface\HtmlParameterValidator.php');
                    require_once('src\Data\MySqlDatabaseReader.php');
                    
                    $generateInputForm = false;
                    
                    if ($validateForm) {
                        // Validate form input
                        $isFormValid = false;
                        if (!\InputFormGenerator\UserInterface\HtmlParameterValidator::hasValue($name)) {
                            outputMissingInformationErrorMessage('Formularname');
                        }
                        else if (!\InputFormGenerator\UserInterface\HtmlParameterValidator::hasValue($server)) {
                            outputMissingInformationErrorMessage('Hostname');
                        }
                        else if (!\InputFormGenerator\UserInterface\HtmlParameterValidator::hasValue($database)) {
                            outputMissingInformationErrorMessage('Datenbankname');
                        }
                        else if (!\InputFormGenerator\UserInterface\HtmlParameterValidator::hasValue($table)) {
                            outputMissingInformationErrorMessage('Tabellenname');
                        }
                        else if (!\InputFormGenerator\UserInterface\HtmlParameterValidator::hasValue($username)) {
                            outputMissingInformationErrorMessage('Benutzername');
                        }
                        else {
                            $isFormValid = true;
                        }
                        if (!$isFormValid) {
                            return;
                        }
                        
                        // Validate database connection
                        $isDatabaseConnectionValid = false;
                        $mySqlDatabaseReader = new \InputFormGenerator\Data\MySqlDatabaseReader($server, $database, $username, $password);
                        if (!$mySqlDatabaseReader->canConnect()) {
                            outputInvalidDatabaseConnectionParameterErrorMessage('Es kann keine Verbindung zur Datenbank hergestellt werden.');
                        }
                        else if (!$mySqlDatabaseReader->doesTableExist($table)) {
                            outputInvalidDatabaseConnectionParameterErrorMessage('Die angegebene Datenbanktabelle existiert nicht.');
                        }
                        else {
                            $isDatabaseConnectionValid = true;
                        }
                        if (!$isDatabaseConnectionValid) {
                            return;
                        }
                        
                        $generateInputForm = true;
                    }
                    
                    if ($generateInputForm) {
                        // TODO: Fucking shit. Really PHP?
                        //http_post_fields('/view_input_form.php', array($))
                        //http_post
                    }
                    
                    // Methods
                    function outputMissingInformationErrorMessage($missingInformation) {
                        echo "Es wurde kein $missingInformation angegeben!";
                    }
                    
                    function outputInvalidDatabaseConnectionParameterErrorMessage($error) {
                        echo "$error<br />
                              Überprüfen Sie die Verbindungsparameter.";
                    }
                    ?>
                </p>
            </div>
        </div>
    </div>

    <?php require('/includes/footer.inc.html'); ?>

    <!--
        ================================================== Scripts
    -->
    <script type="text/javascript">
        setActiveNavigationLink('nav_form_generator');
    </script>

    <?php    
    if (!$validateForm) {
        //echo '<script type="text/javascript">
        //          loadUserInput("hostname");
        //          loadUserInput("database");
        //          loadUserInput("username");
        //      </script>';
    }
    ?>

</body>
</html>
