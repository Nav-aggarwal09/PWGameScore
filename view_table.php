<!DOCTYPE html>
<html>
<head>
<style>
table, th, td {
     border: 1px solid black;
}
</style>
<script src="jquery-3.2.0.min.js"></script>
</head>
<body>
<div id="table"></div>
</body>
<button onclick="window.location.href = 'index.html'">Back to Form</button>
<button id="Delete">Delete</button>
<button id="Display">Display Table</button>
<button id="Add_Score_Home">+2 Home</button>
<button id="Add_Score_Away">+2 Away</button>
<button id="Subtract_Score_Home">-2 Home</button>
<button id="Subtract_Score_Away">-2 Away</button>

</body>
<script>
	var selected = [];

	$(document).ready(function() {
		$("#Delete").click(function() {
			deleteSelected();
		});	
	});

	$(document).ready(function() {
		$("#Display").click(function() {
			updateTable();
		});
	});

	$(document).ready(function() {
		$("#Add_Score_Home").click(function() {
			addScoreHome();
		});
	});

	$(document).ready(function() {
		$("#Add_Score_Away").click(function() {
			addScoreAway();
		});	
	});

	$(document).ready(function() {
		$("#Subtract_Score_Home").click(function() {
			subtractScoreHome();
		});	
	});

	$(document).ready(function() {
		$("#Subtract_Score_Away").click(function() {
			subtractScoreAway();
		});	
	});

	function deleteSelected() {
		var dataToSend = {action: "delete"}
		$.each(selected, function(index, value) {
			dataToSend[index] = value;
		});
		var deleteRequest = $.ajax({
				type: "POST",
				url: "table_functions.php",	
				data: $.param(dataToSend),
				success: function() {
					updateTable();
				}
			});
		selected = [];
	}

	function addScoreHome() {
		var dataToSend = {action: "addscore", scoreTeam: "home"};
		$.each(selected, function(index, value) {
			dataToSend[index] = value;
		});
		var addscoreRequest = $.ajax({
				type: "POST",
				url: "table_functions.php",	
				data: $.param(dataToSend),
				success: function() {
					updateTable();
				}
			});
		selected = [];
	}

	function addScoreAway() {
		var dataToSend = {action: "addscore", scoreTeam: "away"};
		$.each(selected, function(index, value) {
			dataToSend[index] = value;
		});
		var addscoreRequest = $.ajax({
				type: "POST",
				url: "table_functions.php",	
				data: $.param(dataToSend),
				success: function() {
					updateTable();
				}
			});
		selected = [];
	}

	function subtractScoreHome() {
		var dataToSend = {action: "subtractscore", scoreTeam: "home"};
		$.each(selected, function(index, value) {
			dataToSend[index] = value;
		});
		var addscoreRequest = $.ajax({
				type: "POST",
				url: "table_functions.php",	
				data: $.param(dataToSend),
				success: function() {
					updateTable();
				}
			});
		selected = [];
	}

	function subtractScoreAway() {
		var dataToSend = {action: "subtractscore", scoreTeam: "away"};
		$.each(selected, function(index, value) {
			dataToSend[index] = value;
		});
		var addscoreRequest = $.ajax({
				type: "POST",
				url: "table_functions.php",	
				data: $.param(dataToSend),
				success: function() {
					updateTable();
				}
			});
		selected = [];
	}

	function updateTable() {
		var updateRequest = $.ajax({
			type: "POST",
			url: "table_functions.php",
			data: {action: "display"},
			success: function() {
				$("#table").html(updateRequest.responseText);
			}
		});
		selected = [];
	}

	function setSelected(id, checked) {
		if(checked == true) {
			selected.push(id);
		} else if(checked == false) {
			var itemToRemove = id;
			selected.splice($.inArray(itemToRemove, selected), 1);
		}
	}
</script>
</html>