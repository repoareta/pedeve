<html>
    <head>
        <style>
            .table {
                font: normal 12px Verdana, Arial, sans-serif;
                border-collapse: collapse;
                border: 1px solid black;
            }

            th, td {
                border: 1px solid black;
                padding: 5px;
            }

            .table-no-border-all td {
                font: normal 12px Verdana, Arial, sans-serif;
                border: 0px;
                padding: 0px;
            }

            .table-no-border td, .table-no-border tr {
                font: normal 12px Verdana, Arial, sans-serif;
                border:0px;
                padding: 0px;
            }
        </style>
    </head>
    <body>

        
        <center>
        <p>
            <u>Surat Perjalanan Dinas</u>
        </p>
        {{ $panjar_header->no_panjar }}
        </center>

        <div class="row" style="margin-bottom:10px;">
            <table class="table-no-border">
              <tr>
                <td>Nama</td>
                <td>:</td>
                <td>{{ $panjar_header->nama }}</td>
              </tr>
              <tr>
                <td>No. Pekerja</td>
                <td>:</td>
                <td>{{ $panjar_header->nopek }}</td>
              </tr>
              <tr>
                <td>PJL/Golongan</td>
                <td>:</td>
                <td>{{ $panjar_header->gol }}</td>
              </tr>
              <tr>
                <td>Jabatan</td>
                <td>:</td>
                <td>{{ $panjar_header->jabatan }}</td>
              </tr>
              <tr>
                <td>No. KTP/Passport</td>
                <td>:</td>
                <td>{{ $panjar_header->jabatan }}</td>
              </tr>
              <tr>
                <td>Dari/Asal</td>
                <td>:</td>
                <td>{{ $panjar_header->jabatan }}</td>
              </tr>
              <tr>
                <td>Tempat Tujuan</td>
                <td>:</td>
                <td>{{ $panjar_header->jabatan }}</td>
              </tr>
              <tr>
                <td>Terhitung Mulai Tanggal</td>
                <td>:</td>
                <td>{{ $panjar_header->jabatan }}</td>
              </tr>
              <tr>
                <td>Berangkat/Kembali Tanggal</td>
                <td>:</td>
                <td>{{ $panjar_header->jabatan }}</td>
              </tr>
              <tr>
                <td>Berkendaraan</td>
                <td>:</td>
                <td>{{ $panjar_header->jabatan }}</td>
              </tr>
              <tr>
                <td>Biaya Ditanggung Oleh</td>
                <td>:</td>
                <td>{{ $panjar_header->jabatan }}</td>
              </tr>
            </table>
        </div>

        <table style="border: 1px solid #000000;" width="100%">
            <tr>
                <td colspan="6">
                    <p>Keterangan/Keperluan</p>
                    <p>{{ $panjar_header->keterangan }}</p>
                </td>
            </tr>
            <tr>
                <td>No</td>
                <td>Nama Pengikut</td>
                <td>Nopek</td>
                <td>Golongan</td>
                <td>Jabatan</td>
                <td>Keterangan</td>
            </tr>
        </table>
    </body>
</html>