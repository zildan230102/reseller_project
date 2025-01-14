<script src="{{ ('style/static/js/app.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- jQuery dan Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
	// Seleksi semua tombol
	const buttons = document.querySelectorAll('.btn-group .btn');
  
	// Tambahkan event listerner untuk setiap tombol
	buttons.forEach(button => {
	  button.addEventListener('click', function() {
		console.log("Tombol diklik: ", this.textContent);
		// Hapus kelas 'active' dari semua tombol
		buttons.forEach(btn => btn.classList.remove('active'));
  
		// Tambahkan kelas 'active' hanya ke tombol yang diklik
		this.classList.add('active');
	  });
	});
  </script>
  
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			const isMobile = window.innerWidth <= 600;
			var ctx = document.getElementById("chartjs-dashboard-line").getContext("2d");

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
								fontColor: "#ccc",
								maxRotation: 0,
								minRotation: 0,
								autoSkip: !isMobile,
								maxTicksLimit: isMobile ? 6 : 12,
								callback: function(value) {
									if (isMobile) {
										return [1, 3, 5, 7, 9, 11].includes(parseInt(value)) ? value.toString() : null;
									}
								return value;
								}
							}
						}],
						yAxes: [{
							ticks: {
								stepSize: 50000,
								callback: function(value) { return 'Rp' + value; },
								fontColor: "#ccc",
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
    const chart = new Chart(document.getElementById("chartjs-dashboard-bar"), {
        type: "bar",
        data: {
            labels: ["Lazada", "Shopee", "Tokopedia", "OLX", "Web Deepublish", "Bukalapak"],
            datasets: [{
                label: "This month",
                backgroundColor: ['#0F0890', '#F1582E', '#469546', '#3A77FF', '#BCBCBC', '#E31F51'],
                data: [9, 48, 12, 5, 20, 6],
                barPercentage: 0.99,
                categoryPercentage: 0.7
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
							},
							ticks: {
								display: window.innerWidth > 600
							}
						}]
					}
				}
    });

	

    // Helper function to update chart title
    function updateTitle(newTitle) {
        document.querySelector(".title-chart-bar").textContent = newTitle;
    }

    // Helper function to update chart data
    function updateChart(type) {
        switch (type) {
            case "marketplace":
                chart.data.labels = ["Lazada", "Shopee", "Tokopedia", "OLX", "Web Deepublish", "Bukalapak"];
                chart.data.datasets[0].data = [10, 50, 15, 7, 25, 8];
                updateTitle("Marketplace dengan Penjualan Terbanyak Bulan Ini");
                break;
            case "toko":
                chart.data.labels = ["Toko 1", "Toko 2", "Toko 3", "Toko 4", "Toko 5", "Toko 6"];
                chart.data.datasets[0].data = [15, 30, 35, 40, 50, 60];
                updateTitle("Toko dengan Penjualan Terbanyak Bulan Ini");
                break;
            case "buku":
                chart.data.labels = ["Buku 1", "Buku 2", "Buku 3", "Buku 4", "Buku 5", "Buku 6"];
                chart.data.datasets[0].data = [10, 20, 25, 30, 45, 60];
                updateTitle("Buku dengan Penjualan Terbanyak Bulan Ini");
                break;
            default:
                console.error(`Unknown type: ${type}`);
        }
        chart.update();
    }

    // Event listeners untuk tombol
    document.getElementById('marketplace-btn').addEventListener('click', () => {
        updateChart('marketplace');
        setActiveButton('marketplace-btn');
    });

    document.getElementById('btn-toko').addEventListener('click', () => {
    updateChart('toko');
    setActiveButton('btn-toko');
    });

    document.getElementById('buku-btn').addEventListener('click', () => {
        updateChart('buku');
        setActiveButton('buku-btn');
    });

    function setActiveButton(activeId) {
        document.querySelectorAll('.btn-group-desktop .btn').forEach(btn => {
            btn.classList.remove('active');
        });
        document.getElementById(activeId).classList.add('active');
    }

	document.querySelectorAll('#dropdownMenuSmall + .dropdown-menu .dropdown-item').forEach(item => {
    item.addEventListener('click', (e) => {
        e.preventDefault(); // Mencegah default
        const type = item.getAttribute('data-type'); // Ambil data tipe
        updateChart(type); // Perbarui chart sesuai kategori

        // Perbarui teks tombol dropdown
        const dropdownButton = document.getElementById('dropdownMenuSmall');
        dropdownButton.innerHTML = item.textContent + ' <i class="bi bi-chevron-down ms-1"></i>';

        // Tutup dropdown secara paksa
        const dropdownMenu = bootstrap.Dropdown.getOrCreateInstance(dropdownButton);
        setTimeout(() => dropdownMenu.hide(), 150);
    });
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

	<script>
		// Toggle untuk field "Password"
		document.getElementById("togglePassword").addEventListener("click", function () {
			const passwordField = document.getElementById("password");
			const eyeIcon = this;

			// Toggle visibility
			if (passwordField.type === "password") {
				passwordField.type = "text"; // Ubah menjadi teks
				eyeIcon.classList.remove("bi-eye"); // Ganti ikon
				eyeIcon.classList.add("bi-eye-slash");
			} else {
				passwordField.type = "password"; // Ubah menjadi password
				eyeIcon.classList.remove("bi-eye-slash");
				eyeIcon.classList.add("bi-eye");
			}
		});

		// Toggle untuk field "Konfirmasi Password"
		document.getElementById("togglePasswordConfirmation").addEventListener("click", function () {
			const passwordConfirmationField = document.getElementById("password_confirmation");
			const eyeIcon = this;

			// Toggle visibility
			if (passwordConfirmationField.type === "password") {
				passwordConfirmationField.type = "text"; // Ubah menjadi teks
				eyeIcon.classList.remove("bi-eye"); // Ganti ikon
				eyeIcon.classList.add("bi-eye-slash");
			} else {
				passwordConfirmationField.type = "password"; // Ubah menjadi password
				eyeIcon.classList.remove("bi-eye-slash");
				eyeIcon.classList.add("bi-eye");
			}
		});
	</script>
