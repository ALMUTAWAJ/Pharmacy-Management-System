@props(['disabled' => false])

<button type="submit" {{ $disabled ? 'disabled' : '' }}
    class="my-5 w-full text-white bg-purple-700 hover:bg-primary-700 font-medium rounded-lg text-sm px-5 py-2.5 text-center hover:bg-purple-900 active:bg-purple-700 focus:outline-none focus:ring focus:ring-purple-300 {{ $disabled ? 'opacity-60 cursor-not-allowed' : '' }}">
    {{ $slot }}
</button>
