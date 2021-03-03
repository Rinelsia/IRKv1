<?php 
/**
* 
* BaseController - метод класа начального запуска классов составляющих скелет программы. Они как бы ядро всей системы, важная отработка
*/
class Controller extends array_controll
{
	// $arr_view_html - переменная, в нее записывается массив с путями файлов разметки и стилей, ДЛЯ ОТПРАВКИ ВЕРСТКИ КЛИЕНТУ
	public $arr_view_html;

	public function BaseController(){
		echo "Базовый контроллер<br>";
		echo "Запуск URL";
		Request::url();
		// Запуск подключения файлов, описаных в массиве
		// 
		$this->StartController();
		
		if (!is_null($action = Request::$basename)) {
			$action = $action.'Action';
			$this->$action();
		}
		
	}
	private function StartController(){
		$dat = $this->metod[Request::$path];
		$this->arr_view_html = $this->view[Request::$path];
		echo "Запуск метода из контроллера $dat";
		var_dump($dat);
	}
	// 
	private function homeAction(){
		echo "Home";
	}
	// Начальная страница работы с движком
	private function indexAction(){
		
		$view_path = DIR.'/'.$this->arr_view_html;
		
		echo "<p style='color:red'>$view_path<p>";

		// ДАННЫЕ ДЛЯ ВСТАВКИ В ХТМЛ полученные из форм
		$tag_arr = Request::post();
		extract($tag_arr);
		echo "<p style='color:#f19'>Массив пост</p>";
		var_dump($tag_arr);
		echo "<p style='color:#f19'>/</p>";


		// запись данных в файл, заместо бд
		(new SaveJsonData)->readData($tag_arr);

		// 
		$data = (new SaveJsonData)->writeData();

		// прописка переменных, они будут в конфигурационном файле, 
		$host = 'localhost';
		$dbname = 'eleonora';
		$user = 'root';

		// данная выборка для компа дома
		$port = '1433';
		$pass = '1234';

		// для компа на заводе
		
		// $port = '3306';
		// $pass = '';

		// dsn
		$dsn = 'mysql:host='.$host.';port='.$port.';dbname='.$dbname;

		$connect = Request::sqlPDO($dsn, $user, $pass);
		
		
		// отправк4а запроса
		// Request::$query = 'INSERT INTO h1 (ru) VALUES ('.$h1.')';

		// создание таблицы если ее нет, проверка и получение sql строки
		$pdo_comand = (new PdoDatabaseCommand($connect))->createTable;
		var_dump($pdo_comand);

		// запись данных в базу данных
		$insert_table = (new InsertToTable($connect, $tag_arr))->sql_insert;
		echo "<p style='color:#f19'>Массив колонок базы данных</p>";
		var_dump($insert_table);
		echo "<p style='color:#f19'>/</p>";



		// if (!is_object($form_data)) {

		// 	// подготовленный запрос
		// 	// $sql_query = "INSERT INTO `h1` (`id`, `ru`, `en`) VALUES (NULL, '".$h1."', '');";
		// 	// $sql_query = 'SHOW TABLES;';
		// 	// $sql_query = 'select ru from h1;';
		// 	echo "<p style='color:red'>Запрос $sql_query</p>";
		// 	var_dump($sql_query);
		// 	echo "<p style='color:red'>Заголовок $$h1</p>";

		// 	//запрос к базе данных
		// 	$query_result = $connect->query($sql_query);
		// 	var_dump($query_result);
		// 	// 
		// 	$pre = $connect->prepare($sql_query);
		// 	var_dump($pre);
		// 	// выполнение подготовленного запроса
		// 	$res=$pre->execute(); 
		// 	var_dump($res);
		// 	// получение данных
		// 	$result = $pre->fetchAll();
		// 	print_r($result);

		// }
		

		// цикл распеределения ключей как переменных и их значени
		// преред заданием данной функции стоит проверить входящие значения
		// extract($data);
		// foreach ($form_data as $key => $value) {
		// 	# code...
		// 	$$key = $value;
		// 	echo "<p style='color:#f19'>///</p>";
		// 	var_dump($h1);
		// }
		
		echo "<p style='color:#f19'> Параграф $p[0]</p>";
		
		// обнуляем данные
		$form_data = NULL;
		include $view_path;
	}

}
