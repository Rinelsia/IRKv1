<?php
/**
 * Запуск объекта происходит с получением переменной в теле объекта PdoDatabaseCommand($connect), эта переменная пойдет на отработку в конструкт
 * Данный класс реализует создание строки подготовки к запросу к базе данных на создание таблиц для работы с тегами вставки
 */
class PdoDatabaseCommand 
{
	public $createTable;
	// свойство для использования внутри класса
	private $arr_pdo_result;
	
	function __construct($connect)
	{	
		if($connect){
			$this->pdoCon($connect);
		}
		// в переменную ниже будет передаваться массив из конфигурационного файла в таком виде, или из файла настроек. Массив будет содержать ключ названия таблицы, и значение sql код
		$create_table = array(
				'h1'=>'(id int(20) primary key auto_increment, ru text, en text)',
				'h2'=>'(id int(20) primary key auto_increment, ru text, en text)',
				'h3'=>'(id int(20) primary key auto_increment, ru text, en text)',
				'h4'=>'(id int(20) primary key auto_increment, ru text, en text)',
				'h5'=>'(id int(20) primary key auto_increment, ru text, en text)',
				'h6'=>'(id int(20) primary key auto_increment, ru text, en text)',
				'h7'=>'(id int(20) primary key auto_increment, ru text, en text)',
				'h8'=>'(id int(20) primary key auto_increment, ru text, en text)',
				'a'=>'(id int(20) primary key auto_increment, href varchar(100))',
				'p'=>'(id int(20) primary key auto_increment, ru text, en text)'
			);
		$this->createTable($connect, $create_table);
	}

	// функция редактирования создания таблицы для базы данных
	private function createTable($connect, $create_table=[]){
		$i=0;
		foreach ($create_table as $key => $value) {
			if ($this->arr_pdo_result[$i][0]!==$key) {
				// сохраняем текст запроса бд для создания таблиц в массив
				$this->createTable[$key] = 'CREATE TABLE '.$key.' '.$value.';';
				// создаем таблицу через запрос
				// $connect->query($this->createTable[$key]);
			}else{
				$i++;
			}
		}
	}

	// производит чтение базы данных для получения информации о таблицах
	private function pdoCon($connect){
		$sql_query = 'SHOW TABLES;';
		$pdo_result = $connect->query($sql_query);
		$this->arr_pdo_result = $pdo_result ->fetchAll();
	}

}