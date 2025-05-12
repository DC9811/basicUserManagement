<!doctype html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://unpkg.com/flowbite@latest/dist/flowbite.min.js"></script>
    <link href="https://unpkg.com/flowbite@latest/dist/flowbite.min.css" rel="stylesheet" />
  </head>
  <body>
    <div class="h-screen bg-gray-100 p-8">
        <div class="h-full w-full bg-white shadow-lg rounded-lg p-6">
            <nav class="flex justify-between items-center border-b pb-4 mb-6">
                <div class="text-xl font-semibold text-gray-800">
                    Laravel Lumen App
                </div>
                <ul class="flex space-x-6 text-gray-600">
                    <li>
                        <a href="{{route('logoutUser')}}" class="hover:text-black">
                            <button class="bg-red-500 text-white px-8 py-2 rounded hover:bg-red-700 flex items-center space-x-2">
                                <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12H4m12 0-4 4m4-4-4-4m3-4h2a3 3 0 0 1 3 3v10a3 3 0 0 1-3 3h-2"/>
                                </svg>
                                <span>Logout</span>
                            </button>
                        </a>
                    </li>
                </ul>
            </nav>
            @yield('content')
        </div>
    </div>
  </body>
</html>