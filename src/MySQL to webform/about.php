<!DOCTYPE html>

<html>
<head>
    <meta charset="UTF-8" />
    <meta name="author" content="Dimitri Vranken" />

    <title>Über - Formular-Generator</title>
    <link rel="shortcut icon" href="media/icons/form.ico">

    <script src="http://code.jquery.com/jquery.js"></script>

    <script src="js/bootstrap.min.js"></script>
    <link href="style/css/bootstrap.css" rel="stylesheet" media="screen" />

    <link href="style/css/custom.min.css" rel="stylesheet" />
    <script src="js/style.js" type="text/javascript"></script>
</head>
<body>
    <?php require('includes/warnings.inc.php'); ?>
    <?php require('includes/navigation.inc.html'); ?>

    <div class="content">
        <div class="title-box text-center">
            <h1>Über</h1>
        </div>
        <div class="container">
            <article class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <section>
                    <h2>Was</h2>
                    <h3>Funktion</h3>
                    <p>
                        Das Generieren von HTML5-Eingabeformularen. Die benötigten Felder und Attribute werden aus einer MySql Tabelle ausgelesen.
                    </p>
                    <h3>Technik</h3>
                    <p>
                        Frontend: HTML5 Website mit CSS3 und Bootstrap<br />
                        Backend: PHP 5.4
                    </p>
                </section>
                <section>
                    <h2>Warum</h2>
                    <p>
                        Das Erstellen eines HTML-Formular-Generators war ein Semesterbegleitender Kompetenznachsweis im Modul 307 der <a href="http://home.gibm.ch/">Gewerblich-industriellen Berufsfachschule Muttenz</a>.
                    </p>
                </section>
                <section>
                    <h2>Wer</h2>
                    <h3>Entwickler</h3>
                    <p>
                        Dimitri Vranken<br />
                        Mail: <a href="mailto:dimitri.vranken@hotmail.ch">dimitri.vranken@hotmail.ch</a><br />
                    </p>
                    <h3>Experte</h3>
                    <p>
                        Daniel Brodbeck<br />
                        Mail: <a href="mailto:daniel.brodbeck@gibmit.ch">daniel.brodbeck@gibmit.ch</a><br />
                    </p>
                </section>
            </article>
            <aside class="hidden-xs hidden-sm col-md-5 col-lg-4 pull-right">
                <h2>Such free space. WOW!</h2>
                <div>
                    <img src="media/images/kid_lolly_cat.jpg" style="height: 480px; width: 360px;" alt="Ein Kleinkind, das seinen Lutscher an eine Katze geklebt hat und traurig über seinen Verlust ist. Die Katze sieht auch nicht glücklich aus." title="Ein Kleinkind, das seinen Lutscher an eine Katze geklebt hat und traurig über seinen Verlust ist. Die Katze sieht auch nicht glücklich aus." /><br />
                    <p class="image-description">
                        Bildquelle: <a href="http://i.imgur.com/maELdh4.jpg">Imgur.com</a><br />
                    </p>
                </div>
            </aside>
        </div>
    </div>

    <?php require('includes/footer.inc.html'); ?>

    <!--
        ================================================== Scripts
    -->
    <script type="text/javascript">
        setActiveNavigationLink('nav_about');
    </script>
</body>
</html>
