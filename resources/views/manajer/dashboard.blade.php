<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard Manajer - Hotel AMBATUKAM</title>

    @vite('resources/css/app.css')
</head>

<body class="min-h-screen bg-[#F4EFE6]">

    <!-- Navbar -->
    <nav class="bg-[#17324D] text-white px-8 py-5 shadow-lg">

        <div class="max-w-7xl mx-auto flex justify-between items-center">

            <div>
                <h1 class="text-2xl font-bold">
                    Hotel AMBATUKAM
                </h1>

                <p class="text-sm opacity-90">
                    Dashboard Manajer
                </p>
            </div>


            <!-- Logout -->
            <form action="/logout" method="POST">

                @csrf

                <button
                    type="submit"
                    class="bg-white text-[#17324D]
                           px-5 py-2 rounded-xl
                           font-semibold
                           hover:bg-[#F4EFE6]
                           hover:-translate-y-1
                           active:scale-95
                           transition-all duration-200">

                    Logout

                </button>

            </form>

        </div>

    </nav>


    <!-- Isi Dashboard -->
    <main class="max-w-7xl mx-auto px-6 py-10">

        <div class="mb-8">

            <h2 class="text-3xl font-bold text-[#17324D]">
                Dashboard Manajer
            </h2>

            <p class="text-[#17324D] mt-2">
                Ringkasan data dan aktivitas Hotel AMBATUKAM.
            </p>

        </div>


        <!-- Statistik -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">


            <!-- Kamar -->
            <a href="/manajer/kamar"
               class="bg-white rounded-2xl p-6 shadow-lg
                      border-2 border-[#17324D]
                      hover:-translate-y-2
                      hover:shadow-2xl
                      active:scale-95
                      transition-all duration-200">

                <div class="text-4xl mb-4">
                    🏨
                </div>

                <p class="text-[#17324D] font-semibold">
                    Jumlah Kamar
                </p>

                <p class="text-3xl font-bold text-[#17324D] mt-2">
                    {{ $totalKamar }}
                </p>

                <p class="text-[#17324D] mt-2">
                    Total kamar hotel
                </p>

            </a>


            <!-- Tamu -->
            <a href="/manajer/tamu"
               class="bg-white rounded-2xl p-6 shadow-lg
                      border-2 border-[#17324D]
                      hover:-translate-y-2
                      hover:shadow-2xl
                      active:scale-95
                      transition-all duration-200">

                <div class="text-4xl mb-4">
                    👤
                </div>

                <p class="text-[#17324D] font-semibold">
                    Jumlah Tamu
                </p>

                <p class="text-3xl font-bold text-[#17324D] mt-2">
                    {{ $totalTamu }}
                </p>

                <p class="text-[#17324D] mt-2">
                    Total tamu hotel
                </p>

            </a>


            <!-- Reservasi -->
            <a href="/manajer/reservasi"
               class="bg-white rounded-2xl p-6 shadow-lg
                      border-2 border-[#17324D]
                      hover:-translate-y-2
                      hover:shadow-2xl
                      active:scale-95
                      transition-all duration-200">

                <div class="text-4xl mb-4">
                    📅
                </div>

                <p class="text-[#17324D] font-semibold">
                    Jumlah Reservasi
                </p>

                <p class="text-3xl font-bold text-[#17324D] mt-2">
                    {{ $totalReservasi }}
                </p>

                <p class="text-[#17324D] mt-2">
                    Total reservasi hotel
                </p>

            </a>


            <!-- Laporan -->
            <a href="/manajer/laporan"
               class="bg-white rounded-2xl p-6 shadow-lg
                      border-2 border-[#17324D]
                      hover:-translate-y-2
                      hover:shadow-2xl
                      active:scale-95
                      transition-all duration-200">

                <div class="text-4xl mb-4">
                    📊
                </div>

                <p class="text-[#17324D] font-semibold">
                    Jumlah Laporan
                </p>

                <p class="text-3xl font-bold text-[#17324D] mt-2">
                    {{ $jumlahLaporan }}
                </p>

                <p class="text-[#17324D] mt-2">
                    Total laporan hotel
                </p>

            </a>


        </div>

    </main>


    <!-- Footer -->
    <footer class="text-center text-[#17324D] py-6">

        © 2026 Hotel AMBATUKAM

    </footer>

</body>
</html>