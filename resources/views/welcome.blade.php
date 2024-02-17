<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>DevLinks</title>
</head>

<body class="bg-slate-900">
    <div>
        <div class="bg-gray-100">
            <div class="container mx-auto">
                <div class="flex justify-between items-center py-4">
                    <div>
                        <a href="/">
                            <h1
                                class="text-2xl font-bold  bg-gradient-to-r from-purple-600 via-blue-500 to-cyan-400 text-transparent max-w-fit bg-clip-text">
                                DevLinks</h1>
                        </a>
                    </div>
                    <div>
                        <a href="/login"
                            class="text-white font-bold hover:bg-gradient-to-r hover:from-purple-600 hover:via-blue-500 hover:to-cyan-400 hover:text-transparent hover:bg-clip-text hover:transition-all hover:duration-300">Login</a>
                        <a href="/register"
                            class="text-white font-bold ml-7 hover:bg-gradient-to-r hover:from-purple-600 hover:via-blue-500 hover:to-cyan-400 hover:text-transparent hover:bg-clip-text hover:transition-all hover:duration-300">Register</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-gradient-to-r from-purple-600 via-blue-500 to-cyan-400 ">
            <div class="flex justify-center items-center h-96">
                <div class="text-center">
                    <h1 class="text-4xl font-bold text-white">Welcome to DevLinks</h1>
                    <p class="text-white text-2xl font-medium mt-4">A place to share your links with the world</p>
                    <a href="/register"
                        class="bg-white bg-opacity-30 hover:bg-opacity-15 text-white font-bold px-6 py-2 rounded-full inline-block mt-4 shadow-lg border-4">Get
                        Started</a>
                </div>
            </div>
        </div>

        <div class="container mx-auto py-16">
            <div class="grid grid-cols-3 gap-4 text-white">
                <div class="bg-gradient-to-r from-purple-600 via-blue-500 to-cyan-400 p-4 rounded-lg shadow-lg ">
                    <h3 class="text-xl font-bold">Cadastre-se</h3>
                    <p class="mt-2">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quos.</p>
                </div>
                <div class="bg-gradient-to-r from-purple-600 via-blue-500 to-cyan-400 p-4 rounded-lg shadow-lg">
                    <h3 class="text-xl font-bold">Personalize sua página</h3>
                    <p class="mt-2">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quos.</p>
                </div>
                <div class="bg-gradient-to-r from-purple-600 via-blue-500 to-cyan-400 p-4 rounded-lg shadow-lg">
                    <h3 class="text-xl font-bold">Adicione seus links</h3>
                    <p class="mt-2">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quos.</p>
                </div>
            </div>
        </div>
        <div class="container mx-auto pb-16">
            <div class="flex flex-row justify-between">
                <div class="max-w-[500px]">
                    <h2 class="text-3xl font-bold text-white">Como funciona?</h2>
                    <p class="text-white mt-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quos.
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quos.Lorem ipsum dolor sit
                        amet consectetur adipisicing elit. Quisquam, quos.
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quos.
                    </p>
                    <p class="text-white mt-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quos.
                        Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    </p>
                </div>
                <img src="{{asset('/images/dev_page.png')}}" alt="" class="max-h-[400px] rounded-xl">
            </div>
        </div>
        <footer>
            <div class="bg-gray-100  text-white py-8">
                <div class="container mx-auto">
                    <div class="flex flex-row justify-center space-x-4 pb-10">
                        <a href="https://www.facebook.com/yourusername" target="_blank"
                            class="text-white hover:text-gray-300">
                            <img src="{{ asset('images/github-icon.svg') }}" alt="" class="max-w-9">
                        </a>
                        <a href="https://www.twitter.com/yourusername" target="_blank"
                            class="text-white hover:text-gray-300">
                            <img src="{{ asset('images/twitter-icon.svg') }}" alt="" class="max-w-9">
                        </a>
                        <a href="https://www.instagram.com/yourusername" target="_blank"
                            class="text-white hover:text-gray-300">
                            <img src="{{ asset('images/instagram-icon.svg') }}" alt="" class="max-w-9">
                        </a>
                    </div>
                </div>
                <p class="text-center">DevLinks &copy; 2024 - Developed by <b>Ackalantys Dev</b></p>
            </div>
        </footer>
    </div>
</body>

</html>