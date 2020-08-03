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
                <th colspan="6">Gratifikasi</th>
                <th rowspan="3">Average</th>
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
                    <td>{{ $report->nopeg }}</td>
                    <td>{{ $report->nopeg }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="16">Nilai GCG</td>
                <td>65%</td>
            </tr>
        </tbody>
    </table>
</body>
</html>