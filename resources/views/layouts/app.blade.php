<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name')}}</title>
    <link rel="stylesheet" href="/css/main.css">
</head>
<body class="bg-gray-200">
    {{-- <header class="text-white bg-gray-900 ">
        <nav class="container mx-auto flex flex-col lg:flex-row justify-between items-center px-4 py-3">
            <div class="flex flex-col lg:flex-row items-center">
                <ul class="flex space-x-8 mt-6 lg:mt-0">
                    <li><a href="/" class="hover:text-gray-400">Home</a></li>
                </ul>
            </div>
            <div class="flex items-center mt-6 lg:mt-0">
                <div class="ml-6">
                    <a href="https://github.com/ezzamel156">
                        <img alt="@ezzamel156" src="https://avatars3.githubusercontent.com/u/19977029?s=60&amp;v=4" class="rounded-full w-8">                        
                    </a>
                </div>
            </div>
        </nav>
    </header>     --}}
    <main class="py-8">
        @yield('content')
    </main>
    <script src="/js/app.js"></script>
    @stack('scripts')
</body>
</html>