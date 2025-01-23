<script src="{{ ('style/static/js/app.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
	const buttons = document.querySelectorAll('.btn-group .btn');
  
	buttons.forEach(button => {
	  button.addEventListener('click', function() {
		console.log("Tombol diklik: ", this.textContent);
		buttons.forEach(btn => btn.classList.remove('active'));
  
		this.classList.add('active');
	  });
	});
</script>

<script>
	document.addEventListener("DOMContentLoaded", function() {
		const isMobile = window.innerWidth <= 600;
		var ctx = document.getElementById("chartjs-dashboard-line").getContext("2d");

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
					pointRadius: function(context) {
						return context.dataIndex % 2 === 0 ? 3 : 0;
					},
					data: [150000, 140000, 130000, 135000, 145000, 150000, 170000, 200000, 220000, 240000, 260000, 270000]
				}, {
					label: "Comparison",
					fill: false,
					backgroundColor: 'transparent',
					borderColor: 'rgba(204, 204, 204, 1)',
					borderWidth: 1,
					borderDash: [8,8],
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
		new Chart(document.getElementById("chartjs-dashboard-pie"), {
			type: "pie",
			data: {
				labels: ["Shopee", "Tokopedia", "Deepublish", "Lazada", "Bukalapak", "OLX"],
				datasets: [{
					data: [48, 12, 20, 9, 6, 5],
					backgroundColor: [
						'#F1582E',
						'#469546', 
						'#BCBCBC',
						'#0F0890', 
						'#E31F51', 
 						'#3A77FF', 
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

		function updateTitle(newTitle) {
			document.querySelector(".title-chart-bar").textContent = newTitle;
		}

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
				e.preventDefault();
				const type = item.getAttribute('data-type');
				updateChart(type);

				const dropdownButton = document.getElementById('dropdownMenuSmall');
				dropdownButton.innerHTML = item.textContent + ' <i class="bi bi-chevron-down ms-1"></i>';

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
	document.getElementById("togglePassword").addEventListener("click", function () {
		const passwordField = document.getElementById("password");
		const eyeIcon = this;

		if (passwordField.type === "password") {
			passwordField.type = "text";
			eyeIcon.classList.remove("bi-eye");
			eyeIcon.classList.add("bi-eye-slash");
		} else {
			passwordField.type = "password";
			eyeIcon.classList.remove("bi-eye-slash");
			eyeIcon.classList.add("bi-eye");
		}
	});

	document.getElementById("togglePasswordConfirmation").addEventListener("click", function () {
		const passwordConfirmationField = document.getElementById("password_confirmation");
		const eyeIcon = this;

		if (passwordConfirmationField.type === "password") {
			passwordConfirmationField.type = "text"; 
			eyeIcon.classList.remove("bi-eye");
			eyeIcon.classList.add("bi-eye-slash");
		} else {
			passwordConfirmationField.type = "password"; 
			eyeIcon.classList.remove("bi-eye-slash");
			eyeIcon.classList.add("bi-eye");
		}
	});
</script>

<!-- Script Toko -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const editTokoModal = document.getElementById('editTokoModal');
    editTokoModal.addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget;
        const id = button.getAttribute('data-id');
        const nama = button.getAttribute('data-nama');
        const marketplace = button.getAttribute('data-marketplace');
        const isActive = button.getAttribute('data-status');

        const form = document.getElementById('editTokoForm');
        form.action = `/toko/${id}`;
        document.getElementById('edit_nama_toko').value = nama;
        document.getElementById('edit_marketplace').value = marketplace;
        document.getElementById('edit_is_active').value = isActive;
    });

    document.addEventListener('DOMContentLoaded', function () {
        const deleteModal = document.getElementById('confirmDeleteModal');
        deleteModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');
            const nama = button.getAttribute('data-nama');

            document.getElementById('deleteTokoName').textContent = nama;

            const form = document.getElementById('deleteForm');
            form.action = `/toko/${id}`;
        });
    });

    const tokoForm = document.getElementById('tokoForm');
    tokoForm.addEventListener('submit', function(event) {
        event.preventDefault();
        this.submit();
    });

    const editTokoForm = document.getElementById('editTokoForm');
    editTokoForm.addEventListener('submit', function(event) {
        event.preventDefault(); 
        this.submit();
    });

    if (document.querySelector('.toast-success')) {
        const toast = new bootstrap.Toast(document.querySelector('.toast-success'));
        toast.show();
    }

    document.addEventListener('DOMContentLoaded', function () {
        const newRow = document.querySelector('.new-toko-row');
        if (newRow) {
            setTimeout(() => {
                newRow.classList.remove('new-toko-row');
            }, 10000);
        }
    });
});
</script>

<!-- Script Buku -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const newRow = document.querySelector('.new-toko-row');
        if (newRow) {
            setTimeout(() => {
                newRow.classList.remove('new-toko-row');
            }, 10000);
        }
    });
</script>

<!-- Script Bills -->
<script>
	document.addEventListener('DOMContentLoaded', function () {
    	const checkboxes = document.querySelectorAll('.order-checkbox');
    	const totalTagihanElement = document.getElementById('totalTagihan');
    	const payButton = document.getElementById('payButton');

    	function updateTotalTagihan() {
        	let totalTagihan = 0;

        	checkboxes.forEach(checkbox => {
            	if (checkbox.checked) {
                	const grandTotal = parseFloat(checkbox.dataset.total);
                	if (!isNaN(grandTotal)) {
                    	totalTagihan += grandTotal;
                	} else {
                    	console.error(`Grand total invalid untuk checkbox ${checkbox.id}`);
                	}
            	}
        	});

        	console.log(`Total tagihan terhitung: ${totalTagihan}`); // Debugging
        	totalTagihanElement.textContent = new Intl.NumberFormat('id-ID', {
            	style: 'currency',
            	currency: 'IDR',
            	minimumFractionDigits: 0,
        	}).format(totalTagihan).replace('Rp', '');

        	payButton.disabled = totalTagihan === 0;
    	}

		checkboxes.forEach(checkbox => {
			checkbox.addEventListener('change', function () {
				console.log(`Checkbox ${checkbox.id} diubah, checked: ${checkbox.checked}`);
				updateTotalTagihan();
			});
		});

		updateTotalTagihan();
	});

	document.addEventListener('DOMContentLoaded', function () {
		console.log('DOM Loaded');
		const form = document.getElementById('paymentForm');
		if (form) {
			console.log('Form ditemukan');
			form.addEventListener('submit', function (e) {
				e.preventDefault();
				console.log('Submit event tertangkap');
						
				Swal.fire({
					icon: 'success',
					title: 'Berhasil!',
					text: 'Pembayaran Anda berhasil dikonfirmasi, dan dipindahkan ke halaman riwayat pembayaran.',
					showConfirmButton: false,
					timer: 3000,
					customClass: {
						popup: 'sweetalert',
						confirmButton: 'buttonallert'
					}
				}).then(() => {
					form.submit();
				});
			});
		}
	});
</script>