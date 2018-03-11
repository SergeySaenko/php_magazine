<?php

class Page extends Model {
    protected static $table = 'pages';
    
    protected static function setProperties()
    {
        self::$properties['name'] = [
            'type' => 'varchar',
            'size' => 512
        ];

        self::$properties['url'] = [
            'type' => 'varchar',
            'size' => 512
        ];
    }

    public static function getHeader($admin = 2)
    {
        return SQL::Instance()->Select(
            'SELECT * FROM pages WHERE status = :status AND admin = :admin AND footer = 0',
            ['status' => Status::Active, 'admin' => $admin]);
    }

    public static function getFooter($admin = 2, $footer = 1)
    {
        return SQL::Instance()->Select(
            'SELECT * FROM pages WHERE status = :status AND admin = :admin AND footer = 1',
            ['status' => Status::Active, 'admin' => $admin]);
    }
}