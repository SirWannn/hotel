<!DOCTYPE html>

<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


<title>Hotel AMBATUKAM</title>

<script src="https://cdn.tailwindcss.com"></script>


</head>

<body class="bg-[#F4EFE6] text-[#17324D]">

<!-- Navbar -->

<nav class="bg-[#17324D] text-white px-8 py-4 sticky top-0 z-50">


<div class="max-w-6xl mx-auto flex justify-between items-center">

    <div>
        <h1 class="text-2xl font-bold">
            HOTEL AMBATUKAM
        </h1>

        <p class="text-sm">
            Sistem Reservasi Hotel
        </p>
    </div>


    <!-- BAGIAN KANAN NAVBAR -->
    <div class="flex items-center gap-3">

        @if (auth()->check())

            <!-- PROFIL -->
            <a href="/profil"
               class="ml-10 bg-white text-[#17324D]
                      px-5 py-3 rounded-lg shadow
                      flex items-center gap-4
                      cursor-pointer
                      hover:bg-[#F4EFE6]
                      hover:-translate-y-1
                      hover:shadow-xl
                      active:scale-95
                      transition-all duration-200">

                <img
                    src="https://i.pinimg.com/736x/24/a5/4c/24a54c075ae7a7e7ae16d69e2766cefe.jpg"
                    alt="Foto Profil"
                    class="w-14 h-14 rounded-full object-cover
                           border-2 border-[#17324D]">

                <div>

                    <p class="font-bold text-lg">
                        Profil
                    </p>

                    <p class="text-sm">
                        <span class="font-semibold">
                            Nama :
                        </span>
                        {{ auth()->user()->nama }}
                    </p>

                    <p class="text-sm">
                        <span class="font-semibold">
                            Username :
                        </span>
                        {{ auth()->user()->username }}
                    </p>

                </div>

            </a>


            <!-- CEK RESERVASI -->
            @if (auth()->user()->role === 'tamu')

                <a href="/tamu"
                   class="bg-white text-[#17324D]
                          px-5 py-3 rounded-lg font-semibold
                          hover:bg-[#F4EFE6]
                          hover:-translate-y-0.5
                          active:scale-95
                          transition-all duration-200">

                    Cek Reservasi

                </a>

            @endif

        @else

            <!-- MASUK -->
            <a href="/login"
               class="bg-white text-[#17324D]
                      px-5 py-2 rounded-lg
                      font-semibold
                      hover:bg-[#F4EFE6]
                      hover:-translate-y-0.5
                      active:scale-95
                      transition-all duration-200">

                Masuk

            </a>


            <!-- DAFTAR -->
            <a href="/register"
               class="bg-[#F4EFE6] text-[#17324D]
                      px-5 py-2 rounded-lg
                      font-semibold
                      hover:bg-white
                      hover:-translate-y-0.5
                      active:scale-95
                      transition-all duration-200">

                Daftar

            </a>

        @endif

    </div>

</div>


</nav>

<!-- Hero -->

<section class="min-h-[500px] flex items-center">


<div class="max-w-6xl mx-auto w-full px-6 py-16">

    <div class="grid md:grid-cols-2 gap-12 items-center">

        <div>

            <p class="font-semibold text-lg mb-3">
                SELAMAT DATANG
            </p>

            <h2 class="text-5xl font-bold leading-tight mb-6">

                Nikmati Kenyamanan

                <br>

                di Hotel AMBATUKAM

            </h2>

            <p class="text-lg leading-relaxed">

                Hotel AMBATUKAM menyediakan tempat menginap
                yang nyaman dengan pelayanan yang ramah serta
                fasilitas yang mendukung kebutuhan Anda.

            </p>

        </div>


        <div class="rounded-2xl overflow-hidden shadow-xl">

            <img
                src="https://i.pinimg.com/736x/53/0f/a7/530fa7fe770fa473f7a68584569da69a.jpg"
                alt="Hotel AMBATUKAM"
                class="w-full h-[350px] object-cover">

        </div>

    </div>

</div>


</section>

<!-- PILIHAN KAMAR -->

<section class="bg-white py-16 px-6">


<div class="max-w-6xl mx-auto">

    <div class="text-center mb-10">

        <h2 class="text-4xl font-bold">
            Pilihan Kamar
        </h2>

        <p class="mt-3 text-lg">
            Pilih kamar yang sesuai dengan kebutuhan Anda.
        </p>

    </div>


    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">


        @forelse($kamars as $kamar)

    <div class="bg-[#F4EFE6]
                rounded-2xl
                overflow-hidden
                shadow-lg
                border-2
                {{ $kamar->status === 'perbaikan'
                    ? 'border-yellow-500'
                    : 'border-[#17324D]' }}
                hover:-translate-y-2
                hover:shadow-2xl
                transition-all duration-300">

<!-- FOTO KAMAR -->
<div class="h-52 overflow-hidden">

    @if($kamar->foto)

        <img
            src="{{ asset('kamar/' . $kamar->foto) }}"
            alt="Kamar {{ $kamar->nomor_kamar }}"
            class="w-full h-full object-cover
                   {{ $kamar->status !== 'perbaikan' ? 'hover:scale-105' : '' }}
                   transition-transform duration-300">

    @else

        @if($kamar->nomor_kamar == '101')

            <img
                src="https://images.unsplash.com/photo-1566665797739-1674de7a421a?auto=format&fit=crop&w=900&q=80"
                alt="Kamar {{ $kamar->nomor_kamar }}"
                class="w-full h-full object-cover">

        @elseif($kamar->nomor_kamar == '102')

            <img
                src="https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?auto=format&fit=crop&w=900&q=80"
                alt="Kamar {{ $kamar->nomor_kamar }}"
                class="w-full h-full object-cover">

        @elseif($kamar->nomor_kamar == '201')

            <img
                src="https://images.unsplash.com/photo-1611892440504-42a792e24d32?auto=format&fit=crop&w=900&q=80"
                alt="Kamar {{ $kamar->nomor_kamar }}"
                class="w-full h-full object-cover">

        @elseif($kamar->nomor_kamar == '202')

            <img
                src="https://images.unsplash.com/photo-1590490360182-c33d57733427?auto=format&fit=crop&w=900&q=80"
                alt="Kamar {{ $kamar->nomor_kamar }}"
                class="w-full h-full object-cover">

        @elseif($kamar->nomor_kamar == '301')

            <img
                src="https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=900&q=80"
                alt="Kamar {{ $kamar->nomor_kamar }}"
                class="w-full h-full object-cover">

        @elseif($kamar->nomor_kamar == '302')

            <img
                src="https://images.unsplash.com/photo-1601918774946-25832a4be0d6?auto=format&fit=crop&w=900&q=80"
                alt="Kamar {{ $kamar->nomor_kamar }}"
                class="w-full h-full object-cover">

        @endif

    @endif

</div>



        <div class="p-6">

            <p class="text-sm font-semibold">
                KAMAR
            </p>


            <h3 class="text-2xl font-bold mt-1">
                {{ $kamar->nomor_kamar }}
            </h3>


            <p class="text-lg mt-2 font-semibold">
                {{ $kamar->tipe_kamar }}
            </p>


            <div class="mt-4">

                <p class="text-sm">
                    Harga per malam
                </p>

                <p class="text-2xl font-bold">

                    Rp
                    {{ number_format($kamar->harga, 0, ',', '.') }}

                </p>

            </div>


            <div class="mt-4">

                <p>

                    <span class="font-semibold">
                        Kapasitas:
                    </span>

                    {{ $kamar->kapasitas }} orang

                </p>

            </div>


            <div class="mt-3">

                <p>

                    <span class="font-semibold">
                        Fasilitas:
                    </span>

                    {{ $kamar->fasilitas }}

                </p>

            </div>


            @if($kamar->status === 'perbaikan')

                <!-- ================================= -->
                <!-- KAMAR SEDANG DIPERBAIKI -->
                <!-- TIDAK ADA LINK / TIDAK BISA DIKLIK -->
                <!-- ================================= -->

                <div class="mt-5">

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


                <!-- KETERANGAN PERBAIKAN -->

                <div
                    class="mt-4
                           bg-yellow-50
                           border border-yellow-300
                           rounded-xl
                           p-4"
                >

                    <p class="font-bold text-yellow-900">

                        Keterangan Perbaikan

                    </p>

                    <p class="text-sm text-yellow-800 mt-2">

                        {{ $kamar->keterangan_perbaikan
                            ?: 'Kamar sedang dalam proses perbaikan.' }}

                    </p>

                </div>


                <!-- TIDAK DAPAT DIPESAN -->

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


            @else

                <!-- ================================= -->
                <!-- KAMAR NORMAL -->
                <!-- MASIH BISA DIKLIK -->
                <!-- ================================= -->

                <a
                    href="/kamar/{{ $kamar->id }}"
                    class="block text-center
                           mt-6
                           bg-[#17324D]
                           text-white
                           px-5 py-3
                           rounded-lg
                           font-semibold
                           border border-[#17324D]
                           hover:bg-white
                           hover:text-[#17324D]
                           hover:-translate-y-1
                           hover:shadow-lg
                           active:scale-95
                           transition-all duration-200"
                >

                    Pilih Kamar →

                </a>

            @endif


        </div>

    </div>


@empty

    <div class="col-span-full
                bg-[#F4EFE6]
                border-2 border-[#17324D]
                rounded-2xl
                p-8
                text-center">

        <p class="text-lg font-semibold">

            Belum ada kamar yang tersedia.

        </p>

    </div>

@endforelse


    </div>

</div>


</section>

<!-- Tentang Kami -->

<section class="bg-[#F4EFE6] py-16 px-6">


<div class="max-w-6xl mx-auto">

    <h2 class="text-3xl font-bold mb-6">
        Tentang Kami
    </h2>

    <p class="text-lg leading-relaxed max-w-4xl">

        Hotel AMBATUKAM merupakan hotel yang menyediakan
        layanan penginapan dengan mengutamakan kenyamanan
        dan kemudahan bagi para tamu. Sistem reservasi ini
        dibuat untuk membantu tamu dalam melihat kamar,
        melakukan reservasi, pembayaran, serta melihat
        status reservasi.

    </p>

</div>


</section>

<!-- Fasilitas -->

<section class="bg-white py-16 px-6">


<div class="max-w-6xl mx-auto">

    <h2 class="text-3xl font-bold mb-8 text-center">
        Fasilitas Hotel
    </h2>


    <div class="grid md:grid-cols-3 gap-6">


        <!-- Kamar -->
        <div class="bg-[#F4EFE6]
                    p-6 rounded-2xl shadow
                    hover:-translate-y-2
                    transition-all duration-200">

            <img
                src="https://www.svgrepo.com/show/448026/hotel.svg"
                alt="Kamar"
                class="w-20 h-20 object-contain mb-4 mx-auto">

            <h3 class="text-xl font-bold mb-2">
                Kamar Nyaman
            </h3>

            <p>

                Kamar yang nyaman untuk beristirahat
                selama menginap.

            </p>

        </div>


        <!-- WiFi -->
        <div class="bg-[#F4EFE6]
                    p-6 rounded-2xl shadow
                    hover:-translate-y-2
                    transition-all duration-200">

            <img
                src="https://www.svgrepo.com/show/503667/wifi.svg"
                alt="WiFi"
                class="w-20 h-20 object-contain mb-4 mx-auto">

            <h3 class="text-xl font-bold mb-2">
                WiFi
            </h3>

            <p>

                Akses internet untuk mendukung kebutuhan
                selama berada di hotel.

            </p>

        </div>


        <!-- Pelayanan -->
        <div class="bg-[#F4EFE6]
                    p-6 rounded-2xl shadow
                    hover:-translate-y-2
                    transition-all duration-200">

            <img
                src="https://cdn-icons-png.flaticon.com/512/185/185533.png"
                alt="Pelayanan"
                class="w-20 h-20 object-contain mb-4 mx-auto">

            <h3 class="text-xl font-bold mb-2">
                Pelayanan
            </h3>

            <p>

                Pelayanan hotel yang membantu memberikan
                pengalaman menginap yang nyaman.

            </p>

        </div>


    </div>

</div>


</section>

<!-- Media Sosial -->

<section class="bg-white py-16 px-6">


<div class="max-w-6xl mx-auto text-center">

    <h2 class="text-3xl font-bold mb-4">
        Media Sosial
    </h2>

    <p class="mb-6">

        Ikuti informasi terbaru Hotel AMBATUKAM melalui
        media sosial kami.

    </p>


    <div class="bg-[#F4EFE6]
                rounded-2xl
                p-6
                max-w-sm
                mx-auto
                hover:-translate-y-1
                transition-all duration-200">

        <img
            src="https://cdn-icons-png.flaticon.com/512/1384/1384063.png"
            alt="Instagram"
            class="w-16 h-16 object-contain mx-auto mb-4">

        <p class="font-semibold">
            Instagram
        </p>

        <p>
            @AMBATUKAM
        </p>

    </div>

</div>


</section>

<!-- Kontak -->

<section class="bg-[#F4EFE6] py-16 px-6">


<div class="max-w-6xl mx-auto">

    <h2 class="text-3xl font-bold mb-8 text-center">
        Kontak Kami
    </h2>


    <div class="grid md:grid-cols-3 gap-6">


        <!-- Email -->
        <div class="bg-white p-6 rounded-2xl text-center
                    hover:-translate-y-2
                    transition-all duration-200">

            <img
                src="https://www.svgrepo.com/show/498800/email.svg"
                alt="Email"
                class="w-16 h-16 object-contain mx-auto mb-3">

            <h3 class="font-bold mb-2">
                Email
            </h3>

            <p>
                hotelambatukam@gmail.com
            </p>

        </div>


        <!-- Telepon -->
        <div class="bg-white p-6 rounded-2xl text-center
                    hover:-translate-y-2
                    transition-all duration-200">

            <img
                src="https://cdn-icons-png.flaticon.com/512/724/724664.png"
                alt="Telepon"
                class="w-16 h-16 object-contain mx-auto mb-3">

            <h3 class="font-bold mb-2">
                Telepon
            </h3>

            <p>
                088842765979
            </p>

        </div>


        <!-- Alamat -->
        <div class="bg-white p-6 rounded-2xl text-center
                    hover:-translate-y-2
                    transition-all duration-200">

            <img
                src="https://cdn-icons-png.flaticon.com/512/684/684908.png"
                alt="Lokasi"
                class="w-16 h-16 object-contain mx-auto mb-3">

            <h3 class="font-bold mb-2">
                Alamat
            </h3>

            <p>
                Bandung, Jawa Barat
            </p>

        </div>


    </div>

</div>


</section>

<!-- Footer -->

<footer class="bg-[#17324D] text-white py-6 text-center">


<p>
    © 2026 Hotel AMBATUKAM
</p>

<p class="text-sm mt-1">
    Sistem Reservasi Hotel
</p>


</footer>

</body>

</html>
