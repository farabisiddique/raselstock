













<script type="text/javascript">

  $(document).ready(function(){
    var pathname = window.location.pathname;
    var page_name = "./"+pathname.substring(pathname.lastIndexOf('/') + 1);
    console.log(page_name);
    $('a').each(function(){
       var href = $(this).attr("href");
       if(href == page_name){
          $(this).addClass('active');
       }
    });
  });

</script>