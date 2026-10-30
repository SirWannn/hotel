<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard Admin - Hotel AMBATUKAM</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-[#F4EFE6] text-[#17324D]">

    {{-- SIDEBAR --}}
    <aside class="fixed left-0 top-0 h-screen w-64 bg-[#17324D] text-white flex flex-col">

        {{-- LOGO --}}
        <div class="px-6 py-7 border-b border-white/10">
            <h1 class="text-xl font-bold tracking-wide">
                HOTEL AMBATUKAM
            </h1>

            <p class="text-sm text-white/60 mt-1">
                Panel Admin
            </p>
        </div>

        {{-- MENU --}}
        <nav class="flex-1 px-4 py-6 space-y-2">

            <a href="/admin"
                class="flex items-center gap-3 px-4 py-3 rounded-lg bg-white/10 font-semibold">
                <span>⌂</span>
                <span>Dashboard</span>
            </a>

            <a href="/admin/kamar"
                class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/10 transition">
                <span>▣</span>
                <span>Kamar</span>
            </a>

            <a href="/admin/tamu"
                class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/10 transition">
                <span>♙</span>
                <span>Tamu</span>
            </a>

            <a href="/admin/reservasi"
                class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/10 transition">
                <span>▤</span>
                <span>Reservasi</span>
            </a>

            <a href="/admin/pembayaran"
                class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/10 transition">
                <span>Rp</span>
                <span>Pembayaran</span>
            </a>

            <a href="/admin/checkin"
                class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/10 transition">
                <span>→</span>
                <span>Check-in</span>
            </a>

            <a href="/admin/checkout"
                class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/10 transition">
                <span>←</span>
                <span>Check-out</span>
            </a>

            <a href="/admin/laporan"
                class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/10 transition">
                <span>▥</span>
                <span>Laporan</span>
            </a>

        </nav>

        {{-- LOGOUT --}}
        <div class="px-4 py-5 border-t border-white/10">
            <form action="/logout" method="POST">
                @csrf

                <button type="submit"
                    class="w-full text-left flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/10 transition">
                    <span>↪</span>
                    <span>Logout</span>
                </button>
            </form>
        </div>

    </aside>

    {{-- KONTEN UTAMA --}}
    <main class="ml-64 min-h-screen">

        {{-- HEADER --}}
        <header class="bg-white border-b border-gray-200 px-8 py-5 flex items-center justify-between">

            <div>
                <p class="text-sm text-gray-500">
                    Halaman Admin
                </p>

                <h2 class="text-2xl font-bold mt-1">
                    Dashboard
                </h2>
            </div>

            <div class="text-right">
                <p class="font-semibold">
                    {{ auth()->user()->nama ?? 'Administrator' }}
                </p>

                <p class="text-sm text-gray-500">
                    Administrator
                </p>
            </div>

        </header>

        {{-- ISI --}}
        <div class="p-8">

            {{-- PESAN --}}
            @if (session('success'))
                <div class="mb-6 bg-green-100 border border-green-200 text-green-700 px-5 py-4 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 bg-red-100 border border-red-200 text-red-700 px-5 py-4 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif

            {{-- SAMBUTAN --}}
            <div class="mb-8">
                <h3 class="text-2xl font-bold">
                    Selamat datang, Admin
                </h3>

                <p class="text-gray-600 mt-1">
                    Kelola kegiatan Hotel AMBATUKAM dari halaman ini.
                </p>
            </div>

            {{-- STATISTIK --}}
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5 mb-8">

                {{-- TOTAL KAMAR --}}
                <div class="bg-white rounded-xl border border-gray-200 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500">Total Kamar</p>
                            <p class="text-3xl font-bold mt-2">
                                {{ $totalKamar ?? 0 }}
                            </p>
                        </div>

                        <div class="w-11 h-11 rounded-lg bg-[#F4EFE6] flex items-center justify-center text-xl">
                            ▣
                        </div>
                    </div>

                    <a href="/admin/kamar" class="inline-block mt-5 text-sm font-semibold hover:underline">
                        Lihat kamar →
                    </a>
                </div>

                {{-- TOTAL TAMU --}}
                <div class="bg-white rounded-xl border border-gray-200 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500">Total Tamu</p>
                            <p class="text-3xl font-bold mt-2">
                                {{ $totalTamu ?? 0 }}
                            </p>
                        </div>

                        <div class="w-11 h-11 rounded-lg bg-[#F4EFE6] flex items-center justify-center text-xl">
                            ♙
                        </div>
                    </div>

                    <a href="/admin/tamu" class="inline-block mt-5 text-sm font-semibold hover:underline">
                        Lihat tamu →
                    </a>
                </div>

                {{-- TOTAL RESERVASI --}}
                <div class="bg-white rounded-xl border border-gray-200 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500">Total Reservasi</p>
                            <p class="text-3xl font-bold mt-2">
                                {{ $totalReservasi ?? 0 }}
                            </p>
                        </div>

                        <div class="w-11 h-11 rounded-lg bg-[#F4EFE6] flex items-center justify-center text-xl">
                            ▤
                        </div>
                    </div>

                    <a href="/admin/reservasi" class="inline-block mt-5 text-sm font-semibold hover:underline">
                        Lihat reservasi →
                    </a>
                </div>

                {{-- TOTAL PEMBAYARAN --}}
                <div class="bg-white rounded-xl border border-gray-200 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500">Pembayaran</p>
                            <p class="text-3xl font-bold mt-2">
                                {{ $totalPembayaran ?? 0 }}
                            </p>
                        </div>

                        <div class="w-11 h-11 rounded-lg bg-[#F4EFE6] flex items-center justify-center text-xl">
                            Rp
                        </div>
                    </div>

                    <a href="/admin/pembayaran" class="inline-block mt-5 text-sm font-semibold hover:underline">
                        Lihat pembayaran →
                    </a>
                </div>

            </div>

            
{{-- RINGKASAN PENDAPATAN --}}
<div class="mb-8">
    <div class="mb-4">
        <h3 class="text-xl font-bold">
            Ringkasan Pendapatan
        </h3>

        <p class="text-sm text-gray-500 mt-1">
            Ringkasan status pembayaran tamu.
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

        {{-- UANG MASUK --}}
        <div class="bg-white rounded-xl border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">
                        Pembayaran Disetujui
                    </p>

                    <p class="text-2xl font-bold mt-2 text-green-700">
                        Rp {{ number_format($totalUangMasuk ?? 0, 0, ',', '.') }}
                    </p>

                    <p class="text-sm text-gray-500 mt-2">
                        {{ $totalPembayaranDisetujui ?? 0 }}
                        pembayaran disetujui
                    </p>
                </div>

                <div class="w-12 h-12 rounded-lg bg-green-100 flex items-center justify-center text-green-700 text-xl">
                    ✓
                </div>
            </div>
        </div>

        {{-- PEMBAYARAN MENUNGGU --}}
        <div class="bg-white rounded-xl border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">
                        Pembayaran Menunggu
                    </p>

                    <p class="text-2xl font-bold mt-2 text-yellow-700">
                        Rp {{ number_format($totalUangMenunggu ?? 0, 0, ',', '.') }}
                    </p>

                    <p class="text-sm text-gray-500 mt-2">
                        {{ $totalPembayaranMenunggu ?? 0 }}
                        pembayaran menunggu
                    </p>
                </div>

                <div class="w-12 h-12 rounded-lg bg-yellow-100 flex items-center justify-center text-yellow-700 text-xl">
                    ⏱
                </div>
            </div>
        </div>

    </div>
</div>


{{-- GRAFIK RESERVASI BULANAN --}}
<div class="bg-white rounded-xl border border-gray-200 p-6 mb-8">

    <div class="mb-6">
        <h3 class="text-xl font-bold">
            Grafik Reservasi Bulanan
        </h3>

        <p class="text-sm text-gray-500 mt-1">
            Jumlah reservasi selama 6 bulan terakhir.
        </p>
    </div>

    @php
        $maksReservasi = max(
            collect($reservasiBulanan ?? [])->max('jumlah') ?? 0,
            1
        );
    @endphp

    <div class="space-y-5">

        @forelse ($reservasiBulanan ?? [] as $bulan)

            <div>
                <div class="flex justify-between items-center mb-2">
                    <span class="text-sm font-medium">
                        {{ $bulan['bulan'] ?? '-' }}
                    </span>

                    <span class="text-sm font-bold">
                        {{ $bulan['jumlah'] ?? 0 }} reservasi
                    </span>
                </div>

                <div class="w-full bg-[#F4EFE6] rounded-full h-4 overflow-hidden">

                    <div
                        class="bg-[#17324D] h-4 rounded-full transition-all duration-500"
                        style="width: {{ (($bulan['jumlah'] ?? 0) / $maksReservasi) * 100 }}%">
                    </div>

                </div>
            </div>

        @empty

            <p class="text-center text-gray-500 py-8">
                Belum ada data reservasi bulanan.
            </p>

        @endforelse

    </div>

</div>


            {{-- AKSES CEPAT --}}
            <div class="mb-8">
                <div class="mb-4">
                    <h3 class="text-xl font-bold">Akses Cepat</h3>

                    <p class="text-sm text-gray-500 mt-1">
                        Menu yang sering digunakan admin.
                    </p>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">

                    <a href="/admin/reservasi"
                        class="bg-white border border-gray-200 rounded-xl p-5 hover:-translate-y-0.5 active:scale-95 transition">
                        <p class="font-bold">Reservasi</p>
                        <p class="text-sm text-gray-500 mt-1">Kelola pesanan kamar</p>
                    </a>

                    <a href="/admin/pembayaran"
                        class="bg-white border border-gray-200 rounded-xl p-5 hover:-translate-y-0.5 active:scale-95 transition">
                        <p class="font-bold">Pembayaran</p>
                        <p class="text-sm text-gray-500 mt-1">Periksa pembayaran tamu</p>
                    </a>

                    <a href="/admin/checkin"
                        class="bg-white border border-gray-200 rounded-xl p-5 hover:-translate-y-0.5 active:scale-95 transition">
                        <p class="font-bold">Check-in</p>
                        <p class="text-sm text-gray-500 mt-1">Proses kedatangan tamu</p>
                    </a>

                    <a href="/admin/checkout"
                        class="bg-white border border-gray-200 rounded-xl p-5 hover:-translate-y-0.5 active:scale-95 transition">
                        <p class="font-bold">Check-out</p>
                        <p class="text-sm text-gray-500 mt-1">Proses kepulangan tamu</p>
                    </a>

                </div>
            </div>

            {{-- BAGIAN BAWAH --}}
            <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

                {{-- RESERVASI TERBARU --}}
                <div class="xl:col-span-2 bg-white border border-gray-200 rounded-xl">

                    <div class="px-6 py-5 border-b border-gray-200 flex items-center justify-between">
                        <div>
                            <h3 class="font-bold text-lg">Reservasi Terbaru</h3>

                            <p class="text-sm text-gray-500">
                                Data reservasi yang baru masuk
                            </p>
                        </div>

                        <a href="/admin/reservasi" class="text-sm font-semibold hover:underline">
                            Lihat semua
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">

                            <thead class="bg-[#F4EFE6]">
                                <tr>
                                    <th class="text-left px-6 py-4 font-semibold">Tamu</th>
                                    <th class="text-left px-6 py-4 font-semibold">Kamar</th>
                                    <th class="text-left px-6 py-4 font-semibold">Check-in</th>
                                    <th class="text-left px-6 py-4 font-semibold">Check-out</th>
                                    <th class="text-left px-6 py-4 font-semibold">Status</th>
                                    <th class="text-left px-6 py-4 font-semibold">Alasan Penolakan</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($reservasis as $reservasi)
                                    <tr class="border-t border-gray-100 hover:bg-gray-50">

                                        {{-- TAMU --}}
                                        <td class="px-6 py-4">
                                            <p class="font-semibold">
                                                {{ $reservasi->tamu->nama ?? '-' }}
                                            </p>
                                        </td>

                                        {{-- KAMAR --}}
                                        <td class="px-6 py-4">
                                            Kamar {{ $reservasi->kamar->nomor_kamar ?? '-' }}
                                        </td>

                                        {{-- CHECK-IN --}}
                                        <td class="px-6 py-4">
                                            {{ $reservasi->check_in
                                                ? \Carbon\Carbon::parse($reservasi->check_in)->format('d/m/Y')
                                                : '-' }}
                                        </td>

                                        {{-- CHECK-OUT --}}
                                        <td class="px-6 py-4">
                                            {{ $reservasi->check_out
                                                ? \Carbon\Carbon::parse($reservasi->check_out)->format('d/m/Y')
                                                : '-' }}
                                        </td>

                                        {{-- STATUS --}}
                                        <td class="px-6 py-4">
                                            @if ($reservasi->status === 'menunggu')
                                                <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-700">
                                                    Menunggu
                                                </span>
                                            @elseif ($reservasi->status === 'disetujui')
                                                <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                                                    Disetujui
                                                </span>
                                            @elseif ($reservasi->status === 'ditolak')
                                                <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700">
                                                    Ditolak
                                                </span>
                                            @elseif ($reservasi->status === 'check-in')
                                                <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-700">
                                                    Check-in
                                                </span>
                                            @elseif ($reservasi->status === 'check-out')
                                                <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-700">
                                                    Check-out
                                                </span>
                                            @else
                                                <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-700">
                                                    {{ ucfirst($reservasi->status) }}
                                                </span>
                                            @endif
                                        </td>

                                        {{-- ALASAN PENOLAKAN --}}
                                        <td class="px-6 py-4 min-w-48">
                                            @if ($reservasi->status === 'ditolak')
                                                <span class="text-red-600">
                                                    {{ $reservasi->pembayaran->alasan_penolakan ?? 'Alasan belum diisi' }}
                                                </span>
                                            @else
                                                <span class="text-gray-400">-</span>
                                            @endif
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-10 text-center text-gray-500">
                                            Belum ada data reservasi.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>

                        </table>
                    </div>
                </div>

                {{-- INFORMASI KAMAR --}}
                <div class="bg-white border border-gray-200 rounded-xl">

                    <div class="px-6 py-5 border-b border-gray-200">
                        <h3 class="font-bold text-lg">Status Kamar</h3>

                        <p class="text-sm text-gray-500 mt-1">
                            Kondisi kamar saat ini
                        </p>
                    </div>

                    <div class="p-6 space-y-5">

                        {{-- TERSEDIA --}}
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-3 h-3 rounded-full bg-green-500"></div>
                                <span class="text-gray-600">Tersedia</span>
                            </div>

                            <span class="font-bold">
                                {{ $kamarTersedia ?? 0 }}
                            </span>
                        </div>

                        {{-- PERBAIKAN --}}
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
                                <span class="text-gray-600">Perbaikan</span>
                            </div>

                            <span class="font-bold">
                                {{ $kamarPerbaikan ?? 0 }}
                            </span>
                        </div>

                        <div class="pt-4 border-t border-gray-200">
                            <a href="/admin/kamar"
                                class="block text-center bg-[#17324D] text-white py-3 rounded-lg font-semibold hover:-translate-y-0.5 active:scale-95 transition">
                                Kelola Kamar
                            </a>
                        </div>

                    </div>
                </div>

            </div>

            {{-- FOOTER --}}
            <div class="mt-8 text-center text-sm text-gray-500">
                © {{ date('Y') }} Hotel AMBATUKAM
            </div>

        </div>
    </main>

</body>
</html>