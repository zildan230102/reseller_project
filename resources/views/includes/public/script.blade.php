<script src="{{ ('style/static/js/app.js') }}"></script>

	<script>
		document.addEventListener("DOMContentLoaded", function() {
			var ctx = document.getElementById("chartjs-dashboard-line").getContext("2d");
			// var gradient = ctx.createLinearGradient(0, 0, 0, 225);
			// gradient.addColorStop(0, "rgba(50, 115, 220, 0.3)");
			// gradient.addColorStop(1, "rgba(50, 115, 220, 0)");

			// Line chart
			new Chart(document.getElementById("chartjs-dashboard-line"), {
				type: "line",
				data: {
					labels: ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12"],
					datasets: [{
						label: "Sales ($)",
						fill: false,
						backgroundColor: 'trasnparant',
						borderColor:'rgba(50, 115, 220, 1)',
						pointBackgroundColor: "#FFFFFF",
						pointBorderColor: "#000000",
						pointBorderWidth: 1,
						pointRadius: function(context) { // Tambahkan function untuk pointRadius
							return context.dataIndex % 2 === 0 ? 3 : 0; // Return 3 jika index adalah genap, 0 jika ganjil
						},
						data: [150000, 140000, 130000, 135000, 145000, 150000, 170000, 200000, 220000, 240000, 260000, 270000]
					}, {
						label: "Comparison",
						fill: false,
						backgroundColor: 'transparent',
						borderColor: 'rgba(204, 204, 204, 1)',
						borderWidth: 1,
						borderDash: [8,8], // Create a dashed line
						pointBackgroundColor: "#FFFFFF",
						pointBorderColor: "transparant",
						pointBorderWidth: 0,
						pointRadius: 0,
						data: [160000, 130000, 140000, 130000, 140000, 160000, 150000, 170000, 180000, 190000, 200000, 210000]
					}]
				},
				options: {
					maintainAspectRatio: false,
					legend: {
						display: false
					},
					tooltips: {
						intersect: false,
						backgroundColor: 'rgba(0, 0, 0, 0.7)',
						bodyFontColor: '#fff',
						borderColor: '#fff',
						borderWidth: 1
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
							gridLines: {
								display: false
							},
							ticks: {
								display: true,
								fontColor: "#ccc"
							}
						}],
						yAxes: [{
							ticks: {
								stepSize: 50000,
								callback: function(value) { return 'Rp ' + value; },
								fontColor: "#ccc"
							},
							gridLines: {
								borderDash: [5,5],
								color: "#ccc"
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
