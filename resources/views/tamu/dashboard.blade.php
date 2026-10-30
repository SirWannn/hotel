<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Dashboard Tamu - Hotel AMBATUKAM</title>

    @vite('resources/css/app.css')
</head>

<body class="min-h-screen bg-[#F4EFE6] text-[#17324D]">

    <!-- NAVBAR -->
    <nav class="bg-[#17324D] text-white px-6 md:px-10 py-5 shadow-lg">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row md:items-center md:justify-between gap-4">

            <div>
                <h1 class="text-2xl md:text-3xl font-bold">
                    Hotel AMBATUKAM
                </h1>

                <p class="text-sm text-gray-200 mt-1">
                    Dashboard Tamu
                </p>
            </div>

            <div class="flex flex-wrap gap-3">
                <a
                    href="/profil"
                    class="bg-white text-[#17324D] px-4 py-2 rounded-lg font-semibold hover:-translate-y-0.5 active:scale-95 transition duration-200"
                >
                    Profil
                </a>

                <form action="/logout" method="POST">
                    @csrf

                    <button
                        type="submit"
                        class="bg-red-500 text-white px-4 py-2 rounded-lg font-semibold hover:bg-red-600 active:scale-95 transition duration-200"
                    >
                        Logout
                    </button>
                </form>
            </div>

        </div>
    </nav>


    <!-- CONTENT -->
    <main class="max-w-7xl mx-auto px-6 md:px-10 py-10">

        <!-- PESAN SUKSES -->
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-800 rounded-xl p-5 mb-6">
                <p class="font-semibold">
                    {{ session('success') }}
                </p>
            </div>
        @endif

        <!-- PESAN ERROR -->
        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-800 rounded-xl p-5 mb-6">
                <p class="font-semibold">
                    {{ session('error') }}
                </p>
            </div>
        @endif

        <!-- PESAN VALIDASI -->
        @if ($errors->any())
            <div class="bg-red-100 border border-red-300 text-red-800 rounded-xl p-5 mb-6">
                <p class="font-bold mb-2">
                    Ada data yang perlu diperbaiki:
                </p>

                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- KEMBALI KE UTAMA -->
        <div class="mb-6">
            <a
                href="/"
                class="inline-block bg-[#17324D] text-white px-5 py-3 rounded-lg font-semibold hover:-translate-y-0.5 active:scale-95 transition duration-200"
            >
                ⌂ Kembali ke Utama
            </a>
        </div>

        <!-- SAPAAN -->
        <div class="bg-white rounded-2xl shadow-lg border-2 border-[#17324D] p-6 md:p-8 mb-8">
            <p class="text-gray-600">
                Selamat datang,
            </p>

            <h2 class="text-3xl md:text-4xl font-bold mt-1">
                {{ $tamu->nama }}
            </h2>

            <p class="mt-3 text-gray-600">
                Berikut adalah daftar reservasi Anda di Hotel AMBATUKAM.
            </p>
        </div>


        <!-- DAFTAR RESERVASI -->
        @if ($reservasis->count() > 0)

            <div class="space-y-6">

                @foreach ($reservasis as $reservasi)

                    @php
                        $pembayaran = $reservasi->pembayaran;

                        $batasWaktu = $reservasi->created_at
                            ->copy()
                            ->addHour();
                    @endphp

                    <!-- CARD RESERVASI -->
                    <div class="bg-white rounded-2xl shadow-lg border-2 border-[#17324D] overflow-hidden">

                        <!-- HEADER RESERVASI -->
                        <div class="bg-[#17324D] text-white px-6 py-5">

                            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">

                                <div>
                                    <p class="text-sm text-gray-200">
                                        Nomor Reservasi
                                    </p>

                                    <h3 class="text-2xl font-bold">
                                        #{{ $reservasi->id }}
                                    </h3>
                                </div>

                                <!-- STATUS RESERVASI -->
                                <div>

                                    @if ($reservasi->status === 'menunggu')
                                        <span class="inline-block bg-yellow-400 text-gray-900 px-4 py-2 rounded-full text-sm font-bold">
                                            Menunggu
                                        </span>

                                    @elseif ($reservasi->status === 'disetujui')
                                        <span class="inline-block bg-green-400 text-gray-900 px-4 py-2 rounded-full text-sm font-bold">
                                            Disetujui
                                        </span>

                                    @elseif ($reservasi->status === 'ditolak')
                                        <span class="inline-block bg-red-400 text-gray-900 px-4 py-2 rounded-full text-sm font-bold">
                                            Ditolak
                                        </span>

                                    @elseif ($reservasi->status === 'check-in')
                                        <span class="inline-block bg-blue-400 text-gray-900 px-4 py-2 rounded-full text-sm font-bold">
                                            Check-in
                                        </span>

                                    @elseif ($reservasi->status === 'check-out')
                                        <span class="inline-block bg-gray-300 text-gray-900 px-4 py-2 rounded-full text-sm font-bold">
                                            Check-out
                                        </span>

                                    @else
                                        <span class="inline-block bg-gray-300 text-gray-900 px-4 py-2 rounded-full text-sm font-bold">
                                            {{ ucfirst($reservasi->status) }}
                                        </span>
                                    @endif

                                </div>

                            </div>
                        </div>


                        <!-- DETAIL RESERVASI -->
                        <div class="p-6">

                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">

                                <!-- KAMAR -->
                                <div class="bg-[#F4EFE6] rounded-xl p-4">
                                    <p class="text-sm text-gray-600">
                                        Nomor Kamar
                                    </p>

                                    <p class="text-xl font-bold mt-1">
                                        {{ $reservasi->kamar->nomor_kamar ?? '-' }}
                                    </p>
                                </div>

                                <!-- JUMLAH TAMU -->
                                <div class="bg-[#F4EFE6] rounded-xl p-4">
                                    <p class="text-sm text-gray-600">
                                        Jumlah Tamu
                                    </p>

                                    <p class="text-xl font-bold mt-1">
                                        {{ $reservasi->jumlah_tamu }} orang
                                    </p>
                                </div>

                                <!-- CHECK-IN -->
                                <div class="bg-[#F4EFE6] rounded-xl p-4">
                                    <p class="text-sm text-gray-600">
                                        Check-in
                                    </p>

                                    <p class="text-lg font-bold mt-1">
                                        {{ \Carbon\Carbon::parse($reservasi->check_in)->format('d-m-Y') }}
                                    </p>
                                </div>

                                <!-- CHECK-OUT -->
                                <div class="bg-[#F4EFE6] rounded-xl p-4">
                                    <p class="text-sm text-gray-600">
                                        Check-out
                                    </p>

                                    <p class="text-lg font-bold mt-1">
                                        {{ \Carbon\Carbon::parse($reservasi->check_out)->format('d-m-Y') }}
                                    </p>
                                </div>

                            </div>


                            <!-- PEMBAYARAN -->
                            <div class="mt-6 border-t-2 border-gray-200 pt-6">

                                <h4 class="text-xl font-bold mb-4">
                                    Status Pembayaran
                                </h4>

                                @if ($pembayaran)

                                    <!-- PEMBAYARAN MENUNGGU -->
                                    @if ($pembayaran->status === 'menunggu')

                                        <div class="bg-yellow-50 border border-yellow-300 rounded-xl p-5">

                                            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">

                                                <div>
                                                    <p class="font-bold text-yellow-800 text-lg">
                                                        Menunggu Pemeriksaan Admin
                                                    </p>

                                                    <p class="text-sm text-yellow-700 mt-1">
                                                        Bukti pembayaran sudah dikirim.
                                                        Silakan menunggu Admin memeriksa pembayaran Anda.
                                                    </p>
                                                </div>

                                                <span class="bg-yellow-200 text-yellow-900 px-4 py-2 rounded-full font-semibold">
                                                    Menunggu
                                                </span>

                                            </div>

                                        </div>

                                    <!-- PEMBAYARAN DISETUJUI -->
                                    @elseif ($pembayaran->status === 'disetujui')

                                        <div class="bg-green-50 border border-green-300 rounded-xl p-5">

                                            <p class="font-bold text-green-800 text-lg">
                                                Pembayaran Disetujui
                                            </p>

                                            <p class="text-sm text-green-700 mt-1">
                                                Pembayaran Anda telah diperiksa dan disetujui oleh Admin.
                                            </p>

                                            <div class="mt-4">
                                                <a
                                                    href="/pembayaran/{{ $pembayaran->id }}/kuitansi"
                                                    class="inline-block bg-[#17324D] text-white px-5 py-3 rounded-lg font-semibold hover:-translate-y-0.5 active:scale-95 transition duration-200"
                                                >
                                                    Lihat Kuitansi
                                                </a>
                                            </div>

                                        </div>

                                    <!-- PEMBAYARAN DITOLAK -->
                                    @elseif ($pembayaran->status === 'ditolak')

                                        <div class="bg-red-50 border border-red-300 rounded-xl p-5">

                                            <p class="font-bold text-red-800 text-lg">
                                                Pembayaran Ditolak
                                            </p>

                                            <p class="text-sm text-red-700 mt-1">
                                                Bukti pembayaran Anda ditolak oleh Admin.
                                            </p>

                                            @if ($pembayaran->alasan_penolakan)

                                                <div class="mt-4 bg-white border border-red-200 rounded-lg p-4">

                                                    <p class="text-sm font-semibold text-gray-600">
                                                        Alasan Penolakan:
                                                    </p>

                                                    <p class="text-red-700 mt-1">
                                                        {{ $pembayaran->alasan_penolakan }}
                                                    </p>

                                                </div>

                                            @endif

                                        </div>

                                    @else

                                        <div class="bg-gray-50 border border-gray-300 rounded-xl p-5">
                                            <p class="font-semibold text-gray-700">
                                                Status pembayaran: {{ ucfirst($pembayaran->status) }}
                                            </p>
                                        </div>

                                    @endif

                                @else

                                    <!-- BELUM BAYAR -->
                                    <div class="bg-gray-50 border border-gray-300 rounded-xl p-5">

                                        <p class="font-bold text-gray-800 text-lg">
                                            Belum Melakukan Pembayaran
                                        </p>

                                        <p class="text-sm text-gray-600 mt-1">
                                            Silakan melakukan pembayaran untuk menyelesaikan reservasi.
                                        </p>

                                    </div>

                                @endif

                            </div>


                            <!-- ====================================== -->
                            <!-- RATING KAMAR -->
                            <!-- Ditampilkan setelah check-out -->
                            <!-- ====================================== -->

                            @if ($reservasi->status === 'check-out')

                                <div class="mt-6 border-t-2 border-gray-200 pt-6">

                                    <h4 class="text-xl font-bold text-[#17324D] mb-4">
                                        ⭐ Rating Kamar
                                    </h4>

                                    @if ($reservasi->rating)

                                        <!-- RATING SUDAH DIBERIKAN -->
                                        <div class="bg-yellow-50 border border-yellow-300 rounded-xl p-5">

                                            <p class="font-bold text-gray-800">
                                                Rating Anda
                                            </p>

                                            <p class="text-3xl text-yellow-500 my-2">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    {{ $i <= $reservasi->rating->rating ? '★' : '☆' }}
                                                @endfor
                                            </p>

                                            <p class="text-gray-700">
                                                Nilai: {{ $reservasi->rating->rating }}/5
                                            </p>

                                            @if ($reservasi->rating->ulasan)

                                                <div class="mt-3">
                                                    <p class="font-semibold">
                                                        Ulasan Anda:
                                                    </p>

                                                    <p class="text-gray-700 mt-1 whitespace-pre-line">
                                                        {{ $reservasi->rating->ulasan }}
                                                    </p>
                                                </div>

                                            @endif

                                            <p class="text-green-700 font-semibold mt-3">
                                                ✓ Anda sudah memberikan rating.
                                            </p>

                                        </div>

                                    @else

                                        <!-- FORM RATING -->
                                        <form
                                            action="{{ route('tamu.rating.store', $reservasi->id) }}"
                                            method="POST"
                                            class="bg-[#F4EFE6] rounded-xl p-5 space-y-4"
                                        >

                                            @csrf

                                            <div>
                                                <label
                                                    for="rating-{{ $reservasi->id }}"
                                                    class="block font-semibold mb-2 text-gray-800"
                                                >
                                                    Berikan Rating (1–5 Bintang)
                                                </label>

                                                <select
                                                    id="rating-{{ $reservasi->id }}"
                                                    name="rating"
                                                    required
                                                    class="w-full border border-gray-300 rounded-lg p-3 bg-white"
                                                >
                                                    <option value="">
                                                        Pilih rating
                                                    </option>

                                                    <option value="5" {{ old('rating') == '5' ? 'selected' : '' }}>
                                                        ★★★★★ - Sangat Baik
                                                    </option>

                                                    <option value="4" {{ old('rating') == '4' ? 'selected' : '' }}>
                                                        ★★★★☆ - Baik
                                                    </option>

                                                    <option value="3" {{ old('rating') == '3' ? 'selected' : '' }}>
                                                        ★★★☆☆ - Cukup
                                                    </option>

                                                    <option value="2" {{ old('rating') == '2' ? 'selected' : '' }}>
                                                        ★★☆☆☆ - Kurang
                                                    </option>

                                                    <option value="1" {{ old('rating') == '1' ? 'selected' : '' }}>
                                                        ★☆☆☆☆ - Buruk
                                                    </option>
                                                </select>
                                            </div>

                                            <div>
                                                <label
                                                    for="ulasan-{{ $reservasi->id }}"
                                                    class="block font-semibold mb-2 text-gray-800"
                                                >
                                                    Ulasan (Opsional)
                                                </label>

                                                <textarea
                                                    id="ulasan-{{ $reservasi->id }}"
                                                    name="ulasan"
                                                    rows="3"
                                                    maxlength="1000"
                                                    class="w-full border border-gray-300 rounded-lg p-3 bg-white"
                                                    placeholder="Bagikan pengalaman Anda selama menginap..."
                                                >{{ old('ulasan') }}</textarea>

                                                <p class="text-sm text-gray-500 mt-1">
                                                    Maksimal 1000 karakter.
                                                </p>
                                            </div>

                                            <button
                                                type="submit"
                                                class="bg-[#17324D] text-white px-5 py-3 rounded-lg font-semibold hover:bg-[#244b70] transition"
                                            >
                                                ⭐ Kirim Rating
                                            </button>

                                        </form>

                                    @endif

                                </div>

                            @endif


                            <!-- TOMBOL AKSI -->
                            <div class="mt-6 border-t-2 border-gray-200 pt-6">

                                <div class="flex flex-wrap gap-3">

                                    <!-- EDIT PESANAN -->
                                    @if ($pembayaran)

                                        <div>
                                            <span class="inline-block bg-gray-400 text-white px-5 py-3 rounded-lg font-semibold cursor-not-allowed">
                                                Edit Pesanan Kadaluarsa
                                            </span>

                                            <p class="text-sm text-gray-600 mt-2">
                                                Pembayaran sudah dilakukan.
                                                Pesanan tidak dapat diedit lagi.
                                            </p>
                                        </div>

                                    @elseif ($batasWaktu->isPast())

                                        <div>
                                            <span class="inline-block bg-gray-400 text-white px-5 py-3 rounded-lg font-semibold cursor-not-allowed">
                                                Edit Pesanan Kadaluarsa
                                            </span>

                                            <p class="text-sm text-gray-600 mt-2">
                                                Batas waktu edit pesanan sudah berakhir.
                                            </p>
                                        </div>

                                    @else

                                        <a
                                            href="/reservasi/{{ $reservasi->id }}/edit"
                                            class="inline-block bg-[#17324D] text-white px-5 py-3 rounded-lg font-semibold hover:-translate-y-0.5 active:scale-95 transition duration-200"
                                        >
                                            Edit Pesanan
                                        </a>

                                    @endif


                                    <!-- BAYAR -->
                                    @if (!$pembayaran && $reservasi->status === 'menunggu')

                                        <a
                                            href="/pembayaran"
                                            onclick="sessionStorage.setItem('reservasi_id', '{{ $reservasi->id }}')"
                                            class="inline-block bg-green-600 text-white px-5 py-3 rounded-lg font-semibold hover:bg-green-700 hover:-translate-y-0.5 active:scale-95 transition duration-200"
                                        >
                                            Lakukan Pembayaran
                                        </a>

                                    @endif

                                </div>

                            </div>


                            <!-- INFORMASI EDIT -->
                            @if (!$pembayaran && !$batasWaktu->isPast())

                                <div class="mt-5 bg-blue-50 border border-blue-300 rounded-xl p-4">

                                    <p class="text-sm text-blue-800">
                                        <strong>Informasi:</strong>
                                        Anda masih dapat mengedit pesanan sampai
                                        {{ $batasWaktu->format('d-m-Y H:i') }}.
                                    </p>

                                </div>

                            @endif

                        </div>
                    </div>

                @endforeach

            </div>

        @else

            <!-- BELUM ADA RESERVASI -->
            <div class="bg-white rounded-2xl shadow-lg border-2 border-[#17324D] p-10 text-center">

                <h2 class="text-2xl font-bold">
                    Belum Ada Reservasi
                </h2>

                <p class="text-gray-600 mt-3">
                    Anda belum memiliki reservasi kamar.
                </p>

                <a
                    href="/kamar"
                    class="inline-block mt-6 bg-[#17324D] text-white px-6 py-3 rounded-lg font-semibold hover:-translate-y-0.5 active:scale-95 transition duration-200"
                >
                    Lihat Kamar
                </a>

            </div>

        @endif

    </main>


    <!-- FOOTER -->
    <footer class="bg-[#17324D] text-white text-center py-6 mt-10">

        <p>
            © 2026 Hotel AMBATUKAM
        </p>

        <p class="text-sm text-gray-300 mt-1">
            Sistem Reservasi Hotel
        </p>

    </footer>

</body>
</html>
