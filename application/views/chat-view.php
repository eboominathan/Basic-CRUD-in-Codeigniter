<html>
<head>
  <title> Chat Exmaples! </title>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
  <script> 
    var time = 0;
  
    var updateTime = function (cb) {
      $.getJSON("index.php/chat/time", function (data) {
          cb(~~data);
      });
    };
    
    var sendChat = function (message, cb) {
      $.getJSON("index.php/chat/insert_chat?message=" + message, function (data){
        cb();
      });
    }
    
    var addDataToReceived = function (arrayOfData) {
      arrayOfData.forEach(function (data) {
        $("#received").val($("#received").val() + "\n" + data[0]);
      });
    }
    
    var getNewChats = function () {
      $.getJSON("index.php/chat/get_chats?time=" + time, function (data){
        addDataToReceived(data);
        // reset scroll height
        setTimeout(function(){
           $('#received').scrollTop($('#received')[0].scrollHeight);
        }, 0);
        time = data[data.length-1][1];
      });      
    }
  
    // using JQUERY's ready method to know when all dom elements are rendered
    $( document ).ready ( function () {
      // set an on click on the button
      $("form").submit(function (evt) {
        evt.preventDefault();
        var data = $("#text").val();
        $("#text").val('');
        // get the time if clicked via a ajax get queury
        sendChat(data, function (){
          alert("dane");
        });
      });
      setInterval(function (){
        getNewChats(0);
      },1500);
    });
    
  </script>
</head>
<body>
  <h1> Chat Example on Codeigniter </h1>
  
  <textarea id="received" rows="10" cols="50">
  </textarea>
  <form>
    <input id="text" type="text" name="user">
    <input type="submit" value="Send">
  </form>
</body>
</html>
