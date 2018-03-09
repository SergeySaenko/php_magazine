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

    public static function getHeader($admin = 0, $footer = 0)
    {
        return SQL::Instance()->Select(
            'SELECT * FROM pages WHERE status = :status AND admin = :admin AND footer = :footer',
            ['status' => Status::Active, 'admin' => $admin, 'footer' => $footer]);
    }

    public static function getFooter($admin = 0, $footer = 1)
    {
        return SQL::Instance()->Select(
            'SELECT * FROM pages WHERE status = :status AND admin = :admin AND footer = :footer',
            ['status' => Status::Active, 'admin' => $admin, 'footer' => $footer]);
    }
}