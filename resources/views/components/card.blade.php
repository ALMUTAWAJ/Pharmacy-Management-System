<div class="w-56 h-auto flex flex-col items-center justify-items-center max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 mt-2">
  <a href="details/{{$id}}">
      <img class="p-2 rounded-t-lg h-48" src="/products-images/{{ $image }}" alt="product image" />
  </a>
  <div class="px-5 pb-2">
    <a href="#">
      <h5 class="text-sm font-semibold h-14 tracking-tight text-gray-900 dark:text-white">{{ $name }}, {{ $description }}</h5>
    </a>
    <div class="flex items-center justify-between">
      <span class="text-lg font-bold text-gray-900 dark:text-white">{{ $price }}</span>
      <form action="{{ route('cart.add', ['product' => $id]) }}" method="POST">
        @csrf
         @if ($stock > 0) {{--ISSUE IS HERE  --}}
        <button type="submit" class="text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-800">Add to cart</button>
        @else
          <button type="submit" class="text-white bg-purple-700 cursor-not-allowed opacity-50 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-purple-600" disabled>Out of stock</button>
        @endif
      </form>
    </div>
  </div>
</div>