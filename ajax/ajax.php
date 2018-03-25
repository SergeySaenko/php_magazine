<?php
include_once '../configuration/config.default.php';
include_once '../lib/SQL.class.php';

if ($_POST['idOrder'] == '' && $_POST['idStatus'] == '') {
	echo "Что-то пошло не так";
} else {
	console_log($_POST);
	$table = 'orders';
	//$id_order = $_POST['idOrder'];
	//$id_order_status = $_POST['idStatus'];
	$object = array( 'id_order_status' => $_POST['idStatus'] );
	$orderId = $_POST['idOrder'];
	$update = SQL::Instance()->Update( $table, $object, "id_order='$orderId'" );
	if ($update) {
		echo "Статус заказа успешно изменен";
	}else{
		echo "Что-то пошло не так при обновлении";
	}
}