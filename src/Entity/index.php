<!doctype html>
<html lang="en">
<head>
    <meta charset ="UTF-8">
    <meta name="viewport"
          content="width=device-width,user-scalable=no,initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css" type="text/css">
</head>
<body>
<div>
    <span> <i class="fa fa-star fa-2x" style="color:#b300ff" data-indexe="0"></i></span>
    <span> <i class="fa fa-star fa-2x" style="color:#b300ff" data-indexe="1"></i></span>
    <span> <i class="fa fa-star fa-2x" style="color:#b300ff" data-indexe="2"></i></span>
    <span> <i class="fa fa-star fa-2x" style="color:#b300ff" data-indexe="3"></i></span>
    <span> <i class="fa fa-star fa-2x" style="color:#b300ff" data-indexe="4"></i></span>
</div>
<script src="{{asset('https://code.jquery.com/jquery-3.6.0.min.js')}}" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
    var ratedIndex = -1;
$(document).ready (function () {
    resetStarColors();
    if (localStorage.getItem('ratedIndex') !=null)
        setStars(parseInt(localStorage.getItem('ratedIndex')));
     $('.fa-star').on('click', function (){
         ratedIndex = parseInt($(this).data('index'));
         localStorage.setItem('ratedIndex' , ratedIndex );
         saveToTheDB();
     });
     $('.fa-star').mouseover(function () {
        resetStarColors ()
        var currentIndex= parseInt($(this).data('index'));

        setStars(currentIndex);
    });
    $('.fa-star').mouseleave(function () {
        resetStarColors ()
        if(ratedIndex != -1)
            setStars(ratedIndex);
    });
});
function saveToTheDB(){
    $.ajax({
      "url"
    });
};
    function setStars (max) {
        for (var i=O; i <= max; i++)
            $('.fa-star:eq('+i+')').css('color','green');
}
function resetStarColors (){
    $('.fa-star').css('color','yellow');
}
</script>
</body>
</html>