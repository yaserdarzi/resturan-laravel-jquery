<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Demo - How to create a parallax scrolling website</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

    <link rel="stylesheet" href="{{URL::asset('assets/css/normalize.css')}}">
    <link rel="stylesheet" href="{{URL::asset('assets/css/main.css')}}">
    <script src="{{URL::asset('assets/js/vendor/modernizr-2.7.1.min.js')}}"></script>
    <style type="text/css">
        body {
            font-family: 'Open Sans', sans-serif;
        }
    </style>
</head>
<body class="loading">

<main>

    <section id="slide-1" class="homeSlide">
        <div class="bcg" data-center="background-position: 30% 0px;" data-top-bottom="background-position: 30% -100px;" data-anchor-target="#slide-1">
            <div class="hsContainer">
                <div class="hsContent" data-center="opacity: 1" data-106-top="opacity: 0" data-anchor-target="#slide-1 h2">
                    <img src="{{URL::asset('assets/img/logo.png')}}" id="logo">
                    <h2>رستوران بوف آمل</h2>
                    <p>لذت خوردن غذایی سالم</p>
                </div>
            </div>
        </div>
    </section>

    <section id="slide-2" class="homeSlide">
        <div class="bcg" data-0="background-color:rgb(1,27,59);" data--25p-bottom="background-color:rgb(1,27,59);" data--90p-bottom="background-color:(0,0,0);"  data-anchor-target="#slide-2">
            <!-- <div class="bcg" data-0="background-color:rgb(1,27,59);" data-top="background-color:(0,0,0);"  data-anchor-target="#slide-2"> -->
            <div class="hsContainer">
                <div class="hsContent">
                    <h2 data-center="opacity: 1" data--200-bottom="opacity: 0" data-206-top="opacity: 1" data-106-top="opacity: 0" data-anchor-target="#slide-2 h2">Fade me in and out</h2>
                    <p data-center="opacity: 1" data--200-bottom="opacity: 0" data-206-top="opacity: 1" data-106-top="opacity: 0" data-anchor-target="#slide-2 h2">Text is fading in at 206 pixels from the bottom and fading out 106 pixels from the top. <br />Next slide fades in from black.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="slide-3" data-content-offset="50p" class="homeSlide homeSlideTall2">
        <div class="bcg"
             data-center="background-position: 0px 50%;"
             data-bottom-top="background-position: 0px 40%;"
             data-top-bottom="background-position: -40px 50%;"
             data-anchor-target="#slide-3"
            >
            <div class="hsContainer">
                <div class="bcg bcg2" data-bottom-top="opacity: 1" data-top="opacity: 1;" data--150-top="opacity: 0" data-anchor-target="#slide-3">&nbsp;</div>
                <div class="hsContent">
                    <div class="plaxEl" data-bottom-top="opacity: 0" data-top="opacity: 0" data--50p-top="opacity: 1; position: fixed; top: 206px; width: 100%; left: 0;" data--25p-bottom="opacity: 1;" data--50p-bottom="opacity: 0;" data-anchor-target="#slide-3">
                        <h2>Fixed element fading in and out</h2>
                        <p><span class="bgBlack">Text is fixed 206 pixels from the top, while the background is moving 40 pixels to the left.</span></p>
                        <p><span class="bgBlack">Or did you think that the scooter is driving off?</span></p>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <section id="slide-4" data-content-offset="90p" class="homeSlide homeSlideTall">
        <div class="bcg" data-bottom-top="background-position: 50% 100px" data-top-bottom="background-position: 50% -100px;" data-anchor-target="#slide-4">
            <div class="curtainContainer">

                <div class="curtain" data-bottom-top="opacity: 0; height: 1%;" data-106-top="height: 1%; opacity: 0; top: -10%;" data-center="height: 100%; opacity: 0.5; top: 0%;" data-top-bottom="height: 100%; opacity: 0.5; top: 0%;" data-anchor-target="#slide-4"></div>
                <div class="copy" data-bottom-top="opacity: 0" data--100-bottom="opacity: 0" data--280-bottom="opacity: 1;" data-280-top="opacity: 1;" data-106-top="opacity: 0;" data-anchor-target="#slide-4 .copy">
                    <h2>رستوران بوف آمل</h2>
                </div>

            </div>
        </div>
    </section>


    <section id="slide-5" data-content-offset="66p" class="homeSlide homeSlideTall2">
        <div class="bcg">
            &nbsp;
        </div>
        <div class="bcg bcg2" data-bottom-top="opacity: 0;" data--33p-top="opacity: 0;" data--66p-top="opacity: 1;" data-anchor-target="#slide-5">
            <div class="hsContainer">
                <div class="hsContent" data-bottom-top="opacity: 0;" data-center="opacity: 1" data-anchor-target="#slide-5">
                    <h2>Fixed element fading in and out</h2>
                    <p>Showcase your beautiful images before blurring the scene and fading in your headline.</p>
                </div>
            </div>
        </div>
        <div class="bcg bcg3" data-300-bottom="opacity: 0;" data-100-bottom="opacity: 1;" data-anchor-target="#slide-5">
            <div class="hsContainer">
                <div class="hsContent" data-100-bottom="opacity: 0;" data-bottom="opacity: 1;" data-anchor-target="#slide-5">
                    <h2>The End</h2>
                    <p>Not enough parallax goodness? Let me know in the comments or hit me up at <a href="https://www.twitter.com/ihatetomatoes" target="_blank">@ihatetomatoes</a>.</p>
                </div>
            </div>
        </div>
    </section>

</main>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="{{URL::asset('assets/js/imagesloaded.js')}}"></script>
<script src="{{URL::asset('assets/js/waypoints.min.js')}}"></script>
<script src="{{URL::asset('assets/js/skrollr.js')}}"></script>
<!--[if lt IE 9]>
<script type="text/javascript" src="{{URL::asset('assets/js/skrollr.ie.min.js')}}"></script>
<![endif]-->
<script src="{{URL::asset('assets/js/_main.js')}}"></script>

</body>
</html>