<div class="w-screen h-screen flex flex-col justify-center items-center"
    style="background-image: linear-gradient(to bottom left,{{$dev->primary_color}}, {{$dev->secondary_color}}, {{$dev->menu_color}}); color: {{$dev->text_color}}">
    <div class="flex flex-col justify-center items-center text-center gap-3">
        <img src="{{asset('storage/' . $dev->avatar)}}" alt="{{$dev->name}}" class="w-32 h-32 rounded-full">
        <h1 class="text-3xl font-bold">{{$dev->name}}</h1>
        <h2 class="text-xl font-bold">{{$dev->occupation}}</h2>
        <p class="max-w-[600px]">{{$dev->bio}}</p>
            <div class="flex flex-wrap gap-3 flex-col pt-5">
                @foreach ($dev->links as $link)
                <a href="{{$link->url}}" target="_blank" class="flex flex-col items-center gap-1">
                    <div class="w-[550px] h-14 flex flex-col justify-center rounded-xl font-bold border border-white"
                        style="background-color: {{$dev->menu_color}};">
                        <span class="z-10">{{$link->title}}</span>
                    </div>
                </a>
                @endforeach
            </div>
            <div class="py-10 w-full flex flex-row justify-center gap-5">
                @foreach ($dev->links as $link)
                <a href="" class="text-black">
                    <img src="{{asset('storage/' . $link->icon)}}" alt="{{$link->title}}"
                        class="w-9 h-9 fill-black text-black">
                </a>
                @endforeach
            </div>
        <div>
            <p>Copyright &copy; DevLinks 2024</p>
        </div>
    </div>

</div>