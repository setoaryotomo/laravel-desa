<!DOCTYPE html>
<html>
<head>
    <title>Permohonan Surat</title>
</head>
<body>
    <h2>Detail Permohonan Surat</h2>
    
    <p>Berikut detail permohonan surat Anda:</p>
    
    <table>
        <tr>
            <td>Nama</td>
            <td>: {{ $surat->nama }}</td>
        </tr>
        <tr>
            <td>NIK</td>
            <td>: {{ $surat->nik }}</td>
        </tr>
        <tr>
            <td>Jenis Surat</td>
            <td>: {{ $surat->jenis_surat }}</td>
        </tr>
        <tr>
            <td>Keterangan</td>
            <td>: {{ $surat->keterangan }}</td>
        </tr>
        <tr>
            <td>Status</td>
            <td>: {{ $surat->status == 2 ? 'Disetujui' : 'Dalam proses' }}</td>
        </tr>
    </table>
    
    @if($surat->lampiran)
    <p>Lampiran telah disertakan dalam email ini.</p>
    @endif
    
    <p>Terima kasih,</p>
    <p>Admin</p>
</body>
</html>