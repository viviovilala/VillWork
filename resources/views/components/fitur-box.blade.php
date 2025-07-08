<a href="{{ $route }}"
    class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition-shadow border-l-4 border-{{ $color }}-500">
    <div class="flex items-center mb-4">
        <div
            class="bg-{{ $color }}-100 text-{{ $color }}-600 w-14 h-14 rounded-full flex items-center justify-center mr-4">
            <i class="fa fa-{{ $icon }} fa-2x"></i>
        </div>
        <h3 class="text-xl font-bold">{{ $title }}</h3>
    </div>
    <p class="text-gray-600">{{ $desc }}</p>
</a>
