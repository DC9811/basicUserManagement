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
            </nav>
            @yield('content')
        </div>
    </div>
  </body>
</html>