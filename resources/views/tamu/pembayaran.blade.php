<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Pembayaran - Hotel AMBATUKAM</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>


<body class="bg-[#F4EFE6] min-h-screen">


    <!-- NAVBAR -->

    <nav class="bg-[#17324D] text-white px-8 py-4">

        <div class="max-w-6xl mx-auto">

            <div class="flex justify-between items-center">

                <div>

                    <h1 class="text-xl font-bold">
                        Hotel AMBATUKAM
                    </h1>

                    <p class="text-sm">
                        Pembayaran - Tamu
                    </p>

                </div>


                <form
                    action="/logout"
                    method="POST"
                >

                    @csrf

                    <button
                        type="submit"
                        class="bg-white text-[#17324D]
                        hover:bg-[#F4EFE6]
                        hover:-translate-y-0.5
                        active:scale-95
                        transition-all duration-200
                        px-4 py-2 rounded-lg"
                    >

                        Logout

                    </button>

                </form>

            </div>

        </div>

    </nav>


    <!-- CONTENT -->

    <div class="max-w-3xl mx-auto py-10 px-4">


        <div class="bg-white rounded-2xl shadow-lg p-8">


            <!-- JUDUL -->

            <h1 class="text-3xl font-bold text-[#17324D] mb-2">

                Pembayaran Reservasi

            </h1>


            <p class="text-[#17324D] mb-8">

                Silakan pilih metode pembayaran yang ingin digunakan.

            </p>


            <!-- ERROR -->

            @if ($errors->any())

                <div
                    class="bg-[#F4EFE6]
                    text-[#17324D]
                    border border-[#17324D]
                    p-4 rounded-lg mb-6"
                >

                    <ul class="list-disc list-inside">

                        @foreach ($errors->all() as $error)

                            <li>

                                {{ $error }}

                            </li>

                        @endforeach

                    </ul>

                </div>

            @endif


            <!-- SUCCESS -->

            @if (session('success'))

                <div
                    class="bg-green-100
                    border border-green-400
                    text-green-700
                    p-4 rounded-lg mb-6"
                >

                    {{ session('success') }}

                </div>

            @endif


            @if ($reservasi)


                <!-- INFORMASI RESERVASI -->

                <div
                    class="mb-6
                    bg-[#F4EFE6]
                    border border-[#17324D]
                    rounded-xl
                    p-5"
                >

                    <p class="text-sm text-[#17324D] mb-1">

                        Kamar yang dipilih

                    </p>


                    <h2
                        class="text-2xl
                        font-bold
                        text-[#17324D]"
                    >

                        Kamar
                        {{ $reservasi->kamar->nomor_kamar ?? '-' }}

                    </h2>


                    <p
                        class="font-semibold
                        text-[#17324D]
                        mt-1"
                    >

                        {{ $reservasi->kamar->tipe_kamar ?? '-' }}

                    </p>


                    <div
                        class="mt-4
                        space-y-1
                        text-[#17324D]"
                    >

                        <p>

                            <span class="font-semibold">
                                Check-in:
                            </span>

                            {{ $reservasi->check_in }}

                        </p>


                        <p>

                            <span class="font-semibold">
                                Check-out:
                            </span>

                            {{ $reservasi->check_out }}

                        </p>


                        <p>

                            <span class="font-semibold">
                                Jumlah Tamu:
                            </span>

                            {{ $reservasi->jumlah_tamu }}
                            orang

                        </p>

                    </div>

                </div>


                <!-- RINCIAN PEMBAYARAN -->

                <div
                    class="mb-8
                    border border-[#17324D]
                    rounded-xl
                    p-5"
                >

                    <h2
                        class="text-xl
                        font-bold
                        text-[#17324D]
                        mb-4"
                    >

                        Rincian Pembayaran

                    </h2>


                    <div
                        class="flex justify-between
                        border-b pb-3 mb-3"
                    >

                        <span class="text-[#17324D]">

                            Harga kamar / malam

                        </span>


                        <span
                            class="font-semibold
                            text-[#17324D]"
                        >

                            Rp
                            {{ number_format(
                                $reservasi->kamar->harga ?? 0,
                                0,
                                ',',
                                '.'
                            ) }}

                        </span>

                    </div>


                    <div
                        class="flex justify-between
                        border-b pb-3 mb-3"
                    >

                        <span class="text-[#17324D]">

                            Jumlah malam

                        </span>


                        <span
                            class="font-semibold
                            text-[#17324D]"
                        >

                            {{ $jumlahMalam }}
                            malam

                        </span>

                    </div>


                    <div
                        class="flex justify-between
                        bg-[#F4EFE6]
                        rounded-lg
                        p-4"
                    >

                        <span
                            class="font-bold
                            text-[#17324D]"
                        >

                            Total Pembayaran

                        </span>


                        <span
                            class="text-2xl
                            font-bold
                            text-[#17324D]"
                        >

                            Rp
                            {{ number_format(
                                $totalPembayaran,
                                0,
                                ',',
                                '.'
                            ) }}

                        </span>

                    </div>

                </div>


                <!-- PILIH METODE -->

                <div>

                    <h2
                        class="text-xl
                        font-bold
                        text-[#17324D]
                        mb-4"
                    >

                        Pilih Metode Pembayaran

                    </h2>


                    <div class="grid md:grid-cols-2 gap-4">


                        <!-- BANK -->

                        <a
                            href="/pembayaran/metode/bank"
                            class="border border-[#17324D]
                            rounded-xl
                            p-5
                            bg-white
                            hover:bg-[#F4EFE6]
                            hover:-translate-y-1
                            active:scale-95
                            transition-all duration-200"
                        >

                            <div class="flex items-center gap-4">

                                <div
                                    class="w-20 h-20
                                    bg-[#F4EFE6]
                                    rounded-lg
                                    flex items-center
                                    justify-center
                                    overflow-hidden"
                                >

                                    <img
                                        src="{{ asset('images/pembayaran/bank.jpg') }}"
                                        alt="Transfer Bank"
                                        class="w-full h-full
                                        object-contain
                                        rounded-lg"
                                    >

                                </div>


                                <div>

                                    <h3
                                        class="font-bold
                                        text-lg
                                        text-[#17324D]"
                                    >

                                        Transfer Bank

                                    </h3>


                                    <p class="text-sm text-gray-600">

                                        Virtual Account

                                    </p>

                                </div>

                            </div>

                        </a>


                        <!-- DANA -->

                        <a
                            href="/pembayaran/metode/dana"
                            class="border border-[#17324D]
                            rounded-xl
                            p-5
                            bg-white
                            hover:bg-[#F4EFE6]
                            hover:-translate-y-1
                            active:scale-95
                            transition-all duration-200"
                        >

                            <div class="flex items-center gap-4">

                                <div
                                    class="w-20 h-20
                                    bg-[#F4EFE6]
                                    rounded-lg
                                    flex items-center
                                    justify-center
                                    overflow-hidden"
                                >

                                    <img
                                        src="{{ asset('images/pembayaran/dana.jpg') }}"
                                        alt="DANA"
                                        class="w-full h-full
                                        object-contain
                                        rounded-lg"
                                    >

                                </div>


                                <div>

                                    <h3
                                        class="font-bold
                                        text-lg
                                        text-[#17324D]"
                                    >

                                        DANA

                                    </h3>


                                    <p class="text-sm text-gray-600">

                                        E-Wallet

                                    </p>

                                </div>

                            </div>

                        </a>


                        <!-- OVO -->

                        <a
                            href="/pembayaran/metode/ovo"
                            class="border border-[#17324D]
                            rounded-xl
                            p-5
                            bg-white
                            hover:bg-[#F4EFE6]
                            hover:-translate-y-1
                            active:scale-95
                            transition-all duration-200"
                        >

                            <div class="flex items-center gap-4">

                                <div
                                    class="w-20 h-20
                                    bg-[#F4EFE6]
                                    rounded-lg
                                    flex items-center
                                    justify-center
                                    overflow-hidden"
                                >

                                    <img
                                        src="{{ asset('images/pembayaran/ovo.jpg') }}"
                                        alt="OVO"
                                        class="w-full h-full
                                        object-contain
                                        rounded-lg"
                                    >

                                </div>


                                <div>

                                    <h3
                                        class="font-bold
                                        text-lg
                                        text-[#17324D]"
                                    >

                                        OVO

                                    </h3>


                                    <p class="text-sm text-gray-600">

                                        E-Wallet

                                    </p>

                                </div>

                            </div>

                        </a>


                        <!-- GOPAY -->

                        <a
                            href="/pembayaran/metode/gopay"
                            class="border border-[#17324D]
                            rounded-xl
                            p-5
                            bg-white
                            hover:bg-[#F4EFE6]
                            hover:-translate-y-1
                            active:scale-95
                            transition-all duration-200"
                        >

                            <div class="flex items-center gap-4">

                                <div
                                    class="w-20 h-20
                                    bg-[#F4EFE6]
                                    rounded-lg
                                    flex items-center
                                    justify-center
                                    overflow-hidden"
                                >

                                    <img
                                        src="{{ asset('images/pembayaran/gopay.jpg') }}"
                                        alt="GoPay"
                                        class="w-full h-full
                                        object-contain
                                        rounded-lg"
                                    >

                                </div>


                                <div>

                                    <h3
                                        class="font-bold
                                        text-lg
                                        text-[#17324D]"
                                    >

                                        GoPay

                                    </h3>


                                    <p class="text-sm text-gray-600">

                                        E-Wallet

                                    </p>

                                </div>

                            </div>

                        </a>


                        <!-- QRIS -->

                        <a
                            href="/pembayaran/metode/qris"
                            class="border border-[#17324D]
                            rounded-xl
                            p-5
                            bg-white
                            hover:bg-[#F4EFE6]
                            hover:-translate-y-1
                            active:scale-95
                            transition-all duration-200"
                        >

                            <div class="flex items-center gap-4">

                                <div
                                    class="w-20 h-20
                                    bg-[#F4EFE6]
                                    rounded-lg
                                    flex items-center
                                    justify-center
                                    overflow-hidden"
                                >

                                    <img
                                        src="{{ asset('images/pembayaran/qris.png') }}"
                                        alt="QRIS"
                                        class="w-full h-full
                                        object-contain
                                        rounded-lg"
                                    >

                                </div>


                                <div>

                                    <h3
                                        class="font-bold
                                        text-lg
                                        text-[#17324D]"
                                    >

                                        QRIS

                                    </h3>


                                    <p class="text-sm text-gray-600">

                                        Scan QRIS

                                    </p>

                                </div>

                            </div>

                        </a>


                    </div>

                </div>


                <!-- KEMBALI -->

                <div class="mt-8">

                    <a
                        href="/tamu"
                        class="inline-block
                        bg-white
                        text-[#17324D]
                        border border-[#17324D]
                        px-5 py-3
                        rounded-lg
                        font-semibold
                        hover:bg-[#F4EFE6]
                        hover:-translate-y-0.5
                        active:scale-95
                        transition-all duration-200"
                    >

                        ← Kembali ke Dashboard

                    </a>

                </div>


            @else


                <!-- RESERVASI TIDAK DITEMUKAN -->

                <div class="text-center py-10">

                    <h2
                        class="text-2xl
                        font-bold
                        text-[#17324D]
                        mb-3"
                    >

                        Reservasi Tidak Ditemukan

                    </h2>


                    <p class="text-gray-600 mb-6">

                        Silakan kembali ke dashboard tamu.

                    </p>


                    <a
                        href="/tamu"
                        class="inline-block
                        bg-[#17324D]
                        text-white
                        px-6 py-3
                        rounded-lg
                        font-semibold
                        hover:bg-white
                        hover:text-[#17324D]
                        border border-[#17324D]
                        hover:-translate-y-0.5
                        active:scale-95
                        transition-all duration-200"
                    >

                        Kembali ke Dashboard

                    </a>

                </div>

            @endif


        </div>

    </div>


    <!-- FOOTER -->

    <footer
        class="bg-[#17324D]
        text-white
        text-center
        py-6
        mt-10"
    >

        <p>
            © 2026 Hotel AMBATUKAM
        </p>

        <p class="text-sm mt-1">
            Sistem Reservasi Hotel
        </p>

    </footer>


</body>

</html>

