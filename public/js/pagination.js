$(document).ready(function () {
	loadData();
	function loadData(page) {
		$.ajax({
			url: "models/Posts/pagination.php",
			method: "POST",
			data: { pagination: page },
			success: function (data) {
				$(".postsHolder").html(data);
			}
		});
	}

	$(document).on("click", ".pagination", function () {
		var page = $(this).attr("id");
		loadData(page);
	});
});
