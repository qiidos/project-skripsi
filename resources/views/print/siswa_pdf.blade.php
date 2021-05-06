<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/css/dompdf.css">
    <title>Poin Pelanggaran {{ $siswa->nama }}-{{ $siswa->kelas->kelas }}-{{ $siswa->jurusan->jurusan }}</title>
    <style>
        body {
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "Liberation Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            text-align: center;
            background-color: #fff
        }

        p {
            line-height: 3px;
        }

        .hr-black {
            border-top: 3px solid black;
            width: 660px;
        }

        td {
            font-size: 13px;
        }

        .thead-bg {
            background-color: #303e56;
            color: white;
        }

        .tbody-bg {
            background-color: #e6e6e6;
        }

        @page {
            margin: 155px 50px 10px 50px;
        }

        #header {
            position: fixed;
            left: 0px;
            top: -150px;
            right: 0px;
            text-align: center;
        }

        #footer {
            position: fixed;
            left: 0px;
            bottom: 11px;
            right: 0px;
            height: 0px;
            font-size: 11px;
        }

        #footer .page:after {
            content: counter(page, upper-roman);
        }

        .float-left {
            float: left !important
        }

        .float-right {
            float: right !important
        }

        .text-break {
            word-break: break-word !important;
            word-wrap: break-word !important
        }

        #kepala {
            border-collapse: collapse;
            width: 100%;
            text-align: center;
        }

        #kepala td,
        #kepala th {
            font-size: 6px;
            padding-bottom: 5px;
            border: 0px solid black;
            border-bottom: 2px black;
        }

        #main_table {
            border-collapse: collapse;
            width: 100%;
            text-align: middle;
            margin-top: 20px;
            counter-reset: row-num 0;
        }

        #main_table tbody tr td:first-child::before {
            counter-increment: row-num;
            content: counter(row-num);
        }

        #main_table td,
        #main_table th {
            border: 1px solid #ddd;
            line-height: 30px;
            text-align: center;
            padding-bottom: 5px;
        }

        #catatan {
            border-collapse: collapse;
            width: 45%;
            table-layout: fixed;
            margin-top: 10px;
        }

        #catatan td,
        #catatan th {
            text-align: justify;
            text-justify: inter-word;
            border: 0px solid #ddd;
        }
    </style>
</head>

<body>
    <div id="header">
        <table id="kepala">
            <colgroup>
                <col span="1" style="width: 8%;">
                <col span="1" style="width: 84%;">
                <col span="1" style="width: 8%;">
            </colgroup>
            <tbody class="text-center tbody-bg" style="background-color: white;">
                <tr>
                    <td class="float-left"><img src="{{ public_path('asset/logo-smk.png') }}" width="94px"></td>
                    <td>
                        <p style="font-size: 19px; padding-top: 8px;"><strong>PEMERINTAH KOTA PASURUAN</strong></p></br>
                        <p style="font-size: 19px;"><strong>DINAS PENDIDIKAN</strong></p></br>
                        <p style="font-size: 19px;"><strong>SMK NEGERI 1 PASURUAN</strong></p></br>
                        <p style="font-size: 13px;">Jalan Veteran, Kota Pasuruan Telp. (0341) 421380</p></br>
                        <p style="font-size: 13px;">Website: http://www.smkn1-pasuruan.sch.id</p>
                    </td>
                    <td class="float-right"><img src="{{ public_path('asset/logo-pasuruan.png') }}" width="94px"></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div id="footer">
        <table border="0px" style="width: 100%;">
            <td style="font-size: 9px;">
                <p class="page">Halaman </p>
            </td>
            <td style="font-size: 9px;">
                <p style="text-align: right ;">http://www.smkn1-pasuruan.sch.id</p>
            </td>
        </table>
    </div>
    <div id="content">
        <h2 style="text-align: center; margin-bottom: 12px; margin-top: -5px;"><strong>POIN PELANGGARAN SISWA</strong></h2>
        <table id="biodata" border="0px" style="margin-bottom: 12px; width: 60%; border-collapse: collapse;">
            <tbody>
                <tr>
                    <td><strong>NIS (Nomor Induk Siswa)</strong></td>
                    <td><strong>:</strong></td>
                    <td>{{ $siswa->nis }}</td>
                </tr>
                <tr>
                    <td><strong>Nama</strong></td>
                    <td><strong>:</strong></td>
                    <td>{{ $siswa->nama }}</td>
                </tr>
                <tr>
                    <td><strong>Kelas</strong></td>
                    <td><strong>:</strong></td>
                    <td>{{ $siswa->kelas->kelas }} {{ $siswa->jurusan->jurusan }}</td>
                </tr>
                <tr>
                    <td><strong>Predikat Tingkah Laku</strong></td>
                    <td><strong>:</strong></td>
                    <td><strong>{{ $siswa->nilai->nilai }} - {{ $siswa->nilai->predikat }}</strong></td>
                </tr>
            </tbody>
        </table>
        <table id="main_table">
            <thead class="thead-bg">
                <tr>
                    <th>No.</th>
                    <th>Tanggal</th>
                    <th>Pelanggaran</th>
                    <th>Kategori</th>
                    <th>Poin</th>
                </tr>
            </thead>
            @if($siswa->poin->sum('poin') == 0)
            <thead>
                <tr>
                    <td colspan="4" id="tidak_terdapat"><strong>TIDAK MEMPUNYAI POIN PELANGGARAN</strong></td>
                </tr>
            </thead>
            @else
            <tbody>
                @foreach($poin as $poin)
                <tr>
                    <td></td>
                    <td>
                        {{ date('d-m-Y', strtotime($poin -> tanggal)) }}
                    </td>
                    <td>
                        {{ $poin -> jenis_pelanggaran }}
                    </td>
                    <td>{{ $poin -> kategori -> kategori }}</td>
                    <td>
                        {{ $poin -> poin }}
                    </td>
                </tr>
                @endforeach
            </tbody>
            @endif
            <tfoot class="tbody-bg">
                <tr>
                    <td colspan="4"><strong>TOTAL POIN</strong></td>
                    <td>
                        <strong>{{ $siswa->poin->sum('poin') }}</strong>
                    </td>
                </tr>
            </tfoot>
        </table>
        <table>
            <tbody>
                <tr>
                    <td>
                        <small style="color: grey;">*Poin pelanggaran diurutkan berdasarkan dari tanggal terbaru ketika poin ditambahkan.</small>
                    </td>
                </tr>
            </tbody>
        </table>
        <table id="catatan">
            <tbody>
                <tr>
                    <td><strong>CATATAN!</strong><br>
                        @if(empty($siswa->motivasi))
                        .................................................................................................
                        .................................................................................................
                        .................................................................................................
                        .................................................................................................
                        @else
                        {{ $siswa->motivasi->motivasi }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <table border="0px" style="float: right; padding-top: 20px;">
                        <tbody>
                            <tr>
                                {{ setlocale(LC_ALL, 'id-ID') }}
                                <td>Pasuruan, {{ strftime("%d %B %Y") }}<br>
                                    Kepala Sekolah SMKN 1 Pasuruan<br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    Drs. Akh Sigit Suyani, S.ST, M.T<br>
                                    NIP. 19651216 199403 1 002
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>