<?php
// Data tiruan / simulasi yang merepresentasikan isi dari file Excel Anda
// Dalam implementasi nyata, Anda bisa menghubungkannya ke Database MySQL atau membaca file Excel via pustaka PhpSpreadsheet.
$data_kategori = [
    'Al-Quran' => [
        ['no' => 1, 'nama' => 'AINUN AGUSTIN', 'ortu' => 'SAWINAH', 'juni' => '13/06/2026', 'juli' => '29/06/2026', 'agustus' => '12/07/2026', 'september' => '-', 'oktober' => '-', 'november' => '-', 'desember' => '-', 'januari' => '-', 'februari' => '-', 'maret' => '-', 'april' => '-', 'mei' => '-', 'ket' => 'Juni 2026-Mei 2027'],
        ['no' => 2, 'nama' => 'ALFANDI RIFQI', 'ortu' => 'SUPRIYANTO', 'juni' => '14/05/2025', 'juli' => '28/07/2025', 'agustus' => '28/07/2025', 'september' => '06/09/2025', 'oktober' => '29/12/2025', 'november' => '-', 'desember' => '-', 'januari' => '-', 'februari' => '-', 'maret' => '-', 'april' => '-', 'mei' => '-', 'ket' => 'Juni 2024-Mei 2025'],
        ['no' => 3, 'nama' => 'ANINDITA KZ.', 'ortu' => 'RASITA', 'juni' => '06/09/2025', 'juli' => '12/10/2025', 'agustus' => '05/11/2025', 'september' => '12/01/2026', 'oktober' => '31/03/2026', 'november' => '26/04/2024', 'desember' => '30/05/2026', 'januari' => '18/06/2026', 'februari' => '12/07/2026', 'maret' => '-', 'april' => '-', 'mei' => '-', 'ket' => 'Juni 2025-Mei 2026'],
        ['no' => 4, 'nama' => 'CIKA ADELIA', 'ortu' => 'CARTIWAN', 'juni' => 'blm ngaji', 'juli' => '-', 'agustus' => '-', 'september' => '-', 'oktober' => '-', 'november' => '-', 'desember' => '-', 'januari' => '-', 'februari' => '-', 'maret' => '-', 'april' => '-', 'mei' => '-', 'ket' => 'Juni 2026-Mei 2027'],
    ],
    'Iqro Putra' => [
        ['no' => 1, 'nama' => 'ADNAN AZKA KOMARUDIN', 'ortu' => 'SUPRIANTO', 'juni' => 'blm ngaji', 'juli' => '-', 'agustus' => '-', 'september' => '-', 'oktober' => '-', 'november' => '-', 'desember' => '-', 'januari' => '-', 'februari' => '-', 'maret' => '-', 'april' => '-', 'mei' => '-', 'ket' => 'Iqro Putra 1'],
    ],
    'Iqro Putri' => [
        ['no' => 1, 'nama' => 'ARAHMAH NAURA', 'ortu' => 'TETI BAROKAH S.', 'juni' => 'blm ngaji', 'juli' => 'blm ngaji', 'agustus' => '-', 'september' => '-', 'oktober' => '-', 'november' => '-', 'desember' => '-', 'januari' => '-', 'februari' => '-', 'maret' => '-', 'april' => '-', 'mei' => '-', 'ket' => 'Iqro Putri 1'],
    ]
];

// Menentukan tab aktif
$active_tab = isset($_GET['tab']) && array_key_exists($_GET['tab'], $data_kategori) ? $_GET['tab'] : 'Al-Quran';
$search = isset($_GET['search']) ? trim($_GET['search']) : '';

// Filter pencarian sederhana
$current_data = $data_kategori[$active_tab];
if ($search !== '') {
    $current_data = array_filter($current_data, function($row) use ($search) {
        return stripos($row['nama'], $search) !== false || stripos($row['ortu'], $search) !== false;
    });
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catatan Pemasukan Bulanan Santri Musholla Ash-Shiddiqiyyah</title>
    <!-- Menggunakan Tailwind CSS untuk tampilan modern & responsif -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 text-slate-800 min-h-screen p-4 md:p-8">
    <div class="max-w-7xl mx-auto bg-white shadow-lg rounded-2xl p-6 border border-slate-100">
        
        <!-- Header Informasi -->
        <div class="text-center border-b pb-6 mb-6">
            <h1 class="text-2xl md:text-3xl font-extrabold text-emerald-700 uppercase tracking-wide">
                Catatan Pemasukan Bulanan Santri
            </h1>
            <p class="text-slate-500 font-medium mt-1">Musholla Ash-Shiddiqiyyah</p>
        </div>

        <!-- Navigasi Tab Kategori (Sheet) -->
        <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
            <div class="flex space-x-2 border-b md:border-b-0 pb-2 md:pb-0 overflow-x-auto">
                <?php foreach (array_keys($data_kategori) as $tab): ?>
                    <a href="?tab=<?php echo urlencode($tab); ?>" 
                       class="px-5 py-2.5 rounded-xl font-semibold text-sm transition-all duration-200 <?php echo $active_tab === $tab ? 'bg-emerald-600 text-white shadow-md shadow-emerald-200' : 'bg-slate-100 text-slate-600 hover:bg-slate-200'; ?>">
                        <?php echo htmlspecialchars($tab); ?>
                    </a>
                <?php endforeach; ?>
            </div>

            <!-- Form Pencarian -->
            <form method="GET" action="" class="flex items-center gap-2 w-full md:w-auto">
                <input type="hidden" name="tab" value="<?php echo htmlspecialchars($active_tab); ?>">
                <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>" placeholder="Cari Nama Santri / Ortu..." 
                       class="px-4 py-2 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 w-full md:w-64">
                <button type="submit" class="bg-slate-800 text-white px-4 py-2 rounded-xl text-sm font-medium hover:bg-slate-700 transition">
                    Cari
                </button>
                <?php if ($search !== ''): ?>
                    <a href="?tab=<?php echo urlencode($active_tab); ?>" class="text-sm text-red-600 hover:underline px-2">Reset</a>
                <?php endif; ?>
            </form>
        </div>

        <!-- Tabel Data Pemasukan -->
        <div class="overflow-x-auto rounded-xl border border-slate-200">
            <table class="w-full text-left border-collapse text-sm">
                <thead>
                    <tr class="bg-emerald-800 text-white text-xs uppercase tracking-wider">
                        <th class="p-3 text-center border-r border-emerald-700">No</th>
                        <th class="p-3 border-r border-emerald-700">Nama Santri</th>
                        <th class="p-3 border-r border-emerald-700">Nama Ortu</th>
                        <th class="p-3 text-center border-r border-emerald-700">Juni</th>
                        <th class="p-3 text-center border-r border-emerald-700">Juli</th>
                        <th class="p-3 text-center border-r border-emerald-700">Agustus</th>
                        <th class="p-3 text-center border-r border-emerald-700">September</th>
                        <th class="p-3 text-center border-r border-emerald-700">Oktober</th>
                        <th class="p-3 text-center border-r border-emerald-700">November</th>
                        <th class="p-3 text-center border-r border-emerald-700">Desember</th>
                        <th class="p-3 text-center border-r border-emerald-700">Januari</th>
                        <th class="p-3 text-center border-r border-emerald-700">Februari</th>
                        <th class="p-3 text-center border-r border-emerald-700">Maret</th>
                        <th class="p-3 text-center border-r border-emerald-700">April</th>
                        <th class="p-3 text-center border-r border-emerald-700">Mei</th>
                        <th class="p-3 border-r border-emerald-700">Keterangan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 bg-white">
                    <?php if (count($current_data) > 0): ?>
                        <?php foreach ($current_data as $row): ?>
                            <tr class="hover:bg-slate-50 transition">
                                <td class="p-3 text-center font-medium border-r"><?php echo $row['no']; ?></td>
                                <td class="p-3 font-semibold text-slate-900 border-r"><?php echo htmlspecialchars($row['nama']); ?></td>
                                <td class="p-3 text-slate-600 border-r"><?php echo htmlspecialchars($row['ortu']); ?></td>
                                <?php 
                                $months = ['juni', 'juli', 'agustus', 'september', 'oktober', 'november', 'desember', 'januari', 'februari', 'maret', 'april', 'mei'];
                                foreach ($months as $m): 
                                    val_cell($row[$m]);
                                endforeach; 
                                ?>
                                <td class="p-3 text-slate-500 italic text-xs"><?php echo htmlspecialchars($row['ket']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="16" class="p-6 text-center text-slate-400">Tidak ada data santri yang ditemukan.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Footer Kecil -->
        <div class="mt-6 text-center text-xs text-slate-400">
            &copy; <?php echo date('Y'); ?> Musholla Ash-Shiddiqiyyah &bull; Sistem Pencatatan Keuangan Santri
        </div>
    </div>
</body>
</html>

<?php
// Helper kecil untuk styling sel tanggal/status pembayaran
function val_cell($val) {
    $bg = "";
    if ($val === '-' || $val === '') {
        $text_color = "text-slate-300";
    } elseif ($val === 'blm ngaji') {
        $text_color = "text-amber-600 font-medium bg-amber-50 rounded px-1 py-0.5 text-[11px]";
    } else {
        $text_color = "text-emerald-700 font-semibold bg-emerald-50 rounded px-1 py-0.5 text-[11px]";
    }
    echo "<td class='p-2 text-center border-r whitespace-nowrap'><span class='{$text_color}'>" . htmlspecialchars($val) . "</span></td>";
}
?>

