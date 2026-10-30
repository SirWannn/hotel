<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Status Reservasi - Hotel AMBATUKAM</title>

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
                        Status Reservasi - Tamu
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


    <!-- CONTENT -->
    <div class="max-w-6xl mx-auto py-10 px-4">

        <div
            class="bg-white rounded-2xl shadow-lg p-8
                   transition-all duration-200
                   hover:shadow-xl">

            <h1 class="text-3xl font-bold text-[#17324D] mb-2">
                📋 Status Reservasi
            </h1>

            <p class="text-[#17324D] mb-8">
                Berikut daftar reservasi yang telah dibuat.
            </p>


            @if ($reservasis->count() > 0)

                <div class="overflow-x-auto">

                    <table class="w-full border-collapse">

                        <thead>

                            <tr class="bg-[#17324D] text-white">

                                <th class="p-3 text-left">
                                    No
                                </th>

                                <th class="p-3 text-left">
                                    Nama Tamu
                                </th>

                                <th class="p-3 text-left">
                                    Kamar
                                </th>

                                <th class="p-3 text-left">
                                    Jumlah Tamu
                                </th>

                                <th class="p-3 text-left">
                                    Check-in
                                </th>

                                <th class="p-3 text-left">
                                    Check-out
                                </th>

                                <th class="p-3 text-left">
                                    Status Reservasi
                                </th>

                                <th class="p-3 text-left">
                                    Status Pembayaran
                                </th>

                                <th class="p-3 text-left">
                                    Aksi
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @foreach ($reservasis as $reservasi)

                                <tr
                                    class="border-b border-[#F4EFE6]
                                           hover:bg-[#F4EFE6]
                                           transition-all duration-200">

                                    <!-- NO -->
                                    <td class="p-3 text-[#17324D]">
                                        {{ $loop->iteration }}
                                    </td>


                                    <!-- NAMA TAMU -->
                                    <td class="p-3 text-[#17324D]">
                                        {{ $reservasi->tamu->nama ?? '-' }}
                                    </td>


                                    <!-- KAMAR -->
                                    <td class="p-3 text-[#17324D]">
                                        {{ $reservasi->kamar->nomor_kamar ?? '-' }}
                                    </td>


                                    <!-- JUMLAH TAMU -->
                                    <td class="p-3 text-[#17324D]">
                                        {{ $reservasi->jumlah_tamu }} orang
                                    </td>


                                    <!-- CHECK IN -->
                                    <td class="p-3 text-[#17324D]">
                                        {{ $reservasi->check_in }}
                                    </td>


                                    <!-- CHECK OUT -->
                                    <td class="p-3 text-[#17324D]">
                                        {{ $reservasi->check_out }}
                                    </td>


                                    <!-- STATUS RESERVASI -->
                                    <td class="p-3">

                                        @if($reservasi->status === 'ditolak')

                                            <span
                                                class="inline-block
                                                       bg-red-100
                                                       text-red-700
                                                       px-3 py-1
                                                       rounded-full
                                                       font-semibold">

                                                DITOLAK

                                            </span>

                                        @elseif($reservasi->status === 'disetujui')

                                            <span
                                                class="inline-block
                                                       bg-green-100
                                                       text-green-700
                                                       px-3 py-1
                                                       rounded-full
                                                       font-semibold">

                                                DISETUJUI

                                            </span>

                                        @else

                                            <span
                                                class="inline-block
                                                       bg-[#F4EFE6]
                                                       text-[#17324D]
                                                       px-3 py-1
                                                       rounded-full
                                                       font-semibold">

                                                {{ $reservasi->status }}

                                            </span>

                                        @endif

                                    </td>


                                    <!-- STATUS PEMBAYARAN -->
                                    <td class="p-3">

                                        @php
                                            $pembayaran = $reservasi->pembayaran;
                                        @endphp


                                        @if($pembayaran)

                                            @if($pembayaran->status === 'ditolak')

                                                <div
                                                    class="bg-red-100
                                                           border border-red-400
                                                           text-red-700
                                                           rounded-lg
                                                           p-3
                                                           min-w-[250px]">

                                                    <div class="font-bold">
                                                        PEMBAYARAN DITOLAK
                                                    </div>

                                                    <div class="mt-2 text-sm">

                                                        <strong>
                                                            Keterangan Penolakan:
                                                        </strong>

                                                        <p class="mt-1">
                                                            {{ $pembayaran->alasan_penolakan ?? 'Tidak ada keterangan penolakan.' }}
                                                        </p>

                                                    </div>

                                                </div>

                                            @elseif($pembayaran->status === 'disetujui')

                                                <span
                                                    class="inline-block
                                                           bg-green-100
                                                           text-green-700
                                                           px-3 py-1
                                                           rounded-full
                                                           font-semibold">

                                                    PEMBAYARAN DISETUJUI

                                                </span>

                                            @else

                                                <span
                                                    class="inline-block
                                                           bg-yellow-100
                                                           text-yellow-700
                                                           px-3 py-1
                                                           rounded-full
                                                           font-semibold">

                                                    {{ strtoupper($pembayaran->status) }}

                                                </span>

                                            @endif

                                        @else

                                            <span class="text-[#17324D]">
                                                Belum melakukan pembayaran
                                            </span>

                                        @endif

                                    </td>


                                    <!-- AKSI EDIT -->
                                    <td class="p-3">

                                        @php
                                            $bisaEdit = true;

                                            $waktuKadaluarsa = $reservasi->created_at
                                                ? $reservasi->created_at->copy()->addHour()
                                                : null;

                                            if ($waktuKadaluarsa && now()->greaterThanOrEqualTo($waktuKadaluarsa)) {
                                                $bisaEdit = false;
                                            }

                                            if ($pembayaran && $pembayaran->status === 'disetujui') {
                                                $bisaEdit = false;
                                            }
                                        @endphp


                                        @if($bisaEdit)

                                            <div class="min-w-[180px]">

                                                <a
                                                    href="/reservasi/{{ $reservasi->id }}/edit"
                                                    class="inline-block
                                                           bg-[#17324D]
                                                           text-white
                                                           hover:bg-[#F4EFE6]
                                                           hover:text-[#17324D]
                                                           hover:-translate-y-0.5
                                                           active:scale-95
                                                           transition-all duration-200
                                                           px-4 py-2
                                                           rounded-lg
                                                           font-semibold">

                                                    ✏️ Edit Reservasi

                                                </a>

                                                @if($waktuKadaluarsa)

                                                    <p
                                                        class="text-xs text-[#17324D] mt-2">

                                                        Batas edit:
                                                        {{ $waktuKadaluarsa->format('d-m-Y H:i') }}

                                                    </p>

                                                @endif

                                            </div>

                                        @else

                                            @if($pembayaran && $pembayaran->status === 'disetujui')

                                                <span
                                                    class="inline-block
                                                           bg-green-100
                                                           text-green-700
                                                           px-3 py-1
                                                           rounded-lg
                                                           font-semibold">

                                                    🔒 Sudah Dikunci

                                                </span>

                                            @else

                                                <span
                                                    class="inline-block
                                                           bg-gray-200
                                                           text-gray-600
                                                           px-3 py-1
                                                           rounded-lg
                                                           font-semibold">

                                                    ⏰ Kadaluarsa

                                                </span>

                                            @endif

                                        @endif

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="text-center py-10 text-[#17324D]">
                    Belum ada reservasi.
                </div>

            @endif


            <!-- KEMBALI -->
            <div class="mt-8">

                <a
                    href="/tamu"
                    class="inline-block
                           bg-[#17324D]
                           text-white
                           hover:bg-white
                           hover:text-[#17324D]
                           hover:-translate-y-0.5
                           active:scale-95
                           transition-all duration-200
                           px-5 py-3
                           rounded-lg">

                    ← Kembali

                </a>

            </div>

        </div>

    </div>

</body>

</html>