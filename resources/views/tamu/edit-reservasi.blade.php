<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Reservasi - Hotel AMBATUKAM</title>

    @vite('resources/css/app.css')
</head>

<body class="min-h-screen bg-[#F4EFE6] text-[#17324D]">

    <div class="max-w-3xl mx-auto px-6 py-10">

        <div class="bg-white rounded-2xl shadow-lg p-8">

            <h1 class="text-3xl font-bold mb-2">
                Edit Reservasi
            </h1>

            <p class="text-gray-600 mb-8">
                Silakan ubah jumlah tamu dan tanggal reservasi.
            </p>


            {{-- PESAN ERROR --}}
            @if (session('error'))
                <div class="bg-red-100 text-red-700 px-4 py-3 rounded-lg mb-6">
                    {{ session('error') }}
                </div>
            @endif


            {{-- ERROR VALIDASI --}}
            @if ($errors->any())
                <div class="bg-red-100 text-red-700 px-4 py-3 rounded-lg mb-6">

                    <ul class="list-disc ml-5">

                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach

                    </ul>

                </div>
            @endif


            {{-- INFORMASI KAMAR --}}
            <div class="bg-[#F4EFE6] rounded-xl p-5 mb-6">

                <p class="text-sm text-gray-500">
                    Kamar
                </p>

                <p class="text-xl font-bold">
                    Kamar {{ $reservasi->kamar->nomor_kamar }}
                </p>

                <p class="text-gray-600">
                    {{ $reservasi->kamar->tipe_kamar }}
                </p>

            </div>


            {{-- FORM --}}
            <form
                action="{{ url('/reservasi/' . $reservasi->id) }}"
                method="POST"
            >

                @csrf

                @method('PUT')


                
{{-- JUMLAH TAMU --}}
<div class="mb-6">

    <label
        for="jumlah_tamu"
        class="block font-semibold mb-2"
    >
        Jumlah Tamu
    </label>

    <input
        type="number"
        id="jumlah_tamu"
        name="jumlah_tamu"
        value="{{ old('jumlah_tamu', $reservasi->jumlah_tamu) }}"
        min="1"
        max="{{ $reservasi->jumlah_tamu }}"
        required
        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#17324D]"
    >

    <p class="text-sm text-gray-500 mt-2">
        Jumlah tamu saat ini: {{ $reservasi->jumlah_tamu }} orang.
    </p>

</div>



                {{-- CHECK IN --}}
                <div class="mb-6">

                    <label
                        for="check_in"
                        class="block font-semibold mb-2"
                    >
                        Tanggal Check-in
                    </label>

                    <input
                        type="date"
                        id="check_in"
                        name="check_in"
                        value="{{ old('check_in', \Carbon\Carbon::parse($reservasi->check_in)->format('Y-m-d')) }}"
                        required
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#17324D]"
                    >

                </div>


                {{-- CHECK OUT --}}
                <div class="mb-8">

                    <label
                        for="check_out"
                        class="block font-semibold mb-2"
                    >
                        Tanggal Check-out
                    </label>

                    <input
                        type="date"
                        id="check_out"
                        name="check_out"
                        value="{{ old('check_out', \Carbon\Carbon::parse($reservasi->check_out)->format('Y-m-d')) }}"
                        required
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#17324D]"
                    >

                </div>


                {{-- BUTTON --}}
                <div class="flex gap-3">

                    <a
                        href="/tamu"
                        class="flex-1 text-center bg-gray-200 text-[#17324D] font-semibold py-3 rounded-lg hover:-translate-y-0.5 active:scale-95 transition"
                    >
                        Batal
                    </a>

                    <button
                        type="submit"
                        class="flex-1 bg-[#17324D] text-white font-semibold py-3 rounded-lg hover:-translate-y-0.5 active:scale-95 transition"
                    >
                        Simpan Perubahan
                    </button>

                </div>

            </form>

        </div>

    </div>

</body>

</html>