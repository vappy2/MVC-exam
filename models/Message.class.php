<?php
require_once('./classes/Connection.class.php');

Class Message
{
    public $id;
    public $id_message;
    public $user_id;
    public $content;

    public $errors = [];

    public function __construct($id = null)
    {
        if (!is_null($id)) {
            $this->get($id);
        }
    }

    public function get($id = null)
    {
        if (!is_null($id)) {
            $dbh = Connection::get();
            //print_r($dbh);

            $stmt = $dbh->prepare("select * from messages where user_id = :id limit 1");
            $stmt->execute(array(
                ':id' => $id
            ));
            // recupere les users et fout le resultat dans une variable sous forme de tableau de tableaux
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Message');
            $message = $stmt->fetch();

            $this->id_message = $message->id;
            $this->user_id = $message->user_id;
            $this->content = $message->content;
        }
    }

    public function findAll($data)
    {
        $dbh = Connection::get();
        $sql = "select * from messages where user_id = :user_id";
        $sth = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth->execute(array(
            ':user_id' => $data['user_id']
        ));
        $messages = $sth->fetchAll(PDO::FETCH_CLASS);
        return $messages;
    }

    public function validate($data)
    {
        $this->errors = [];

        /* required fields */
        if (!isset($data['content'])) {
            $this->errors[] = 'Commence par entrée un message avant d\'envoyer';
        }

        if (count($this->errors) > 0) {
            return false;
        }
        return true;
    }

    public function add($data) {

        if ($this->validate($data)) {
            $dbh = Connection::get();
            $sql = "insert into messages ( user_id, content) values (:user_id, :content)";
            $sth = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            if ($sth->execute(array(
                ':user_id' => $data['user_id'],
                ':content' => $data['content']
            ))) {
                return true;
            } else {
                // ERROR
                // put errors in $session
                $this->errors['Le message ne peut pas être ajouté, recommence!'];
            }
        }
    }

    public function deleted($data) {

        $dbh = Connection::get();
        $sql = "delete from messages where id = :id";
        $sth = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        if ($sth->execute(array(
            ':id' => $data['id']
        ))) {
            return true;
        } else {
            // ERROR
            // put errors in $session
            $this->errors['Le message ne peut pas être ajouté, recommence!'];
            echo "Message pas supprimé";
        }

    }
}