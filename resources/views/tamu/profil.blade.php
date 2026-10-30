<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Profil Tamu - Hotel AMBATUKAM</title>

    @vite('resources/css/app.css')
</head>

<body class="bg-[#F4EFE6] text-[#17324D] min-h-screen">

    <!-- NAVBAR -->
    <nav class="bg-[#17324D] text-white px-8 py-4">

        <div class="max-w-6xl mx-auto flex justify-between items-center">

            <div>
                <h1 class="text-2xl font-bold">
                    HOTEL AMBATUKAM
                </h1>

                <p class="text-sm">
                    Profil Tamu
                </p>
            </div>

            <form action="/logout" method="POST">

                @csrf

                <button
                    type="submit"
                    class="bg-white text-[#17324D]
                           px-5 py-2 rounded-lg
                           font-semibold
                           hover:bg-[#F4EFE6]
                           hover:-translate-y-1
                           active:scale-95
                           transition-all duration-200">

                    Logout

                </button>

            </form>

        </div>

    </nav>


    <!-- PROFIL -->
    <main class="max-w-3xl mx-auto px-6 py-12">

        <div class="bg-white rounded-2xl shadow-xl
                    border-2 border-[#17324D]
                    overflow-hidden">

            <!-- HEADER PROFIL -->
            <div class="bg-[#17324D] text-white
                        text-center py-8">

                <!-- FOTO PROFIL -->
                <img
                    src="https://i.pinimg.com/736x/24/a5/4c/24a54c075ae7a7e7ae16d69e2766cefe.jpg"
                    alt="Foto Profil"
                    class="w-28 h-28 mx-auto
                           rounded-full
                           object-cover
                           border-4 border-white
                           shadow-lg">

                <h2 class="text-3xl font-bold mt-4">
                    Profil Tamu
                </h2>

                <p class="mt-1">
                    Data akun Hotel AMBATUKAM
                </p>

            </div>


            <!-- DATA PROFIL -->
            <div class="p-8">

                <!-- NAMA -->
                <div class="border-b border-[#F4EFE6] py-4">

                    <p class="text-sm font-semibold">
                        Nama
                    </p>

                    <p class="text-lg font-bold mt-1">
                        {{ auth()->user()->nama }}
                    </p>

                </div>


                <!-- USERNAME -->
                <div class="border-b border-[#F4EFE6] py-4">

                    <p class="text-sm font-semibold">
                        Username
                    </p>

                    <p class="text-lg font-bold mt-1">
                        {{ auth()->user()->username }}
                    </p>

                </div>


                <!-- NOMOR IDENTITAS -->
                <div class="border-b border-[#F4EFE6] py-4">

                    <p class="text-sm font-semibold">
                        Nomor Identitas
                    </p>

                    <p class="text-lg font-bold mt-1">
                        {{ auth()->user()->tamu->nomor_identitas ?? '-' }}
                    </p>

                </div>


                <!-- NO TELEPON -->
                <div class="border-b border-[#F4EFE6] py-4">

                    <p class="text-sm font-semibold">
                        No. Telepon
                    </p>

                    <p class="text-lg font-bold mt-1">
                        {{ auth()->user()->tamu->no_telepon ?? '-' }}
                    </p>

                </div>


                <!-- ALAMAT -->
                <div class="py-4">

                    <p class="text-sm font-semibold">
                        Alamat
                    </p>

                    <p class="text-lg font-bold mt-1">
                        {{ auth()->user()->tamu->alamat ?? '-' }}
                    </p>

                </div>


                <!-- TOMBOL KEMBALI -->
                <div class="mt-8">

                    <a href="/"
                       class="block text-center
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
                              transition-all duration-200">

                        ← Kembali ke Halaman Utama

                    </a>

                </div>

            </div>

        </div>

    </main>


    <!-- FOOTER -->
    <footer class="bg-[#17324D] text-white
                   py-6 text-center mt-10">

        <p>
            © 2026 Hotel AMBATUKAM
        </p>

        <p class="text-sm mt-1">
            Sistem Reservasi Hotel
        </p>

    </footer>

</body>

</html>

