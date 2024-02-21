<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
	<h2 class="text-lg font-medium mr-auto">
		Commission Report
	</h2>
</div>
<div class="intro-y box p-3 mt-5">
	<div class="section mt-2">
		<div class="card">
			<div class="card-body">
				<form class="form-horizontal" method="get" action="<?php echo api_url("admin/export/commissionSheet"); ?>">
					<!-- <div class="form-group">
						<div class="input-wrapper">
							<select name="period" id="period" class="form-control">
								<option value="monthly">Monthly</option>
								<option value="yearly">Yearly</option>
							</select>
						</div>
					</div> -->
					<div class="form-group basic mt-2">
						<div class="flex mt-4 items-center justify-around">
							<button type="submit" class="btn btn-primary shadow-md mr-2" id="commissionReporte">Download Reports</button>
						</div>
					</div>
				</form>
			</div>



			<!-- <div class="p-5 px-10 overflow-auto">
              <a target="_blank" href="<?php echo api_url("admin/export/commissionSheet"); ?>"
                 class="btn btn-primary float-right">
                  [[EXPORT_REPORT_COUNT]]
              </a>
          </div> -->

			<!-- <div class="intro-y box mt-5">
				<table class="table">
					<thead>
					<tr>
						<th>#</th>
						<th>[[LABEL_AMOUNT]]</th>
					</tr>
					</thead>
					<tbody>
					<tr>
						<td>[[COM_TOTAL_MEMBERS]]</td>
						<td>
							<?php echo $reports['main_members']; ?>
						</td>
					</tr>
					<tr>
						<td>[[COM_TOTAL_NODES]]</td>
						<td>
							<?php echo $reports['members']; ?>
						</td>
					</tr>
					<tr>
						<td>[[COM_TOTAL_SALES]]</td>
						<td>
							<?php echo number_format($reports['sales'], 2); ?>
						</td>
					</tr>
					<tr>
						<td>
							[[COM_TOTAL_SALES_IN]] <?php echo strlen($period) == 4 ? $period : date('M Y', strtotime($period . "-01")); ?>
						</td>
						<td>
							<?php echo number_format($reports['period_sales'], 2); ?>
						</td>
					</tr>
					<?php foreach ($reports['ledgers'] as $ledger) { ?>
							<tr>
								<td>[[<?php echo preg_replace("/[\s-]/", "_", $ledger['trans_source_type']); ?>]] (<?php echo $ledger['currency'] ?>)</td>
								<td><?php echo $ledger['dr'] == 0 ? $ledger['cr'] : $ledger['dr']; ?></td>
							</tr>
					<?php } ?>
					</tbody>
				</table>
			</div> -->
		</div>
	</div>
</div>
<!-- <script>
	let commissionReporte = document.getElementById("commissionReporte");

	commissionReporte.addEventListener("click", (e) => {
		e.preventDefault();

		// Make an AJAX request
		$.ajax({
			url: "<?php echo api_url("admin/export/commissionSheet"); ?>",
			type: "GET",
			// dataType: "json", 
			success: function(data) {
				// Handle the successful response here
				console.log("API Response:", data);

				// Check if the response contains a file path
				if (data && data.filePath) {
					// Create a link element
					const link = document.createElement("a");

					// Set the href attribute to the file path
					link.href = data.filePath;

					// Set the download attribute to specify the filename
					link.download = "commission_sheet.csv";

					// Append the link to the body
					document.body.appendChild(link);

					// Trigger a click event on the link to start the download
					link.click();

					// Remove the link from the body
					document.body.removeChild(link);
				} else {
					console.error("Invalid response format. Expected filePath.");
				}
			},
			error: function(xhr, status, error) {
				// Handle errors here
				console.error("Error:", error);
			}
		});
	});
</script> -->