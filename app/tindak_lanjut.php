<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penjelasan Status</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f0f0f0;
            padding: 20px;
        }
        h1 {
            text-align: left; /* Mengubah perataan teks menjadi kiri */
            color: #333;
            margin-bottom: 20px; /* Mengurangi jarak bawah */
            font-size: 24px; /* Memperkecil ukuran font */
        }
        .status-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .status-container.layak {
            background-color: #e0f7fa; /* Latar belakang biru muda */
        }
        .status-container.error {
            background-color: #ffe4e1; /* Latar belakang merah muda */
            border: 1px solid #ffcdd2;
        }
        .status-container h2 {
            color: #333;
        }
        .status-container p {
            color: #666;
        }
        .status-container .action-link {
            display: inline-block;
            margin-top: 10px;
            padding: 8px 16px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            cursor: pointer; /* Menjadikan kursor berbentuk tangan saat mengarah ke tombol */
        }
        .status-container .action-link:hover {
            background-color: #45a049; /* Warna tombol saat dihover */
        }
        .form-popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            z-index: 1000;
        }
        .form-popup h2 {
            color: #333;
            margin-bottom: 10px;
        }
        .form-popup p {
            color: #666;
            margin-bottom: 20px;
        }
        .form-popup button {
            background-color: #f44336; /* Latar belakang merah */
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .form-popup button:hover {
            background-color: #d32f2f; /* Warna tombol saat dihover */
        }
    </style>
</head>
<body>
    <h1>Tindak Lanjut</h1>
    <div class="status-container layak">
        <h2>Layak</h2>
        <p>Hasil Akhir : <strong>Siap Dipromosikan</strong></p>
        <p>Klik tombol dibawah ini untuk melihat penjelasan dari tindak lanjut yang didapat oleh Pelaku Usaha :</p>
        <a href="#" class="action-link" data-status="layak">Lihat Detail</a>
    </div>

    <div class="status-container error">
        <h2>Tidak Layak</h2>
        <p>Hasil Akhir : <strong>Perlu Dibina Kembali</strong></p>
        <p>Klik tombol dibawah ini untuk melihat deskripsi singkat tentang langkah-langkah yang perlu diambil untuk memperbaiki status ini :</p>
        <a href="#" class="action-link" data-status="tidak-layak">Lihat Detail</a>
    </div>

    <div class="form-popup" id="formPopup">
        <h2>Penjelasan :</h2>
        <p id="formContent"></p>
        <button onclick="closeForm()">Tutup</button>
    </div>

    <script>
        // Ambil semua elemen dengan kelas action-link
        var actionLinks = document.querySelectorAll('.action-link');

        // Iterasi dan tambahkan event listener untuk setiap elemen
        actionLinks.forEach(function(link) {
            link.addEventListener('click', function(event) {
                event.preventDefault(); // Menghentikan perilaku default dari link

                // Dapatkan status dari atribut data-status
                var status = this.getAttribute('data-status');
                
                // Sesuaikan konten form berdasarkan status
                var content = "";
                if (status === "layak") {
                    content = "Dinas Perikanan Kabupaten Kotabaru akan mendukung dan membantu mempromosikan produk dalam bentuk sebagai berikut : <br>1. Diikutsertakan pada event, pameran atau festival bernuansa kuliner di tingkat Kabupaten dan Provinsi.<br>2. Dibantu menghubungkan ke minimarket dan toko penjual oleh-oleh agar dapat menjadi pemasok produk makanan yang dijual.<br>3. Dibantu dalam membuat desain kemasan produk untuk meningkatkan daya tarik produk.<br>4. Dibantu kelengkapan peralatan produksi pengolahan yang berteknologi.<br>5. Dapat menjadi produk souvenir untuk tamu atau peserta kegiatan tertentu.";
                } else if (status === "tidak-layak") {
                    content = "Dalam mengembangkan usaha UMKM pengolah hasil perikanan, Dinas Perikanan Kabupaten Kotabaru akan melakukan pembinaan agar dapat diusulkan menerima bantuan peralatan berteknologi, yakni : <br>1. Memberikan pengetahuan tentang manajemen usaha bagi pelaku usaha berskala rumah tangga.<br>2. Membantu meningkatkan kualitas produk dengan memenuhi kelengkapan persyaratan usulan seperti Sertifikat SPP-IRT dari Pemda dan Sertifikat Halal dari Kemenag.<br>3. Pembinaan strategi pemasaran produk untuk meningkatkan hasil penjualan yang maksimal.<br>4. Memberikan informasi modal usaha dari produk perbankan yang berkaitan dengan usaha.";
                }
                
                // Tampilkan konten di form
                document.getElementById('formContent').innerHTML = content;

                // Tampilkan form dengan id formPopup
                document.getElementById('formPopup').style.display = 'block';
            });
        });

        // Fungsi untuk menutup form
        function closeForm() {
            document.getElementById('formPopup').style.display = 'none';
        }
    </script>

</body>
</html>
