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

  public static function getAllOrders()
  {
    return SQL::Instance()->Select(
      'SELECT * FROM orders 
      LEFT JOIN order_status ON orders.id_order_status = order_status.id_order_status
      ORDER BY orders.id_order',
      []);
  }

  public static function getOrderedGoods($id_order)
  {
    return SQL::Instance()->Select(
      'SELECT * FROM ordered_goods 
      LEFT JOIN goods ON ordered_goods.id_good = goods.id_good
      WHERE id_order=:id_order 
      ORDER BY ordered_goods.id_order',
      ['id_order' => $id_order]);
  }
}