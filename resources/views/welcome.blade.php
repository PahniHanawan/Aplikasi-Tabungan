<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include('layouts.include.head')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background: linear-gradient(135deg, #e0f7fa 0%, #e0f2f1 100%);
            font-family: 'Nunito', sans-serif;
        }

        main {
            flex: 1;
        }

        .animate-fade-in {
            animation: fadeIn 2s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .animate-bounce {
            animation: bounce 2s infinite;
        }

        @keyframes bounce {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-15px);
            }
        }
    </style>
</head>

<body class="bg-gray-100">
    <header class="bg-green-600 text-white py-4 shadow-md animate-fade-in">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold">Sistem Keuangan Pesantren (project 12jt/ bulan)</h1>
            <nav>
                @if (Route::has('login'))
                <nav class="-mx-3 flex flex-1 justify-end">
                    @auth
                    <a href="{{ url('/dashboard') }}"
                        class="rounded-md px-3 py-2 text-white ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]">
                        Dashboard
                    </a>
                    @else
                    <a href="{{ route('login') }}"
                        class="rounded-md px-3 py-2 text-white ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]">
                        Log in
                    </a>

                    @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                        class="rounded-md px-3 py-2 text-white ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]">
                        Register
                    </a>
                    @endif
                    @endauth
                </nav>
                @endif
            </nav>
        </div>
    </header>

    <main class="container mx-auto mt-10 p-5 animate-fade-in">
        <div class="bg-white rounded-lg shadow-lg p-8">
            <h2 class="text-3xl font-semibold mb-5 animate-bounce">Selamat Datang di Sistem Keuangan Pesantren</h2>
            <p class="text-gray-700 mb-5">
                Sistem ini dirancang untuk membantu pengelolaan keuangan pesantren secara efisien dan transparan.
                Dengan sistem ini, Anda dapat melacak pemasukan dan pengeluaran, menghasilkan laporan keuangan, dan
                memastikan semua dana dikelola dengan baik.
            </p>
            @if (Route::has('login'))
            @else
            <div class="flex justify-center">
                <a href="{{ route('register') }}"
                    class="bg-green-600 text-white py-2 px-4 rounded hover:bg-green-700 transition transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-green-500">
                    Mulai Sekarang
                </a>
            </div>
            @endif
        </div>
    </main>

    <footer class="bg-green-600 text-white py-4 bottom animate-fade-in">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 Sistem Keuangan Pesantren. All rights reserved.</p>
        </div>
    </footer>
</body>

</html>
