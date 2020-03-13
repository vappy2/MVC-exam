<?php
$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : [];
$users = isset($_SESSION['users']) ? $_SESSION['users'] : [];
?>

<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://hedinoamane.fr/_css/normalize.css"/>
    <link rel="stylesheet" href="https://hedinoamane.fr/_css/skeleton.css"/>
    <style>
        fieldset {
            border: 0.25rem solid rgba(225, 225, 225, 0.5);
            border-radius: 4px;
            padding: 1rem 2rem;
        }

        .errors {
            color: #ff5555;
        }

        img{
            max-height: 40px;
        }
    </style>
</head>

<body>
<?php require_once('./components/nav.php') ?>
<div class="container">

    <div class="row">
        <h2>Users</h2>
        <table class="u-full-width">
            <thead>
            <tr>
                <th>id</th>
                <th>login</th>
                <th>password</th>
                <th>picture</th>

            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($users as $user) {
                ?>
                <tr>
                    <td><?= $user->id ?></td>
                    <td><?= $user->login ?></td>
                    <td><?= $user->password ?></td>
                    <td><img src="<?php echo ('./uploads/'.$user->picture) ?>"></td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>

    <div class="row">
        <div class="column">
            $_SESSION
            Tableau JSON
            <pre><?php echo json_encode($_SESSION,JSON_PRETTY_PRINT) ?></pre>
            Tableau Array
            <pre><?php print_r($_SESSION) ?></pre>

        </div>

    </div>

    <div class="row">
        <div class="one-half column">
            $_GET
            <pre><?php print_r($_GET) ?></pre>
        </div>
        <div class="one-half column">
            $_POST :
            <pre><?php print_r($_POST) ?></pre>
        </div>
        <div class="one-half column">
            $_FILES :
            <pre><?php print_r($_FILES) ?></pre>
        </div>
    </div>

</div>
</body>
</html>