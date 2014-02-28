<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">

    <title>Formulargenerator</title>
    <meta name="author" content="Dimitri Vranken">

    <link href="style/css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="style/css/style.css" rel="stylesheet">
</head>
<body>
    <?php require('navigation.inc.html'); ?>

    <div class="content">
        <div class="title-box text-center">
            <h1>Formular-Generator</h1>
        </div>
        <div class="container">
            <aside class="hidden-xs col-sm-6 col-md-6 col-lg-6">
                <h2>Wilkommen beim Formular-Generator</h2>
                <article>
                    <p class="lead">
                        Der Formular-Generator unterstützt Sie in Ihrer Aufgabe Nutzereingaben für eine Datenbank zu erfassen.                
                    </p>
                    <p class="lead">
                        Geben Sie einfach die erforderlichen Informationen ein und lassen Sie ein HTML Formular generieren.
                    </p>
                    <p class="lead">
                        Zur <a href="">Kurzanleitung</a>.
                    </p>
                </article>
            </aside>
            <div class="col-xs-12 col-sm-5 col-md-4 col-lg-4 pull-right">
                <form method="post">
                    <div class="input-group">
                        <label class="input-header" for="formName">Formularname</label>
                        <input type="text" id="formName" name="formName" maxlength="64" required pattern="^[^\s][a-zA-Z0-9_\- ]{1,64}$" title="Der Name des zu generierenden Formulares. Erlaubte Zeichen: a-z, A-Z, 0-9, '_', '-' und ' ' (Leerzeichen)" class="input" spellcheck="true" />
                    </div>
                    <br />
                    <div class="input-group">
                        <label class="input-header" for="hostname">Hostname</label>
                        <input type="text" id="hostname" name="hostname" maxlength="256" required pattern="^((([a-zA-Z0-9]|[a-zA-Z0-9][a-zA-Z0-9\-]*[a-zA-Z0-9])\.)*([A-Za-z0-9]|[A-Za-z0-9][A-Za-z0-9\-]*[A-Za-z0-9])|(([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5]))$" title="Der Name des Hosts, auf dem sich die zu verwendende Datenbank befindet. Erlaubte Zeichen: Hostname oder IP-Adresse des Hosts" class="input" />
                    </div>
                    <div class="input-group">
                        <label class="input-header" for="database">Datenbank</label>
                        <input type="text" id="database" name="database" maxlength="256" required pattern="^\w$" title="Der Name der Datenbank, in der sich die zu verwendende Tabelle befindet. Erlaubte Zeichen: a-z, A-Z, 0-9 und '_'" class="input" />
                    </div>
                    <div class="input-group">
                        <label class="input-header" for="table">Tabelle</label>
                        <input type="text" id="table" name="table" maxlength="256" required pattern="^\w$" title="Der Name der Tabelle, aus der das Eingabeformular generiert werden soll. Erlaubte Zeichen: a-z, A-Z, 0-9 und '_'" class="input" />
                    </div>
                    <div class="input-group">
                        <label class="input-header" for="username">Benutzername</label>
                        <input type="text" id="username" name="username" maxlength="256" required pattern="^\w$" title="Der Benutzername für den Zugriff auf die angegebene Datenbank. Erlaubte Zeichen: a-z, A-Z, 0-9 und '_'" class="input" />
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

    <?php require('footer.inc.html'); ?>

    <!--
        ================================================== Scripts
    -->
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="scripts/js/bootstrap.min.js"></script>
    <script src="scripts/js/style.js" type="text/javascript"></script>
</body>
</html>
