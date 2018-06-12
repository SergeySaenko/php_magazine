<?php
//************************************************
//**** Добавляем товар
//***********************************************
if (isset($_POST['add_submit']))//добавляем товар 
{
	$lastId = SQL::Instance()->Select("SELECT id_good FROM goods ORDER BY id_good DESC LIMIT 1");
	if (!$lastId) {
		$nextId = 1;
	}else{
		$nextId = $lastId[0]['id_good'] + 1;
	}
	$category = $_POST['category'];
	$collection = $_POST['collection'];
	$code = $category . "-" . $collection . "-" . $nextId;
	$name = $_POST['good_name']; 
	$price = $_POST['price']; 
	$size = $_POST['size']; 
	$description = $_POST['description']; 
	$status = $_POST['status']; 

	$addNewProduct = SQL::Instance()->Insert("goods", array('id_good'=>null,
                                                          'good_code'=>$code,
                                                          'good_name'=>$name,
                                                          'price'=>$price,
                                                          'size'=>$size,
                                                          'description'=>$description,
                                                          'id_category'=>$category,
                                                          'id_collection'=>$collection,
                                                          'status'=>$status));
	//print_r($_POST['materials']);
	if (isset($_POST['materials']))//заполняем табицу примененных материалов 
	{
		$id_good = $addNewProduct;
		foreach($_POST['materials'] as $key=>$value)
		{
			$id_material = $value;
			$addAppliedMaterials = SQL::Instance()->Insert("applied_materials", array('id_applied_material'=>null,
																																								'id_good'=>$id_good,
																																								'id_material'=>$id_material));
		}
	}

	if (isset($_FILES["files"]))//если выбраны файлы 
	{
		$errors = array();
		$extension = array("jpeg","jpg","png","gif");
		$bytes = 1024;
		$allowedKB = 3000;
		$totalBytes = $allowedKB * $bytes;
		$queue = 0;
		print_r(file_exists("public/upload/"));
		
		if(!file_exists("public/upload/".$code."/"))
		{
			mkdir("public/upload/".$code ."/", 0755);
		} 

		foreach($_FILES["files"]["tmp_name"] as $key=>$tmp_name)
		{
			$translate = new Translate();
			$file_tmp=$_FILES["files"]["tmp_name"][$key];			
			$file_name = $translate->translate($file_tmp);

			$imgPath = "public/upload/".$code."/".$file_name;// Путь куда сохраняем большое изображение
			$thumbPath = "public/upload/".$code."/mini.".$file_name;// Путь куда сохраняем большое миниатюру

			$ext=pathinfo($file_name,PATHINFO_EXTENSION);//определяем и проверяем тип файла
			if(!in_array(strtolower($ext),$extension))
			{
				array_push($errors, "File type is invalid. Name:- ".$file_name);
				$uploadThisFile = false;
			}

			if($_FILES["files"]["size"][$key] > $totalBytes)//проверяем размер файла
			{
				array_push($errors, "File size must be less than 3MB. Name:- ".$file_name);
				$uploadThisFile = false;
			}

			if(file_exists($imgPath))//проверяем существует ли файл
			{
				array_push($errors, "File is already exist. Name:- ". $file_name);
				$uploadThisFile = false;
			}

			if($uploadThisFile)
			{
				if (copy($file_tmp, $imgPath)) 
				{
					$createThumb = new Thumbnail($imgPath, $thumbPath, '300', '300');

					if ($createThumb) //вносим запись в таблицу картинки
					{
						$addNewImg = SQL::Instance()->Insert("images", array(
							'id_image'=>null,
		          'id_good'=>$addNewProduct,
		          'image_name'=>$file_name,
		          'queue'=>$queue));
						$queue +=1;
					}
				}			
			}	
		}

		$count = count($errors);

		if($count != 0)
		{
			foreach($errors as $error)
			{
				echo $error."<br/>";
			}
		}
	}
}	
	
