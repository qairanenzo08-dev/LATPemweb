<?php
$matkul = [
    ["nama" => "Pemrograman Web",     "sks" => 3, "nilai" => 88],
    ["nama" => "Sistem Basis Data",          "sks" => 3, "nilai" => 76],
    ["nama" => "Algoritma dan Pemrograman", "sks" => 4, "nilai" => 62],
    ["nama" => "Pengantar Kecerdasan Artificial",  "sks" => 3, "nilai" => 45],
    ["nama" => "Jaringan Komputer",   "sks" => 2, "nilai" => 81],
    ["nama" => "Sistem Operasi",      "sks" => 2, "nilai" => 55],
];

function hitungBobot(int|float $nilai): array
{
    if ($nilai >= 80) {
        return ["huruf" => "A", "bobot" => 4.0];
    } elseif ($nilai >= 70) {
        return ["huruf" => "B", "bobot" => 3.0];
    } elseif ($nilai >= 60) {
        return ["huruf" => "C", "bobot" => 2.0];
    } elseif ($nilai >= 50) {
        return ["huruf" => "D", "bobot" => 1.0];
    } else {
        return ["huruf" => "E", "bobot" => 0.0];
    }
}
$totalSks = 0;
$totalMutu = 0;

foreach ($matkul as $i => $mk) {
    $hasil = hitungBobot($mk["nilai"]);
    $matkul[$i]["huruf"]  = $hasil["huruf"];
    $matkul[$i]["bobot"]  = $hasil["bobot"];
    $matkul[$i]["status"] = $hasil["bobot"] >= 2.0 ? "LULUS" : "MENGULANG";

    $totalSks  += $mk["sks"];
    $totalMutu += $hasil["bobot"] * $mk["sks"];
}
$ips = $totalSks > 0 ? $totalMutu / $totalSks : 0;
$maksSks = $ips >= 3.00 ? 24 : 20;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latihan Individu - Nilai Mata Kuliah</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; color: #1f2937; }
        h1 { margin-bottom: 4px; }
        table { border-collapse: collapse; width: 100%; max-width: 800px; margin-top: 16px; }
        th, td { border: 1px solid #cbd5e1; padding: 8px 12px; text-align: left; }
        th { background: #e2e8f0; }
        tr.mengulang { background: #fee2e2; color: #b91c1c; font-weight: bold; }
        .ringkasan { margin-top: 24px; max-width: 800px; padding: 16px; background: #f1f5f9; border-radius: 8px; }
        .ringkasan p { margin: 6px 0; } 
    </style>
</head>
<body>
    <h1>Daftar Nilai Semester</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Mata Kuliah</th>
                <th>SKS</th>
                <th>Nilai Angka</th>
                <th>Nilai Huruf</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($matkul as $i => $mk): ?>
                <tr class="<?= $mk["status"] === "MENGULANG" ? "mengulang" : "" ?>">
                    <td><?= $i + 1 ?></td>
                    <td><?= $mk["nama"] ?></td>
                    <td><?= $mk["sks"] ?></td>
                    <td><?= $mk["nilai"] ?></td>
                    <td><?= $mk["huruf"] ?></td>
                    <td><?= $mk["status"] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="ringkasan">
        <h3>Ringkasan IPS</h3>
        <p>Total SKS: <strong><?= $totalSks ?></strong></p>
        <p>Total Bobot x SKS: <strong><?= number_format($totalMutu, 2) ?></strong></p>
        <p>IPS: <strong><?= number_format($ips, 2) ?></strong></p>
        <p>Batas maksimal SKS semester depan: <strong><?= $maksSks ?> SKS</strong></p>
    </div>
</body>
</html>