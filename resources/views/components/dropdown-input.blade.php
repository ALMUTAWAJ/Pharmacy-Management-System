  <button class="relative flex justify-between p-2 w-24 h-full items-center bg-white border focus:outline-none shadow text-gray-600 rounded-md focus:ring ring-gray-200 group" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    {{ $triggerText }}
    <span class="border-1 hover:bg-gray-100 rounded-md">
      <!-- Remove the SVG code here -->
    </span>
    <div class="hidden absolute group-focus:block top-full min-w-full w-max bg-white shadow-sm mt-1 rounded-md">
      <ul>
        {{ $slot }}
      </ul>
    </div>
  </button>