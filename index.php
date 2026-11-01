<?php
// =====================================================
// LATIHAN INDIVIDU
// PENGANTAR PHP DAN KONSEP BACKEND
// =====================================================


// 1. ARRAY MULTIDIMENSI DATA MATA KULIAH

$matkul = [
    [
        "nama"  => "Algoritma dan Pemrograman",
        "sks"   => 3,
        "nilai" => 85
    ],
    [
        "nama"  => "Basis Data",
        "sks"   => 3,
        "nilai" => 78
    ],
    [
        "nama"  => "Jaringan Komputer",
        "sks"   => 3,
        "nilai" => 65
    ],
    [
        "nama"  => "Matematika Diskrit",
        "sks"   => 2,
        "nilai" => 55
    ],
    [
        "nama"  => "Pemrograman Web",
        "sks"   => 3,
        "nilai" => 90
    ]
];


// 2. FUNGSI MENGHITUNG NILAI HURUF DAN BOBOT

function hitungBobot($nilai)
{
    if ($nilai >= 80) {
        return [
            "huruf" => "A",
            "bobot" => 4.0
        ];
    } elseif ($nilai >= 70) {
        return [
            "huruf" => "B",
            "bobot" => 3.0
        ];
    } elseif ($nilai >= 60) {
        return [
            "huruf" => "C",
            "bobot" => 2.0
        ];
    } elseif ($nilai >= 50) {
        return [
            "huruf" => "D",
            "bobot" => 1.0
        ];
    } else {
        return [
            "huruf" => "E",
            "bobot" => 0.0
        ];
    }
}


// 3. VARIABEL UNTUK PERHITUNGAN

$totalSks = 0;
$totalMutu = 0;
$jumlahLulus = 0;
$jumlahMengulang = 0;


// Menghitung total SKS dan nilai mutu

foreach ($matkul as $mk) {

    $hasil = hitungBobot($mk["nilai"]);

    $totalSks += $mk["sks"];

    $totalMutu += $hasil["bobot"] * $mk["sks"];

    if ($hasil["bobot"] >= 2.0) {
        $jumlahLulus++;
    } else {
        $jumlahMengulang++;
    }
}


// Menghitung IPS

$ips = $totalSks > 0
    ? $totalMutu / $totalSks
    : 0;


// Menentukan batas maksimal SKS semester depan

if ($ips >= 3.00) {
    $maksSks = 24;
} else {
    $maksSks = 20;
}


// Format angka IPS menjadi dua angka desimal

$ipsTampil = number_format($ips, 2);


// 4. MEMULAI TAMPILAN HTML

?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Daftar Nilai Mata Kuliah</title>

    <style>

        /* PENGATURAN DASAR */

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f1f5f9;
            color: #1e293b;
            padding: 25px;
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: auto;
        }


        /* HEADER */

        .header {
            background: linear-gradient(
                135deg,
                #1d4ed8,
                #2563eb
            );

            color: white;
            padding: 30px;
            border-radius: 15px;
            margin-bottom: 25px;

            box-shadow: 0 5px 15px
                rgba(0, 0, 0, 0.08);
        }

        .header h1 {
            font-size: 28px;
            margin-bottom: 8px;
        }

        .header p {
            font-size: 16px;
            margin-top: 3px;
        }


        /* KARTU RINGKASAN */

        .statistik {
            display: grid;

            grid-template-columns:
                repeat(2, minmax(0, 1fr));

            gap: 20px;
            margin-bottom: 25px;
        }

        .card {
            background-color: white;
            padding: 22px;
            border-radius: 12px;

            box-shadow: 0 3px 10px
                rgba(0, 0, 0, 0.05);
        }

        .card h3 {
            color: #64748b;
            font-size: 15px;
            font-weight: normal;
            margin-bottom: 8px;
        }

        .card .angka {
            font-size: 28px;
            font-weight: bold;
            color: #1d4ed8;
        }

        .card .keterangan {
            font-size: 13px;
            color: #64748b;
            margin-top: 5px;
        }


        /* BAGIAN TABEL */

        .bagian-tabel {
            background-color: white;
            padding: 25px;
            border-radius: 12px;
            margin-bottom: 25px;

            box-shadow: 0 3px 10px
                rgba(0, 0, 0, 0.05);
        }

        .bagian-tabel h2 {
            margin-bottom: 20px;
            font-size: 22px;
        }

        .table-responsive {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 750px;
        }

        thead {
            background-color: #1d4ed8;
            color: white;
        }

        th {
            padding: 15px 12px;
            text-align: center;
            font-size: 14px;
        }

        td {
            padding: 15px 12px;
            text-align: center;
            border-bottom: 1px solid #e2e8f0;
        }

        td:nth-child(2) {
            text-align: left;
        }

        tbody tr:hover {
            background-color: #f8fafc;
        }


        /* BARIS MENGULANG BERWARNA MERAH */

        tr.mengulang {
            background-color: #fef2f2;
        }

        tr.mengulang:hover {
            background-color: #fee2e2;
        }

        .status-lulus {
            display: inline-block;
            background-color: #dcfce7;
            color: #15803d;

            padding: 5px 12px;
            border-radius: 20px;

            font-weight: bold;
            font-size: 12px;
        }

        .status-mengulang {
            display: inline-block;
            background-color: #fee2e2;
            color: #b91c1c;

            padding: 5px 12px;
            border-radius: 20px;

            font-weight: bold;
            font-size: 12px;
        }


        /* RINGKASAN IPS */

        .ringkasan {
            background-color: white;
            padding: 25px;
            border-radius: 12px;
            margin-bottom: 25px;

            border-left: 6px solid #2563eb;

            box-shadow: 0 3px 10px
                rgba(0, 0, 0, 0.05);
        }

        .ringkasan h2 {
            margin-bottom: 15px;
        }

        .ringkasan p {
            margin-bottom: 10px;
            font-size: 16px;
        }

        .nilai-ips {
            font-size: 30px;
            font-weight: bold;
            color: #1d4ed8;
        }

        .info-sks {
            background-color: #eff6ff;
            padding: 15px;
            border-radius: 8px;
            margin-top: 15px;
        }


        /* KETERANGAN */

        .keterangan-nilai {
            background-color: white;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 25px;
        }

        .keterangan-nilai h3 {
            margin-bottom: 10px;
        }

        .keterangan-nilai ul {
            padding-left: 22px;
        }

        .footer {
            text-align: center;
            padding: 20px;
            color: #64748b;
            font-size: 13px;
        }


        /* RESPONSIVE UNTUK HP */

        @media (max-width: 600px) {

            body {
                padding: 12px;
            }

            .header {
                padding: 22px;
            }

            .header h1 {
                font-size: 23px;
            }

            .statistik {
                grid-template-columns: 1fr;
            }

            .bagian-tabel {
                padding: 15px;
            }

            .bagian-tabel h2 {
                font-size: 19px;
            }
        }

    </style>

</head>

<body>

<div class="container">


    <!-- HEADER -->

    <div class="header">

        <h1>Daftar Nilai Mata Kuliah</h1>

        <p>
            Sistem Informasi Nilai Akademik Mahasiswa
        </p>

        <p>
            Semester: Ganjil
        </p>

    </div>


    <!-- KARTU STATISTIK -->

    <div class="statistik">

        <div class="card">

            <h3>Jumlah Mata Kuliah</h3>

            <div class="angka">
                <?= count($matkul); ?>
            </div>

            <div class="keterangan">
                Mata kuliah terdaftar
            </div>

        </div>


        <div class="card">

            <h3>Total SKS</h3>

            <div class="angka">
                <?= $totalSks; ?>
            </div>

            <div class="keterangan">
                SKS yang ditempuh
            </div>

        </div>


        <div class="card">

            <h3>Mata Kuliah Lulus</h3>

            <div class="angka">
                <?= $jumlahLulus; ?>
            </div>

            <div class="keterangan">
                Mata kuliah lulus
            </div>

        </div>


        <div class="card">

            <h3>Mata Kuliah Mengulang</h3>

            <div class="angka">
                <?= $jumlahMengulang; ?>
            </div>

            <div class="keterangan">
                Mata kuliah perlu diulang
            </div>

        </div>

    </div>


    <!-- TABEL NILAI -->

    <div class="bagian-tabel">

        <h2>Tabel Nilai Mata Kuliah</h2>

        <div class="table-responsive">

            <table>

                <thead>

                    <tr>
                        <th>No.</th>
                        <th>Nama Mata Kuliah</th>
                        <th>SKS</th>
                        <th>Nilai Angka</th>
                        <th>Nilai Huruf</th>
                        <th>Bobot</th>
                        <th>Status</th>
                    </tr>

                </thead>

                <tbody>

                    <?php foreach ($matkul as $index => $mk): ?>

                        <?php

                        // Mengambil nilai huruf dan bobot

                        $hasil = hitungBobot($mk["nilai"]);

                        $huruf = $hasil["huruf"];
                        $bobot = $hasil["bobot"];


                        // Menentukan status kelulusan

                        if ($bobot >= 2.0) {

                            $status = "LULUS";

                            $kelasStatus = "status-lulus";

                            $kelasBaris = "";

                        } else {

                            $status = "MENGULANG";

                            $kelasStatus = "status-mengulang";

                            $kelasBaris = "mengulang";

                        }

                        ?>

                        <tr class="<?= $kelasBaris; ?>">

                            <td>
                                <?= $index + 1; ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($mk["nama"]); ?>
                            </td>

                            <td>
                                <?= $mk["sks"]; ?>
                            </td>

                            <td>
                                <?= $mk["nilai"]; ?>
                            </td>

                            <td>
                                <?= $huruf; ?>
                            </td>

                            <td>
                                <?= number_format($bobot, 1); ?>
                            </td>

                            <td>

                                <span class="<?= $kelasStatus; ?>">
                                    <?= $status; ?>
                                </span>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                </tbody>

            </table>

        </div>

    </div>


    <!-- RINGKASAN IPS -->

    <div class="ringkasan">

        <h2>Ringkasan IPS dan SKS</h2>

        <p>
            Total SKS:
            <strong><?= $totalSks; ?> SKS</strong>
        </p>

        <p>
            Total Nilai Mutu:
            <strong>
                <?= number_format($totalMutu, 1); ?>
            </strong>
        </p>

        <p>
            Indeks Prestasi Semester (IPS):
        </p>

        <div class="nilai-ips">
            <?= $ipsTampil; ?>
        </div>

        <div class="info-sks">

            <p>
                <strong>Batas Maksimal SKS Semester Depan</strong>
            </p>

            <p>
                <?php if ($ips >= 3.00): ?>

                    IPS kamu minimal 3,00.

                    Kamu boleh mengambil maksimal
                    <strong><?= $maksSks; ?> SKS</strong>
                    pada semester berikutnya.

                <?php else: ?>

                    IPS kamu kurang dari 3,00.

                    Kamu boleh mengambil maksimal
                    <strong><?= $maksSks; ?> SKS</strong>
                    pada semester berikutnya.

                <?php endif; ?>

            </p>

        </div>

    </div>


    <!-- KETERANGAN NILAI -->

    <div class="keterangan-nilai">

        <h3>Keterangan Penilaian</h3>

        <ul>

            <li>
                Nilai 80–100: A, bobot 4,0.
            </li>

            <li>
                Nilai 70–79: B, bobot 3,0.
            </li>

            <li>
                Nilai 60–69: C, bobot 2,0.
            </li>

            <li>
                Nilai 50–59: D, bobot 1,0.
            </li>

            <li>
                Nilai 0–49: E, bobot 0,0.
            </li>

            <li>
                Bobot minimal 2,0 dinyatakan LULUS.
            </li>

            <li>
                Bobot di bawah 2,0 dinyatakan MENGULANG.
            </li>

            <li>
                IPS minimal 3,00: maksimal 24 SKS.
            </li>

            <li>
                IPS di bawah 3,00: maksimal 20 SKS.
            </li>

        </ul>

    </div>


    <!-- FOOTER -->

    <div class="footer">

        <p>
            Latihan Individu PHP - Sistem Informasi Akademik
        </p>

        <p>
            Program menampilkan data menggunakan
            Array Multidimensi, Fungsi, Perulangan,
            dan Kondisional PHP.
        </p>

    </div>


</div>

</body>

</html>