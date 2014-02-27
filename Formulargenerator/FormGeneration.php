TODO: Update and complete validation (regex, etc..)

<!DOCTYPE html>

<html>
<head>
    <title>Formulargenerator</title>
    <link href="css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="css/main.css" rel="stylesheet">
</head>
<body>
    <div class="navbar navbar-inverse navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Dimitri V.</a>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#">Home</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="titlebox text-center">
        <h1>Generate a motherfucking input form</h1>
    </div>

    <div class="container">
        <div class="col-xs-4 col-sm-6 col-md-6 col-lg-6">
            <h2>Welcome to my fucking website!</h2>
            <p class="lead">
                Test. THIS IS A FUCKING TEST.
            </p>
        </div>
        <div class="col-xs-4 col-sm-5 col-md-4 col-lg-4 pull-right">
            <form method="post">
                <div class="input-group">
                    <label class="input-header">Formularname</label>
                    <input type="text" id="formName" name="formName" required pattern="\S+" title="Der Name des zu generierenden Formulares" class="input" />
                </div>
                <br />
                <div class="input-group">
                    <label class="input-header">Hostname</label>
                    <input type="text" id="hostname" name="hostname" required pattern="\S+" title="Der Name des Hosts, auf dem sich die zu verwendende Datenbank befindet" class="input" />
                </div>
                <div class="input-group">
                    <label class="input-header">Datenbank</label>
                    <input type="text" id="database" name="database" required pattern="\S+" title="Der Name der Datenbank, in der sich die zu verwendende Tabelle befindet" class="input" />
                </div>
                <div class="input-group">
                    <label class="input-header">Tabelle</label>
                    <input type="text" id="table" name="table" required pattern="\S+" title="Der Name der Tabelle, aus der das Eingabeformular generiert werden soll" class="input" />
                </div>
                <div class="input-group">
                    <label class="input-header">Benutzername</label>
                    <input type="text" id="username" name="username" required class="input" />
                </div>
                <div class="input-group">
                    <label class="input-header">Passwort</label>
                    <input type="password" id="password" name="password" required class="input" />
                </div>

                <input type="submit" value="Formular generieren" class="submit" />
            </form>
        </div>
    </div>

    <!--
        -------------------------------------------------- Scripts
    -->
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
