<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Laporan Hotel AMBATUKAM</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        @media print {
            .no-print {
                display: none !important;
            }

            body {
                background: white !important;
                color: black !important;
            }

            main {
                max-width: 100% !important;
                padding: 10px !important;
            }

            .report-card {
                box-shadow: none !important;
                break-inside: avoid;
            }
        }
    </style>
</head>

<body class="min-h-screen bg-[#F4EFE6] text-[#17324D]">

    {{-- NAVBAR --}}
    <nav class="no-print bg-[#17324D] text-white px-6 py-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center">

            <div>
                <h1 class="text-2xl font-bold">
                    HOTEL AMBATUKAM
                </h1>

                <p class="text-sm text-white/70">
                    Laporan Admin
                </p>
            </div>

            <a href="/admin"
                class="border border-white rounded-lg px-4 py-2 hover:bg-white hover:text-[#17324D]">
                Kembali
            </a>

        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-6 py-8">

        {{-- JUDUL --}}
        <div class="flex flex-wrap justify-between items-center gap-4 mb-6">

            <div>
                <h2 class="text-3xl font-bold">
                    Laporan Hotel
                </h2>

                <p class="text-gray-600 mt-1">
                    Ringkasan laporan Hotel AMBATUKAM.
                </p>
            </div>

            <button onclick="window.print()"
                class="no-print bg-[#17324D] text-white px-5 py-3 rounded-lg font-semibold">
                Cetak Laporan
            </button>

        </div>

        {{-- PESAN ERROR --}}
        @if ($errors->any())
            <div class="no-print bg-red-100 text-red-700 rounded-lg p-4 mb-5">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        {{-- FILTER TANGGAL --}}
        <div class="no-print bg-white rounded-xl border border-gray-200 p-5 mb-6">

            <h3 class="font-bold text-lg mb-4">
                Filter Tanggal
            </h3>

            <form action="{{ url('/admin/laporan') }}" method="GET"
                class="grid grid-cols-1 md:grid-cols-3 gap-4">

                <div>
                    <label for="tanggal_mulai" class="block text-sm mb-2">
                        Tanggal Mulai
                    </label>

                    <input type="date"
                        id="tanggal_mulai"
                        name="tanggal_mulai"
                        value="{{ $tanggalMulai }}"
                        class="w-full border rounded-lg px-3 py-2">
                </div>

                <div>
                    <label for="tanggal_akhir" class="block text-sm mb-2">
                        Tanggal Akhir
                    </label>

                    <input type="date"
                        id="tanggal_akhir"
                        name="tanggal_akhir"
                        value="{{ $tanggalAkhir }}"
                        min="{{ $tanggalMulai }}"
                        class="w-full border rounded-lg px-3 py-2">
                </div>

                <div class="flex items-end gap-2">

                    <button type="submit"
                        class="flex-1 bg-[#17324D] text-white rounded-lg px-4 py-2">
                        Terapkan
                    </button>

                    <a href="{{ url('/admin/laporan') }}"
                        class="flex-1 text-center border rounded-lg px-4 py-2">
                        Reset
                    </a>

                </div>

            </form>

        </div>

        {{-- PERIODE LAPORAN --}}
        <p class="text-sm text-gray-600 mb-5">
            Periode:
            {{ $tanggalMulai ? \Carbon\Carbon::parse($tanggalMulai)->format('d/m/Y') : 'Awal data' }}
            -
            {{ $tanggalAkhir ? \Carbon\Carbon::parse($tanggalAkhir)->format('d/m/Y') : 'Akhir data' }}
        </p>

        {{-- RINGKASAN --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 mb-8">

            <div class="report-card bg-white rounded-xl border p-5">
                <p class="text-gray-500 text-sm">Total Uang Masuk</p>
                <h3 class="text-2xl font-bold mt-2">
                    Rp {{ number_format($totalUangMasuk, 0, ',', '.') }}
                </h3>
            </div>

            <div class="report-card bg-white rounded-xl border p-5">
                <p class="text-gray-500 text-sm">Total Reservasi</p>
                <h3 class="text-2xl font-bold mt-2">
                    {{ $totalReservasi }}
                </h3>
            </div>

            <div class="report-card bg-white rounded-xl border p-5">
                <p class="text-gray-500 text-sm">Total Tamu</p>
                <h3 class="text-2xl font-bold mt-2">
                    {{ $totalTamu }}
                </h3>
            </div>

            <div class="report-card bg-white rounded-xl border p-5">
                <p class="text-gray-500 text-sm">Total Kamar</p>
                <h3 class="text-2xl font-bold mt-2">
                    {{ $totalKamar }}
                </h3>
            </div>

            <div class="report-card bg-white rounded-xl border p-5">
                <p class="text-gray-500 text-sm">Kamar Tersedia</p>
                <h3 class="text-2xl font-bold mt-2">
                    {{ $kamarTersedia }}
                </h3>
            </div>

            <div class="report-card bg-white rounded-xl border p-5">
                <p class="text-gray-500 text-sm">Kamar Terisi</p>
                <h3 class="text-2xl font-bold mt-2">
                    {{ $kamarTerisi }}
                </h3>
            </div>

        </div>

        {{-- GRAFIK --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            {{-- GRAFIK UANG MASUK --}}
            <div class="report-card bg-white rounded-xl border p-5">

                <h3 class="text-lg font-bold mb-4">
                    Grafik Uang Masuk
                </h3>

                <div class="relative h-72">
                    <canvas id="grafikUangMasuk"></canvas>
                </div>

            </div>

            {{-- GRAFIK RESERVASI --}}
            <div class="report-card bg-white rounded-xl border p-5">

                <h3 class="text-lg font-bold mb-4">
                    Grafik Reservasi
                </h3>

                <div class="relative h-72">
                    <canvas id="grafikReservasi"></canvas>
                </div>

            </div>

        </div>

        {{-- FOOTER --}}
        <div class="text-center text-sm text-gray-500 mt-8">
            © {{ date('Y') }} Hotel AMBATUKAM
        </div>

    </main>

    {{-- GRAFIK --}}
    <script>
        const tanggalUangMasuk = @json($uangMasuk->pluck('tanggal')->values());
        const jumlahUangMasuk = @json($uangMasuk->pluck('total')->values());

        const tanggalReservasi = @json($jumlahReservasi->pluck('tanggal')->values());
        const jumlahReservasiData = @json($jumlahReservasi->pluck('total')->values());

        function formatRupiah(nilai) {
            return 'Rp ' + Number(nilai).toLocaleString('id-ID');
        }

        // GRAFIK UANG MASUK
        new Chart(document.getElementById('grafikUangMasuk'), {
            type: 'bar',

            data: {
                labels: tanggalUangMasuk,

                datasets: [{
                    label: 'Uang Masuk',
                    data: jumlahUangMasuk,
                    backgroundColor: '#17324D',
                    borderRadius: 5
                }]
            },

            options: {
                responsive: true,
                maintainAspectRatio: false,

                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return formatRupiah(context.raw);
                            }
                        }
                    }
                },

                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return formatRupiah(value);
                            }
                        }
                    }
                }
            }
        });

        // GRAFIK RESERVASI
        new Chart(document.getElementById('grafikReservasi'), {
            type: 'line',

            data: {
                labels: tanggalReservasi,

                datasets: [{
                    label: 'Jumlah Reservasi',
                    data: jumlahReservasiData,
                    borderColor: '#17324D',
                    backgroundColor: 'rgba(23, 50, 77, 0.12)',
                    pointBackgroundColor: '#17324D',
                    borderWidth: 2,
                    tension: 0.3,
                    fill: true
                }]
            },

            options: {
                responsive: true,
                maintainAspectRatio: false,

                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                            precision: 0
                        }
                    }
                }
            }
        });
    </script>

</body>
</html>
