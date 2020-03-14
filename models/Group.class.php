<?php
require_once('./classes/Connection.class.php');

class Group
{
    public $id;
    public $title;

    public function get($id = null)
    {
        if (!is_null($id)){
            $dbh = Connexion::get();
            //print_r($dbh);

            $stmt = $dbh->prepare("select * from groups where id = :id limit 1");
            $stmt->execute(array(
                ':id' => $id
            ));
            // Recupere les users et met le resultat dans une variable sous forme de tableau de tableaux
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Group.class');
            $groups = $stmt->fetch();

            $this->id = $groups->id;
            $this->title = $groups->title;
        }
    }

/*    public function findAll($data)
    {
        $dbh = Connexion::get();
        $sql = "select * from group where id = :id";
        $sth = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth->execute(array(
            ':id' => $data['id']
        ));
        $groups = $sth->fetchAll(PDO::FETCH_CLASS);
        return $groups;
    }*/

    public function findAll()
    {
        $dbh = Connection::get();
        $stmt = $dbh->query("select * from groups");
        // recupere les users et fout le resultat dans une variable sous forme de tableau de tableaux
        $groups = $stmt->fetchAll(PDO::FETCH_CLASS);
        return $groups;
    }

    public function findGroup($data){
        $dbh = Connexion::get();
        $sql = "select g.title from groups g left join groups_users gu on g.id = gu.id_groups right join users u on gu.id_user = u.id where id_user = :id_user";
        $sth = $dbh->prepare($sql, array(PDO::ATTR_CURSOR =>PDO::CURSOR_FWDONLY));
        $sth->execute(array(
            ':id_user' => $_SESSION['user_id']
        ));
        $groups = $sth->fetchAll(PDO::FETCH_CLASS);
        return $groups;
    }

    public function validate($data)
    {
        $this->errors = [];

        /* required fields */
        if (!isset($data['content'])) {
            $this->errors[] = 'Tu n\'a pas donné de nom à ton groupe';
        }

        if (count($this->errors) > 0) {
            return false;
        }
        return true;
    }

    public function add($data) {

        if ($this->validate($data)){
            $dbh = Connexion::get();
            $sql = "insert into groups (title) values (:title)";
            $sth = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            if ($sth->execute(array(
                ':title' => $data['title']
            ))) {
                return true;
            } else {
                // ERROR
                // put errors in $session
                $this->errors['Il y a eu un problème lors de la création du groupe'];
            }
        }
    }

    public function update($data){

        if ($this->validate($data)){
            $dbh = Connexion::get();
            $sql = "update groups set (title) values (:title)";
            $sth = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            if ($sth->execute(array(
                ':title' => $data['title']
            ))) {
                return true;
            } else {
                // ERROR
                // put errors in $session
                $this->errors['Il y a eu une erreur lors de la modification du nom du groupe.'];
            }
        }
    }
}
