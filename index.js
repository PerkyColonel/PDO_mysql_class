$("#btn").click(function () {
	$.ajax({
		url: "get.php",
		success: function (result) {
			let output = $("#getOutput");
			if (!output.is(":empty")) {
				output.empty();
			}

			let table = $("<table></table>");

			let colnames = Object.keys(result[0]);

			let table_head = $("<thead></thead>");
			let row = $("<tr></tr>");

			colnames.forEach((item) => {
				let th = $("<th></th>");
				$(th).text(item);
				$(row).append(th);
			});
			$(table_head).append(row);
			$(table).append(table_head);
			result.forEach((item) => {
				let tr = $("<tr></tr>");
				let waardes = Object.values(item);
				waardes.forEach((elem) => {
					let td = $("<td></td>");
					td.text(elem);
					tr.append(td);
				});
				table.append(tr);
			});
			$(output).append(table);
		},
	});
});
