<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    @media print {
      .no-print {
        display: none;
      }
    }
  </style>
</head>
<body>

  <div id="id-pelaku">Pelaku</div>
  <div id="id-indikator">Indikator</div>
  <div id="aksi">Aksi</div>

  <script>
    window.onbeforeprint = function() {
      document.getElementById('id-pelaku').classList.add('no-print');
      document.getElementById('id-indikator').classList.add('no-print');
      document.getElementById('aksi').classList.add('no-print');
    };

    window.onafterprint = function() {
      document.getElementById('id-pelaku').classList.remove('no-print');
      document.getElementById('id-indikator').classList.remove('no-print');
      document.getElementById('aksi').classList.remove('no-print');
    };
  </script>

</body>
</html>
