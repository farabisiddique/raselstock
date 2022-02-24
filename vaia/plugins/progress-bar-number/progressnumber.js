$(document).ready(function(){
    $('.progress-bar-number').appear(function(){
            setTimeout(function(){
                $('.progress-bar-number .num').countTo();
            },1000);
        });
  });