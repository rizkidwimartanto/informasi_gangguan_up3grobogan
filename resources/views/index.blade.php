<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Informasi Gangguan | UP3 Grobogan</title>

    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- ✅ Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- ✅ jQuery & DataTables -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>

    <style>
        body {
            background-color: #f5f7fa;
            font-family: "Segoe UI", sans-serif;
        }

        .navbar {
            background-color: #2563eb;
        }

        .navbar-brand {
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .btn-outline-light.active {
            background-color: #ffffff;
            color: #2563eb !important;
            font-weight: 600;
        }

        .card {
            border: none;
            border-radius: 0.75rem;
        }

        .card-body {
            padding: 2rem;
        }

        .form-label {
            font-weight: 500;
        }

        /* Pagination styling (DataTables) */
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 0.3em 0.8em;
            border-radius: 0.4em;
            margin: 0 2px;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background-color: #2563eb !important;
            color: white !important;
        }

        footer {
            font-size: 0.9rem;
            letter-spacing: 0.3px;
        }
    </style>
</head>

<body>
    <!-- 🌐 NAVBAR -->
    <nav class="navbar navbar-dark shadow-sm">
        <div class="container d-flex justify-content-between align-items-center">
            <a class="navbar-brand" href="#">UP3 Grobogan</a>
            <div class="d-flex gap-2">
                <button id="navInput" class="btn btn-outline-light btn-sm active">Input Gangguan</button>
                <button id="navData" class="btn btn-outline-light btn-sm">Data Gangguan</button>
            </div>
        </div>
    </nav>

    <main class="container my-5">
        <!-- 🧾 FORM INPUT -->
        <section id="sectionInput">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h4 class="text-center text-primary mb-4">Form Laporan Gangguan</h4>
                    <form id="formGangguan">
                        <div class="mb-3">
                            <label for="penyulang" class="form-label">Nama Penyulang</label>
                            <select name="penyulang" id="penyulang" class="form-select select2" required>
                                <option value="" disabled selected>Pilih Penyulang</option>
                                @foreach ($penyulang as $p)
                                    <option value="{{ $p->penyulang }}">{{ $p->penyulang }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="keypoint" class="form-label">Keypoint / Lokasi Gangguan</label>
                            <select name="keypoint" id="keypoint" class="form-select select2" required>
                                <option value="" disabled selected>Pilih Keypoint</option>
                                @foreach ($keypoint as $k)
                                    <option value="{{ $k->keypoint }}">{{ $k->keypoint }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success w-100 fw-semibold">Kirim ke WhatsApp</button>
                    </form>
                </div>
            </div>
        </section>

        <!-- 📋 DATA GANGGUAN -->
        <section id="sectionData" class="d-none">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h4 class="text-center text-primary mb-4">Data Gangguan</h4>

                    <form action="{{ route('data-gangguan.importExcel') }}" method="POST" enctype="multipart/form-data"
                        class="mb-3 d-flex align-items-center gap-2">
                        @csrf
                        <input type="file" name="file" class="form-control" accept=".xlsx, .xls" required>
                        <button class="btn btn-primary" type="submit">Import Excel</button>
                    </form>

                    <div class="table-responsive">
                        <table id="tabelGangguan" class="table table-striped table-bordered align-middle"
                            style="width:100%">
                            <thead class="table-primary text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Nihil</th>
                                    <th>Penyulang</th>
                                    <th>Keypoint</th>
                                    <th>Jumlah Trafo</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1; @endphp
                                @foreach ($data_gangguan as $gangguan)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $gangguan->nihil }}</td>
                                        <td>{{ $gangguan->penyulang }}</td>
                                        <td>{{ $gangguan->keypoint }}</td>
                                        <td>{{ $gangguan->jumlah_trafo }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- FOOTER -->
    <footer class="bg-primary text-white text-center py-3 mt-5">
        © 2025 PLN UP3 Grobogan — Sistem Informasi Gangguan
    </footer>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // ✅ Toggle Section
            const navInput = document.getElementById("navInput");
            const navData = document.getElementById("navData");
            const sectionInput = document.getElementById("sectionInput");
            const sectionData = document.getElementById("sectionData");

            navInput.addEventListener("click", () => {
                sectionInput.classList.remove("d-none");
                sectionData.classList.add("d-none");
                navInput.classList.add("active");
                navData.classList.remove("active");
            });

            navData.addEventListener("click", () => {
                sectionInput.classList.add("d-none");
                sectionData.classList.remove("d-none");
                navData.classList.add("active");
                navInput.classList.remove("active");
            });

            // ✅ DataTables
            $('#tabelGangguan').DataTable({
                pageLength: 10,
                lengthMenu: [5, 10, 25, 50],
                language: {
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ entri",
                    info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                    paginate: {
                        previous: "Prev",
                        next: "Next"
                    },
                    zeroRecords: "Tidak ada data ditemukan"
                }
            });
        });
    </script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            // Aktifkan Select2 pada kedua select
            $('#penyulang').select2({
                placeholder: "Cari atau pilih penyulang...",
                allowClear: true
            });

            $('#keypoint').select2({
                placeholder: "Cari atau pilih keypoint...",
                allowClear: true
            });
        });
    </script>
    <script>
        document.getElementById('formGangguan').addEventListener('submit', function(e) {
            e.preventDefault();

            const penyulang = document.getElementById('penyulang').value.trim();
            const keypoint = document.getElementById('keypoint').value.trim();

            const pesan =
                `🟢 *Laporan Gangguan UP3 Grobogan*\n\n📡 *Penyulang:* ${penyulang}\n📍 *Keypoint:* ${keypoint}\n📝Pelapor: Petugas Lapangan_`;

            const groupLink = `https://chat.whatsapp.com/Ctyt8rTFzdsBU9Ea5MGDLq`; // link grup kamu

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
