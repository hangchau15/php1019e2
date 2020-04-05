<?php
require_once 'models/Model.php';

class Category extends Model
{
    //khai báo các thuộc tính của category
    public $id;
    public $name;
    public $avatar;
    public $description;
    public $status;
    public $created_at;
    public $updated_at;

    public function insert()
    {
        //chuẩn bị câu truy vấn
        $obj_insert = $this->connection->prepare("INSERT INTO categories(`name`, `avatar`, `description`, `status`) VALUES (:name, :avatar, :description, :status)");
        //gán giá trị cho các param trong câu truy vấn
        $arr_insert = [
            ':name' => $this->name,
            ':avatar' => $this->avatar,
            ':description' => $this->description,
            ':status' => $this->status,
        ];

        return $obj_insert->execute($arr_insert);
    }

    public function getAll()
    {
        $obj_select = $this->connection->prepare('SELECT * FROM categories');
        $obj_select->execute();

        $categories = $obj_select->fetchAll(PDO::FETCH_ASSOC);

        return $categories;
    }

    public function getCategoryById($id)
    {
        $obj_select = $this->connection->prepare('SELECT * FROM categories WHERE id = :id');
        $arr_select = [
            ':id' => $id
        ];

        $obj_select->execute($arr_select);

        $categories = $obj_select->fetchAll(PDO::FETCH_ASSOC);
        if (isset($categories[0])) {
            return $categories[0];
        }

        return [];
    }

    public function update($id)
    {
        $obj_update = $this->connection->prepare("UPDATE categories SET `name` = :name, `avatar` = :avatar, `description` = :description, `status` = :status, `updated_at` = :updated_at 
         WHERE id = $id");
        $arr_update = [
            ':name' => $this->name,
            ':avatar' => $this->avatar,
            ':description' => $this->description,
            ':status' => $this->status,
            ':updated_at' => $this->updated_at,
        ];

        return $obj_update->execute($arr_update);
    }
}