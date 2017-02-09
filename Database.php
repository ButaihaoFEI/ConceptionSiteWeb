<?php

class Database
{
    private $config;
    private $mysqli;

    /**
     * Database constructor.
     */
    public function __construct($config)
    {
        $this->config = $config;
    }

    public function connect()
    {
        session_start();
        if (!isset($this->mysqli)) {
            $this->mysqli = new mysqli($this->config['host'], $this->config['login'], $this->config['password'], $this->config['dbname']);
        }
        return $this;
    }

    public function insert($table, $fields)
    {
        $this->connect();
        $string = "INSERT INTO bddgr1004." . $table . " (";
        foreach ($fields as $k => $v) {
            $string .= $k . ', ';
        }
        $string = rtrim($string, ', ') . ') VALUES (';
        foreach ($fields as $k) {
            $string .= '?, ';
        }
        $string = rtrim($string, ', ') . ')';

        if (!($stmt = $this->mysqli->prepare($string))) {
            echo "Echec de la préparation : (" . $this->mysqli->errno . ") " . $this->mysqli->error;
        }

        $fieldsTypes = "";
        foreach ($fields as $field => $value) {
            if ($field != 'motdepasse' && is_numeric($value))
                $fieldsTypes .= 'i';
            else
                $fieldsTypes .= 's';
        }

        $bind = array_values($fields);
        array_unshift($bind, $fieldsTypes);

        call_user_func_array([$stmt, 'bind_param'], $this->refValues($bind));

        if ($stmt->execute()) {
            $_SESSION['msg'] = 'Elément ajouté';
        } else {
            $_SESSION['msg'] = "Echec lors de l'exécution de la requête : (" . $stmt->errno . ") " . $stmt->error;
        }

        header('Location: index.php');

    }

    public function get($table, $fields = [])
    {
        $this->connect();

        if (empty($fields)) {
//            var_dump("NOPE");
        } else {
//            var_dump("LOL");
            $string = "SELECT * FROM bddgr1004." . $table . " WHERE ";
            foreach ($fields as $k => $v) {
                $string .= $k . ' = ? AND ';
            }
            $string = rtrim($string, ' AND ');

            if (!($stmt = $this->mysqli->prepare($string))) {
                echo "Echec de la préparation : (" . $this->mysqli->errno . ") " . $this->mysqli->error;
            }

            $fieldsTypes = "";
            foreach ($fields as $field => $value) {
                if ($field != 'motdepasse' && is_numeric($value))
                    $fieldsTypes .= 'i';
                else
                    $fieldsTypes .= 's';
            }

            $bind = array_values($fields);
            array_unshift($bind, $fieldsTypes);

            call_user_func_array([$stmt, 'bind_param'], $this->refValues($bind));

            if ($stmt->execute()) {
                $res = $stmt->get_result();
                $a_data = [];
                while ($row = $res->fetch_array(MYSQLI_ASSOC)) {
                    array_push($a_data, $row);
                }

                return $a_data[0];
            } else {
                $_SESSION['msg'] = "Echec lors de l'exécution de la requête : (" . $stmt->errno . ") " . $stmt->error;
                return false;
            }
        }
        return false;
    }

    public function getAll($table, $fields = [])
    {
        $this->connect();

        if (empty($fields)) {
//            var_dump("NOPE");
            $string = "SELECT * FROM bddgr1004." . $table;

            if (!($stmt = $this->mysqli->prepare($string))) {
                echo "Echec de la préparation : (" . $this->mysqli->errno . ") " . $this->mysqli->error;
            }

            /*$fieldsTypes = "";
            foreach ($fields as $field => $value) {
                if ($field != 'motdepasse' && is_numeric($value))
                    $fieldsTypes .= 'i';
                else
                    $fieldsTypes .= 's';
            }

            $bind = array_values($fields);
            array_unshift($bind, $fieldsTypes);

            call_user_func_array([$stmt, 'bind_param'], $this->refValues($bind));*/

            if ($stmt->execute()) {
                $res = $stmt->get_result();
                $a_data = [];
                while($row = $res->fetch_array(MYSQLI_ASSOC)) {
                    array_push($a_data, $row);
                }

                return $a_data;
            } else {
                $_SESSION['msg'] = "Echec lors de l'exécution de la requête : (" . $stmt->errno . ") " . $stmt->error;
                return false;
            }
        } else {
//            var_dump("LOL");
            $string = "SELECT * FROM bddgr1004." . $table . " WHERE ";
            foreach ($fields as $k => $v) {
                $string .= $k . ' = ? AND ';
            }
            $string = rtrim($string, ' AND ');

            if (!($stmt = $this->mysqli->prepare($string))) {
                echo "Echec de la préparation : (" . $this->mysqli->errno . ") " . $this->mysqli->error;
            }

            $fieldsTypes = "";
            foreach ($fields as $field => $value) {
                if ($field != 'motdepasse' && is_numeric($value))
                    $fieldsTypes .= 'i';
                else
                    $fieldsTypes .= 's';
            }

            $bind = array_values($fields);
            array_unshift($bind, $fieldsTypes);

            call_user_func_array([$stmt, 'bind_param'], $this->refValues($bind));

            if ($stmt->execute()) {
                $res = $stmt->get_result();
                $a_data = [];
                while($row = $res->fetch_array(MYSQLI_ASSOC)) {
                    array_push($a_data, $row);
                }

                return $a_data;
            } else {
                $_SESSION['msg'] = "Echec lors de l'exécution de la requête : (" . $stmt->errno . ") " . $stmt->error;
                return false;
            }
        }
    }

    private function refValues($arr){
        if (strnatcmp(phpversion(),'5.3') >= 0) {
            $refs = array();
            foreach($arr as $key => $value)
                $refs[$key] = &$arr[$key];
            return $refs;
        }
        return $arr;
    }

    public function update($table, $where, $fields)
    {
        echo "test";
        $this->connect();
        $string = "UPDATE bddgr1004." . $table . " SET ";
        foreach ($fields as $k => $v) {
            $string .= $k . ' = ?, ';
        }
        $string = rtrim($string, ', ') . ' WHERE ';
        foreach ($where as $k => $v) {
            $string .= $k . ' = ? AND ';
        }
        $string = rtrim($string, ' AND ');

        var_dump($string);


        if (!($stmt = $this->mysqli->prepare($string))) {
            echo "Echec de la préparation : (" . $this->mysqli->errno . ") " . $this->mysqli->error;
        }

        $fields = array_merge($fields, $where);
        var_dump($fields);

        $fieldsTypes = "";
        foreach ($fields as $field => $value) {
            if ($field != 'motdepasse' && is_numeric($value))
                $fieldsTypes .= 'i';
            else
                $fieldsTypes .= 's';
        }

        var_dump($fieldsTypes);

        $bind = array_values($fields);
        array_unshift($bind, $fieldsTypes);

        call_user_func_array([$stmt, 'bind_param'], $this->refValues($bind));

        if ($stmt->execute()) {
            $_SESSION['msg'] = 'Mise à jour effectuée';
        } else {
            $_SESSION['msg'] = "Echec lors de l'exécution de la requête : (" . $stmt->errno . ") " . $stmt->error;
        }
    }
}