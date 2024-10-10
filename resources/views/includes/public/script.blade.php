<script src="{{ ('style/static/js/app.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

	<script>
		document.addEventListener("DOMContentLoaded", function() {
			var ctx = document.getElementById("chartjs-dashboard-line").getContext("2d");
			var gradient = ctx.createLinearGradient(0, 0, 0, 225);
			gradient.addColorStop(0, "rgba(215, 227, 244, 1)");
			gradient.addColorStop(1, "rgba(215, 227, 244, 0)");
			// Line chart
			new Chart(document.getElementById("chartjs-dashboard-line"), {
				type: "line",
				data: {
					labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
					datasets: [{
						label: "Sales ($)",
						fill: true,
						backgroundColor: gradient,
						borderColor: window.theme.primary,
						data: [
							2115,
							1562,
							1584,
							1892,
							1587,
							1923,
							2566,
							2448,
							2805,
							3438,
							2917,
							3327
						]
					}]
				},
				options: {
					maintainAspectRatio: false,
					legend: {
						display: false
					},
					tooltips: {
						intersect: false
					},
					hover: {
						intersect: true
					},
					plugins: {
						filler: {
							propagate: false
						}
					},
					scales: {
						xAxes: [{
							reverse: true,
							gridLines: {
								color: "rgba(0,0,0,0.0)"
							}
						}],
						yAxes: [{
							ticks: {
								stepSize: 1000
							},
							display: true,
							borderDash: [3, 3],
							gridLines: {
								color: "rgba(0,0,0,0.0)"
							}
						}]
					}
				}
			});
		});
	</script>
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			// Pie chart
			new Chart(document.getElementById("chartjs-dashboard-pie"), {
				type: "pie",
				data: {
					labels: ["Shopee", "Tokopedia", "Deepublish", "Lazada", "Bukalapak", "OLX"],
					datasets: [{
						data: [48, 12, 20, 9, 6, 5],
						backgroundColor: [
							'#F1582E', // Merah tua
							'#469546', // Hijau tua
							'#BCBCBC', // Abu-abu
							'#0F0890', // Biru tua
							'#E31F51', // Merah muda
 							'#3A77FF', // Biru muda
						],
						borderWidth: 0
					}]
				},
				options: {
					responsive: !window.MSInputMethodContext ,
					maintainAspectRatio: false,
					legend: {
						display: false
					},
					cutoutPercentage: 51
				}
			});
		});
	</script>
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			// Bar chart
			new Chart(document.getElementById("chartjs-dashboard-bar"), {
				type: "bar",
				data: {
					labels: ["Lazada", "Shopee", "Tokopedia", "OLX", "Web Deepublish", "Bukalapak"],
					datasets: [{
						label: "This month",
						backgroundColor: ['#0F0890', '#F1582E', '#469546', '#3A77FF', '#BCBCBC', '#E31F51'],
						borderColor: window.theme.primary['#0F0890', '#F1582E', '#469546', '#3A77FF', '#BCBCBC', '#E31F51'],
						hoverBackgroundColor: window.theme.primary['#0F0890', '#F1582E', '#469546', '#3A77FF', '#BCBCBC', '#E31F51'],
						hoverBorderColor: window.theme.primary['#0F0890', '#F1582E', '#469546', '#3A77FF', '#BCBCBC', '#E31F51'],
						data: [9, 48, 12, 5, 20, 6],
						barPercentage: .99,
						categoryPercentage: .7
					}]
				},
				options: {
					maintainAspectRatio: false,
					legend: {
						display: false
					},
					scales: {
						yAxes: [{
							gridLines: {
								display: false
							},
							stacked: false,
							ticks: {
								stepSize: 20
							}
						}],
						xAxes: [{
							stacked: false,
							gridLines: {
								color: "transparent"
							}
						}]
					}
				}
			});
		});
	</script>
	
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			var date = new Date(Date.now() - 5 * 24 * 60 * 60 * 1000);
			var defaultDate = date.getUTCFullYear() + "-" + (date.getUTCMonth() + 1) + "-" + date.getUTCDate();
			document.getElementById("datetimepicker-dashboard").flatpickr({
				inline: true,
				prevArrow: "<span title=\"Previous month\">&laquo;</span>",
				nextArrow: "<span title=\"Next month\">&raquo;</span>",
				defaultDate: defaultDate
			});
		});
	</script>
