<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Informasi Gangguan | UP3 Grobogan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f5f6fa;
        }

        .navbar-brand {
            font-weight: bold;
            letter-spacing: 1px;
        }

        .card {
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        footer {
            background-color: #0d6efd;
            color: white;
            padding: 15px;
            text-align: center;
            margin-top: 50px;
        }
    </style>
</head>

<body>

    <!-- 🌐 NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">UP3 Grobogan</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" id="navInput" href="#">Input Gangguan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="navData" href="#">Data Gangguan</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- 🧾 KONTEN -->
    <div class="container my-5">

        <!-- FORM INPUT GANGGUAN -->
        <div id="sectionInput">
            <div class="card p-4">
                <h4 class="text-center mb-4 text-primary">Form Laporan Gangguan</h4>
                <form id="formGangguan">
                    <div class="mb-3">
                        <label for="penyulang" class="form-label">Nama Penyulang</label>
                        <input type="text" class="form-control" id="penyulang" placeholder="Contoh: Klambu 02"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="keypoint" class="form-label">Keypoint / Lokasi Gangguan</label>
                        <input type="text" class="form-control" id="keypoint"
                            placeholder="Contoh: Tiang 32 - Dusun Krajan" required>
                    </div>
                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan Tambahan</label>
                        <textarea class="form-control" id="keterangan" rows="3" placeholder="Deskripsi gangguan..." required></textarea>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-success btn-lg">Kirim ke WhatsApp</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- DATA GANGGUAN -->
        <div id="sectionData" class="d-none">
            <div class="card p-4">
                <h4 class="text-center mb-4 text-primary">Data Gangguan</h4>
                <!-- Form Import Excel -->
                <form action="{{ route('data-gangguan.importExcel') }}" method="POST" enctype="multipart/form-data" class="mb-4">
                    @csrf
                    <div class="input-group">
                        <input type="file" name="file" class="form-control" accept=".xlsx,.xls" required>
                        <button type="submit" class="btn btn-success">📂 Import Excel</button>
                    </div>
                </form>

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <table class="table table-striped table-bordered">
                    <thead class="table-primary">
                        <tr>
                            <th>No</th>
                            <th>Penyulang</th>
                            <th>Keypoint</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>

    </div>

    <!-- FOOTER -->
    <footer>
        <p>© 2025 PLN UP3 Grobogan — Sistem Informasi Gangguan</p>
    </footer>

    <!-- SCRIPT -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Navigasi antar menu
        const navInput = document.getElementById('navInput');
        const navData = document.getElementById('navData');
        const sectionInput = document.getElementById('sectionInput');
        const sectionData = document.getElementById('sectionData');

        navInput.addEventListener('click', function() {
            sectionInput.classList.remove('d-none');
            sectionData.classList.add('d-none');
            navInput.classList.add('active');
            navData.classList.remove('active');
        });

        navData.addEventListener('click', function() {
            sectionInput.classList.add('d-none');
            sectionData.classList.remove('d-none');
            navData.classList.add('active');
            navInput.classList.remove('active');
        });
    </script>

    <script>
        document.getElementById('formGangguan').addEventListener('submit', function(e) {
            e.preventDefault();

            const penyulang = document.getElementById('penyulang').value.trim();
            const keypoint = document.getElementById('keypoint').value.trim();
            const keterangan = document.getElementById('keterangan').value.trim();

            const pesan =
                `🟢 *Laporan Gangguan UP3 Grobogan*\n\n📡 *Penyulang:* ${penyulang}\n📍 *Keypoint:* ${keypoint}\n📝 *Keterangan:* ${keterangan}\n\n_Pelapor: Petugas Lapangan_`;

            const groupLink = `https://chat.whatsapp.com/Ctyt8rTFzdsBU9Ea5MGDLq?text=${pesan}`; // link grup kamu

            navigator.clipboard.writeText(pesan).then(() => {
                alert(
                    "✅ Pesan berhasil disalin.\nSilakan tempel (Ctrl+V) di grup WhatsApp setelah terbuka."
                );
                window.open(groupLink, "_blank");
            });
        });
    </script>

</body>

</html>
