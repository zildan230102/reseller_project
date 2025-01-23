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
        .card {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
        }
        h3 {
            color: #333;
            margin-bottom: 15px;
            text-align: left;
        }
        label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
        }
        input[type="text"], input[type="date"], input[type="time"], textarea, input[type="file"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        textarea {
            resize: vertical;
            min-height: 80px;
        }
        .form-group input,
        .form-group textarea {
            flex: 1;
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            padding: 10px 15px;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .button-group {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-bottom: 20px;
        }
        button[type="button"] {
            background-color: #FFA500;
        }
        button[type="submit"] {
            background-color: #28a745;
        }

        .daftar-hadir div, .agenda div {
            margin-bottom: 20px;
        }

        .section-description {
            font-style: italic;
            color: #555;
            margin-bottom: 20px;
            margin-top: 0;
        }
        .form-section {
            width: 100%;
            max-width: 700px;
            margin: auto;
            display: flex;
            flex-direction: column;
        }

        .form-group {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            margin-left: 20px;
        }

        .form-group label {
            width:35%;
            margin-right: 10px;
            font-weight: bold;
        }

        .form-group input {
            flex: 1;
        }
        .radio-group {
            display: flex;
            gap: 20px;
            align-items: center; 
        }

        .radio-group label {
            display: flex;
            align-items: center;
            gap: 5px;
        }
        /* .separator {
            width: 100%;
            height: 1px; 
            background-color: #ccc;
            margin: 20px 0;
        } */
        
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

            
            <h2>Informasi Rapat</h3>
            <div class="card">
                <div class="form-section">
                    <div class="form-group">
                        <label for="tanggal">Tanggal:</label>
                        <input type="date" name="tanggal" id="tanggal" required>
                    </div>
                    <div class="form-group">
                        <label for="waktu">Waktu:</label>
                        <input type="time" name="waktu" id="waktu" required>
                    </div>
                    <div class="form-group">
                        <label for="tempat">Tempat:</label>
                        <input type="text" name="tempat" id="tempat" required>
                    </div>
                    <div class="form-group">
                        <label for="pemimpin_musyawarah">Pemimpin Musyawarah:</label>
                        <input type="text" name="pemimpin_musyawarah" id="pemimpin_musyawarah" required>
                    </div>
                    <div class="form-group">
                        <label for="pimpinan_paraf">Paraf Pimpinan:</label>
                        <input type="file" name="pimpinan_paraf" id="pimpinan_paraf">
                    </div>
                    <div class="form-group">
                        <label for="notulis">Notulis:</label>
                        <input type="text" name="notulis" id="notulis" required>
                    </div>
                    <div class="form-group">
                        <label for="notulis_paraf">Paraf Notulis:</label>
                        <input type="file" name="notulis_paraf" id="notulis_paraf">
                    </div>
                </div>
            </div>
            
            <h3>Daftar Hadir</h3>
                    <p class="section-description">Isilah nama, jabatan, dan beri paraf pada daftar hadir. Klik "Tambah Hadir" untuk menambah peserta lainnya.</p>
            <div class="card">
                <div class="form-section" id="daftar-hadir">
                    <div class="form-group" id="hadir-0">
                        <label>Nama:</label>
                        <input type="text" name="daftar_hadir[0][nama]" required>
                    </div>
                    <div class="form-group">
                        <label>Jabatan:</label>
                        <input type="text" name="daftar_hadir[0][jabatan]" required>
                    </div>
                    <div class="form-group">
                        <label>Paraf:</label>
                        <input type="file" name="daftar_hadir[0][paraf]">
                    </div>
                    <div class="button-group">
                        <button type="button" class="add-button" onclick="addHadir()">Tambah Hadir</button>
                    </div>
                </div>
            </div>
            
            <h3>Agenda Rapat</h3>
            <p class="section-description">Isilah setiap agenda beserta pembahasan, keputusan, dan keterangan yang relevan. Klik "Tambah Agenda" untuk menambah agenda lainnya.</p>
            <div class="card">
                <div class="form-section" id="agenda">
                   <div class="form-group" id="agenda-0">
                        <label>Agenda:</label>
                        <input type="text" name="agenda[0][judul_agenda]" required>
                    </div>
                    <div class="form-group">
                        <label>Pembahasan:</label>
                        <textarea name="agenda[0][keputusan][0][pembahasan]" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Keputusan:</label>
                        <textarea name="agenda[0][keputusan][0][keputusan_bersama]" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Keterangan:</label>
                        <div class="radio-group">
                            <label><input type="radio" name="agenda[0][keterangan]" value="eksekusi" required> Eksekusi</label>
                            <label><input type="radio" name="agenda[0][keterangan]" value="eskalasi" required> Eskalasi</label>
                        </div>
                    </div>
                    <div class="button-group">
                        <button type="button" class="add-button" onclick="addAgenda()">Tambah Agenda</button>
                    </div>
                </div>
            </div>
            
            {{-- <div class="separator"></div> --}}
                <div class="button-group">
                    <button type="submit" class="add-button">Simpan</button>
                </div>
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
        <div class="form-group">
            <label>Nama:</label>
            <input type="text" name="daftar_hadir[${hadirIndex}][nama]" required>
        </div>
        <div class="form-group">
            <label>Jabatan:</label>
            <input type="text" name="daftar_hadir[${hadirIndex}][jabatan]" required>
        </div>
        <div class="form-group">
            <label>Paraf:</label>
            <input type="file" name="daftar_hadir[${hadirIndex}][paraf]">
        </div>
    `;
    container.insertBefore(div, container.querySelector('.button-group'));
    hadirIndex++;
}

function addAgenda() {
    const container = document.getElementById('agenda');
    const div = document.createElement('div');
    div.id = `agenda-${agendaIndex}`;
    div.innerHTML = `
        <div class="form-group">
            <label>Agenda:</label>
            <input type="text" name="agenda[${agendaIndex}][judul_agenda]" required>
        </div>
        <div class="form-group">
            <label>Pembahasan:</label>
            <textarea name="agenda[${agendaIndex}][keputusan][0][pembahasan]" required></textarea>
        </div>
        <div class="form-group">
            <label>Keputusan:</label>
            <textarea name="agenda[${agendaIndex}][keputusan][0][keputusan_bersama]" required></textarea>
        </div>
        <div class="form-group">   
            <label>Keterangan:</label>
            <div class="radio-group">
                <label><input type="radio" name="agenda[${agendaIndex}][keterangan]" value="eksekusi" required> Eksekusi</label>
                <label><input type="radio" name="agenda[${agendaIndex}][keterangan]" value="eskalasi" required> Eskalasi</label>
            </div>
        </div>
    `;
    container.insertBefore(div, container.querySelector('.button-group'));
    agendaIndex++;
}
</script>
</body>
</html>
