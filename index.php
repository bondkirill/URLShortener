<?php
require_once 'shorten.php';

?>

<!DOCTYPE html>
<html>
<head>
    <title>Simple URL Shortener</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready (function(){
            $(".tab_item").hide();
            var counter = 6;

            //hide div container and show new div tab_item on 5 second
            function move(event) {

                event.preventDefault();
                $(".container").hide();
                $(".tab_item").show();
                setTimeout(function(){
                    location.href= '<?php echo $res2->id; ?>';
                }, 5000);

            }
            //timer on how long show div tab_item
            function timer(){
                counter--;
                document.getElementById("count").innerHTML = counter;
                setTimeout(timer,1000);
            }


            // onClick to link (short url), turn on 2 timer - move and timer
            $("a#customLink").click(function() {
                move(event);
                timer();


            });

            // Sending data without reloading pages using Ajax
            $("#shorten").click(function (){
                var urlname = $("#url").val();

                $.ajax({
                    type: 'POST',
                    data: urlname,
                    url: "index.php",
                    dataType: "json",
                    success: function(data){
                        $(".data").html();
                    }
                });
            });


        });

    </script>
</head>
<body>
<div class="content" style="margin-top: 200px;">
    <div class="container" >
        <h1 class="title" >Simple URL Shortener</h1>
        <form action="" method="POST">
            <input type="url" name="url" placeholder="https://" autocomplete="off" id="url">
            <input type="submit" value="shorten" id="shorten">
        </form>
        <div class="wrapper">
            <div class="data">
                <a id="customLink" href="<?php echo $res2->id; ?>"><?php echo $res2->id;  //show short url ?></a>
            </div> <!--date -->
        </div><!--wrapper -->
    </div> <!--container -->
    <div class="tab_content" onload="timer()">
        <div class="tab_item">This link was clicked <?php echo $res2->analytics->allTime->shortUrlClicks; //show how many click on short link?> times<br/>
            You will be redirected to <a href="<?php echo $res2->longUrl; ?>"><?php echo $res2->longUrl; //show long url?></a> in <span id="count"></span> seconds</div>
    </div> <!--tab_content -->
</div> <!--content -->
</body>
</html>