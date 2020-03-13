<nav>

    <div>
        <a href="./index.php?controller=users&action=signon">register</a>
        <a href="./index.php?controller=users&action=login">login</a>
        <a href="./index.php?controller=users&action=liste">list users</a>
        <a href="./index.php?controller=messages&action=add">add message</a>
        <a href="./index.php?controller=messages&action=list">list messages</a>
        <a href="./index.php?controller=users&action=jsonlist">json user</a>

        <?php

        if(!empty($_SESSION['user_id']))
        {
            echo'<a href="./index.php?controller=users&action=deco">deco</a>';
        }

        ?>


    </div>

</nav>