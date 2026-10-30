<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Data Kamar - Hotel AMBATUKAM</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-[#F4EFE6]">

    <!-- NAVBAR -->
    <nav class="bg-[#17324D] text-white px-8 py-5 flex justify-between items-center">

        <div>
            <h1 class="text-2xl font-bold">
                HOTEL AMBATUKAM
            </h1>

            <p class="text-sm text-gray-300">
                Admin / Data Kamar
            </p>
        </div>

        <a
            href="/admin"
            class="bg-white text-[#17324D] px-5 py-2 rounded-lg font-semibold
                   hover:bg-[#F4EFE6]
                   hover:-translate-y-0.5
                   active:scale-95
                   transition-all duration-200">
            Dashboard
        </a>

    </nav>


    <!-- CONTENT -->
    <main class="p-8">

        <div class="bg-white rounded-2xl shadow-lg p-6">

            <div class="flex justify-between items-center mb-6">

                <div>
                    <h2 class="text-2xl font-bold text-[#17324D]">
                        🏨 Data Kamar
                    </h2>

                    <p class="text-gray-500 mt-1">
                        Kelola data kamar Hotel AMBATUKAM
                    </p>
                </div>

                <a
                    href="/admin/kamar/tambah"
                    class="bg-[#17324D] text-white px-5 py-3 rounded-lg
                           hover:bg-white
                           hover:text-[#17324D]
                           hover:-translate-y-0.5
                           active:scale-95
                           transition-all duration-200
                           border border-[#17324D]">
                    + Tambah Kamar
                </a>

            </div>


            <!-- SEARCH -->
            <form action="/admin/kamar" method="GET" class="mb-6">

                <div class="flex gap-3">

                    <input
                        type="text"
                        name="search"
                        value="{{ $search ?? '' }}"
                        placeholder="Cari nomor kamar, tipe, fasilitas, atau status..."
                        class="flex-1 border border-[#17324D] rounded-lg px-4 py-3
                               text-[#17324D]
                               focus:outline-none
                               focus:ring-2
                               focus:ring-[#17324D]">

                    <button
                        type="submit"
                        class="bg-[#17324D] text-white px-6 py-3 rounded-lg
                               hover:bg-white
                               hover:text-[#17324D]
                               hover:-translate-y-0.5
                               active:scale-95
                               transition-all duration-200
                               border border-[#17324D]">
                        Cari
                    </button>

                    @if(!empty($search))

                        <a
                            href="/admin/kamar"
                            class="bg-white text-[#17324D] px-6 py-3 rounded-lg
                                   border border-[#17324D]
                                   hover:bg-[#F4EFE6]
                                   hover:-translate-y-0.5
                                   active:scale-95
                                   transition-all duration-200">
                            Reset
                        </a>

                    @endif

                </div>

            </form>


            <!-- SUCCESS MESSAGE -->
            @if(session('success'))

                <div class="mb-6 bg-green-100 text-green-800 px-5 py-4 rounded-lg">
                    {{ session('success') }}
                </div>

            @endif


            <!-- TABLE -->
            <div class="overflow-x-auto">

                <table class="w-full border-collapse">

                    <thead>

                        <tr class="bg-[#17324D] text-white">

                            <th class="px-4 py-4 text-left">
                                No
                            </th>

                            <th class="px-4 py-4 text-left">
                                Nomor Kamar
                            </th>

                            <th class="px-4 py-4 text-left">
                                Tipe
                            </th>

                            <th class="px-4 py-4 text-left">
                                Harga
                            </th>

                            <th class="px-4 py-4 text-left">
                                Kapasitas
                            </th>

                            <th class="px-4 py-4 text-left">
                                Fasilitas
                            </th>

                            <th class="px-4 py-4 text-left">
                                Status
                            </th>

                            <th class="px-4 py-4 text-left">
                                Keterangan Perbaikan
                            </th>

                            <th class="px-4 py-4 text-left">
                                Landing Page
                            </th>

                            <th class="px-4 py-4 text-left">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($kamars as $kamar)

                            <tr class="border-b hover:bg-[#F4EFE6]">

                                <td class="px-4 py-4">
                                    {{ $kamars->firstItem() + $loop->index }}
                                </td>

                                <td class="px-4 py-4 font-semibold text-[#17324D]">
                                    {{ $kamar->nomor_kamar }}
                                </td>

                                <td class="px-4 py-4">
                                    {{ $kamar->tipe_kamar }}
                                </td>

                                <td class="px-4 py-4">
                                    Rp {{ number_format($kamar->harga, 0, ',', '.') }}
                                </td>

                                <td class="px-4 py-4">
                                    {{ $kamar->kapasitas }} orang
                                </td>

                                <td class="px-4 py-4">
                                    {{ $kamar->fasilitas }}
                                </td>

                                <!-- STATUS -->
                                <td class="px-4 py-4">

                                    @if($kamar->status === 'tersedia')

                                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                                            Tersedia
                                        </span>

                                    @else

                                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">
                                            Perbaikan
                                        </span>

                                    @endif

                                </td>


                                <!-- KETERANGAN PERBAIKAN -->
                                <td class="px-4 py-4">

                                    @if($kamar->status === 'perbaikan')

                                        <div class="bg-red-50 border border-red-200 rounded-lg p-3">

                                            <p class="text-sm text-red-700 font-semibold mb-1">
                                                Sedang diperbaiki
                                            </p>

                                            <p class="text-sm text-gray-700">
                                                {{ $kamar->keterangan_perbaikan ?: 'Tidak ada keterangan.' }}
                                            </p>

                                        </div>

                                    @else

                                        <span class="text-gray-400 text-sm">
                                            -
                                        </span>

                                    @endif

                                </td>


                                <!-- TAMPIL / SEMBUNYI -->
                                <td class="px-4 py-4">

                                    @if($kamar->tampil)

                                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                                            Tampil
                                        </span>

                                    @else

                                        <span class="bg-gray-200 text-gray-700 px-3 py-1 rounded-full text-sm">
                                            Disembunyikan
                                        </span>

                                    @endif

                                    @if($kamar->tampil)

    <!-- TOMBOL SEMBUNYIKAN -->

    <button
        type="button"
        onclick="bukaFormSembunyikan({{ $kamar->id }})"
        class="mt-2
               bg-[#17324D]
               text-white
               px-3
               py-2
               rounded-lg
               text-sm
               hover:bg-white
               hover:text-[#17324D]
               active:scale-95
               transition-all duration-200
               border border-[#17324D]">

        Sembunyikan

    </button>


    <!-- FORM ALASAN -->

    <div
        id="formSembunyikan{{ $kamar->id }}"
        class="hidden mt-4 bg-yellow-50 border border-yellow-300 rounded-xl p-4">

        <p class="font-semibold text-[#17324D] mb-2">
            Alasan Kamar Disembunyikan
        </p>

        <p class="text-sm text-gray-600 mb-3">
            Masukkan alasan atau keterangan perbaikan kamar.
        </p>


        <form
            action="/admin/kamar/{{ $kamar->id }}/toggle-tampil"
            method="POST">

            @csrf


            <textarea
                name="keterangan_perbaikan"
                rows="4"
                required
                maxlength="1000"
                placeholder="Contoh: AC rusak dan sedang diperbaiki."
                class="w-full
                       border
                       border-[#17324D]
                       rounded-lg
                       px-3
                       py-2
                       focus:outline-none
                       focus:ring-2
                       focus:ring-[#17324D]"></textarea>


            <div class="flex gap-2 mt-3">

                <button
                    type="submit"
                    class="bg-[#17324D]
                           text-white
                           px-4
                           py-2
                           rounded-lg
                           text-sm
                           hover:bg-white
                           hover:text-[#17324D]
                           active:scale-95
                           transition-all duration-200
                           border border-[#17324D]">

                    Simpan & Sembunyikan

                </button>


                <button
                    type="button"
                    onclick="tutupFormSembunyikan({{ $kamar->id }})"
                    class="bg-gray-200
                           text-gray-700
                           px-4
                           py-2
                           rounded-lg
                           text-sm
                           hover:bg-gray-300
                           active:scale-95
                           transition-all duration-200">

                    Batal

                </button>

            </div>

        </form>

    </div>


@else

    <!-- KAMAR SUDAH DISEMBUNYIKAN -->

    <form
        action="/admin/kamar/{{ $kamar->id }}/toggle-tampil"
        method="POST"
        class="mt-2">

        @csrf

        <button
            type="submit"
            class="bg-[#17324D]
                   text-white
                   px-3
                   py-2
                   rounded-lg
                   text-sm
                   hover:bg-white
                   hover:text-[#17324D]
                   active:scale-95
                   transition-all duration-200
                   border border-[#17324D]">

            Tampilkan

        </button>

    </form>

@endif

                                </td>


                                <!-- AKSI -->
                                <td class="px-4 py-4">

                                    <div class="flex gap-2">

                                        <a
                                            href="/admin/kamar/{{ $kamar->id }}/edit"
                                            class="bg-[#17324D] text-white px-4 py-2 rounded-lg text-sm
                                                   hover:bg-white
                                                   hover:text-[#17324D]
                                                   active:scale-95
                                                   transition-all duration-200
                                                   border border-[#17324D]">
                                            Edit
                                        </a>


                                        <form
                                            action="/admin/kamar/{{ $kamar->id }}"
                                            method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus kamar ini?');">

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="bg-red-600 text-white px-4 py-2 rounded-lg text-sm
                                                       hover:bg-red-700
                                                       active:scale-95
                                                       transition-all duration-200">
                                                Hapus
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="10"
                                    class="px-4 py-8 text-center text-gray-500">

                                    Data kamar tidak ditemukan.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            <!-- PAGINATION -->
            <div class="mt-6">

                {{ $kamars->links() }}

            </div>


            <!-- KEMBALI -->
            <div class="mt-6">

                <a
                    href="/admin"
                    class="text-[#17324D] font-semibold hover:underline">
                    ← Kembali ke Dashboard
                </a>

            </div>

        </div>

    </main>

</body>

<script>

    function bukaFormSembunyikan(id) {

        const form =
            document.getElementById('formSembunyikan' + id);

        form.classList.remove('hidden');

    }


    function tutupFormSembunyikan(id) {

        const form =
            document.getElementById('formSembunyikan' + id);

        form.classList.add('hidden');

    }

</script>

</html>

