<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Hotel AMBATUKAM - Login</title>

    <script src="https://cdn.tailwindcss.com"></script>

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

                    Selamat datang di Hotel AMBATUKAM.
                    Silakan masuk ke akun Anda untuk
                    melanjutkan proses reservasi kamar
                    melalui sistem hotel kami.

                </p>


                <!-- INFORMASI HOTEL -->

                <div class="bg-white
                            rounded-2xl
                            p-6
                            shadow-md
                            border-2
                            border-[#17324D]">

                    <h3 class="font-bold text-xl mb-3">

                        Sistem Reservasi Hotel

                    </h3>


                    <p class="leading-relaxed">

                        Login diperlukan ketika Anda ingin
                        melakukan reservasi kamar. Jika belum
                        memiliki akun, silakan melakukan
                        pendaftaran terlebih dahulu.

                    </p>

                </div>


            </div>



            <!-- KARTU LOGIN -->

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



                <!-- LOGIN CARD -->

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

                            🔐

                        </div>

                    </div>



                    <div class="text-center mb-8">

                        <h2 class="text-3xl
                                   font-bold">

                            Selamat Datang

                        </h2>


                        <p class="mt-2
                                  text-gray-600">

                            Silakan login untuk melanjutkan

                        </p>

                    </div>



                    <!-- SUCCESS -->

                    @if(session('success'))

                        <div class="bg-[#F4EFE6]
                                    border
                                    border-[#17324D]
                                    rounded-xl
                                    p-4
                                    mb-5
                                    text-center
                                    text-sm">

                            {{ session('success') }}

                        </div>

                    @endif



                    <!-- ERROR -->

                    @if(session('error'))

                        <div class="bg-[#F4EFE6]
                                    border
                                    border-[#17324D]
                                    rounded-xl
                                    p-4
                                    mb-5
                                    text-center
                                    text-sm">

                            {{ session('error') }}

                        </div>

                    @endif



                    <!-- VALIDATION -->

                    @if($errors->any())

                        <div class="bg-[#F4EFE6]
                                    border
                                    border-[#17324D]
                                    rounded-xl
                                    p-4
                                    mb-5
                                    text-sm">

                            @foreach($errors->all() as $error)

                                <p>
                                    {{ $error }}
                                </p>

                            @endforeach

                        </div>

                    @endif



                    <!-- FORM LOGIN -->

                    <form action="/login" method="POST">

                        @csrf


                        <!-- USERNAME -->

                        <div class="mb-5">

                            <label class="block
                                          font-semibold
                                          mb-2">

                                Username

                            </label>


                            <input
                                type="text"
                                name="username"
                                value="{{ old('username') }}"
                                placeholder="Masukkan username"
                                required
                                class="w-full
                                       border-2
                                       border-[#F4EFE6]
                                       rounded-xl
                                       px-4
                                       py-3
                                       outline-none
                                       focus:border-[#17324D]
                                       focus:ring-2
                                       focus:ring-[#17324D]
                                       transition-all">

                        </div>



                        <!-- PASSWORD -->

                        <div class="mb-6">

                            <label class="block
                                          font-semibold
                                          mb-2">

                                Password

                            </label>


                            <input
                                type="password"
                                name="password"
                                placeholder="Masukkan password"
                                required
                                class="w-full
                                       border-2
                                       border-[#F4EFE6]
                                       rounded-xl
                                       px-4
                                       py-3
                                       outline-none
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

                            Masuk ke Akun

                        </button>


                    </form>



                    <!-- REGISTER -->

                    <div class="text-center
                                mt-7
                                pt-6
                                border-t-2
                                border-[#F4EFE6]">


                        <p class="text-gray-600">

                            Belum memiliki akun?

                        </p>


                        <a
                            href="/register"
                            class="inline-block
                                   mt-2
                                   font-bold
                                   text-[#17324D]
                                   underline
                                   hover:no-underline
                                   hover:-translate-y-0.5
                                   transition-all">

                            Daftar dulu →

                        </a>


                    </div>


                </div>


            </div>


        </div>


    </div>


</body>

</html>