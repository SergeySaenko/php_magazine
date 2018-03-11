<?php

class Order extends Model {
  protected static $table = 'orders';

  protected static function setProperties()
  {
    self::$properties['phone'] = [
      'type' => 'varchar',
      'size' => 512
    ];

    self::$properties['address'] = [
      'type' => 'varchar',
      'size' => 512
    ];

    self::$properties['email'] = [
      'type' => 'float'
    ];
  }

  public static function getOrders($user_id)
  {
    return SQL::Instance()->Select(
      'SELECT * FROM orders 
      LEFT JOIN order_status ON orders.id_order_status = order_status.id_order_status
      WHERE id_user=:user_id 
      ORDER BY orders.id_order',
      ['user_id' => $user_id]);
  }
}