{{-- <form class="flex flex-col md:flex-row gap-3">
    <div class="flex">
        <input type="text" placeholder="{{ $searchDomain }}"
            class="w-full md:w-80 px-3 h-10 rounded-l border-2 border-gray-500 focus:outline-none focus:border-gray-700">
        <button type="submit"
            class="bg-gray-500 text-white rounded-r px-2 md:px-3 py-0 md:py-1 hover:bg-gray-700">Search</button>
    </div>
    <select id="pricingType" name="pricingType"
        class="w-full h-10 border-2 border-gray-500 focus:outline-none focus:border-gray-700 text-gray-700 rounded px-2 md:px-3 py-0 md:py-1 tracking-wider">
        <option value="All" selected="">All</option>
        <option value="admin">Admin</option>
        <option value="staff">Staff</option>
        <option value="customer">Customer</option>
        <option value="supplier">Supplier</option>
    </select>
</form> --}}


<label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
<div class="relative">
  <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
    </svg>
  </div>
  <form action="" method="GET">
    <input type="search" id="default-search" name="search" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{ $placeholder ?? '' }}" value="{{ $value }}">
    <button type="submit" class=" text-white absolute right-2.5 bottom-2.5 bg-gray-700 hover:bg-gray-800 focus:ring-4  focus:border-purple-500 font-medium rounded-lg text-sm px-4 py-2">Search</button>
  </form>
</div>