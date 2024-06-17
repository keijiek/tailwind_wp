    <!-- Sidebar -->
    <nav
      class="absolute transform transition duration-300 inset-0 lg:relative z-10 w-80 bg-blue-900 text-gray-50 h-screen p-4"
      :class="{'-translate-x-full opacity-0':isOpen === false, 'translate-x-0 opacity-100': isOpen === true}"
    >
      <div class="flex justify-between">
        <span class="font-bold text-2xl sm:text-3xl">Sidebar</span>
        <button class="p-2 rounded hover:bg-blue-800" @click="isOpen = false">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
          </svg>
        </button>
      </div>
      <ul class="mt-4 flex flex-col space-y-2">
        <li class="hover:bg-blue-800 rounded p-2 text-lg cursor-pointer transition duration-200">
          <a href="#">Home</a>
        </li>
        <li class="hover:bg-blue-800 rounded p-2 text-lg cursor-pointer transition duration-200">
          <a href="#">About</a>
        </li>
        <li class="hover:bg-blue-800 rounded p-2 text-lg cursor-pointer transition duration-200">
          <a href="#">Products</a>
        </li>
        <li class="hover:bg-blue-800 rounded p-2 text-lg cursor-pointer transition duration-200">
          <a href="#">Pricing</a>
        </li>
        <li class="hover:bg-blue-800 rounded p-2 text-lg cursor-pointer transition duration-200">
          <a href="#">Contact</a>
        </li>
      </ul>
    </nav>
