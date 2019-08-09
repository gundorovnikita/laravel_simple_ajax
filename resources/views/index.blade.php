<html>
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
	<a href="{{url('/cart')}}">cart</a>
	<a href="{{url('/api')}}">api</a>
	<a href="/parse">parse</a>
	<br>

	<hr>
	@foreach($text as $text)
	<div class="text" id="{{$text->id}}">
		{{$text->text}}
		<button onclick="deletetext( {{ $text->id }} )">delete</button>
		
		<a href="{{ url('add-to-cart/'.$text->id) }}"> add to cart </a>
		<br>
	</div>
	@endforeach
	<div id="field">
		
	</div>

	<input type="text" id="add">
	<button onclick="send()">Sumbit</button>

	<script>

		$.ajaxSetup({
		  headers: {
		    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		  }
		});




		function send(){
		    var tAnswer = document.getElementById("add"); 
		    console.log(tAnswer.value);
		    $('#field').append(tAnswer.value,'<button>delete</button>', '<br>' )
		    $.ajax({
		    	type: 'POST',
		        url: '/ajax/', 
		        data:{message: tAnswer.value},  
		    });
		    $('#add').val('');
		}

		function deletetext(a){
			 console.log(a);
			 var hide = document.getElementById(a);
			 $(hide).hide();
			 $.ajax({
				 url: '/delete/',
				 type: 'POST',
				 data: {id: a},
				 success: function(d) {
				 console.log(d);
				 },
				 error: function(d) {
				 console.log(d);
				 }
 			 });
		}

		
	</script>
</body>
</html>