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
	<div class="text" >
	@foreach($text as $text)
		<div class=detail>
			{{$text->text}}
			<button class="del" data-id="{{$text->id}}">delete</button>
			
			<a href="{{ url('add-to-cart/'.$text->id) }}"> add to cart </a>
			<br>
		</div>
	@endforeach
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
		    var text = tAnswer.value;
		    console.log(tAnswer.value);
		    
		    $.ajax({
		    	type: 'POST',
		        url: '/ajax/', 
		        data:{message: tAnswer.value},  
		        success: function(e) {
		        	var id = e.id;
		        	
				 	
				 	$('.text').append('<div class="detail">'+text+' '+'<button class="del" data-id="'+id+'">delete</button><a href="{{ url("add-to-cart/'+id+'") }}"> add to cart </a></div>' )
				 },
		    });
		    $('#add').val('');
		}
		
		$(".text").on("click", "button.del", function(){
			 var id = $(this).data("id");
			 $(this).parent().hide();
			 $.ajax({
				 url: '/delete/',
				 type: 'POST',
				 data: {id: id},
				 success: function(d) {
				 console.log(d);
				 },
				 error: function(d) {
				 console.log(d);
				 }
 			 });
		});

		
	</script>
</body>
</html>