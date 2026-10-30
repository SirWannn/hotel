<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Kuitansi Pembayaran - Hotel AMBATUKAM</title>

    @vite('resources/css/app.css')
</head>

<body class="bg-[#F4EFE6] min-h-screen">

<nav class="bg-[#17324D] text-white px-8 py-4">

    <div class="max-w-5xl mx-auto">

        <div class="flex justify-between items-center">

            <div>

                <h1 class="text-xl font-bold">
                    Hotel AMBATUKAM
                </h1>

                <p class="text-sm">
                    Kuitansi Pembayaran
                </p>

            </div>

            <form action="/logout" method="POST">

                @csrf

                <button
                    type="submit"
                    class="bg-white text-[#17324D]
                           hover:bg-[#F4EFE6]
                           hover:-translate-y-0.5
                           active:scale-95
                           transition-all duration-200
                           px-4 py-2 rounded-lg">

                    Logout

                </button>

            </form>

        </div>

    </div>

</nav>


<div class="max-w-3xl mx-auto py-10 px-4">

    <div class="bg-white rounded-2xl shadow-lg p-8">

        <!-- HEADER -->

        <div class="text-center border-b border-[#17324D] pb-6">

            <h1 class="text-3xl font-bold text-[#17324D]">
                HOTEL AMBATUKAM
            </h1>

            <p class="text-[#17324D] mt-2">
                KUITANSI PEMBAYARAN
            </p>

            <div class="inline-block mt-4
                        bg-[#F4EFE6]
                        text-[#17324D]
                        font-bold
                        px-5 py-2
                        rounded-full">

                LUNAS

            </div>

        </div>


        <!-- DATA TAMU -->

        <div class="mt-6">

            <h2 class="text-xl font-bold text-[#17324D] mb-4">
                Data Tamu
            </h2>

            <div class="space-y-2 text-[#17324D]">

                <div class="flex justify-between">

                    <span class="font-semibold">
                        Nama
                    </span>

                    <span>
                        {{ $reservasi->tamu->nama ?? '-' }}
                    </span>

                </div>

                <div class="flex justify-between">

                    <span class="font-semibold">
                        Nomor Reservasi
                    </span>

                    <span>
                        #{{ $reservasi->id }}
                    </span>

                </div>

            </div>

        </div>


        <!-- DETAIL KAMAR -->

        <div class="mt-8">

            <h2 class="text-xl font-bold text-[#17324D] mb-4">
                Detail Kamar
            </h2>

            <div class="space-y-2 text-[#17324D]">

                <div class="flex justify-between">

                    <span class="font-semibold">
                        Nomor Kamar
                    </span>

                    <span>
                        {{ $reservasi->kamar->nomor_kamar ?? '-' }}
                    </span>

                </div>

                <div class="flex justify-between">

                    <span class="font-semibold">
                        Tipe Kamar
                    </span>

                    <span>
                        {{ $reservasi->kamar->tipe_kamar ?? '-' }}
                    </span>

                </div>

                <div class="flex justify-between">

                    <span class="font-semibold">
                        Check-in
                    </span>

                    <span>
                        {{ $reservasi->check_in }}
                    </span>

                </div>

                <div class="flex justify-between">

                    <span class="font-semibold">
                        Check-out
                    </span>

                    <span>
                        {{ $reservasi->check_out }}
                    </span>

                </div>

            </div>

        </div>


        <!-- DETAIL PEMBAYARAN -->

        <div class="mt-8">

            <h2 class="text-xl font-bold text-[#17324D] mb-4">
                Detail Pembayaran
            </h2>

            <div class="space-y-2 text-[#17324D]">

                <div class="flex justify-between">

                    <span class="font-semibold">
                        Metode Pembayaran
                    </span>

                    <span>
                        {{ $pembayaran->metode }}
                    </span>

                </div>

                <div class="flex justify-between">

                    <span class="font-semibold">
                        Tanggal Pembayaran
                    </span>

                    <span>
                        {{ $pembayaran->tanggal }}
                    </span>

                </div>

                <div class="flex justify-between">

                    <span class="font-semibold">
                        Status
                    </span>

                    <span class="font-bold">
                        DISETUJUI
                    </span>

                </div>

            </div>

        </div>


        <!-- TOTAL -->

        <div class="mt-8
                    bg-[#F4EFE6]
                    rounded-xl
                    p-5">

            <div class="flex justify-between items-center">

                <span class="text-lg font-bold text-[#17324D]">
                    TOTAL DIBAYAR
                </span>

                <span class="text-2xl font-bold text-[#17324D]">

                    Rp {{ number_format(
                        $pembayaran->jumlah,
                        0,
                        ',',
                        '.'
                    ) }}

                </span>

            </div>

        </div>


        <!-- KETERANGAN -->

        <div class="mt-6
                    text-center
                    text-sm
                    text-gray-600">

            <p>
                Pembayaran telah diperiksa dan disetujui
                oleh Admin Hotel AMBATUKAM.
            </p>

            <p class="mt-1">
                Simpan kuitansi ini sebagai bukti pembayaran.
            </p>

        </div>


        <!-- BUTTON -->

        <div class="mt-8 flex gap-3">

            <a href="/tamu"
               class="flex-1 text-center
                      bg-[#17324D]
                      text-white
                      py-3
                      rounded-lg
                      font-semibold
                      hover:bg-white
                      hover:text-[#17324D]
                      hover:-translate-y-0.5
                      active:scale-95
                      transition-all duration-200
                      border border-[#17324D]">

                ← Kembali

            </a>

            <button
                onclick="window.print()"
                class="flex-1
                       bg-white
                       text-[#17324D]
                       py-3
                       rounded-lg
                       font-semibold
                       hover:bg-[#F4EFE6]
                       hover:-translate-y-0.5
                       active:scale-95
                       transition-all duration-200
                       border border-[#17324D]">

                Cetak Kuitansi

            </button>

        </div>

    </div>

</div>

</body>

</html>