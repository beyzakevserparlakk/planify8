<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş — Planify</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen">

    <div class="w-full max-w-md p-8 bg-white rounded-2xl shadow-xl">
        <div class="text-center mb-8">
            <a href="{{ route('home') }}" class="text-3xl font-black">Plan<span class="text-[#ff5528]">ify</span></a>
            <p class="text-gray-500 text-sm mt-2 font-medium">Hesabına giriş yap</p>
        </div>

        @if($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-lg text-sm mb-6">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf
            <div>
                <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">E-posta</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus
                    class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 text-sm font-medium focus:border-[#ff5528] focus:ring-0 outline-none transition">
            </div>
            <div>
                <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Şifre</label>
                <input type="password" name="password" required
                    class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 text-sm font-medium focus:border-[#ff5528] focus:ring-0 outline-none transition">
            </div>
            <div class="flex items-center gap-2">
                <input type="checkbox" name="remember" id="remember" class="rounded accent-[#ff5528]">
                <label for="remember" class="text-sm text-gray-500">Beni hatırla</label>
            </div>
            <button type="submit"
                class="w-full bg-[#ff5528] text-white py-3 rounded-xl font-black text-sm uppercase tracking-widest hover:bg-black transition-colors">
                Giriş Yap
            </button>
        </form>

        <p class="text-center text-sm text-gray-500 mt-6">
            Hesabın yok mu?
            <a href="{{ route('register') }}" class="text-[#ff5528] font-bold hover:underline">Kayıt ol</a>
        </p>
    </div>

</body>
</html>
