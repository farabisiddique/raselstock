// $(document).ready(function(){

// 	$(".delete-order-trigger").click(function(){
// 		var delete_what = $(this).data("id");
// 		var delete_url = "delete.php?id=" + delete_what;
// 		console.log("hello ",delete_what);
// 		$(".delete-final").attr("href",delete_url);
// 	});

// });


$(document).on("click", ".delete-order-trigger", function () {
     var delete_what = $(this).data('id');
     var delete_url = "delete_order.php?id=" + delete_what;
	 $(".delete-final").attr("href",delete_url);

     // $(".modal-body #bookId").val( myBookId );
});