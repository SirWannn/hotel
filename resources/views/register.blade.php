<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Register - Hotel AMBATUKAM</title>

    @vite('resources/css/app.css')

</head>


<body class="bg-[#F4EFE6] text-[#17324D] min-h-screen">


    <!-- Background Decoration -->

    <div class="fixed
                -top-32
                -left-32
                w-96
                h-96
                bg-[#17324D]
                rounded-full
                opacity-10">
    </div>


    <div class="fixed
                -bottom-40
                -right-32
                w-96
                h-96
                bg-[#17324D]
                rounded-full
                opacity-10">
    </div>



    <!-- MAIN -->

    <div class="min-h-screen
                flex
                items-center
                justify-center
                px-6
                py-10">


        <div class="max-w-5xl
                    w-full
                    grid
                    md:grid-cols-2
                    gap-10
                    items-center">


            <!-- BAGIAN KIRI -->

            <div class="px-4 md:px-8">


                <div class="mb-8">

                    <div class="inline-flex
                                items-center
                                gap-3
                                bg-[#17324D]
                                text-white
                                px-5
                                py-3
                                rounded-full
                                shadow-lg">

                        <span class="text-xl">
                            🏨
                        </span>

                        <span class="font-semibold">
                            SISTEM RESERVASI HOTEL
                        </span>

                    </div>

                </div>



                <h1 class="text-5xl
                           md:text-6xl
                           font-bold
                           leading-tight
                           mb-6">

                    HOTEL
                    <br>

                    <span>
                        AMBATUKAM
                    </span>

                </h1>


                <p class="text-lg
                          leading-relaxed
                          max-w-lg
                          mb-6">

                    Buat akun Tamu Hotel AMBATUKAM
                    untuk dapat melanjutkan proses
                    reservasi kamar dan pembayaran.

                </p>


                <div class="bg-white
                            rounded-2xl
                            p-6
                            shadow-md
                            border-2
                            border-[#17324D]">

                    <h3 class="font-bold text-xl mb-3">
                        Buat Akun Tamu
                    </h3>

                    <p class="leading-relaxed">
                        Isi data diri dengan benar agar
                        informasi tamu dapat digunakan
                        dalam proses reservasi hotel.
                    </p>

                </div>


            </div>



            <!-- REGISTER CARD -->

            <div class="relative">


                <!-- Dekorasi -->

                <div class="absolute
                            -top-5
                            -right-5
                            w-20
                            h-20
                            bg-[#17324D]
                            rounded-2xl
                            rotate-12
                            opacity-10">
                </div>


                <div class="absolute
                            -bottom-5
                            -left-5
                            w-20
                            h-20
                            bg-[#17324D]
                            rounded-full
                            opacity-10">
                </div>



                <!-- CARD -->

                <div class="relative
                            bg-white
                            rounded-3xl
                            shadow-2xl
                            p-8
                            md:p-10
                            border-2
                            border-[#17324D]">


                    <!-- ICON -->

                    <div class="flex
                                justify-center
                                mb-5">

                        <div class="w-16
                                    h-16
                                    bg-[#17324D]
                                    text-white
                                    rounded-2xl
                                    flex
                                    items-center
                                    justify-center
                                    text-3xl
                                    shadow-lg">

                            👤

                        </div>

                    </div>



                    <div class="text-center mb-8">

                        <h2 class="text-3xl font-bold">

                            Buat Akun

                        </h2>


                        <p class="mt-2 text-gray-600">

                            Daftar sebagai Tamu Hotel AMBATUKAM

                        </p>

                    </div>



                    <!-- ERROR -->

                    @if ($errors->any())

                        <div class="bg-[#F4EFE6]
                                    border
                                    border-[#17324D]
                                    text-[#17324D]
                                    px-4
                                    py-3
                                    rounded-xl
                                    mb-5">

                            @foreach ($errors->all() as $error)

                                <p>
                                    {{ $error }}
                                </p>

                            @endforeach

                        </div>

                    @endif



                    <!-- FORM -->

                    <form action="/register" method="POST">

                        @csrf



                        <!-- NAMA -->

                        <div class="mb-5">

                            <label class="block
                                          text-sm
                                          font-semibold
                                          mb-2">

                                Nama

                            </label>


                            <input
                                type="text"
                                name="nama"
                                value="{{ old('nama') }}"
                                required
                                placeholder="Masukkan nama"
                                class="w-full
                                       px-4
                                       py-3
                                       border-2
                                       border-[#F4EFE6]
                                       rounded-xl
                                       focus:outline-none
                                       focus:border-[#17324D]
                                       focus:ring-2
                                       focus:ring-[#17324D]
                                       transition-all">

                        </div>



                        <!-- NOMOR IDENTITAS -->

                        <div class="mb-5">

                            <label class="block
                                          text-sm
                                          font-semibold
                                          mb-2">

                                Nomor Identitas

                            </label>


                            <input
                                type="text"
                                name="nomor_identitas"
                                value="{{ old('nomor_identitas') }}"
                                required
                                placeholder="Masukkan nomor identitas"
                                class="w-full
                                       px-4
                                       py-3
                                       border-2
                                       border-[#F4EFE6]
                                       rounded-xl
                                       focus:outline-none
                                       focus:border-[#17324D]
                                       focus:ring-2
                                       focus:ring-[#17324D]
                                       transition-all">

                        </div>



                        <!-- NO TELEPON -->

                        <div class="mb-5">

                            <label class="block
                                          text-sm
                                          font-semibold
                                          mb-2">

                                No. Telepon

                            </label>


                            <input
                                type="text"
                                name="no_telepon"
                                value="{{ old('no_telepon') }}"
                                required
                                placeholder="Masukkan nomor telepon"
                                class="w-full
                                       px-4
                                       py-3
                                       border-2
                                       border-[#F4EFE6]
                                       rounded-xl
                                       focus:outline-none
                                       focus:border-[#17324D]
                                       focus:ring-2
                                       focus:ring-[#17324D]
                                       transition-all">

                        </div>



                        <!-- ALAMAT -->

                        <div class="mb-5">

                            <label class="block
                                          text-sm
                                          font-semibold
                                          mb-2">

                                Alamat

                            </label>


                            <textarea
                                name="alamat"
                                required
                                placeholder="Masukkan alamat"
                                class="w-full
                                       px-4
                                       py-3
                                       border-2
                                       border-[#F4EFE6]
                                       rounded-xl
                                       focus:outline-none
                                       focus:border-[#17324D]
                                       focus:ring-2
                                       focus:ring-[#17324D]
                                       transition-all"
                            >{{ old('alamat') }}</textarea>

                        </div>



                        <!-- USERNAME -->

                        <div class="mb-5">

                            <label class="block
                                          text-sm
                                          font-semibold
                                          mb-2">

                                Username

                            </label>


                            <input
                                type="text"
                                name="username"
                                value="{{ old('username') }}"
                                required
                                placeholder="Masukkan username"
                                class="w-full
                                       px-4
                                       py-3
                                       border-2
                                       border-[#F4EFE6]
                                       rounded-xl
                                       focus:outline-none
                                       focus:border-[#17324D]
                                       focus:ring-2
                                       focus:ring-[#17324D]
                                       transition-all">

                        </div>



                        <!-- PASSWORD -->

                        <div class="mb-6">

                            <label class="block
                                          text-sm
                                          font-semibold
                                          mb-2">

                                Password

                            </label>


                            <input
                                type="password"
                                name="password"
                                required
                                placeholder="Minimal 6 karakter"
                                class="w-full
                                       px-4
                                       py-3
                                       border-2
                                       border-[#F4EFE6]
                                       rounded-xl
                                       focus:outline-none
                                       focus:border-[#17324D]
                                       focus:ring-2
                                       focus:ring-[#17324D]
                                       transition-all">

                        </div>



                        <!-- BUTTON -->

                        <button
                            type="submit"
                            class="w-full
                                   bg-[#17324D]
                                   text-white
                                   py-3.5
                                   rounded-xl
                                   font-bold
                                   border-2
                                   border-[#17324D]
                                   hover:bg-white
                                   hover:text-[#17324D]
                                   hover:-translate-y-1
                                   hover:shadow-lg
                                   active:scale-95
                                   transition-all duration-200">

                            Daftar Akun

                        </button>


                    </form>



                    <!-- LOGIN -->

                    <div class="text-center
                                mt-7
                                pt-6
                                border-t-2
                                border-[#F4EFE6]">


                        <p class="text-gray-600">

                            Sudah punya akun?

                        </p>


                        <a
                            href="/login"
                            class="inline-block
                                   mt-2
                                   font-bold
                                   text-[#17324D]
                                   underline
                                   hover:no-underline
                                   hover:-translate-y-0.5
                                   transition-all">

                            Login →

                        </a>


                    </div>


                </div>


            </div>


        </div>


    </div>


</body>

</html>