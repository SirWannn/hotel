<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Data Kamar - Hotel AMBATUKAM
    </title>

    @vite('resources/css/app.css')

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
                    Data Kamar - Tamu
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



<div class="max-w-6xl mx-auto px-6 py-8">


    <h1 class="text-3xl font-bold text-[#17324D] mb-6">

        Data Kamar Hotel AMBATUKAM

    </h1>



    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">


        @forelse ($kamars as $kamar)


            {{-- ================================================= --}}
            {{-- KAMAR SEDANG DIPERBAIKI --}}
            {{-- ================================================= --}}

            @if ($kamar->status === 'perbaikan')


                <div
                    class="block bg-white rounded-2xl shadow p-6
                           border-2 border-yellow-500"
                >


                    <!-- FOTO -->

                    <div
                        class="h-40 bg-[#F4EFE6] rounded-xl mb-5
                               flex items-center justify-center
                               overflow-hidden"
                    >

                        @if ($kamar->foto)

                            <img
                                src="{{ asset('kamar/' . $kamar->foto) }}"
                                alt="Kamar Hotel"
                                class="w-full h-full object-cover"
                            >

                        @else

                            <img
                                src="https://images.unsplash.com/photo-1611892440504-42a792e24d32?auto=format&fit=crop&w=800&q=80"
                                alt="Kamar Hotel"
                                class="w-full h-full object-cover"
                            >

                        @endif

                    </div>



                    <!-- NAMA KAMAR -->

                    <h2 class="text-xl font-bold text-[#17324D]">

                        Kamar {{ $kamar->nomor_kamar }}

                    </h2>


                    <p class="text-[#17324D] mt-2">

                        Tipe: {{ $kamar->tipe_kamar }}

                    </p>


                    <p class="text-[#17324D] font-bold mt-2">

                        Rp {{ number_format($kamar->harga, 0, ',', '.') }}

                    </p>


                    <p class="text-[#17324D] mt-2">

                        {{ $kamar->fasilitas }}

                    </p>



                    <!-- STATUS -->

                    <div class="mt-4">

                        <span
                            class="inline-block
                                   bg-yellow-400
                                   text-gray-900
                                   px-4 py-2
                                   rounded-full
                                   font-bold
                                   text-sm"
                        >

                            🔧 Sedang Diperbaiki

                        </span>

                    </div>



                    <!-- KETERANGAN -->

                    <div
                        class="mt-4
                               bg-yellow-50
                               border border-yellow-300
                               rounded-xl
                               p-4"
                    >

                        <p
                            class="font-bold
                                  text-yellow-900"
                        >

                            Keterangan Perbaikan

                        </p>


                        <p
                            class="text-sm
                                  text-yellow-800
                                  mt-2"
                        >

                            {{ $kamar->keterangan_perbaikan ?: 'Kamar sedang dalam proses perbaikan dan belum dapat digunakan.' }}

                        </p>

                    </div>



                    <!-- TIDAK BISA RESERVASI -->

                    <div class="mt-5">

                        <span
                            class="block
                                   text-center
                                   bg-gray-400
                                   text-white
                                   px-5 py-3
                                   rounded-lg
                                   font-semibold
                                   cursor-not-allowed"
                        >

                            Tidak Dapat Dipesan

                        </span>

                    </div>


                </div>



            {{-- ================================================= --}}
            {{-- KAMAR NORMAL / TERSEDIA --}}
            {{-- ================================================= --}}

            @else


                <a
                    href="/kamar/{{ $kamar->id }}"
                    class="block bg-white rounded-2xl shadow p-6
                           transition-all duration-200
                           hover:-translate-y-2 hover:shadow-xl
                           active:scale-95"
                >


                    <!-- FOTO -->

                    <div
                        class="h-40 bg-[#F4EFE6] rounded-xl mb-5
                               flex items-center justify-center
                               overflow-hidden"
                    >

                        @if ($kamar->foto)

                            <img
                                src="{{ asset('kamar/' . $kamar->foto) }}"
                                alt="Kamar Hotel"
                                class="w-full h-full object-cover"
                            >

                        @else

                            <img
                                src="https://images.unsplash.com/photo-1611892440504-42a792e24d32?auto=format&fit=crop&w=800&q=80"
                                alt="Kamar Hotel"
                                class="w-full h-full object-cover"
                            >

                        @endif

                    </div>



                    <!-- NOMOR KAMAR -->

                    <h2
                        class="text-xl font-bold text-[#17324D]"
                    >

                        Kamar {{ $kamar->nomor_kamar }}

                    </h2>



                    <!-- TIPE -->

                    <p class="text-[#17324D] mt-2">

                        Tipe:
                        {{ $kamar->tipe_kamar }}

                    </p>



                    <!-- HARGA -->

                    <p
                        class="text-[#17324D]
                               font-bold
                               mt-2"
                    >

                        Rp
                        {{ number_format($kamar->harga, 0, ',', '.') }}

                    </p>



                    <!-- FASILITAS -->

                    <p class="text-[#17324D] mt-2">

                        {{ $kamar->fasilitas }}

                    </p>



                    <!-- STATUS -->

                    <div
                        class="mt-4
                               flex
                               justify-between
                               items-center"
                    >

                        <p class="text-[#17324D]">

                            Status:

                            <span class="font-bold">

                                {{ $kamar->status }}

                            </span>

                        </p>


                        <span
                            class="text-[#17324D]
                                   font-bold"
                        >

                            Lihat Detail →

                        </span>

                    </div>


                </a>


            @endif


        @empty


            <p class="text-[#17324D]">

                Belum ada data kamar.

            </p>


        @endforelse


    </div>



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
                   rounded-lg"
        >

            ← Kembali

        </a>


    </div>


</div>


</body>

</html>