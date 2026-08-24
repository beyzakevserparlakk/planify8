@extends('admin.layouts.app')

@section('title', 'Sliderı Düzenle')
@section('page_title', 'Slider Düzenle: ' . $slider->title)

@section('content')
<div class="max-w-2xl mx-auto space-y-6">

    <div class="flex items-center justify-between">
        <a href="{{ route('admin.sliders.index') }}" class="text-xs font-bold text-gray-400 hover:text-white flex items-center gap-1.5">
            &larr; Slider Listesine Dön
        </a>
    </div>

    <div class="bg-[#16181e] p-8 rounded-3xl border border-gray-800 shadow-xl">
        <form action="{{ route('admin.sliders.update', $slider->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-xs font-black uppercase tracking-wider text-gray-300 mb-2">Slider Başlığı *</label>
                <input type="text" name="title" value="{{ old('title', $slider->title) }}" required
                       class="w-full bg-white/5 border border-gray-700 rounded-xl px-4 py-3 text-xs text-white placeholder-gray-500 focus:outline-none focus:border-[#ff5528]">
                @error('title') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-xs font-black uppercase tracking-wider text-gray-300 mb-2">Afiş / Slider Görseli</label>
                @if($slider->image)
                    <div class="mb-3">
                        <img src="{{ asset('storage/' . $slider->image) }}" class="h-28 w-48 rounded-xl object-cover border border-gray-700" alt="Mevcut Görsel">
                    </div>
                @endif
                <input type="file" name="image" accept="image/*"
                       class="w-full bg-white/5 border border-gray-700 rounded-xl px-4 py-3 text-xs text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-black file:bg-[#ff5528] file:text-white hover:file:bg-black">
                @error('image') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-xs font-black uppercase tracking-wider text-gray-300 mb-2">Yönlendirme Linki (Opsiyonel)</label>
                <input type="text" name="link" value="{{ old('link', $slider->link) }}" placeholder="Örn: /etkinlikler veya https://..."
                       class="w-full bg-white/5 border border-gray-700 rounded-xl px-4 py-3 text-xs text-white placeholder-gray-500 focus:outline-none focus:border-[#ff5528]">
            </div>

            <div class="grid grid-cols-2 gap-4 items-center">
                <div>
                    <label class="block text-xs font-black uppercase tracking-wider text-gray-300 mb-2">Görüntülenme Sırası</label>
                    <input type="number" name="order" value="{{ old('order', $slider->order) }}" min="0"
                           class="w-full bg-white/5 border border-gray-700 rounded-xl px-4 py-3 text-xs text-white focus:outline-none focus:border-[#ff5528]">
                </div>

                <div class="pt-6">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $slider->is_active) ? 'checked' : '' }} class="w-4 h-4 rounded accent-[#ff5528]">
                        <span class="text-xs font-bold text-gray-300">Aktif Olarak Yayınla</span>
                    </label>
                </div>
            </div>

            <div class="pt-4 flex items-center justify-end gap-3 border-t border-gray-800">
                <a href="{{ route('admin.sliders.index') }}" class="px-6 py-3 rounded-xl bg-white/5 text-gray-300 hover:text-white text-xs font-bold">İptal</a>
                <button type="submit" class="px-8 py-3 rounded-xl bg-[#ff5528] hover:bg-white hover:text-black text-white text-xs font-black uppercase tracking-wider transition shadow-lg shadow-[#ff5528]/25">
                    Değişiklikleri Kaydet
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
