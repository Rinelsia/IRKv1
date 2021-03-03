<?php 

/**
 * 
 */
class IncRoute
{
	
	function __construct()
	{
		# code...
		echo "Открыт файл IncRoute";
	}
	function IncludeRoute($href){
		if (is_file($href)) {
			# code...
			return require $href;
		}
		echo "Открыт файл IncRoute";
		var_dump($href);
	}
}