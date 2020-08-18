<!DOCTYPE html>
<html lang="en">
<body>
    <table>
        <tr>
            <td colspan="10">PT PERTAMINA PEDEVE INDONESIA</td>
        </tr>
        <tr>
            <td colspan="10">Report Compliance Online PEDEVE</td>
        </tr>
        <tr>
            <td colspan="10">
                Bulan {{ $bulan." ".$tahun }}
            </td>
        </tr>
    </table>

    <table>
        <thead>
            <tr>
                <th rowspan="3">No</th>
                <th rowspan="3">Fungsi</th>
                <th rowspan="3">Jabatan</th>
                <th rowspan="3">Nopek</th>
                <th rowspan="3">Nama</th>
                <th rowspan="2" colspan="2">CoC</th>
                <th rowspan="2" colspan="2">CoI</th>
                <th rowspan="2" colspan="2">LHKPN</th>
                <th colspan="6">Gratifikasi</th>
                <th rowspan="3">Average</th>
                <th rowspan="2" colspan="2">Sosialisasi</th>
                <th rowspan="3">Nilai GCG</th>
            </tr>
            <tr>
                <th colspan="2">Penerimaan</th>
                <th colspan="2">Pemberian</th>
                <th colspan="2">Permintaan</th>
            </tr>
            <tr>
                <th>Status</th>
                <th>%</th>
                <th>Status</th>
                <th>%</th>
                <th>Status</th>
                <th>%</th>
                <th>Status</th>
                <th>%</th>
                <th>Status</th>
                <th>%</th>
                <th>Status</th>
                <th>%</th>
                <th>Status</th>
                <th>%</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
            @endphp
            @foreach ($report_list as $report)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $report->userpdv->fungsi->nama }}</td>
                    <td>{{ $report->userpdv->fungsi_jabatan->nama }}</td>
                    <td>{{ $report->nopeg }}</td>
                    <td>{{ $report->pekerja->nama }}</td>
                    <td>COC Status</td>
                    <td>COC Persen</td>
                    <td>COI Status</td>
                    <td>COI Persen</td>
                    <td>LHKPN Status</td>
                    <td>LHKPN Persen</td>
                    <td>{{ $report->nopeg }}</td>
                    <td>{{ $report->nopeg }}</td>
                    <td>{{ $report->nopeg }}</td>
                    <td>{{ $report->nopeg }}</td>
                    <td>{{ $report->nopeg }}</td>
                    <td>{{ $report->nopeg }}</td>
                    <td>{{ $report->nopeg }}</td>
                    <td>{{ $report->nopeg }}</td>
                    <td>{{ $report->nopeg }}</td>
                    <td>{{ $report->nopeg }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="20">Nilai GCG</td>
                <td>65%</td>
            </tr>
        </tbody>
    </table>

    <table>
        <thead>
            <tr>
                <td></td>
                <td>Wajib Lapor LHKPN</td>
                <td>Non Wajib Lapor LHKPN</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    COC
                </td>
                <td>
                    15%
                </td>
                <td>
                    20%
                </td>
            </tr>
            <tr>
                <td>
                    COI
                </td>
                <td>
                    15%
                </td>
                <td>
                    20%
                </td>
            </tr>
            <tr>
                <td>
                    Sosialisasi GCG
                </td>
                <td>
                    20%
                </td>
                <td>
                    30%
                </td>
            </tr>
            <tr>
                <td>
                    Pengisian LHKPN
                </td>
                <td>
                    20%
                </td>
                <td>
                    0%
                </td>
            </tr>
            <tr>
                <td>
                    Pengisian Pengisian Gratifikasi
                </td>
                <td>
                    30%
                </td>
                <td>
                    30%
                </td>
            </tr>
        </tbody>
    </table>

    <p>
        *Catatan
        <br>			
        WL LHKPN hanya untuk Level Manager Ke atas
        <br>					
        Perhitungan Average menyesuaikan dengan jabatan
        <br>							
        COI, COC, LHKPN diisi 1 tahun sekali
        <br>							
        Laporan Gratifikasi diisi setiap bulan
        <br>				
		Sosialisasi 1 tahun sekali
    </p>
</body>
</html>