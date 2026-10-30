<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kamar - Admin</title>

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
                    Tambah Kamar - Admin
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

        <h1 class="text-3xl font-bold text-[#17324D] mb-2">
            ➕ Tambah Data Kamar
        </h1>

        <p class="text-[#17324D] mb-8">
            Masukkan data kamar Hotel AMBATUKAM.
        </p>

        @if ($errors->any())
            <div class="bg-[#F4EFE6] text-[#17324D] p-4 rounded-lg mb-6">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/admin/kamar" method="POST">
            @csrf

            <div class="mb-5">
                <label class="block font-semibold mb-2 text-[#17324D]">
                    Nomor Kamar
                </label>

                <input
                    type="text"
                    name="nomor_kamar"
                    value="{{ old('nomor_kamar') }}"
                    class="w-full border border-[#17324D] rounded-lg px-4 py-3
                           focus:outline-none focus:ring-2 focus:ring-[#17324D]"
                    placeholder="Masukkan nomor kamar"
                    required>
            </div>

            <div class="mb-5">
                <label class="block font-semibold mb-2 text-[#17324D]">
                    Tipe Kamar
                </label>

                <input
                    type="text"
                    name="tipe_kamar"
                    value="{{ old('tipe_kamar') }}"
                    class="w-full border border-[#17324D] rounded-lg px-4 py-3
                           focus:outline-none focus:ring-2 focus:ring-[#17324D]"
                    placeholder="Contoh: Standard, Deluxe"
                    required>
            </div>

            <div class="mb-5">
                <label class="block font-semibold mb-2 text-[#17324D]">
                    Harga
                </label>

                <input
                    type="number"
                    name="harga"
                    value="{{ old('harga') }}"
                    class="w-full border border-[#17324D] rounded-lg px-4 py-3
                           focus:outline-none focus:ring-2 focus:ring-[#17324D]"
                    placeholder="Masukkan harga kamar"
                    required>
            </div>

            <div class="mb-5">
                <label class="block font-semibold text-[#17324D] mb-2">
                    Kapasitas
                </label>

                <input
                    type="number"
                    name="kapasitas"
                    min="1"
                    max="10"
                    required
                    class="w-full border border-[#17324D] rounded-lg px-4 py-2
                           focus:outline-none focus:ring-2 focus:ring-[#17324D]"
                    placeholder="Contoh: 2">
            </div>

            <div class="mb-5">
                <label class="block font-semibold mb-2 text-[#17324D]">
                    Fasilitas
                </label>

                <textarea
                    name="fasilitas"
                    rows="4"
                    class="w-full border border-[#17324D] rounded-lg px-4 py-3
                           focus:outline-none focus:ring-2 focus:ring-[#17324D]"
                    placeholder="Masukkan fasilitas kamar"
                    required>{{ old('fasilitas') }}</textarea>
            </div>

            <button
                type="submit"
                class="w-full bg-[#17324D] text-white py-3 rounded-lg
                       font-semibold
                       hover:bg-white hover:text-[#17324D]
                       hover:-translate-y-0.5
                       active:scale-95
                       transition-all duration-200
                       border border-[#17324D]">
                Simpan Kamar
            </button>

        </form>

        <div class="mt-8">

            <a href="/admin/kamar"
               class="inline-block bg-[#17324D] text-white
                      hover:bg-white hover:text-[#17324D]
                      hover:-translate-y-0.5
                      active:scale-95
                      transition-all duration-200
                      px-5 py-3 rounded-lg">
                ← Kembali
            </a>

        </div>

    </div>

</div>

</body>
</html>