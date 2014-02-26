<!DOCTYPE html>

<html>
<head>
    <title>Formulargenerator</title>
</head>
<body>
    <?php require('Header.inc.php'); ?>
    <form name="" method="post" action="post">
        <table>
            <tbody>
                <tr>
                    <td>
                        <h3>Allgemein</h3>
                    </td>
                </tr>
                <tr>
                    <td>Name:</td>
                </tr>
                <tr>
                    <td>
                        <br />
                        <h3>Datenquelle</h3>
                    </td>
                </tr>
                <tr>
                    <td>Server:</td>
                </tr>
                <tr>
                    <td>Datenbank:</td>
                </tr>
                <tr>
                    <td>Tabelle:</td>
                </tr>
                <tr>
                    <td>Benutzername:</td>
                </tr>
                <tr>
                    <td>Passwort:</td>
                </tr>
                <tr>
                    <td>
                        <br />
                        <input type="submit" value="Generieren" /></td>
                </tr>
            </tbody>
        </table>
    </form>
</body>
</html>
