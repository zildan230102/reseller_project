<style>
	.footer {
		background-color: #f5f5f5;
		padding: 20px 0 10px 0 !important;
		min-height: 100px;
		color: #333;
		font-size: 14px;
		border-top: 1px solid #ccc;
		box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
		width: 100%;
		flex: 0 0 auto;
		position: relative;
		bottom: 0;
		margin-top: 20px;
	}

	.footer-container {
		display: flex;
		justify-content: flex-start;
		max-width: 1200px;
		margin: 0 auto;
		padding: 0 20px;
		gap: 10px;
		flex-wrap: wrap;
	}

	.footer-section {
		flex: 1;
		margin-bottom: 10px;
	}

	.logo-deepublish {
		width: 180px; 
		margin-bottom: 10px; 
	}

	.company-info h4 {
		margin-top: 0; 
		font-size: 16px;
		color: #ff6600; 
	}

	.footer-section h4 {
		font-size: 16px;
		margin-bottom: 10px;
		color: #ff8c42;
	}

	.footer-section p, .footer-section ul {
		margin: 0;
		padding: 0;
	}

	.footer-section ul {
		list-style: none;
	}

	.footer-section ul li {
		margin-bottom: 5px;
	}

	.footer-section ul li a {
		color: #333;
		text-decoration: none;
		transition: color 0.3s;
	}

	.footer-section ul li a:hover {
		color: #ff6600;
	}

	.footer-section.company-info {
		flex: none; 
		width: 400px; 
		font-size: 14px;
		margin-right: 10px;
	}

	.footer-section.contact-info {
		flex: none; 
		width: 350px; 
		font-size: 14px;
		margin-left: 20px;
		margin-right: 0;
	}

	.footer-section.social-media {
		margin-left: 20px; 
	}

	.social-media h4 {
		font-size: 16px;
		margin-bottom: 10px;
		color: #ff8c42;
	}

	.social-icons {
		display: flex;
		gap: 10px;
	}

	.social-icon {
		width: 40px;
		height: 40px;
		border-radius: 50%;
		color: white;
		display: flex;
		align-items: center;
		justify-content: center;
		font-size: 18px;
		transition: background-color 0.3s;
		text-decoration: none;
		background-color: #ff9800;
		line-height: 1;
	}

	.social-icon:hover {
		opacity: 0.8;
		color: #ff6600;
	}

	.contact-info i {
		color: #ff8c42;
	}

	.footer-bottom {
		text-align: center;
		padding-top: 20px;
		font-size: 12px;
		color: #818181;
		text-align: center;
		width: 100%;
		margin: 0 auto;
	}
	html, body {
		height: auto;
		margin: 0;
		padding: 0;
	}
	.container {
		display: block;
		padding-bottom: 40px;
	}
	.content {
		padding: 20px;
	}

	/* Responsive Design */
	@media (max-width: 676px) {
		.footer-container {
			flex-direction: column;
			text-align: center;
			gap: 0px;
		}
		.footer-section {
			text-align: center;
        	min-width: 100%;
			margin-bottom: 10px;
		}
		.logo-deepublish {
			width: 120px;
		}
		.footer-section h4 {
			font-size: 14px;
			margin-bottom: 4px;
			color: #ff8c42;
		}
		.footer-section.company-info {
			max-width: 200px; 
			font-size: 12px;
			margin-right: 0px;
		}
		.footer-section ul li {
			font-size: 12px;
			margin-bottom: 0px;
		}
		.footer-section.contact-info {
			font-size: 12px;
			margin-left: 0px;
			max-width: 200px;
		}
		.footer-section.social-media {
			margin-left: 0px;
			margin-bottom: 16px;
		}
		.social-icon {
			width: 30px;
			height: 30px;
			line-height: 1;
		}
		.social-icons {
			justify-content: center;
			gap: 5px;
		}
		.social-icons .social-icon {
			font-size: 14px; 
		}
		.footer-bottom {
			font-size: 10px;
			margin-top: 0px;
			max-width: 300px;
			text-align: center;
			max-width: 300px;
			justify-content: center;
			padding: 0px 10px 10px 10px;
		}
	}

	@media (min-width: 767px) and (max-width: 1024px) {
		.footer-section.company-info {
			max-width: 300px; 
			font-size: 14px;
			margin-left: 40px;
		}
		.footer-section.contact-info {
			max-width: 300px;
			margin-top: 65px;
		}
		.footer-section.social-media {
			margin-left: 0px;
			margin-top: 0;
		}
		.social-media {
			display: flex;
			flex-direction: column;
			align-items: center;
		}
		.social-icons {
			justify-content: center;
		}
		.footer-bottom {
			margin-bottom: 30px;
			padding-top: 0;
		}
	}

	@media (min-width: 768px) and (max-width: 1024px) {
		.footer-section.company-info {
			width: 320px; 
			font-size: 14px;
			margin-left: 40px;
		}
		.footer-section.contact-info {
			margin-top: 65px;
		}
		.footer-section.social-media {
			margin-left: 0px;
			margin-top: 0;
		}
		.social-media {
			display: flex;
			flex-direction: column;
			align-items: center;
		}
		.social-icons {
			justify-content: center;
		}
		.footer-bottom {
			margin-bottom: 30px;
			padding-top: 0;
		}
	}
	@media (max-width: 1180px) {
		/* .footer-container {
			padding: 0 0 0 40px;
		} */
	}
</style>

<footer class="footer">
    <div class="footer-container">
        <!-- Company Info Section -->
        <div class="footer-section company-info">
			<img src="{{ ('style/src/img/icons/d2.png') }}" alt="Logo Deepublish" class="logo-deepublish">
            <h4>Penerbit Deepublish</h4>
            <p>Penerbit Deepublish adalah penerbit buku yang memfokuskan penerbitannya dalam bidang pendidikan, 
			pernah meraih penghargaan sebagai Penerbit Terbaik pada Tahun 2017 oleh Perpustakaan Nasional Republik Indonesia (PNRI).</p>
        </div>

        <!-- Contact Info Section -->
        <div class="footer-section contact-info">
            <h4>Contact Us</h4>
            <p><i class="bi bi-envelope"></i> adminkonsultan@deepublish.co.id</p>
			<p><i class="bi bi-envelope"></i> cs@deepublish.co.id</p>
            <p><i class="bi bi-telephone"></i> (0274) 283-6082</p>
            <p><i class="bi bi-geo-alt"></i> Jl.Rajawali G. Elang 6 No 3 RT/RW 005/033, Drono, Sardonoharjo, Ngaglik, Sleman, D.I. Yogyakarta 55581</p>
        </div>

		<!-- Social Media Section -->
		<div class="footer-section social-media">
			<h4>Follow Us</h4>
			<div class="social-icons">
				<a href="https://facebook.com" target="_blank" class="social-icon facebook"><i class="bi bi-facebook"></i></a>
				<a href="https://twitter.com" target="_blank" class="social-icon twitter-x"><i class="bi bi-twitter"></i></a>
				<a href="https://youtube.com" target="_blank" class="social-icon youtube"><i class="bi bi-youtube"></i></a>
				<a href="https://instagram.com" target="_blank" class="social-icon instagram"><i class="bi bi-instagram"></i></i></a>
				<a href="https://linkedin.com" target="_blank" class="social-icon linkedin"><i class="bi bi-linkedin"></i></a>
				<a href="https://github.com" target="_blank" class="social-icon github"><i class="bi bi-github"></i></a>
			</div>
		</div>
    </div>
	<div class="footer-bottom">
        <p>&copy; 2024 All Rights Reserved | Penerbit Buku Deepublish - CV. Budi Utama</p>
	</div>
</footer>


</body>
</html>