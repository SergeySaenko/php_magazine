<?php

class Translate{
	private $translit = ['а' => 'a',
					  'б' => 'b',
					  'в' => 'v',
					  'г' => 'g',
					  'д' => 'd',
					  'е' => 'e',
					  'ё' => 'e',
					  'ж' => 'zh',
					  'з' => 'z',
					  'и' => 'i',
					  'й' => 'j',
					  'к' => 'k',
					  'л' => 'l',
					  'м' => 'm',
					  'н' => 'n',
					  'о' => 'o',
					  'п' => 'p',
					  'р' => 'r',
					  'с' => 's',
					  'т' => 't',
					  'у' => 'u',
					  'ф' => 'f',
					  'х' => 'kh',
					  'ц' => 'ts',
					  'ч' => 'ch',
					  'ш' => 'sh',
					  'щ' => 'ch\'',
					  'ъ' => '',
					  'ы' => 'y',
					  'ь' => '\'',
					  'э' => 'e',
					  'ю' => 'yu',
					  'я' => 'ya',
					  ' ' => ' '
];
	function __construct() {}

	public function translate($str){
		$result = str_replace(" ", "_", strtr(mb_strtolower($str), $this->translit));
		return strtolower($result);
	}
}
