<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
</head>
<body>
<div class="row"> <select class="w-list-cities" id="cityName" name="cityName" style="width: 157px;   margin-left: 46px; border: 1px solid black; ">
                    <option value="Hanoi" selected>Hanoi</option>
                    <option value="Da Nang">Da Nang</option>
                    <option value="Ho Chi Minh city">Ho Chi Minh City</option>
                </select>
                
            </div>
            <div class="w-temperature" style="margin-left:32px;"></div>
            
    <img class="w-icon" src="" style="width: 32px; height: 32px;">
   
            <script>

        $(document).ready(function() {
            
            $( "#cityName option:selected" ).text(function() {
                var city = $(this).val();
        
        //alert(city);
        $.ajax({
            url: "https://api.openweathermap.org/data/2.5/weather?q=" + city + "&appid=38f0f3fc497cfc4bcf8fea946a07f7b0",
            method: "get",
            type: "get",
            success: function(data) {
              
              var url = "https://openweathermap.org/img/wn/"+data.weather[0].icon+"@2x.png";
               $(".w-temperature").html('<p>'+Math.round(data.main.temp-273.15)+'°C / <span style="font-size: 12px;color: #ada7a7;">'+Math.round(data.main.temp_min-1-273.15)+'°C - '+ Math.round(data.main.temp_min+2-273.15)+'°C</span></p>');
               $(".w-icon").attr("src",url);
     
            },

        })
            });
            $("#cityName").change(function() {
                var city = $(this).val();
        
                //alert(city);
                $.ajax({
                    url: "https://api.openweathermap.org/data/2.5/weather?q=" + city + "&appid=38f0f3fc497cfc4bcf8fea946a07f7b0",
                    method: "get",
                    //dataType:"text",
                    type: "get",
                    //data: {cityName:city},
                    success: function(data) {
                  
                      var url = "https://openweathermap.org/img/wn/"+data.weather[0].icon+"@2x.png";
                       $(".w-temperature").html('<p>'+Math.round(data.main.temp-273.15)+'°C / <span style="font-size: 12px;color: #ada7a7;">'+Math.round(data.main.temp_min-1-273.15)+'°C - '+ Math.round(data.main.temp_min+2-273.15)+'°C</span></p>');
                       $(".w-icon").attr("src",url);
                   
                    },

                })
            });
        });
    </script>
</body>
</html>
















           
           