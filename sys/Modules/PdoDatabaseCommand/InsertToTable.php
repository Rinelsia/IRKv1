<?php 
/**
* $form_array - данные в массиве для занесения в таблицу, где ключ это имя таблицы, а значение массив из значений полученных от формы клиента
*/
class InsertToTable
{
	private $name_col_array;
	public $sql_insert;

	function __construct($connect, $form_array)
	{
		foreach ($form_array as $key => $value) {
			$this->selectTable($connect, $key);
			$this->insertTable($key, $value);
		}
	}
	// занесение в таблицу
	private function insertTable($table_name, $table_value){
		// здесь нужно подумать над вставкой значения на разных языках
		$arr_columns = $this->name_col_array[$table_name];
		var_dump($arr_columns);
		foreach ($table_value as $key => $value) {
			$var_columns = $this->createNameColumns($arr_columns);
			$this->sql_insert[$table_name][$key] = "INSERT INTO ".$table_name." (".$var_columns.") VALUES (".$key.", '".$value."', '');";
		}
		
	}
	// запрос к базе данных
	// данную функцию переделать, убрать цикл, найти способ вытаскивания названия столбцов таблицы
	private function selectTable($connect, $table_name){
		$sql = 'describe '.$table_name.';';
		$pdo_result = $connect->query($sql);
		// вытаскиваем строку из набора ответа от сервера
		$col_array = $pdo_result->fetchAll();
		for ($i=0; $i < count($col_array); $i++) { 
			$this->name_col_array[$table_name][$i] = $col_array[$i]["Field"];
		}
	}
	// отдельная функция логического ветвления для создания списка столбцов для вставки в строку запроса к базе данных
	private function createNameColumns($arr_columns){
		for ($i=0; $i < $cou=count($arr_columns); $i++) { 
			if ($i!==($cou-1)) {
				$var_columns = $var_columns.$arr_columns[$i].',';
			}else{
				$var_columns = $var_columns.$arr_columns[$i].'';
			}
		}
		return $var_columns;
	}
}