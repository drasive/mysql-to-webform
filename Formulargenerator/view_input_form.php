<!DOCTYPE html>

<html>
<head>
    <meta charset="UTF-8" />
    <meta name="author" content="Dimitri Vranken" />

    <title>Vorschau - Formular-Generator</title>
    <link rel="shortcut icon" href="/media/icons/form.ico">

    <script src="http://code.jquery.com/jquery.js"></script>

    <script src="/scripts/js/bootstrap.min.js"></script>
    <link href="/style/css/bootstrap.css" rel="stylesheet" media="screen" />

    <link href="/style/css/style.css" rel="stylesheet" />
    <script src="/scripts/js/style.js" type="text/javascript"></script>
</head>
<body>
    <?php require('/includes/warnings.inc.php'); ?>
    <?php require('/includes/navigation.inc.html'); ?>

    <div class="content">
        <div class="title-box text-center">
            <h1>Formular-Vorschau</h1>
        </div>
        <div class="container">
            <aside class="hidden-xs col-sm-4 col-md-4 col-lg-4">
                <article>
                    <section>
                        <h2>Glückwunsch!</h2>
                        <p class="lead">
                            Ihr Formular wurde generiert und steht Ihnen zur freien Verwendung zur Verfügung.
                        </p>
                        <p class="lead">
                            Probieren Sie es direkt hier im Browser aus, laden Sie es sich herunter oder verwerfen Sie es und lassen Sie sich beliebig viele andere Formulare generieren.
                        </p>
                    </section>
                    <section class="hidden-sm">
                        <h3>Informationen</h3>
                        <table>
                            <tbody>
                                <tr>
                                    <td>Formularname</td>
                                    <td>Test</td>
                                </tr>
                                <tr>
                                    <td>Anzahl Eingabefelder</td>
                                    <td>Test</td>
                                </tr>
                                <tr class="new-section">
                                    <td>Hostname</td>
                                    <td>Test</td>
                                </tr>
                                <tr>
                                    <td>Datenbank</td>
                                    <td>Test</td>
                                </tr>
                                <tr>
                                    <td>Tabelle</td>
                                    <td>Test</td>
                                </tr>
                                <tr>
                                    <td>Benutzername</td>
                                    <td>Test</td>
                                </tr>
                            </tbody>
                        </table>
                    </section>
                </article>
            </aside>
            <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6 pull-right">


                <form method="post" action="test.php">
                    <input name="download" type="submit" value="Herunterladen" />
                    <input type="button" value="Verwerfen" onclick="if (confirm('Möchten Sie dieses Eingabeformular wirklich verwerfen?\nSie können es beliebig viele male erneut generieren lassen.')) { window.location = '/generate_input_form.php'; }" />
                </form>
            </div>
        </div>
    </div>

    <?php require('/includes/footer.inc.html'); ?>
</body>
</html>
