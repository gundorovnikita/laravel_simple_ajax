<html>
   <head>
      <title>Ajax Example</title>
      
      <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
      </script>
      <meta name="csrf-token" content="{{ csrf_token() }}">
      
   </head>
   
   <body>
      <div id = 'msg'>This message will be replaced using Ajax. 
         Click the button to replace the message.</div>


      <button onclick="getMessage()">Click me</button>



   
      <script>
         $.ajaxSetup({
           headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
         });


         function getMessage() {
            $.ajax({
               type:'POST',
               url:'/getmsg',
               data:'123',
               success:function(data) {
                  $("#msg").text(data.msg);
               }
            });
            
         }

      </script>



   </body>

</html>