<?php
if (isset($_POST['cityName'])) { // nếu tồn tại post từ là đã bấm trước đó 1 lần rồi
    $cityname = $_POST['cityName'];
    // echo '<h1>'.$cityname.'</h1>';
    $api_key = '38f0f3fc497cfc4bcf8fea946a07f7b0';
    $api_url = 'https://api.openweathermap.org/data/2.5/weather?q=' . $cityname . '&appid=' . $api_key;
    $weather_data = json_decode(file_get_contents($api_url), true);
    $temprature = $weather_data['main']['temp'];
    $temprature_in_celsius = ceil($temprature - 273.15);
    $weather_current_description = $weather_data['weather'][0]['main'];
    $weather_current_icon = $weather_data['weather'][0]['icon'];
    $temprature_min = ceil($weather_data['main']['temp_min'] - 273.15 - 1);
    $temprature_max = ceil($weather_data['main']['temp_max'] - 273.15 + 2);
 ?>
    <form action="" method="post" enctype="multipart/form-data" name="myForm" onchange="myForm.submit();">
        <div class="row"> <select class="w-list-cities" id="cityName" name="cityName" style="width: 157px;   margin-left: 46px; border: 1px solid black; ">
                <?php
                echo '<option value="' . $cityname . '">' . $cityname . '</option>';
                if ($cityname == 'Hanoi') {

                    echo '<option value="Da Nang">Da Nang</option>';
                    echo '<option value="Ho Chi Minh City">Ho Chi Minh City</option>';
                } else if ($cityname == 'Da Nang') {
                    echo '<option value="Hanoi">Hanoi</option>';

                    echo '<option value="Ho Chi Minh City">Ho Chi Minh City</option>';
                } else {
                    echo '<option value="Hanoi">Hanoi</option>';
                    echo '<option value="Da Nang">Da Nang</option>';
                }
                ?>
            </select>


    </form>

    </form>

    <div class="w-temperature"><?php echo $temprature_in_celsius; ?>°C / <span style="    font-size: 12px;
    color: #ada7a7;"><?php echo $temprature_min; ?>°C - <?php echo $temprature_max; ?>°C</span></div>
    <img class="w-icon" src="https://openweathermap.org/img/wn/<?php echo $weather_current_icon; ?>@2x.png" style="width: 32px; height: 32px;">
    <div class="w-humidity">&nbsp;</div>
<?php
} else { // còn ko tức là mới vào trang thì mặc định thành phố là 'Hà Nội', nếu k muốn xem HN chọn tiếp thì sẽ chuyển lên post


    $cityname = 'Hanoi';
    // echo '<h1>'.$cityname.'</h1>';
    $api_key = '38f0f3fc497cfc4bcf8fea946a07f7b0';
    $api_url = 'https://api.openweathermap.org/data/2.5/weather?q=' . $cityname . '&appid=' . $api_key;
    $weather_data = json_decode(file_get_contents($api_url), true);
    $temprature = $weather_data['main']['temp'];
    $temprature_in_celsius = ceil($temprature - 273.15);
    $weather_current_description = $weather_data['weather'][0]['main'];
    $weather_current_icon = $weather_data['weather'][0]['icon'];
    $temprature_min = ceil($weather_data['main']['temp_min'] - 273.15 - 1);
    $temprature_max = ceil($weather_data['main']['temp_max'] - 273.15 + 2);


 ?>
    <form action="" method="post" enctype="multipart/form-data" name="myForm" onchange="myForm.submit();">
        <div class="row"> <select class="w-list-cities" id="cityName" name="cityName" style="width: 157px;   margin-left: 46px; border: 1px solid black; ">
                <option value="Hanoi">Hanoi</option>
                <option value="Da Nang">Da Nang</option>
                <option value="Ho Chi Minh city">Ho Chi Minh City</option>
            </select>
            <!-- <input class="btn btn-success" type="submit" name="create" value="Chọn"></div>
                        -->
    </form>
    <div class="w-temperature"><?php echo $temprature_in_celsius; ?>°C / <span style="    font-size: 12px;
    color: #ada7a7;"><?php echo $temprature_min; ?>°C - <?php echo $temprature_max; ?>°C</span></div>
    <img class="w-icon" src="https://openweathermap.org/img/wn/<?php echo $weather_current_icon; ?>@2x.png" style="width: 32px; height: 32px;">
   
<?php } ?>
<script language="javascript" src="http://code.jquery.com/jquery-2.0.0.min.js"></script>

 