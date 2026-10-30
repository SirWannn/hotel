<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Ubah Kamar - Admin</title>

    @vite('resources/css/app.css')

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
                    Ubah Kamar - Admin
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

            ✏️ Ubah Data Kamar

        </h1>


        <p class="text-[#17324D] mb-8">

            Ubah data kamar Hotel AMBATUKAM.

        </p>



        <!-- ERROR -->

        @if ($errors->any())

            <div class="bg-[#F4EFE6]
                        text-[#17324D]
                        p-4
                        rounded-lg
                        mb-6">

                <ul>

                    @foreach ($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

        @endif



        <form
            action="/admin/kamar/{{ $kamar->id }}"
            method="POST"
            enctype="multipart/form-data">

            @csrf

            @method('PUT')



            <!-- NOMOR KAMAR -->

            <div class="mb-5">

                <label
                    class="block
                           font-semibold
                           mb-2
                           text-[#17324D]">

                    Nomor Kamar

                </label>


                <input
                    type="text"
                    name="nomor_kamar"
                    value="{{ old('nomor_kamar', $kamar->nomor_kamar) }}"
                    class="w-full
                           border
                           border-[#17324D]
                           rounded-lg
                           px-4
                           py-3
                           focus:outline-none
                           focus:ring-2
                           focus:ring-[#17324D]"
                    required>

            </div>



            <!-- TIPE KAMAR -->

            <div class="mb-5">

                <label
                    class="block
                           font-semibold
                           mb-2
                           text-[#17324D]">

                    Tipe Kamar

                </label>


                <input
                    type="text"
                    name="tipe_kamar"
                    value="{{ old('tipe_kamar', $kamar->tipe_kamar) }}"
                    class="w-full
                           border
                           border-[#17324D]
                           rounded-lg
                           px-4
                           py-3
                           focus:outline-none
                           focus:ring-2
                           focus:ring-[#17324D]"
                    required>

            </div>



            <!-- HARGA -->

            <div class="mb-5">

                <label
                    class="block
                           font-semibold
                           mb-2
                           text-[#17324D]">

                    Harga

                </label>


                <input
                    type="number"
                    name="harga"
                    value="{{ old('harga', $kamar->harga) }}"
                    class="w-full
                           border
                           border-[#17324D]
                           rounded-lg
                           px-4
                           py-3
                           focus:outline-none
                           focus:ring-2
                           focus:ring-[#17324D]"
                    required>

            </div>



            <!-- KAPASITAS -->

            <div class="mb-5">

                <label
                    class="block
                           font-semibold
                           mb-2
                           text-[#17324D]">

                    Kapasitas

                </label>


                <input
                    type="number"
                    name="kapasitas"
                    min="1"
                    max="10"
                    value="{{ old('kapasitas', $kamar->kapasitas) }}"
                    class="w-full
                           border
                           border-[#17324D]
                           rounded-lg
                           px-4
                           py-3
                           focus:outline-none
                           focus:ring-2
                           focus:ring-[#17324D]"
                    required>

            </div>



            <!-- FASILITAS -->

            <div class="mb-6">

                <label
                    class="block
                           font-semibold
                           mb-2
                           text-[#17324D]">

                    Fasilitas

                </label>


                <textarea
                    name="fasilitas"
                    rows="4"
                    class="w-full
                           border
                           border-[#17324D]
                           rounded-lg
                           px-4
                           py-3
                           focus:outline-none
                           focus:ring-2
                           focus:ring-[#17324D]"
                    required>{{ old('fasilitas', $kamar->fasilitas) }}</textarea>

            </div>



            <!-- STATUS KAMAR -->

            <div class="mb-6">

                <label
                    class="block
                           font-semibold
                           mb-2
                           text-[#17324D]">

                    Status Kamar

                </label>


                <select
                    name="status"
                    id="status"
                    class="w-full
                           border
                           border-[#17324D]
                           rounded-lg
                           px-4
                           py-3
                           bg-white
                           focus:outline-none
                           focus:ring-2
                           focus:ring-[#17324D]"
                    required>

                    <option
                        value="tersedia"
                        {{ old('status', $kamar->status) === 'tersedia' ? 'selected' : '' }}>

                        Tersedia

                    </option>


                    <option
                        value="perbaikan"
                        {{ old('status', $kamar->status) === 'perbaikan' ? 'selected' : '' }}>

                        Perbaikan

                    </option>

                </select>

            </div>



            <!-- KETERANGAN PERBAIKAN -->

            <div
                id="bagianKeterangan"
                class="mb-6">

                <label
                    class="block
                           font-semibold
                           mb-2
                           text-[#17324D]">

                    Keterangan Perbaikan

                </label>


                <textarea
                    name="keterangan_perbaikan"
                    id="keterangan_perbaikan"
                    rows="4"
                    placeholder="Contoh: AC kamar rusak dan sedang diperbaiki."
                    class="w-full
                           border
                           border-[#17324D]
                           rounded-lg
                           px-4
                           py-3
                           focus:outline-none
                           focus:ring-2
                           focus:ring-[#17324D]">{{ old('keterangan_perbaikan', $kamar->keterangan_perbaikan) }}</textarea>


                <p class="text-sm text-gray-500 mt-2">

                    Isi keterangan jika kamar sedang dalam perbaikan.

                    Keterangan ini hanya digunakan sebagai informasi
                    perbaikan kamar pada halaman Admin.

                </p>

            </div>



            <!-- FOTO KAMAR -->

            <div class="mb-6">

                <label
                    class="block
                           font-semibold
                           mb-2
                           text-[#17324D]">

                    Foto Kamar

                </label>


                @if ($kamar->foto)

                    <div class="mb-4">

                        <p class="text-sm text-gray-600 mb-2">

                            Foto saat ini:

                        </p>


                        <img
                            src="{{ asset('kamar/' . $kamar->foto) }}"
                            alt="Foto Kamar {{ $kamar->nomor_kamar }}"
                            class="w-full max-w-md h-56 object-cover rounded-xl border">

                    </div>

                @endif


                <input
                    type="file"
                    name="foto"
                    accept="image/jpeg,image/png,image/jpg"
                    class="w-full
                           border
                           border-[#17324D]
                           rounded-lg
                           px-4
                           py-3
                           bg-white">


                <p class="text-sm text-gray-500 mt-2">

                    Pilih foto baru jika ingin mengganti foto kamar.

                    Format: JPG, JPEG, PNG. Maksimal 2 MB.

                </p>

            </div>



            <!-- TOMBOL -->

            <button
                type="submit"
                class="w-full
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
                       border
                       border-[#17324D]">

                Simpan Perubahan

            </button>


        </form>



        <div class="mt-8">

            <a
                href="/admin/kamar"
                class="inline-block
                       bg-[#17324D]
                       text-white
                       hover:bg-white
                       hover:text-[#17324D]
                       hover:-translate-y-0.5
                       active:scale-95
                       transition-all duration-200
                       px-5
                       py-3
                       rounded-lg">

                ← Kembali

            </a>

        </div>


    </div>

</div>



<!-- JAVASCRIPT STATUS PERBAIKAN -->

<script>

    const status = document.getElementById('status');

    const bagianKeterangan =
        document.getElementById('bagianKeterangan');

    const keterangan =
        document.getElementById('keterangan_perbaikan');


    function aturKeterangan() {

        if (status.value === 'perbaikan') {

            bagianKeterangan.style.display = 'block';

            keterangan.required = true;

        } else {

            bagianKeterangan.style.display = 'none';

            keterangan.required = false;

            keterangan.value = '';

        }

    }


    status.addEventListener('change', aturKeterangan);


    // Jalankan saat halaman pertama kali dibuka
    aturKeterangan();

</script>


</body>

</html>

