<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - Hotel AMBATUKAM</title>

    @vite('resources/css/app.css')
</head>

<body class="min-h-screen bg-[#F4EFE6] flex items-center justify-center p-6">

<div class="text-center pt-8 pb-4">
    <img
        src="https://i.pinimg.com/736x/24/a5/4c/24a54c075ae7a7e7ae16d69e2766cefe.jpg"
        alt="foto profil"
        class="w-48 h-auto mx-auto"
    >
</div>

    <div class="w-full max-w-md">

        <!-- Judul -->
        <div class="text-center mb-8">

            <h1 class="text-3xl font-bold text-[#17324D]">
                Hotel AMBATUKAM
            </h1>

            <p class="text-[#17324D] mt-2">
                Silakan login untuk melanjutkan
            </p>

        </div>

        <!-- Form Login -->
        <div class="bg-white rounded-2xl shadow-xl p-8">

            <h2 class="text-2xl font-bold text-[#17324D] text-center mb-6">
                Login
            </h2>

            @if(session('error'))
                <div class="bg-[#F4EFE6] text-[#17324D] p-3 rounded-lg mb-5 text-center">
                    {{ session('error') }}
                </div>
            @endif

            <form action="/login" method="POST">

                @csrf

                <!-- Username -->
                <div class="mb-5">

                    <label for="username"
                           class="block text-[#17324D] font-semibold mb-2">
                        Username
                    </label>

                    <input
                        type="text"
                        id="username"
                        name="username"
                        value="{{ old('username') }}"
                        placeholder="Masukkan username"
                        required
                        class="w-full px-4 py-3
                               border border-[#17324D]
                               rounded-lg
                               text-[#17324D]
                               focus:outline-none
                               focus:ring-2
                               focus:ring-[#17324D]">

                    @error('username')
                        <p class="text-[#17324D] text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

                <!-- Password -->
                <div class="mb-6">

                    <label for="password"
                           class="block text-[#17324D] font-semibold mb-2">
                        Password
                    </label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Masukkan password"
                        required
                        class="w-full px-4 py-3
                               border border-[#17324D]
                               rounded-lg
                               text-[#17324D]
                               focus:outline-none
                               focus:ring-2
                               focus:ring-[#17324D]">

                    @error('password')
                        <p class="text-[#17324D] text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

                <!-- Tombol Login -->
                <button
                    type="submit"
                    class="w-full bg-[#17324D] text-white
                           py-3 rounded-lg font-semibold
                           hover:bg-[#17324D]
                           hover:-translate-y-0.5
                           active:scale-95
                           transition-all duration-200">
                    Login
                </button>

            </form>

            <!-- Register -->
            <div class="text-center mt-6">

                <p class="text-[#17324D]">
                    Belum punya akun?
                </p>

                <a href="/register"
                   class="inline-block mt-2
                          text-[#17324D] font-bold
                          hover:underline">
                    Register
                </a>

            </div>

        </div>

    </div>

</body>
</html>