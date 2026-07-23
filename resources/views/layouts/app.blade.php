<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'MindCare') | Konsultasi Psikolog & Psikiater</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        peach: '#E8A07C',
                        olive: '#827148',
                        sage: '#A5AF79',
                        cream: '#FFEED6',
                    },
                    fontFamily: {
                        sans: ['Poppins', 'ui-sans-serif', 'system-ui'],
                    },
                },
            },
        }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Poppins', sans-serif; }</style>
</head>
<body class="bg-cream text-olive min-h-screen flex flex-col">

    <nav class="bg-olive text-cream shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <a href="{{ route('home') }}" class="flex items-center gap-2 font-semibold text-lg">
                    <span class="bg-peach text-white rounded-full w-9 h-9 flex items-center justify-center">🧠</span>
                    MindCare
                </a>
                <div class="flex items-center gap-4 text-sm">
                    @auth
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="hover:text-sage">Dashboard Admin</a>
                        @elseif(auth()->user()->isDokter())
                            <a href="{{ route('dokter.dashboard') }}" class="hover:text-sage">Dashboard Dokter</a>
                            <a href="{{ route('dokter.konsultasi.index') }}" class="hover:text-sage">Konsultasi</a>
                        @else
                            <a href="{{ route('user.dashboard') }}" class="hover:text-sage">Dashboard</a>
                            <a href="{{ route('tests.index') }}" class="hover:text-sage">Tes Kejiwaan</a>
                            <a href="{{ route('consultations.index') }}" class="hover:text-sage">Konsultasi</a>
                        @endif
                        <span class="opacity-75">|</span>
                        <span>{{ auth()->user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="bg-peach hover:bg-sage transition text-white px-3 py-1.5 rounded-lg">Keluar</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="hover:text-sage">Masuk</a>
                        <a href="{{ route('register') }}" class="bg-peach hover:bg-sage transition text-white px-4 py-1.5 rounded-lg">Daftar</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @if(session('success'))
            <div class="mb-6 bg-sage/20 border border-sage text-olive px-4 py-3 rounded-lg">
                {{ session('success') }}
            </div>
        @endif
        @if($errors->any())
            <div class="mb-6 bg-peach/20 border border-peach text-olive px-4 py-3 rounded-lg">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="bg-olive text-cream text-center text-sm py-4">
        &copy; {{ date('Y') }} MindCare — Aplikasi Konsultasi Psikologi & Kejiwaan
    </footer>
</body>
</html>
