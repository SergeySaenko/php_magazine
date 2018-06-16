<?php
include_once '../configuration/config.default.php';
include_once '../lib/SQL.class.php';

if($_POST['jqAction'] == 'changeStatus') {
	if ($_POST['idOrder'] == '' || $_POST['idStatus'] == '') {
		echo "Что-то пошло не так";
	} else {
		//console_log($_POST);
		$table = 'orders';
		$object = array( 'id_order_status' => $_POST['idStatus'] );
		$orderId = $_POST['idOrder'];
		$update = SQL::Instance()->Update( $table, $object, "id_order='$orderId'" );
		if ($update) {
			echo "Статус заказа успешно изменен";
		}else{
			echo "Что-то пошло не так при обновлении";
		}
	}
}

if($_POST['jqAction'] == 'deleteGood') {
	if ($_POST['idGood'] == '') {
		echo "Что-то пошло не так";
	} else {
		$table = 'goods';
		$goodId = $_POST['idGood'];
		$delete = SQL::Instance()->Delete( $table, "id_good='$goodId'" );
		if ($delete) {
			echo "Товар удален)";
		}else{
			echo "Что-то пошло не так при удалении(";
		}
	}
}

/*if($_POST['jqAction'] == 'showDetails') {
	if ($_POST['idOrder'] == '') {
		echo "Что-то пошло не так";
	} else {
		//console_log($_POST);
		$orderId = $_POST['idOrder'];
		$select = SQL::Instance()->Select(      
			'SELECT * FROM ordered_goods 
      LEFT JOIN goods ON ordered_goods.id_good = goods.id_good
      WHERE id_order=:order_id 
      ORDER BY orders.id_order',
      ['order_id' => $orderId]);
		if ($select) {
			echo "Статус заказа успешно изменен";
		}else{
			echo "Что-то пошло не так при обновлении";
		}
	}
}*/