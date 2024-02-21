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
                <div class="flex justify-between items-center py-4 max-sm:px-3">
                    <div>
                        <a href="{{route('home')}}">
                            <h1
                                class="text-2xl font-bold  bg-gradient-to-r from-purple-600 via-blue-500 to-cyan-400 text-transparent max-w-fit bg-clip-text">
                                DevLinks</h1>
                        </a>
                    </div>
                    <div>
                        <a href="{{route('filament.admin.auth.login')}}"
                            class="text-white font-bold hover:bg-gradient-to-r hover:from-purple-600 hover:via-blue-500 hover:to-cyan-400 hover:text-transparent hover:bg-clip-text hover:transition-all hover:duration-300">Login</a>
                        <a href="{{route('filament.admin.auth.register')}}"
                            class="text-white font-bold ml-7 hover:bg-gradient-to-r hover:from-purple-600 hover:via-blue-500 hover:to-cyan-400 hover:text-transparent hover:bg-clip-text hover:transition-all hover:duration-300">Register</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-gradient-to-r from-purple-600 via-blue-500 to-cyan-400">
            <div class="flex justify-center items-center h-96">
                <div class="text-center">
                    <h1 class="text-4xl font-bold text-white">Bem vindo ao DevLinks</h1>
                    <p class="text-white text-2xl font-medium mt-4">Um lugar para compartilhar seus links com o mundo!
                    </p>
                    <a href="{{route('filament.admin.auth.register')}}"
                        class="bg-white bg-opacity-30 hover:bg-opacity-15 text-white font-bold px-6 py-2 rounded-full inline-block mt-4 shadow-lg border-4">Começar</a>
                </div>
            </div>
        </div>

        <div class="container mx-auto py-16">
            <div class="grid grid-cols-3 gap-4 text-white max-sm:grid max-sm:grid-cols-1 max-sm:px-3">
                <div class="bg-gradient-to-r from-purple-600 via-blue-500 to-cyan-400 p-4 rounded-lg shadow-lg ">
                    <h3 class="text-xl font-bold">Cadastre-se</h3>
                    <p class="mt-2">Após se cadastrar na nossa base você já pode começar a montar sua página.</p>
                </div>
                <div class="bg-gradient-to-r from-purple-600 via-blue-500 to-cyan-400 p-4 rounded-lg shadow-lg">
                    <h3 class="text-xl font-bold">Personalize sua página</h3>
                    <p class="mt-2">Você pode escolher as cores que desejar, adicionar seu avatar e muito mais.</p>
                </div>
                <div class="bg-gradient-to-r from-purple-600 via-blue-500 to-cyan-400 p-4 rounded-lg shadow-lg">
                    <h3 class="text-xl font-bold">Adicione seus links</h3>
                    <p class="mt-2">Temos dois tipos de links para você personalizar com os links que desejar.</p>
                </div>
            </div>
        </div>
        <div class="container mx-auto pb-16">
            <div
                class="flex flex-row justify-between max-sm:flex max-sm:flex-col max-sm:px-3 max-sm:gap-3 sm:flex sm:flex-col sm:gap-3 lg:flex lg:flex-row">
                <div class="max-w-[500px] sm:max-w-full">
                    <h2 class="text-3xl font-bold text-white">Como funciona?</h2>
                    <p class="text-white mt-4 lg:w-96 xl:w-[500px]">Para começar a usar o DevLinks é muito simples,
                        basta se cadastrar e começar a montar sua página. Lá você pode adicionar suas informações,
                        escolher as cores da sua página, adicionar seus links.
                        Além disso, você pode adicionar um avatar e uma bio para que as pessoas possam te conhecer
                        melhor.
                    </p>
                    </p>
                    <p class="text-white mt-4 lg:w-96 xl:w-[500px]">E pronto! Você já tem sua página pronta para ser
                        compartilhada com o mundo. Você pode compartilhar o link da sua página em suas redes sociais,
                        currículo, cartão de visitas e muito mais.
                    </p>
                </div>
                <img src="{{asset('/images/dev_page.png')}}" alt=""
                    class="max-h-[400px] xl:h-[400px] lg:h-[300px] rounded-xl">
            </div>
        </div>
        <footer>
            <div class="bg-gray-100  text-white py-8">
                <div class="container mx-auto">
                    <div class="flex flex-row justify-center space-x-4 pb-10">
                        <a href="https://github.com/AdryanneKelly" target="_blank"
                            class="text-white hover:text-gray-300">
                            <img src="{{ asset('images/github-icon.svg') }}" alt="" class="max-w-9">
                        </a>
                        <a href="https://www.linkedin.com/in/adryanne-kelly/" target="_blank"
                            class="text-white hover:text-gray-300">
                            <img src="{{ asset('images/linkedin-icon.svg') }}" alt="" class="max-w-9">
                        </a>
                        <a href="https://www.instagram.com/drysilva____/" target="_blank"
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