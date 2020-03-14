<?php
$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : [];
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

        <form method="post" action="./index.php?controller=users&action=signon" id="userRegisterForm" enctype="multipart/form-data">
            <fieldset>
                <legend>user register</legend>
                <label for="userFirstname">firstname</label>
                <input type="text" id="userFirstname" name="firstname" value="<?php echo !empty($_POST['firstname']) ? ($_POST['firstname']) : '' ?>">
                <label for="userLastname">lastname</label>
                <input type="text" id="userLastname" name="lastname" value="<?php echo !empty($_POST['lastname']) ? ($_POST['lastname']) : '' ?>">
                <label for="userLogin">login</label>
                <input type="text" id="userLogin" name="login" value="<?php echo !empty($_POST['login']) ? ($_POST['login']) : '' ?>">
                <label for="userPassword">password</label>
                <input type="password" id="userLogin" name="password" value="">
            </fieldset>



            <fieldset>
                <label for="photo">Photo</label>
                <input type="file" name="photo" value="" id="photo" accept="image/png, image/jpeg, image/gif" required="required">

            </fieldset>

            <input type="submit" value="Envoyer" class="button-primary">
        </form>
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
        <div class="one-half column">
            $_FILES :
            <pre><?php print_r($_FILES) ?></pre>
        </div>
    </div>

</div>
</body>
</html>