<footer {{ $attributes->merge(['class' => 'bg-gray-100 w-full border-t border-gray-200']) }}>
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 text-center text-gray-700">
        {{ $slot }}
    </div>
</footer>
