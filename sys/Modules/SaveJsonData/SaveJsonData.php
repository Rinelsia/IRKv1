<?php 

/**
* функция записи данных со страници в формате json в документ
*/
class SaveJsonData 
{
	// 
	public function readData($arr_data){
		// запишем полученные данные в файл
		$data = json_encode($arr_data);

		file_put_contents('data.json', $data);
	}
	// 
	public function writeData(){
		// читаем данные из файла
		$data_json = file_get_contents('data.json');
		$data = json_decode($data_json);
		return $data;
	}
}	