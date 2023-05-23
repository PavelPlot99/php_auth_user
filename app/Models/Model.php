<?php

namespace PavelPlot\App\Models;

use PavelPlot\App\Config;

class Model
{
    protected string $table;
    protected \mysqli $connection;

    public function __construct()
    {
        $this->connection = new \mysqli(Config::get('db_host'), Config::get('db_user'), Config::get('db_password'), Config::get('db_name'));
        $this->connection->set_charset("utf8");
    }

    public function create($data)
    {
        $keys = [];
        $values = [];

        foreach ($data as $key => $value) {
            $keys[] = $key;
            if (is_null($value)) {
                $values[] = null;
            } else {
                $values[] = str_replace(',', '.', $this->connection->real_escape_string($value));
            }
        }
        $types = str_repeat('s', count($values));
//        var_dump("INSERT INTO $this->table (" . implode(',', $keys) . ") VALUES (" . implode(',', array_fill(0, count($values), '?')) . ")");
        $stmt = $this->connection->prepare("INSERT INTO $this->table (" . implode(',', $keys) . ") VALUES (" . implode(',', array_fill(0, count($values), '?')) . ")");

        $stmt->bind_param($types, ...$values);

        $stmt->execute();
    }

    public function find($row, $value)
    {
//        var_dump("SELECT * FROM $this->table WHERE `$row` = `$value`");
        $stmt = $this->connection->prepare("SELECT * FROM $this->table WHERE `$row` = ?");
        $stmt->bind_param('s', $value);
        $stmt->execute();
        $result_row = [];
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $result_row[] = $row;
        }

        return $result_row;
    }

    public function get($limit, $page): array
    {
        $count = $this->count();
        $result = [];
        if ($count === 0) {
            return [];
        }
        if ($count < $limit) {
            $result = $this->connection->query("SELECT * FROM $this->table");
        } else {
            $offset = ($page - 1) * $limit;
            $result = $this->connection->query("SELECT * FROM $this->table LIMIT $offset , $limit");
        }
        $result_array = [];
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $result_array[] = $row;
        }

        return $result_array;
    }

    public function count()
    {
        $count = $this->connection->query("SELECT COUNT(*) FROM $this->table")->fetch_array();
        return (int)$count[0];

    }

    public function __destruct()
    {
        $this->connection->close();
    }


}