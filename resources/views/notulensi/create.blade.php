<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="AdminKit">
    <meta name="keywords"
        content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <title>Form Notulensi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fa;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            max-width: 800px;
            margin: 20px auto;
            background-color: white;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h3 {
            color: #333;
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
        }
        input[type="text"], input[type="date"], input[type="time"], textarea, input[type="file"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        textarea {
            resize: vertical;
            min-height: 80px;
        }
        button {
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button[type="button"] {
            background-color: #007BFF;
        }
        button[type="submit"] {
            background-color: #28a745;
        }
        .form-section {
            margin-bottom: 20px;
        }
        .daftar-hadir div, .agenda div {
            margin-bottom: 20px;
        }
        .add-button {
            margin: 15px 0;
        }
        .section-description {
            font-style: italic;
            color: #555;
            margin-bottom: 20px;
        }
        @media (max-width: 768px) {
            .container {
                width: 95%;
                padding: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <form action="/notulensi" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-section">
                <h3>Informasi Rapat</h3>
                <label for="tanggal">Tanggal:</label>
                <input type="date" name="tanggal" id="tanggal" required>
                
                <label for="waktu">Waktu:</label>
                <input type="time" name="waktu" id="waktu" required>
                
                <label for="tempat">Tempat:</label>
                <input type="text" name="tempat" id="tempat" required>
                
                <label for="pemimpin_musyawarah">Pemimpin Musyawarah:</label>
                <input type="text" name="pemimpin_musyawarah" id="pemimpin_musyawarah" required>

                <label for="pimpinan_paraf">Paraf Pimpinan:</label>
                <input type="file" name="pimpinan_paraf" id="pimpinan_paraf">
                
                <label for="notulis">Notulis:</label>
                <input type="text" name="notulis" id="notulis" required>

                <label for="notulis_paraf">Paraf Notulis:</label>
                <input type="file" name="notulis_paraf" id="notulis_paraf">
            </div>

            <div class="form-section" id="daftar-hadir">
                <h3>Daftar Hadir</h3>
                <p class="section-description">Isilah nama, jabatan, dan beri paraf pada daftar hadir. Klik "Tambah Hadir" untuk menambah peserta lainnya.</p>
                <div id="hadir-0">
                    <label>Nama:</label>
                    <input type="text" name="daftar_hadir[0][nama]" required>
                    
                    <label>Jabatan:</label>
                    <input type="text" name="daftar_hadir[0][jabatan]" required>
                    
                    <label>Paraf:</label>
                    <input type="file" name="daftar_hadir[0][paraf]">
                </div>
            </div>
            <button type="button" class="add-button" onclick="addHadir()">Tambah Hadir</button>

            <div class="form-section" id="agenda">
                <h3>Agenda Rapat</h3>
                <p class="section-description">Isilah setiap agenda beserta pembahasan, keputusan, dan keterangan yang relevan. Klik "Tambah Agenda" untuk menambah agenda lainnya.</p>
                <div id="agenda-0">
                    <label>Agenda:</label>
                    <input type="text" name="agenda[0][judul_agenda]" required>
                    
                    <label>Pembahasan:</label>
                    <textarea name="agenda[0][keputusan][0][pembahasan]" required></textarea>
                    
                    <label>Keputusan:</label>
                    <textarea name="agenda[0][keputusan][0][keputusan_bersama]" required></textarea>
                    
                    <label>Keterangan:</label>
                    <div>
                        <label><input type="radio" name="agenda[0][keterangan]" value="eksekusi" required> Eksekusi</label>
                        <label><input type="radio" name="agenda[0][keterangan]" value="eskalasi" required> Eskalasi</label>
                    </div>
                </div>
            </div>
            <button type="button" class="add-button" onclick="addAgenda()">Tambah Agenda</button>

            <button type="submit">Simpan</button>
        </form>
    </div>

    <script>
        let hadirIndex = 1;
        let agendaIndex = 1;

        function addHadir() {
            const container = document.getElementById('daftar-hadir');
            const div = document.createElement('div');
            div.id = `hadir-${hadirIndex}`;
            div.innerHTML = `
                <label>Nama:</label>
                <input type="text" name="daftar_hadir[${hadirIndex}][nama]" required>
                
                <label>Jabatan:</label>
                <input type="text" name="daftar_hadir[${hadirIndex}][jabatan]" required>
                
                <label>Paraf:</label>
                <input type="file" name="daftar_hadir[${hadirIndex}][paraf]">
            `;
            container.appendChild(div);
            hadirIndex++;
        }

        function addAgenda() {
            const container = document.getElementById('agenda');
            const div = document.createElement('div');
            div.id = `agenda-${agendaIndex}`;
            div.innerHTML = `
                <label>Agenda:</label>
                <input type="text" name="agenda[${agendaIndex}][judul_agenda]" required>
                
                <label>Pembahasan:</label>
                <textarea name="agenda[${agendaIndex}][keputusan][0][pembahasan]" required></textarea>
                
                <label>Keputusan:</label>
                <textarea name="agenda[${agendaIndex}][keputusan][0][keputusan_bersama]" required></textarea>
                
                <label>Keterangan:</label>
                <div>
                    <label><input type="radio" name="agenda[${agendaIndex}][keterangan]" value="eksekusi" required> Eksekusi</label>
                    <label><input type="radio" name="agenda[${agendaIndex}][keterangan]" value="eskalasi" required> Eskalasi</label>
                </div>
            `;
            container.appendChild(div);
            agendaIndex++;
        }
    </script>
</body>
</html>
