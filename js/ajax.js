$(document).ready(function () {
	// When a brand is selected
	$("#deviceBrand").on("change", function () {
		var selectedBrand = $(this).val(); // Get selected brand

		if (selectedBrand) {
			// Show loading spinner
			$("#deviceModel").html("<option>Loading...</option>");

			// Make Ajax request to get device names for the selected brand
			$.ajax({
				type: "GET",
				url: "ajax.php", // The PHP file that will return the device names
				data: { brand: selectedBrand }, // Send the brand as a parameter
				success: function (response) {
					// Parse the response and populate the deviceModel dropdown
					var deviceNames = JSON.parse(response);
					var options = '<option value="">Select a device</option>';

					if (deviceNames.length > 0) {
						deviceNames.forEach(function (device) {
							options += '<option value="' + device + '">' + device + "</option>";
						});
					} else {
						options += '<option value="other">Other</option>';
					}

					$("#deviceModel").html(options); // Update the deviceModel dropdown
				},
				error: function () {
					alert("Error fetching device names");
					// Reset the dropdown on error
					$("#deviceModel").html('<option value="">Select a device</option>');
				},
			});
		} else {
			// Reset the dropdown when no brand is selected
			$("#deviceModel").html('<option value="">Select a device</option>');
		}
	});
});
