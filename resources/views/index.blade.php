<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Informasi Gangguan | UP3 Grobogan</title>

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
        }

        .navbar {
            background-color: #2563eb;
        }

        .navbar-brand {
            font-weight: bold;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 0.3em 0.8em;
            border-radius: 0.4em;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background-color: #2563eb !important;
            color: white !important;
        }
    </style>
</head>

<body>
    <!-- 🌐 NAVBAR -->
    <nav class="navbar navbar-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#">UP3 Grobogan</a>
            <div>
                <button id="navInput" class="btn btn-outline-light btn-sm me-2 active">Input Gangguan</button>
                <button id="navData" class="btn btn-outline-light btn-sm">Data Gangguan</button>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <!-- 🧾 FORM INPUT -->
        <div id="sectionInput">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h4 class="text-center text-primary mb-4">Form Laporan Gangguan</h4>
                    <form id="formGangguan">
                        <div class="mb-3">
                            <label class="form-label">Nama Penyulang</label>
                            <input type="text" id="penyulang" class="form-control" placeholder="Contoh: Klambu 02"
                                required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Keypoint / Lokasi Gangguan</label>
                            <input type="text" id="keypoint" class="form-control"
                                placeholder="Contoh: Tiang 32 - Dusun Krajan" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Keterangan Tambahan</label>
                            <textarea id="keterangan" class="form-control" rows="3" placeholder="Deskripsi gangguan..." required></textarea>
                        </div>
                        <button type="submit" class="btn btn-success w-100">Kirim ke WhatsApp</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- 📋 DATA GANGGUAN -->
        <div id="sectionData" class="d-none">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h4 class="text-center text-primary mb-4">Data Gangguan</h4>

                    <div class="table-responsive">
                        <table id="tabelGangguan" class="table table-striped table-bordered align-middle"
                            style="width:100%">
                            <thead class="table-primary">
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
        </div>
    </div>

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

            // ✅ Aktifkan DataTables
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
</body>

</html>
