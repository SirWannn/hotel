<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Detail Kamar - Hotel AMBATUKAM</title>

    @vite('resources/css/app.css')
</head>

<body class="bg-[#F4EFE6] min-h-screen">

    <!-- Navbar -->
    <nav class="bg-[#17324D] text-white px-8 py-4">

        <div class="max-w-6xl mx-auto">

            <div class="flex justify-between items-center">

                <div>
                    <h1 class="text-xl font-bold">
                        Hotel AMBATUKAM
                    </h1>

                    <p class="text-sm">
                        Detail Kamar
                    </p>
                </div>

                <form action="/logout" method="POST">

                    @csrf

                    <button
                        type="submit"
                        class="bg-white text-[#17324D]
                               hover:bg-[#F4EFE6]
                               hover:-translate-y-0.5
                               hover:shadow-lg
                               active:scale-95
                               transition-all duration-200
                               px-4 py-2 rounded-lg">

                        Logout

                    </button>

                </form>

            </div>

        </div>

    </nav>


    <!-- Detail Kamar -->
    <div class="max-w-5xl mx-auto px-6 py-10">

        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">

            <div class="grid md:grid-cols-2">

<!-- Slider Foto Kamar -->
<div class="h-80 md:h-full relative overflow-hidden">

    <div id="sliderKamar"
         class="flex h-full transition-transform duration-500 ease-in-out">

        <!-- FOTO 1 -->
        <img
            id="foto1"
            src=""
            alt="Foto Kamar"
            class="w-full h-full object-cover flex-shrink-0">

        <!-- FOTO 2 -->
        <img
            id="foto2"
            src=""
            alt="Foto Kamar"
            class="w-full h-full object-cover flex-shrink-0">

        <!-- FOTO 3 -->
        <img
            id="foto3"
            src=""
            alt="Foto Kamar"
            class="w-full h-full object-cover flex-shrink-0">

    </div>


    <!-- Tombol Kiri -->
    <button
        type="button"
        onclick="geserFoto(-1)"
        class="absolute left-3 top-1/2 -translate-y-1/2
               bg-white/80 hover:bg-white
               text-[#17324D]
               w-11 h-11 rounded-full
               flex items-center justify-center
               text-2xl font-bold
               shadow-lg
               active:scale-90
               transition-all duration-200">

        ←

    </button>


    <!-- Tombol Kanan -->
    <button
        type="button"
        onclick="geserFoto(1)"
        class="absolute right-3 top-1/2 -translate-y-1/2
               bg-white/80 hover:bg-white
               text-[#17324D]
               w-11 h-11 rounded-full
               flex items-center justify-center
               text-2xl font-bold
               shadow-lg
               active:scale-90
               transition-all duration-200">

        →

    </button>


    <!-- Indikator -->
    <div class="absolute bottom-4 left-1/2 -translate-x-1/2
                flex gap-2">

        <span id="dot1"
              class="w-3 h-3 rounded-full bg-white shadow"></span>

        <span id="dot2"
              class="w-3 h-3 rounded-full bg-white/50 shadow"></span>

        <span id="dot3"
              class="w-3 h-3 rounded-full bg-white/50 shadow"></span>

    </div>

</div>


<script>

const fotoKamar = {

    "1": [
        "https://images.unsplash.com/photo-1566665797739-1674de7a421a?auto=format&fit=crop&w=1000&q=80",
        "https://images.unsplash.com/photo-1590490360182-c33d57733427?auto=format&fit=crop&w=1000&q=80",
        "https://images.unsplash.com/photo-1601918774946-25832a4be0d6?auto=format&fit=crop&w=1000&q=80"
    ],

    "2": [
        "https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?auto=format&fit=crop&w=1000&q=80",
        "https://images.unsplash.com/photo-1611892440504-42a792e24d32?auto=format&fit=crop&w=1000&q=80",
        "https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=1000&q=80"
    ],

    "3": [
        "https://images.unsplash.com/photo-1611892440504-42a792e24d32?auto=format&fit=crop&w=1000&q=80",
        "https://images.unsplash.com/photo-1601918774946-25832a4be0d6?auto=format&fit=crop&w=1000&q=80",
        "https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?auto=format&fit=crop&w=1000&q=80"
    ],

    "4": [
        "https://images.unsplash.com/photo-1590490360182-c33d57733427?auto=format&fit=crop&w=1000&q=80",
        "https://images.unsplash.com/photo-1566665797739-1674de7a421a?auto=format&fit=crop&w=1000&q=80",
        "https://images.unsplash.com/photo-1611892440504-42a792e24d32?auto=format&fit=crop&w=1000&q=80"
    ],

    "5": [
        "https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=1000&q=80",
        "https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?auto=format&fit=crop&w=1000&q=80",
        "https://images.unsplash.com/photo-1590490360182-c33d57733427?auto=format&fit=crop&w=1000&q=80"
    ],

    "6": [
        "https://images.unsplash.com/photo-1601918774946-25832a4be0d6?auto=format&fit=crop&w=1000&q=80",
        "https://images.unsplash.com/photo-1566665797739-1674de7a421a?auto=format&fit=crop&w=1000&q=80",
        "https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=1000&q=80"
    ]

};


const nomorKamar = "{{ $kamar->nomor_kamar }}".replace(/^0+/, '') || '0';

const foto = fotoKamar[nomorKamar] || fotoKamar["1"];

document.getElementById("foto1").src = foto[0];
document.getElementById("foto2").src = foto[1];
document.getElementById("foto3").src = foto[2];


let posisiFoto = 0;


function geserFoto(arah) {

    posisiFoto += arah;

    if (posisiFoto < 0) {
        posisiFoto = 2;
    }

    if (posisiFoto > 2) {
        posisiFoto = 0;
    }

    document.getElementById("sliderKamar").style.transform =
        `translateX(-${posisiFoto * 100}%)`;


    document.getElementById("dot1").classList.toggle(
        "bg-white",
        posisiFoto === 0
    );

    document.getElementById("dot1").classList.toggle(
        "bg-white/50",
        posisiFoto !== 0
    );


    document.getElementById("dot2").classList.toggle(
        "bg-white",
        posisiFoto === 1
    );

    document.getElementById("dot2").classList.toggle(
        "bg-white/50",
        posisiFoto !== 1
    );


    document.getElementById("dot3").classList.toggle(
        "bg-white",
        posisiFoto === 2
    );

    document.getElementById("dot3").classList.toggle(
        "bg-white/50",
        posisiFoto !== 2
    );

}

</script>




                <!-- Informasi -->
                <div class="p-8">

                    <p class="text-sm font-semibold text-[#17324D] mb-2">
                        DETAIL KAMAR
                    </p>


                    <h1 class="text-3xl font-bold text-[#17324D]">
                        Kamar {{ $kamar->nomor_kamar }}
                    </h1>


                    <p class="text-lg text-[#17324D] mt-2">
                        {{ $kamar->tipe_kamar }}
                    </p>


                    <!-- Rating -->
                    <div class="mt-5">

                        <p class="font-semibold text-[#17324D] mb-1">
                            Rating
                        </p>

                        <div class="text-xl tracking-widest">
                            ★★★★★
                        </div>

                        <p class="text-sm text-gray-500 mt-1">
                            5.0 / 5
                        </p>

                    </div>


                    <!-- Harga -->
                    <div class="mt-6">

                        <p class="text-sm text-gray-500">
                            Harga per malam
                        </p>

                        <p class="text-2xl font-bold text-[#17324D]">
                            Rp {{ number_format($kamar->harga, 0, ',', '.') }}
                        </p>

                    </div>


                    <!-- Kapasitas -->
                    <div class="mt-6">

                        <p class="text-sm text-gray-500">
                            Kapasitas
                        </p>

                        <p class="font-semibold text-[#17324D]">
                            {{ $kamar->kapasitas }} orang
                        </p>

                    </div>


                    <!-- Fasilitas -->
                    <div class="mt-6">

                        <h2 class="font-bold text-[#17324D] mb-2">
                            Fasilitas
                        </h2>

                        <p class="text-gray-700">
                            {{ $kamar->fasilitas }}
                        </p>

                    </div>


                    <!-- Tombol Reservasi -->
                    <a
                        href="/reservasi?kamar_id={{ $kamar->id }}"
                        class="block text-center mt-7
                               bg-[#17324D] text-white
                               px-6 py-3 rounded-lg
                               font-semibold
                               hover:bg-white
                               hover:text-[#17324D]
                               hover:-translate-y-1
                               hover:shadow-lg
                               active:scale-95
                               transition-all duration-200
                               border border-[#17324D]">

                        Reservasi Kamar

                    </a>

                </div>

            </div>

        </div>


        <!-- Kembali -->
        <div class="mt-8">

            <a
                href="/"
                class="inline-block
                       bg-[#17324D] text-white
                       hover:bg-white
                       hover:text-[#17324D]
                       hover:-translate-y-0.5
                       active:scale-95
                       transition-all duration-200
                       px-5 py-3 rounded-lg">

                ← Kembali ke Halaman Utama

            </a>

        </div>

    </div>

</body>

</html>