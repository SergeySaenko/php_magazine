<?php

class Collection extends Model {
    protected static $table = 'collections';

    protected static function setProperties()
    {
        self::$properties['collection_name'] = [
            'type' => 'text',
        ];

        self::$properties['collection_description'] = [
            'type' => 'text',
        ];

        self::$properties['season'] = [
            'type' => 'varchar',
            'size' => 15
        ];
    }

    public static function getAllCollections()
    {
        return SQL::Instance()->Select(
            'SELECT * FROM collections WHERE collection_status=:status
            ORDER BY id_collection',
            ['status' => Status::Active]);
    }
}