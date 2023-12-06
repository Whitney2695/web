<?php
if(array_key_exists('submit',$_GET)){
    //checking if input is empty
    if(!$_GET['city']){
        $error="sorry, your input field is empty";
    }
    if($_GET['city']){
       $apiData= file_get_contents("https://api.openweathermap.org/data/2.5/weather?q=".$_GET['city']."&appid=c2aef17981b21587d23941a9ed71311c");
    $weatherArray=json_decode($apiData,true);
    if($weatherArray['cod']==200){
         //C = K-273.15
    $tempCelcius=$weatherArray['main']['temp']-273;
    $weather="<b>".$weatherArray['name'].",".$weatherArray['sys']['country'].":".intval($tempCelcius)."&deg;C</b> <br>";
    $weather.="<b>weather condition:<b/>".$weatherArray['weather']['0']['description']."<br>";
    $weather.="<b>Atmospheric condition:<b/>".$weatherArray['main']['pressure']."hPa<br>";
    $weather.="<b>wind speed:<b/>".$weatherArray['wind']['speed']."meter/sec<br>";   
    $weather.="<b>cloudness:<b/>".$weatherArray['clouds']['all']."%<br>";     
    date_default_timezone_set('Kenya/Nairobi');
    $sunrise =$weatherArray['sys']['sunrise'];
    $weather.="<b>Sunrise:<b>". date("g:i a",$sunrise)."<br>";
    $weather.="<b>Current Time:<b>". date("F j, Y, g:i a")."<br>";



    }
   else{
        $error="couldn't be process,your city name is not valid";
    }
   
}

}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Weather app</title>
    <link rel="stylesheet" href="weather.css">
   
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
    <h1>Search Global Weather</h1>
    <form action=""method="GET">
        <p><label for="City">Enter your city name</label></p>
       <p> <input type="text"name="city"id="city"placeholder="City name"></p>
        <button type="submit"name="submit"class="btn btn-success">Submit Now</button>
        <div class="output mt-3">
            <?php
           if($weather){
            echo'<div class="alert alert-success" role="alert">
            '.$weather.'
            </div>';

           }
           if($error){
            echo'<div class="alert alert-danger" role="alert">
            '.$error.'
          </div>';
           }
           
            ?>
        </div>
    </form>
    </div>
    
    <!--optional JavaScript; choose one of the two!-->

    <!-- option 1:Boostrap Bundle with popper-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <!-- option 2:Separate popper and Bostrap Js -->
    <!==
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    
</body>
</html>