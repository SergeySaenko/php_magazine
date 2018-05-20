<?php
//************************************************
//**** Добавляем товар
//***********************************************
if (isset($_POST['add_submit'])) {
	$LastId = SQL::Instance()->Select("SELECT id_good FROM goods ORDER BY id DESC LIMIT 1");
	$category = $_POST['category'];
	$collection = $_POST['collection'];
	$code = $category + "-" + $collection + "-" + ($LastId + 1);
	$name = $_POST['good_name']; 
	$price = $_POST['price']; 
	$size = $_POST['size']; 
	$description = $_POST['description']; 
	$status = $_POST['status']; 

	$addNewProduct = SQL::Instance()->Insert("goods", array('id_good'=>null,
                                                          'good_code'=>$code,
                                                          'good_name'=>$$name,
                                                          'price'=>$price,
                                                          'size'=>$size,
                                                          'description'=>$description,
                                                          'id_category'=>$category,
                                                          'id_collection'=>$collection,
                                                          'status'=>$status));

	
/*

	$interpretTo = new Translate();
	$toLatName = $interpretTo->translate($_FILES['add_photo']['name']);
	$photoSize = $_FILES['add_photo']['size'];

	

	/*Если записей в базе нет, то имя папки с изображениями будет 1
	if (!$showIdLastProduct) {
		$folderNameCreate = '1';
	}else{
		$folderNameCreate = $showIdLastProduct[0]['id'] + 1;
	}

	$savePath = "img/product/" .$folderNameCreate ."/" . $toLatName; // Путь куда сохраняем большое изображение
	$saveThumb = "img/product/" .$folderNameCreate ."/mini." . $toLatName;

	if (mkdir("v/assets/img/product/" .$folderNameCreate ."/", 0755)) {
		if ($photoSize < 3000000 && $_FILES['add_photo']['type'] == 'image/jpeg' || $_FILES['add_photo']['type'] == 'image/gif' || $_FILES['add_photo']['type'] == 'image/png') {

			if (copy($_FILES['add_photo']['tmp_name'], 'v/assets/'.$savePath)) {

				$createThumb = new createThumbnail("v/assets/".$savePath, "v/assets/".$saveThumb, '300', '300');

			if ($createThumb) {

				$addNewProduct = SQL::Instance()->Insert("products_table", array('id'=>null,
                                                                                  'name_mini'=>$prodNameMini,
                                                                                  'name_full'=>$prodNameFull,
                                                                                  'path_mini'=>$saveThumb,
                                                                                  'path_full'=>$savePath,
                                                                                  'description'=>$prodDescr,
                                                                                  'price'=>$prodPrice,
                                                                                  'see_counter'=>'0'));


				if ($addNewProduct) {
					echo $addNewProduct;

					/* Если имя папки не совпадает с только что добавленным товаром(таблица очищена и id начинаются не с 1), то
					переименовываем папку, чтобы имя совпадало с id, а так же делаем апдейт
					базы изменив пути к изображениям 
					if ($addNewProduct != $folderNameCreate) {

						if (rename("v/assets/img/product/" .$folderNameCreate, "v/assets/img/product/" .$addNewProduct)) {

							$folderNameCreate = $addNewProduct;
							$savePath = "img/product/" .$folderNameCreate ."/" . $toLatName;
							$saveThumb = "img/product/" .$folderNameCreate ."/mini." . $toLatName;
                     $renameId = $addNewProduct;

                            /*=== Делаем update записи ===
                            $updateNewProductF = SQL::Instance()->Update("products_table", array('id'=>$renameId,
                                                                                                 'name_mini'=>$prodNameMini,
                                                                                                 'name_full'=>$prodNameFull,
                                                                                                 'path_mini'=>$saveThumb,
                                                                                                 'path_full'=>$savePath,
                                                                                                 'description'=>$prodDescr,
                                                                                                 'price'=>$prodPrice), "id='$renameId'");
							if ($updateNewProductF) {
								header("Location: " .ROOT ."manager/");
							}
						}
					}else{
						header("Location: " .ROOT ."manager/");
					}
				}
			}
		}
	}
}*/
}
			