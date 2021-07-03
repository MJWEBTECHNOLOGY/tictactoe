<!DOCTYPE html>
<html lang="en">
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&amp;display=swap" rel="stylesheet"> -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <link href="css/style.css" rel="stylesheet">
        <!-- <link href="css/style2.scss" rel="stylesheet"> -->
    </head>
    <body>
    <div class="horizontal-scroll-wrapper squares">
        <div class="div" id="div1">item 1</div>
        <div class="div" id="div2">item 2</div>
        <div class="div" id="div3">item 3</div>
        <div class="div" id="div4">item 4</div>
        <div class="div" id="div5">item 5</div>
    </div>



        <ul class="menus">
            <div class="slider"></div>
            <li><a href="#" id="wallet" onclick="wallet()"><i class="fas fa-dollar-sign"></i><span>Wallet</span></a></li>
            <li><a href="#" id="leader" onclick="leader()"><i class="fas fa-tasks"></i><span>Leader Board</span></a></li>
            <li><a href="#" id="home" onclick="home()" class="active-icon"><i class="fas fa-home"></i><span>Home</span></a></li>
            <li><a href="#" id="joined" onclick="joined()"><i class="fas fa-gamepad"></i><span>Joined</span></a></li>
            <li><a href="#" id="profile" onclick="profile()"><i class="fas fa-user"></i><span>Profile</span></a></li>
        </ul>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script>
            $(document).ready(function(){
                $(".menus li a").click(function(){
                    var position = $(this).position();
                    var margin = 12;
                    $(".slider").css({"left":+position.left+margin, "transform": "translateX(0)"});

                    $(".menus li a").removeClass("active-icon");
                    $(this).addClass("active-icon");
                })
            })
        </script>
        <script>
                $("#div1").hide();
                $("#div2").hide();
                $("#div3").show();
                $("#div4").hide();
                $("#div5").hide();

            function wallet() {
                $("#div1").show();
                $("#div2").hide();
                $("#div3").hide();
                $("#div4").hide();
                $("#div5").hide();
            };

            function leader() {
                $("#div1").hide();
                $("#div2").show();
                $("#div3").hide();
                $("#div4").hide();
                $("#div5").hide();
            };

            function home() {
                $("#div1").hide();
                $("#div2").hide();
                $("#div3").show();
                $("#div4").hide();
                $("#div5").hide();
            };

            function joined() {
                $("#div1").hide();
                $("#div2").hide();
                $("#div3").hide();
                $("#div4").show();
                $("#div5").hide();
            };

            function profile() {
                $("#div1").hide();
                $("#div2").hide();
                $("#div3").hide();
                $("#div4").hide();
                $("#div5").show();
            };
        </script>
    </body>
</html>