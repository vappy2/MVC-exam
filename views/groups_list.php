<?php
$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : [];
$groups = isset($_SESSION['groups']) ? $_SESSION['groups'] : [];
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
                <th>Nom du groupe</th>

            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($groups as $group) {
                ?>
                <tr>
                    <form method="post" action="./index.php?controller=groups&action=edit" id="<?= $group->id ?>">

                    <td><input type="text" name="id" value="<?= $group->id ?>"></td>
                    <td><input type="text" name="title" value="<?= $group->title ?>"></td>
                    <td><input type="submit" value="Renommer" ></td>

                    </form>

                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
        <a href="./index.php?controller=groups&action=add">add groupe</a>
    </div>


    <div class="row">
        <div class="column">
            $_SESSION
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
    </div>

</div>
</body>
</html>
