<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>

	<h2>parse list:</h2>
	<div class="parse">
		
	</div>
<br>
<a href="{{url('/')}}">back</a>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
	url = 'http://127.0.0.1:8000/api';

    $.getJSON(url, function(data) { 
		for (var i in data) {
		  string = data[i]['text'];
		  $('.parse').append(string, '<br>');
		} 
		});
</script>
</body>
</html>