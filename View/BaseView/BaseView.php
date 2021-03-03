<!DOCTYPE html>
<html lang="en">
<head>

	<title></title>
</head>
<body>
<nav>
	<ul>
		<li><a href="/ru">Русский</a></li>
		<li><a href="/en">Английский</a></li>
	</ul>
</nav>
<h1><?=$h1[0]?></h1>
<p><?=$p[0]?></p>
<p><?=$p[1]?></p>
<form method="post">
	<input type="text" name="h1[0]" placeholder="h1">
	<input type="text" name="p[0]" placeholder="p[0]">
	<input type="text" name="p[1]" placeholder="p1">
	<input type="submit" name="">
</form>
</body>
</html>