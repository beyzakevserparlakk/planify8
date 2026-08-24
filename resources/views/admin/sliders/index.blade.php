@extends('admin.layouts.app')

@section('title', 'Slider & Vitrin Yönetimi')
@section('page_title', 'Ana Sayfa Slider & Vitrin Yönetimi')

@section('content')
<div class="space-y-6">

    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-base font-black text-white">Aktif Sliderlar</h2>
            <p class="text-xs text-gray-400 font-medium">Ana sayfadaki hero vitrininde dönen afiş ve bağlantılar</p>
        </div>
        <a href="{{ route('admin.sliders.create') }}"
           class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#ff5528] hover:bg-white hover:text-black text-white text-xs font-black uppercase tracking-wider rounded-xl transition shadow-lg shadow-[#ff5528]/25">
            + Yeni Slider Ekle
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($sliders as $slider)
            <div class="bg-[#16181e] rounded-3xl overflow-hidden border border-gray-800 shadow-xl flex flex-col group">
                <div class="relative h-48 bg-gray-900 overflow-hidden">
                    <img src="{{ asset('storage/' . $slider->image) }}" alt="{{ $slider->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    <div class="absolute top-3 left-3 px-2.5 py-1 rounded-lg text-[10px] font-black uppercase tracking-wider {{ $slider->is_active ? 'bg-emerald-500 text-white' : 'bg-red-500 text-white' }}">
                        {{ $slider->is_active ? 'Aktif' : 'Pasif' }}
                    </div>
                    <div class="absolute top-3 right-3 px-2 py-1 bg-black/70 backdrop-blur-md rounded-lg text-[10px] text-gray-300 font-bold">
                        Sıra: {{ $slider->order }}
                    </div>
                </div>

                <div class="p-5 flex flex-col flex-grow">
                    <h3 class="text-sm font-black text-white mb-2 line-clamp-1">{{ $slider->title }}</h3>
                    <p class="text-xs text-gray-400 font-medium truncate mb-4">{{ $slider->link ?: 'Bağlantı linki yok' }}</p>

                    <div class="mt-auto pt-4 border-t border-gray-800 flex items-center justify-between">
                        <a href="{{ route('admin.sliders.edit', $slider->id) }}" class="text-xs font-bold text-gray-300 hover:text-white flex items-center gap-1">
                            <span>Düzenle</span>
                        </a>

                        <form action="{{ route('admin.sliders.destroy', $slider->id) }}" method="POST" onsubmit="return confirm('Bu sliderı silmek istediğinizden emin misiniz?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-xs font-bold text-red-400 hover:text-red-300">
                                Sil
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full bg-[#16181e] p-12 rounded-3xl text-center border border-gray-800 text-gray-500 text-xs">
                Henüz slider eklenmemiş. "+ Yeni Slider Ekle" butonuna basarak ilk görseli ekleyebilirsiniz.
            </div>
        @endforelse
    </div>

</div>
@endsection
