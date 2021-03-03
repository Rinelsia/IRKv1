<?php 
if (is_file($file = 'composer.phar')) {
	# code...
	// $boole - устанавливает, нужно ли перезаписывать существующие файлы распаковки, если true то да, если '' то нет
	$boole = null;
	if (is_dir($dir = 'vendor')) {
		# code...
		$path = DIR.'/'.$dir."/";

	}else{
		$path = '';
	}
	$out = PharExtract($path,$file,$boole);
	echo "Архив фар отработал = $out";
	var_dump($path);
}
function PharExtract($dir, $file,$boole){
	$phar = new Phar($file);
	if (is_bool($boole)) {
		$result = $phar->extractTo($dir, $boole);
		var_dump($boole);
	}else{
		$result = $phar->extractTo($dir);
	}
	
	return $result;
}