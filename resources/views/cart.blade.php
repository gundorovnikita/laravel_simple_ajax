<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <?php $total = 0 ?>
    @if(session('cart'))
        @foreach(session('cart') as $id => $details)
            <?php $total += $details['quantity'] ?>
           
            {{ $details['name'] }}
            <button class="btn btn-danger btn-sm remove-from-cart" data-id="{{ $id }}"><i class="fa fa-trash-o">delete</i></button>
            <br>
            <input type="number" value="{{ $details['quantity'] }}" class="form-control quantity" />
            <hr>
        @endforeach
    @endif
 
        <strong>Total {{ $total }}</strong>
<br>
<a href="{{url('/')}}">back</a>


<script type="text/javascript">
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
 
        $(".remove-from-cart").click(function (e) {
            e.preventDefault();
 
            var ele = $(this);
 

            $.ajax({
                url: '{{ url('remove-from-cart') }}',
                method: "DELETE",
                data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id")},
                success: function (response) {
                    window.location.reload();
                }
            });
            
        });
 
    </script>


</body>
</html>




