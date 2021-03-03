<?php 
// 

/**
* $path - переменная пути страницы, будет записана как название таблицы в бд. откуда будут доставать и добавлять данные;
* $query - переменная значения которые будут вставляться в страницу, запись в бд как название файла текста или видео;
* формат записи пути пример: home/ru будет имя таблицы баз данных для хранения значаений для вставки;
* форма адреса URL: http://доменное_имя/имя_страницы/язык?значение#метка_на_странице;
*$basename - имя страницы, будет использоваться для запуска контроллера
*/
class Request 
{
	public static $path;
	public static $query;
	public static $lang;
	public static $basename;
	
	function __construct(){
		self::url();
	}
	function request(){
		// 
	}
	public static function url(){
		
		// определение языка наиболее используемого пользователем
		if ($_SERVER["HTTP_ACCEPT_LANGUAGE"]) {
			$lang = explode(",", $_SERVER["HTTP_ACCEPT_LANGUAGE"])[0];
		}

		
		
		// получение значения из адресной строки и разбитие url на элементы (адрес и значение)
		$url = ($_SERVER["REQUEST_URI"] === "/")?( "index/".$lang): (parse_url($_SERVER["REQUEST_URI"]));
		
		if (is_array($url)) {
			// цикл распределения элементов url
			foreach ($url as $key => $value) {
				self::$$key = trim($value, "/");
			}

		}else{
			self::$path = $url;
			self::$basename = $url;
		}
		// разделение пути на имя страницы и язык
		if (count($arr = explode('/', self::$path))>1) {
			self::$basename = $arr[0];
			self::$lang = $arr[1];
		}
		

		// echo " url = ";
		// var_dump($url);
		
		// echo "путь = ";
		// var_dump(self::$path);

		// echo "Язык = ";
		// var_dump(self::$lang);

		// echo "значение = ";
		// var_dump(self::$query);

		
		// echo "имя страницы = ";
		// var_dump(self::$basename);

		// echo "<br>_SERVER = ";
		// var_dump($_SERVER["HTTP_ACCEPT_LANGUAGE"]);
		
	}
	// язык
	public function lang(){
		self::url();
		return self::$lang;
	}
	// имя страницы
	public function basename(){
		self::url();
		return self::$basename;
	}
	// значение
	public function query(){
		self::url();
		return self::$query;
	}
	// путь
	public function path(){
		self::url();
		return self::$path;
	}

	function get(){
		return $_GET;
	}
	function post(){
		// здесь будет прописана проверка полученных данных из глобального массива
		return $_POST;
	}

	// функция подключения к базам данных через pdo, в данном случае реализация пока MySql
	function sqlPDO($dsn, $user, $pass){
		//пропись dsn метода подключения класса PDO, где прописан хост порт и на первое время имя бд. В последствии имя бд можно будет менять в конфигурационном файле с возможностью создания, но пока управление бд будет проходить вручную
		
		
		$connect = new PDO($dsn, $user, $pass);
		// $res = $connect->query(self::$query);
		// var_dump($res);
		
		return $connect;
	}
	
}

 ?>