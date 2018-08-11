<?php

class Good extends Model {
    protected static $table = 'goods';

    protected static function setProperties()
    {
        self::$properties['id_good'] = [
            'type' => 'int'
        ];

        self::$properties['name'] = [
            'type' => 'varchar',
            'size' => 512
        ];

        self::$properties['price'] = [
            'type' => 'float'
        ];

        self::$properties['description'] = [
            'type' => 'text'
        ];

        self::$properties['category'] = [
            'type' => 'int'
        ];
    }

    public static function getGoods($categoryId)
    {
        return SQL::Instance()->Select(
            'SELECT id_good, id_category, good_name, price FROM goods WHERE id_category = :category AND status=:status',
            ['status' => Status::Active, 'category' => $categoryId]);
    }

    public function getGoodInfo(){
        return SQL::Instance()->Select(
            'SELECT * FROM goods WHERE id_good = :id_good',
            ['id_good' => (int)$this->id_good]);
    }

    public static function getGoodPrice($id_good){
        $result = SQL::Instance()->Select(
            'SELECT price FROM goods WHERE id_good = :id_good',
            ['id_good' => $id_good]);

        return (isset($result[0]) ? $result[0]['price'] : null);
    }

    public static function getAllGoods()
    {
        return SQL::Instance()->Select(
            'SELECT * FROM goods 
            LEFT JOIN categories ON goods.id_category = categories.id_category
            LEFT JOIN collections ON goods.id_collection = collections.id_collection
            ORDER BY goods.id_good',
            []);
    }

    public static function getGoodId($id_good)
    {
        return SQL::Instance()->Select(
            'SELECT * FROM goods 
            LEFT JOIN categories ON goods.id_category = categories.id_category
            LEFT JOIN collections ON goods.id_collection = collections.id_collection
            LEFT JOIN applied_materials ON goods.id_good = applied_materials.id_good
            LEFT JOIN images ON goods.id_good = images.id_good
            WHERE id_good = :id_good
            LIMIT 1',
            ['id_good' => $id_good]);
    }
}