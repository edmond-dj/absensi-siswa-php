<?php require_once 'config.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Absensi Siswa</title>
  <style>
    * { margin:0; padding:0; box-sizing:border-box; font-family:Arial, sans-serif; }
    body { background: linear-gradient(135deg, #4facfe, #00f2fe); min-height:100vh; padding:20px; }
    .container { max-width:900px; margin:auto; background:white; border-radius:16px; padding:25px; box-shadow:0 10px 30px rgba(0,0,0,0.2); }
    h1 { text-align:center; margin-bottom:20px; }
    .input-area { display:flex; gap:10px; margin:20px 0; }
    input[type=text] { flex:1; padding:12px; border:1px solid #ddd; border-radius:8px; }
    button { padding:12px 20px; background:#28a745; color:white; border:none; border-radius:8px; cursor:pointer; }
    .student-item {
      display:flex; align-items:center; padding:12px; background:#f8f9fa; margin:8px 0; 
      border-radius:10px; gap:10px;
    }
    .status-btn {
      padding:8px 16px; border:none; border-radius:8px; cursor:pointer; font-size:14px;
    }
    .hadir { background:#28a745; color:white; }
    .sakit { background:#ffc107; color:black; }
    .izin  { background:#17a2b8; color:white; }
    .alfa  { background:#dc3545; color:white; }
    .summary { margin-top:30px; padding:15px; background:#e7f3ff; border-radius:10px; text-align:center; font-weight:bold; }
  </style>
</head>
<body>
  <div class="container">
    <h1>📋 Absensi Siswa</h1>
    
    <div class="input-area">
      <input type="text" id="nama" placeholder="Nama siswa baru...">
      <button onclick="tambahSiswa()">+ Tambah Siswa</button>
    </div>

    <input type="date" id="tanggal" style="margin-bottom:15px; padding:10px;">

    <div id="daftarSiswa"></div>
    <div class="summary" id="summary"></div>
  </div>

  <script>
    const tanggalInput = document.getElementById('tanggal');
    tanggalInput.valueAsDate = new Date();

    function loadData() {
      fetch('get_data.php?tanggal=' + tanggalInput.value)
        .then(r => r.text())
        .then(html => document.getElementById('daftarSiswa').innerHTML = html)
        .then(() => hitungSummary());
    }

    function tambahSiswa() {
      const nama = document.getElementById('nama').value.trim();
      if (!nama) return alert("Nama tidak boleh kosong!");

      fetch('simpan_siswa.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: 'nama=' + encodeURIComponent(nama)
      }).then(() => {
        document.getElementById('nama').value = '';
        loadData();
      });
    }

    function ubahAbsensi(id, status) {
      fetch('simpan_absensi.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: `id=${id}&status=${status}&tanggal=${tanggalInput.value}`
      }).then(() => loadData());
    }

    function hitungSummary() {
      // Summary dihitung di PHP
    }

    tanggalInput.addEventListener('change', loadData);
    window.onload = loadData;
  </script>
</body>
</html>