<?php

class Material extends Model {
    protected static $table = 'materials';

    protected static function setProperties()
    {
        self::$properties['material_name'] = [
            'type' => 'text',
        ];
    }

    public static function getAllMaterials()
    {
        return SQL::Instance()->Select(
            'SELECT * FROM materials 
            ORDER BY material_name',
            []);
    }
}