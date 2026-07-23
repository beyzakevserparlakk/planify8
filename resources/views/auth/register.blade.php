<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kayıt Ol — Planify</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen">

    <div class="w-full max-w-md p-8 bg-white rounded-2xl shadow-xl">
        <div class="text-center mb-8">
            <a href="{{ route('home') }}" class="text-3xl font-black">Plan<span class="text-[#ff5528]">ify</span></a>
            <p class="text-gray-500 text-sm mt-2 font-medium">Yeni hesap oluştur</p>
        </div>

        @if($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-lg text-sm mb-6">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf
            <div>
                <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Ad Soyad</label>
                <input type="text" name="name" value="{{ old('name') }}" required autofocus
                    class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 text-sm font-medium focus:border-[#ff5528] focus:ring-0 outline-none transition">
            </div>
            <div>
                <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">E-posta</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                    class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 text-sm font-medium focus:border-[#ff5528] focus:ring-0 outline-none transition">
            </div>
            <div>
                <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Şifre</label>
                <input type="password" name="password" required
                    class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 text-sm font-medium focus:border-[#ff5528] focus:ring-0 outline-none transition">
            </div>
            <div>
                <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">Şifre Tekrar</label>
                <input type="password" name="password_confirmation" required
                    class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 text-sm font-medium focus:border-[#ff5528] focus:ring-0 outline-none transition">
            </div>
            <button type="submit"
                class="w-full bg-[#ff5528] text-white py-3 rounded-xl font-black text-sm uppercase tracking-widest hover:bg-black transition-colors">
                Kayıt Ol
            </button>
        </form>

        <p class="text-center text-sm text-gray-500 mt-6">
            Zaten hesabın var mı?
            <a href="{{ route('login') }}" class="text-[#ff5528] font-bold hover:underline">Giriş yap</a>
        </p>
    </div>

</body>
</html>
