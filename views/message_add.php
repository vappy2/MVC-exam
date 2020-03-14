<?php
$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : [];
$messages = isset($_SESSION['messages']) ? $_SESSION['messages'] : [];
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

        <ul class="errors">
            <?php
            foreach ($errors as $error) {
                echo("<li>" . $error . "</li>");
            }
            ?>
        </ul>


        <form method="post" action="./index.php?controller=messages&action=add" id="addMessageForm">
            <fieldset>
                <legend>add message</legend>
                <label for="contentMessage">Content</label>
                <textarea id="contentMessage" name="content"></textarea>
            </fieldset>
            <input type="submit" value="Envoyer" class="button-primary">
            <input type="hidden" name="user_id" id="user_id" value="<?php echo $_SESSION['user_id']; ?>">
        </form>
    </div>

    <div class="row">
        <div class="column">
            $_SESSION
            <pre><?php print_r($_SESSION) ?></pre>
        </div>

    </div>

    <div class="row">
        <div class="column">
            $_SESSION USER
            <pre><?php print_r($_SESSION ['user_id']) ?></pre>
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