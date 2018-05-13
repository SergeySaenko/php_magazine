<?php

class Category extends Model {
    protected static $table = 'categories';

    protected static function setProperties()
    {
        self::$properties['name'] = [
            'type' => 'varchar',
            'size' => 512
        ];

        self::$properties['parent_id'] = [
            'type' => 'int',
        ];
    }

    public static function getCategories($parentId = 0)
    {
        return SQL::Instance()->Select(
            'SELECT id_category, category_name FROM categories WHERE category_status=:status AND parent_id = :parent_id',
            ['status' => Status::Active, 'parent_id' => $parentId]);
    }

    public static function getAllSubcategories($parentId = 0)
    {
        return SQL::Instance()->Select(
            'SELECT id_category, category_name FROM categories WHERE category_status=:status AND parent_id != :parent_id
            ORDER BY id_category',
            ['status' => Status::Active, 'parent_id' => $parentId]);
    }
}