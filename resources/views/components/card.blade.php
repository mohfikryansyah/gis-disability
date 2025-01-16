<div class="overflow-hidden">
    <div class="h-[25rem] rounded-lg overflow-hidden">
        <img src="{{ $src }}" class="object-cover h-full w-full hover:scale-105 transition duration-300" alt="">
    </div>
    <div class="h-auto pt-3">
        <h1 class="text-slate-900 font-medium text-2xl line-clamp-1">{{ $title }}</h1>
        <p class="text-gray-500 mt-2 line-clamp-2">{{ $address }}</p>
    </div>
</div>