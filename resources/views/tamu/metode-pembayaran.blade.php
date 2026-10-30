<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        {{ $metodePembayaran }} - Hotel AMBATUKAM
    </title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>


<body class="min-h-screen bg-[#F4EFE6] text-[#17324D]">


<!-- NAVBAR -->

<nav class="bg-[#17324D] text-white px-6 py-5 shadow-lg">

    <div class="max-w-5xl mx-auto">

        <h1 class="text-2xl md:text-3xl font-bold">
            Hotel AMBATUKAM
        </h1>

        <p class="text-sm mt-1">
            Metode Pembayaran
        </p>

    </div>

</nav>



<main class="max-w-5xl mx-auto px-6 py-10">


<!-- ERROR -->

@if ($errors->any())

    <div class="bg-red-100 border border-red-400 text-red-700 rounded-xl p-4 mb-6">

        @foreach ($errors->all() as $error)

            <p>
                {{ $error }}
            </p>

        @endforeach

    </div>

@endif



<!-- DETAIL RESERVASI -->

<div class="bg-white rounded-2xl shadow-lg border-2 border-[#17324D] p-6 mb-8">

    <h2 class="text-2xl font-bold mb-5">
        Detail Reservasi
    </h2>


    <div class="grid md:grid-cols-2 gap-4">


        <div>

            <p class="text-sm text-gray-600">
                Nama Tamu
            </p>

            <p class="font-bold text-lg">
                {{ $reservasi->tamu->nama ?? '-' }}
            </p>

        </div>


        <div>

            <p class="text-sm text-gray-600">
                Kamar
            </p>

            <p class="font-bold text-lg">
                Kamar
                {{ $reservasi->kamar->nomor_kamar ?? '-' }}
            </p>

        </div>


        <div>

            <p class="text-sm text-gray-600">
                Check-in
            </p>

            <p class="font-bold">
                {{ $reservasi->check_in }}
            </p>

        </div>


        <div>

            <p class="text-sm text-gray-600">
                Check-out
            </p>

            <p class="font-bold">
                {{ $reservasi->check_out }}
            </p>

        </div>

    </div>


    <div class="mt-6 bg-[#F4EFE6] rounded-xl p-5 border border-[#17324D]">

        <p class="text-sm">
            Jumlah malam
        </p>

        <p class="font-bold text-lg">
            {{ $jumlahMalam }} malam
        </p>


        <p class="text-sm mt-4">
            Total pembayaran
        </p>

        <p class="font-bold text-2xl">
            Rp {{ number_format($totalPembayaran, 0, ',', '.') }}
        </p>

    </div>

</div>



<!-- ================================================= -->
<!-- TRANSFER BANK -->
<!-- ================================================= -->

@if ($metode === 'bank')


<div class="bg-white rounded-2xl shadow-lg border-2 border-[#17324D] p-6 md:p-8">


    <h2 class="text-2xl md:text-3xl font-bold">
        Transfer Bank
    </h2>


    <p class="mt-2 text-gray-600">
        Cari nama bank atau masukkan nomor Virtual Account.
    </p>



    <!-- SEARCH BAR -->

    <div class="mt-7">

        <label class="block font-bold mb-2">
            Cari Bank / Nomor Virtual Account
        </label>


        <input
            type="text"
            id="searchBank"
            placeholder="Contoh: BCA atau 123456789001"
            class="w-full border-2 border-[#17324D] rounded-xl px-5 py-4 text-lg outline-none focus:ring-2 focus:ring-[#17324D]"
            oninput="cariBank()"
        >

    </div>



    <!-- HASIL PENCARIAN -->

    <div
        id="hasilBank"
        class="mt-4 space-y-3"
    >

        @foreach ($bank as $item)

            <button
                type="button"
                onclick="pilihBank('{{ $item['kode'] }}')"
                data-nama="{{ strtolower($item['nama']) }}"
                data-va="{{ $item['va'] }}"
                class="bank-item hidden w-full text-left border-2 border-[#17324D] rounded-xl p-5 hover:bg-[#F4EFE6] hover:-translate-y-1 active:scale-95 transition-all duration-200"
            >

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-xl font-bold">
                            {{ $item['nama'] }}
                        </p>

                        <p class="text-sm text-gray-600 mt-1">
                            Virtual Account:
                            {{ $item['va'] }}
                        </p>

                    </div>


                    <span class="text-2xl">
                        →
                    </span>

                </div>

            </button>

        @endforeach

    </div>



    <!-- PESAN TIDAK DITEMUKAN -->

    <div
        id="bankTidakDitemukan"
        class="hidden mt-4 bg-red-50 border border-red-300 text-red-700 rounded-xl p-4"
    >

        Bank atau nomor Virtual Account tidak ditemukan.

    </div>



    <!-- PILIH LANGSUNG -->

    <div class="mt-8">

        <p class="font-bold mb-3">
            Atau pilih bank langsung
        </p>


        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">

            @foreach ($bank as $item)

                <button
                    type="button"
                    onclick="pilihBank('{{ $item['kode'] }}')"
                    class="border-2 border-[#17324D] rounded-xl py-4 px-3 font-bold hover:bg-[#F4EFE6] hover:-translate-y-1 active:scale-95 transition-all duration-200"
                >

                    {{ $item['nama'] }}

                </button>

            @endforeach

        </div>

    </div>



    <!-- BANK TERPILIH -->

    <div
        id="bankTerpilih"
        class="hidden mt-8 bg-[#F4EFE6] border-2 border-[#17324D] rounded-2xl p-6"
    >

        <p class="text-sm text-gray-600">
            Bank yang dipilih
        </p>


        <h3
            id="namaBank"
            class="text-3xl font-bold mt-1"
        >
        </h3>



        <!-- NOMOR VA -->

        <div class="mt-6 bg-white rounded-xl border border-[#17324D] p-5">

            <p class="text-sm text-gray-600">
                Nomor Virtual Account
            </p>


            <div class="flex flex-col md:flex-row gap-3 mt-2">

                <input
                    type="text"
                    id="nomorVA"
                    placeholder="Masukkan nomor Virtual Account"
                    class="flex-1 border-2 border-[#17324D] rounded-lg px-4 py-3 text-lg font-semibold tracking-wider"
                    oninput="deteksiVA()"
                >


                <button
                    type="button"
                    onclick="salinVA()"
                    class="bg-[#17324D] text-white px-5 py-3 rounded-lg font-semibold hover:bg-[#F4EFE6] hover:text-[#17324D] border border-[#17324D] active:scale-95 transition-all duration-200"
                >
                    Salin VA
                </button>

            </div>


            <p
                id="statusVA"
                class="text-sm mt-3"
            ></p>

        </div>



        <!-- LANJUT KE BANK -->

        <button
            type="button"
            id="tombolBank"
            onclick="lanjutKeBank()"
            disabled
            class="w-full mt-6 bg-gray-400 text-white px-6 py-4 rounded-xl font-bold text-lg cursor-not-allowed transition-all duration-200"
        >

            Masukkan Nomor VA

        </button>



        <div class="mt-5 bg-yellow-50 border border-yellow-300 rounded-xl p-4">

            <p class="text-sm text-yellow-800">

                <strong>Catatan:</strong>
                Ini merupakan simulasi pembayaran untuk Hotel AMBATUKAM.
                Nomor Virtual Account yang digunakan adalah nomor demo.

            </p>

        </div>

    </div>


</div>



<!-- ================================================= -->
<!-- DANA -->
<!-- ================================================= -->

@elseif ($metode === 'dana')


<div class="bg-white rounded-2xl shadow-lg border-2 border-[#17324D] p-6 md:p-8">

    <h2 class="text-2xl md:text-3xl font-bold">
        Pembayaran DANA
    </h2>

    <p class="mt-2">
        Silakan transfer ke nomor DANA berikut.
    </p>


    <div class="mt-6 bg-[#F4EFE6] border border-[#17324D] rounded-xl p-6">

        <p class="text-sm">
            Nomor DANA
        </p>

        <p class="text-2xl font-bold mt-2">
            {{ $nomorEwallet }}
        </p>

    </div>

</div>



<!-- ================================================= -->
<!-- OVO -->
<!-- ================================================= -->

@elseif ($metode === 'ovo')


<div class="bg-white rounded-2xl shadow-lg border-2 border-[#17324D] p-6 md:p-8">

    <h2 class="text-2xl md:text-3xl font-bold">
        Pembayaran OVO
    </h2>

    <p class="mt-2">
        Silakan transfer ke nomor OVO berikut.
    </p>


    <div class="mt-6 bg-[#F4EFE6] border border-[#17324D] rounded-xl p-6">

        <p class="text-sm">
            Nomor OVO
        </p>

        <p class="text-2xl font-bold mt-2">
            {{ $nomorEwallet }}
        </p>

    </div>

</div>



<!-- ================================================= -->
<!-- GOPAY -->
<!-- ================================================= -->

@elseif ($metode === 'gopay')


<div class="bg-white rounded-2xl shadow-lg border-2 border-[#17324D] p-6 md:p-8">

    <h2 class="text-2xl md:text-3xl font-bold">
        Pembayaran GoPay
    </h2>

    <p class="mt-2">
        Silakan transfer ke nomor GoPay berikut.
    </p>


    <div class="mt-6 bg-[#F4EFE6] border border-[#17324D] rounded-xl p-6">

        <p class="text-sm">
            Nomor GoPay
        </p>

        <p class="text-2xl font-bold mt-2">
            {{ $nomorEwallet }}
        </p>

    </div>

</div>



<!-- ================================================= -->
<!-- QRIS -->
<!-- ================================================= -->

@elseif ($metode === 'qris')


<div class="bg-white rounded-2xl shadow-lg border-2 border-[#17324D] p-6 md:p-8">

    <h2 class="text-2xl md:text-3xl font-bold">
        Pembayaran QRIS
    </h2>

    <p class="mt-2">
        Scan QRIS menggunakan aplikasi pembayaran Anda.
    </p>


    <div class="mt-6 text-center">

        <div
            id="qrisContainer"
            class="inline-block bg-white border-2 border-[#17324D] rounded-xl p-4"
        >

            <img
                src="{{ asset('images/pembayaran/qris.png') }}"
                alt="QRIS Hotel AMBATUKAM"
                class="w-64 h-64 object-contain mx-auto"
            >

        </div>


        <p class="mt-5 font-bold">
            Waktu pembayaran tersisa:
        </p>


        <p
            id="timer"
            class="text-3xl font-bold mt-2"
        >
            05:00
        </p>

    </div>


    <div
        id="qrisExpired"
        class="hidden mt-6 bg-red-100 border border-red-400 text-red-700 rounded-xl p-5 text-center"
    >

        <p class="font-bold">
            QRIS sudah kedaluwarsa.
        </p>


        <a
            href="/pembayaran/metode/qris?baru=1"
            class="inline-block mt-4 bg-[#17324D] text-white px-5 py-3 rounded-lg font-semibold"
        >
            Buat QRIS Baru
        </a>

    </div>

</div>

@endif



<!-- ================================================= -->
<!-- UPLOAD BUKTI -->
<!-- ================================================= -->

<div
    id="uploadSection"
    class="bg-white rounded-2xl shadow-lg border-2 border-[#17324D] p-6 md:p-8 mt-8"
>

    <h2 class="text-2xl font-bold">
        Upload Bukti Pembayaran
    </h2>


    <p class="mt-2 text-gray-600">
        Setelah melakukan pembayaran, upload bukti pembayaran Anda.
    </p>


    <form
        action="/pembayaran"
        method="POST"
        enctype="multipart/form-data"
        class="mt-6"
    >

        @csrf


        <input
            type="hidden"
            name="reservasi_id"
            value="{{ $reservasi->id }}"
        >


        <input
            type="hidden"
            name="metode"
            value="{{ $metodePembayaran }}"
        >


        <div>

            <label class="block font-semibold mb-2">
                Bukti Pembayaran
            </label>


            <input
                type="file"
                name="bukti_pembayaran"
                accept=".jpg,.jpeg,.png"
                required
                class="w-full border-2 border-[#17324D] rounded-lg px-4 py-3"
            >


            <p class="text-sm text-gray-600 mt-2">
                Format JPG, JPEG, PNG. Maksimal 2 MB.
            </p>

        </div>


        <button
            type="submit"
            class="mt-6 w-full bg-[#17324D] text-white px-6 py-4 rounded-xl font-bold hover:bg-[#F4EFE6] hover:text-[#17324D] border-2 border-[#17324D] hover:-translate-y-1 active:scale-95 transition-all duration-200"
        >
            Kirim Bukti Pembayaran
        </button>

    </form>

</div>



<!-- KEMBALI -->

<div class="mt-8 text-center">

    <a
        href="/pembayaran"
        class="inline-block bg-white text-[#17324D] px-6 py-3 rounded-lg font-semibold border-2 border-[#17324D] hover:bg-[#F4EFE6] active:scale-95 transition-all duration-200"
    >
        ← Pilih Metode Lain
    </a>

</div>


</main>



<footer class="bg-[#17324D] text-white text-center py-6 mt-10">

    <p>
        © 2026 Hotel AMBATUKAM
    </p>

    <p class="text-sm mt-1">
        Sistem Reservasi Hotel
    </p>

</footer>



<script>

/*
|--------------------------------------------------------------------------
| DATA BANK DARI LARAVEL
|--------------------------------------------------------------------------
*/

const daftarBank = @json($bank);

let bankAktif = null;



/*
|--------------------------------------------------------------------------
| CARI BANK / NOMOR VA
|--------------------------------------------------------------------------
*/

function cariBank() {

    const input =
        document
            .getElementById('searchBank')
            .value
            .toLowerCase()
            .trim();


    const semuaBank =
        document.querySelectorAll('.bank-item');


    const tidakDitemukan =
        document.getElementById('bankTidakDitemukan');


    if (input === '') {

        semuaBank.forEach(function(item) {

            item.classList.add('hidden');

        });

        tidakDitemukan.classList.add('hidden');

        return;
    }


    let ditemukan = false;


    semuaBank.forEach(function(item) {

        const nama =
            item.dataset.nama;

        const va =
            item.dataset.va;


        if (
            nama.includes(input) ||
            va.includes(input)
        ) {

            item.classList.remove('hidden');

            ditemukan = true;

        } else {

            item.classList.add('hidden');

        }

    });


    if (!ditemukan) {

        tidakDitemukan.classList.remove('hidden');

    } else {

        tidakDitemukan.classList.add('hidden');
    }


    /*
    | Jika nomor VA diketik lengkap,
    | bank otomatis dipilih.
    */

    const bankDitemukan =
        daftarBank.find(function(bank) {

            return bank.va === input;

        });


    if (bankDitemukan) {

        pilihBank(bankDitemukan.kode);

    }

}



/*
|--------------------------------------------------------------------------
| PILIH BANK
|--------------------------------------------------------------------------
*/

function pilihBank(kode) {

    const bank =
        daftarBank.find(function(item) {

            return item.kode === kode;

        });


    if (!bank) {

        return;
    }


    bankAktif = bank;


    document
        .getElementById('bankTerpilih')
        .classList.remove('hidden');


    document
        .getElementById('namaBank')
        .innerText = bank.nama;


    const nomorVA =
        document.getElementById('nomorVA');


    nomorVA.value = '';


    document
        .getElementById('statusVA')
        .innerHTML =
        'Masukkan nomor Virtual Account untuk melanjutkan.';


    const tombol =
        document.getElementById('tombolBank');


    tombol.disabled = true;

    tombol.classList.remove(
        'bg-[#17324D]',
        'hover:bg-[#F4EFE6]',
        'hover:text-[#17324D]',
        'cursor-pointer'
    );

    tombol.classList.add(
        'bg-gray-400',
        'cursor-not-allowed'
    );

    tombol.innerText =
        'Masukkan Nomor VA';


    nomorVA.focus();

}



/*
|--------------------------------------------------------------------------
| DETEKSI NOMOR VA OTOMATIS
|--------------------------------------------------------------------------
*/

function deteksiVA() {

    const input =
        document
            .getElementById('nomorVA')
            .value
            .trim();


    const status =
        document
            .getElementById('statusVA');


    const tombol =
        document
            .getElementById('tombolBank');


    /*
    | Belum ada nomor
    */

    if (input === '') {

        status.innerHTML =
            'Masukkan nomor Virtual Account.';

        status.className =
            'text-sm mt-3 text-gray-600';


        tombol.disabled = true;

        tombol.classList.remove(
            'bg-[#17324D]',
            'hover:bg-[#F4EFE6]',
            'hover:text-[#17324D]',
            'cursor-pointer'
        );

        tombol.classList.add(
            'bg-gray-400',
            'cursor-not-allowed'
        );

        tombol.innerText =
            'Masukkan Nomor VA';

        return;
    }


    /*
    | Cari VA
    */

    const bankDitemukan =
        daftarBank.find(function(bank) {

            return bank.va === input;

        });


    /*
    | VA cocok
    */

    if (bankDitemukan) {

        bankAktif = bankDitemukan;


        document
            .getElementById('namaBank')
            .innerText =
            bankDitemukan.nama;


        status.innerHTML =
            '✓ Nomor VA cocok dengan Bank ' +
            bankDitemukan.nama;


        status.className =
            'text-sm mt-3 text-green-700 font-semibold';


        tombol.disabled = false;


        tombol.classList.remove(
            'bg-gray-400',
            'cursor-not-allowed'
        );


        tombol.classList.add(
            'bg-[#17324D]',
            'hover:bg-[#F4EFE6]',
            'hover:text-[#17324D]',
            'cursor-pointer'
        );


        tombol.innerText =
            'Lanjut ke Bank ' +
            bankDitemukan.nama;


        return;
    }


    /*
    | VA tidak cocok
    */

    status.innerHTML =
        '✕ Nomor VA tidak ditemukan.';

    status.className =
        'text-sm mt-3 text-red-600 font-semibold';


    tombol.disabled = true;


    tombol.classList.remove(
        'bg-[#17324D]',
        'hover:bg-[#F4EFE6]',
        'hover:text-[#17324D]',
        'cursor-pointer'
    );


    tombol.classList.add(
        'bg-gray-400',
        'cursor-not-allowed'
    );


    tombol.innerText =
        'Nomor VA Tidak Cocok';

}



/*
|--------------------------------------------------------------------------
| SALIN VA
|--------------------------------------------------------------------------
*/

function salinVA() {

    if (!bankAktif) {

        return;
    }


    const nomorVA =
        bankAktif.va;


    navigator.clipboard
        .writeText(nomorVA)
        .then(function() {

            document
                .getElementById('nomorVA')
                .value = nomorVA;


            deteksiVA();


            alert(
                'Nomor Virtual Account berhasil disalin.'
            );

        });

}



/*
|--------------------------------------------------------------------------
| LANJUT KE BANK
|--------------------------------------------------------------------------
*/

function lanjutKeBank() {

    if (!bankAktif) {

        alert(
            'Silakan pilih bank terlebih dahulu.'
        );

        return;
    }


    const nomorVA =
        document
            .getElementById('nomorVA')
            .value
            .trim();


    if (nomorVA !== bankAktif.va) {

        alert(
            'Nomor Virtual Account tidak sesuai dengan bank yang dipilih.'
        );

        return;
    }


    /*
    | Buka website bank yang dipilih.
    | Ini merupakan simulasi.
    */

    window.open(
        bankAktif.url,
        '_blank'
    );

}



/*
|--------------------------------------------------------------------------
| TIMER QRIS
|--------------------------------------------------------------------------
*/

@if ($metode === 'qris' && $qrisExpiredAt)

const expiredAt =
    {{ $qrisExpiredAt * 1000 }};


const timerElement =
    document.getElementById('timer');


const qrisContainer =
    document.getElementById('qrisContainer');


const qrisExpired =
    document.getElementById('qrisExpired');


const uploadSection =
    document.getElementById('uploadSection');


function updateTimer() {

    const sekarang =
        new Date().getTime();


    const selisih =
        expiredAt - sekarang;


    if (selisih <= 0) {

        timerElement.innerHTML =
            '00:00';


        qrisContainer
            .classList
            .add('hidden');


        uploadSection
            .classList
            .add('hidden');


        qrisExpired
            .classList
            .remove('hidden');


        return;
    }


    const menit =
        Math.floor(
            selisih / 1000 / 60
        );


    const detik =
        Math.floor(
            (selisih / 1000) % 60
        );


    timerElement.innerHTML =
        String(menit).padStart(2, '0')
        +
        ':'
        +
        String(detik).padStart(2, '0');

}


updateTimer();

setInterval(
    updateTimer,
    1000
);

@endif

</script>


</body>

</html>