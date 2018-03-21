<?php

class OrderStatus extends Model {
  protected static $table = 'order_status';

  protected static function setProperties()
  {
    self::$properties['order_status_name'] = [
      'type' => 'varchar',
      'size' => 50
    ];
  }

  public static function getAllOrderStatuses()
  {
    return SQL::Instance()->Select(
      'SELECT * FROM order_status',
      []);
  }

}