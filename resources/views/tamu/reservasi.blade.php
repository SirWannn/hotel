<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservasi - Hotel AMBATUKAM</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#F4EFE6] min-h-screen">

<nav class="bg-[#17324D] text-white px-8 py-4">

    <div class="max-w-6xl mx-auto">

        <div class="flex justify-between items-center">

            <div>
                <h1 class="text-xl font-bold">
                    Hotel AMBATUKAM
                </h1>

                <p class="text-sm">
                    Reservasi Kamar
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


<div class="max-w-3xl mx-auto px-6 py-10">


    @if(session('error'))

        <div class="bg-white border border-[#17324D]
                    text-[#17324D] rounded-xl
                    px-5 py-4 mb-6 shadow">

            {{ session('error') }}

        </div>

    @endif


    @if($errors->any())

        <div class="bg-white border border-[#17324D]
                    text-[#17324D] rounded-xl
                    px-5 py-4 mb-6 shadow">

            <ul class="list-disc list-inside">

                @foreach($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    <div class="bg-white rounded-2xl shadow-xl p-8">


        <h1 class="text-3xl font-bold text-[#17324D] mb-2">

            Reservasi Kamar

        </h1>

        <p class="text-gray-600 mb-8">

            Silakan periksa identitas dan isi data reservasi.

        </p>


        <!-- IDENTITAS TAMU -->

        <div class="border border-[#17324D]
                    rounded-xl p-5 mb-8">

            <h2 class="text-xl font-bold text-[#17324D] mb-4">

                Identitas Tamu

            </h2>


            <div class="space-y-3">

                <div>

                    <p class="text-sm text-gray-500">
                        Nama
                    </p>

                    <p class="font-semibold text-[#17324D]">
                        {{ $tamu->nama }}
                    </p>

                </div>


                <div>

                    <p class="text-sm text-gray-500">
                        Nomor Identitas
                    </p>

                    <p class="font-semibold text-[#17324D]">
                        {{ $tamu->nomor_identitas }}
                    </p>

                </div>


                <div>

                    <p class="text-sm text-gray-500">
                        Nomor Telepon
                    </p>

                    <p class="font-semibold text-[#17324D]">
                        {{ $tamu->no_telepon }}
                    </p>

                </div>


                <div>

                    <p class="text-sm text-gray-500">
                        Alamat
                    </p>

                    <p class="font-semibold text-[#17324D]">
                        {{ $tamu->alamat }}
                    </p>

                </div>

            </div>

        </div>


        <!-- KAMAR YANG DIPILIH -->

        <div class="border border-[#17324D]
                    rounded-xl p-5 mb-8">

            <h2 class="text-xl font-bold text-[#17324D] mb-4">

                Kamar yang Dipilih

            </h2>


            <div class="space-y-3">

                <div>

                    <p class="text-sm text-gray-500">
                        Nomor Kamar
                    </p>

                    <p class="font-semibold text-[#17324D]">
                        Kamar {{ $kamar->nomor_kamar }}
                    </p>

                </div>


                <div>

                    <p class="text-sm text-gray-500">
                        Tipe Kamar
                    </p>

                    <p class="font-semibold text-[#17324D]">
                        {{ $kamar->tipe_kamar }}
                    </p>

                </div>


                <div>

                    <p class="text-sm text-gray-500">
                        Harga
                    </p>

                    <p class="font-semibold text-[#17324D]">
                        Rp {{ number_format($kamar->harga, 0, ',', '.') }} / malam
                    </p>

                </div>


                <div>

                    <p class="text-sm text-gray-500">
                        Kapasitas
                    </p>

                    <p class="font-semibold text-[#17324D]">
                        {{ $kamar->kapasitas }} orang
                    </p>

                </div>


                <div>

                    <p class="text-sm text-gray-500">
                        Fasilitas
                    </p>

                    <p class="font-semibold text-[#17324D]">
                        {{ $kamar->fasilitas }}
                    </p>

                </div>

            </div>

        </div>


        <!-- FORM RESERVASI -->

        <form action="/reservasi" method="POST">

            @csrf


            <!-- ID KAMAR OTOMATIS -->

            <input
                type="hidden"
                name="kamar_id"
                value="{{ $kamar->id }}">


            <!-- JUMLAH TAMU -->

            <div class="mb-6">

                <label class="block font-semibold text-[#17324D] mb-2">

                    Jumlah Tamu

                </label>

                <input
                    type="number"
                    name="jumlah_tamu"
                    value="{{ old('jumlah_tamu', 1) }}"
                    min="1"
                    max="{{ $kamar->kapasitas }}"
                    required
                    class="w-full border border-gray-300
                           rounded-lg px-4 py-3
                           focus:outline-none
                           focus:ring-2
                           focus:ring-[#17324D]"
                    placeholder="Masukkan jumlah tamu">

                <p class="text-sm text-gray-500 mt-2">

                    Maksimal {{ $kamar->kapasitas }} orang sesuai kapasitas kamar.

                </p>

            </div>


            <!-- CHECK IN -->

            <div class="mb-6">

                <label class="block font-semibold text-[#17324D] mb-2">

                    Check-in

                </label>


                <input
                    type="date"
                    name="check_in"
                    value="{{ old('check_in') }}"
                    min="{{ date('Y-m-d') }}"
                    required
                    class="w-full border border-gray-300
                           rounded-lg px-4 py-3
                           focus:outline-none
                           focus:ring-2
                           focus:ring-[#17324D]">

            </div>


            <!-- CHECK OUT -->

            <div class="mb-6">

                <label class="block font-semibold text-[#17324D] mb-2">

                    Check-out

                </label>


                <input
                    type="date"
                    name="check_out"
                    value="{{ old('check_out') }}"
                    min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                    required
                    class="w-full border border-gray-300
                           rounded-lg px-4 py-3
                           focus:outline-none
                           focus:ring-2
                           focus:ring-[#17324D]">

            </div>


            <button
                type="submit"
                class="w-full bg-[#17324D] text-white
                       py-3 rounded-lg font-semibold
                       hover:-translate-y-1
                       hover:shadow-lg
                       active:scale-95
                       transition-all duration-200">

                Buat Reservasi

            </button>

        </form>

    </div>


    <div class="mt-8">

        <a href="/kamar/{{ $kamar->id }}"
           class="inline-block bg-[#17324D] text-white
                  hover:bg-white hover:text-[#17324D]
                  hover:-translate-y-0.5
                  active:scale-95
                  transition-all duration-200
                  px-5 py-3 rounded-lg">

            ← Kembali ke Detail Kamar

        </a>

    </div>

</div>

</body>

</html>