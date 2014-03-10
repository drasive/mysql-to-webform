<!DOCTYPE html>

<html>
<head>
    <meta charset="UTF-8" />

    <title>Formular-Generator</title>
    <meta name="author" content="Dimitri Vranken" />

    <script src="http://code.jquery.com/jquery.js"></script>

    <script src="scripts/js/bootstrap.min.js"></script>
    <link href="style/css/bootstrap.css" rel="stylesheet" media="screen" />

    <link href="style/css/style.css" rel="stylesheet" />
    <script src="scripts/js/style.js" type="text/javascript"></script>

    <script src="scripts/js/jquery.cookies.js" type="text/javascript"></script>
    <script src="scripts/js/storage.js" type="text/javascript"></script>
</head>
<body>
    <?php require('includes/warnings.inc.php'); ?>
    <?php require('includes/navigation.inc.html'); ?>

    <div class="content">
        <div class="title-box text-center">
            <h1>Formular-Generator</h1>
        </div>
        <div class="container">
            <aside class="hidden-xs col-sm-6 col-md-6 col-lg-6">
                <h2>Wilkommen beim Formular-Generator</h2>
                <article>
                    <p class="lead">
                        Der Formular-Generator unterstützt Sie in Ihrer Aufgabe Nutzereingaben zu erfassen.
                    </p>
                    <p class="lead">
                        Geben Sie einfach die erforderlichen Informationen ein und lassen Sie ein HTML5 Formular generieren.
                    </p>
                    <p class="lead">
                        Zur <a href="">Kurzanleitung</a>.
                    </p>
                </article>

                <br />
                <br />
                --- For testing purposes only ---<br />
                <!--<input type="button" title="button" value="Test" /><br />-->
                <input type="checkbox" title="checkbox" value="Test" /><br />
                <input type="color" title="color" value="Test" /><br />
                <input type="date" title="date" value="Test" /><br />
                <input type="datetime" title="datetime" value="Test" /><br />
                <input type="datetime-local" title="datetime-local" value="Test" /><br />
                <input type="email" title="email" value="Test" /><br />
                <input type="file" title="file" value="Test" /><br />
                <!--<input type="hidden" title="hidden" value="Test" /><br />
                <input type="image" title="image" value="Test" /><br />-->
                <input type="month" title="month" value="Test" /><br />
                <input type="number" title="number" value="Test" /><br />
                <input type="password" title="password" value="Test" /><br />
               <!-- <input type="radio" title="radio" value="Test" /><br />-->
                <input type="range" title="range" value="Test" max="5"/><br />
                <!--<input type="reset" title="reset" value="Test" /><br />-->
                <input type="search" title="search" value="Test" /><br />
                <input type="submit" title="submit" value="Test" /><br />
                <input type="tel" title="tel" value="Test" /><br />
                <input type="text" title="text" value="Test" /><br />
                <input type="time" title="time" value="Test" /><br />
                <input type="url" title="url" value="Test" /><br />
                <input type="week" title="week" value="Test" /><br />
            </aside>
            <div class="col-xs-12 col-sm-5 col-md-4 col-lg-4 pull-right">
                <form method="post" action="test.php">
                    <div class="input-group">
                        <label class="input-header" for="formName">Formularname</label>
                        <input value="Test" type="text" id="formName" name="formName" maxlength="64" required pattern="^[^\s][a-zA-Z0-9_\- ]{0,64}$" title="Der Name des zu generierenden Formulares. Erlaubte Zeichen: a-z, A-Z, 0-9, '_', '-' und ' ' (Leerzeichen)" class="input" spellcheck="true" />
                    </div>
                    <br />
                    <div class="input-group">
                        <label class="input-header" for="hostname">Hostname</label>
                        <input value="localhost" type="text" id="hostname" name="hostname" onchange="saveUserInput('hostname');" maxlength="256" required pattern="^((([a-zA-Z0-9]|[a-zA-Z0-9][a-zA-Z0-9\-]*[a-zA-Z0-9])\.)*([A-Za-z0-9]|[A-Za-z0-9][A-Za-z0-9\-]*[A-Za-z0-9])|(([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5]))$" title="Der Name des Hosts, auf dem sich die zu verwendende Datenbank befindet. Erlaubte Zeichen: Hostname oder IP-Adresse des Hosts" class="input" />
                    </div>
                    <div class="input-group">
                        <label class="input-header" for="database">Datenbank</label>
                        <input value="formulargenerator" type="text" id="database" name="database" onchange="saveUserInput('database');" maxlength="256" required pattern="^[^\s].{0,256}$" title="Der Name der Datenbank, in der sich die zu verwendende Tabelle befindet" class="input" />
                    </div>
                    <div class="input-group">
                        <label class="input-header" for="table">Tabelle</label>
                        <input value="personen" type="text" id="table" name="table" maxlength="256" required pattern="^[^\s].{0,256}$" title="Der Name der Tabelle, aus der das Eingabeformular generiert werden soll" class="input" />
                    </div>
                    <div class="input-group">
                        <label class="input-header" for="username">Benutzername</label>
                        <input value="root" type="text" id="username" name="username" onchange="saveUserInput('username');" maxlength="256" required pattern="^[^\s].{0,256}$" title="Der Benutzername für den Zugriff auf die angegebene Datenbank" class="input" />
                    </div>
                    <div class="input-group">
                        <label class="input-header" for="password">Passwort</label>
                        <input type="password" id="password" name="password" maxlength="256" class="input" />
                    </div>

                    <input type="submit" value="Formular generieren" class="submit" />
                </form>
            </div>
        </div>
    </div>

    <?php require('includes/footer.inc.html'); ?>

    <!--
        ================================================== Scripts
    -->
    <script type="text/javascript">
        //loadUserInput('hostname');
        //loadUserInput('database');
        //loadUserInput('username');
    </script>
</body>
</html>
