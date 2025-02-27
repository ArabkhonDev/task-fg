<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Elonlar') }}
        </h2>
    </x-slot>
    <div class="flex w-[1280px] flex-start p-2 m-auto ">
        <button type="submit" class="btn btn-primary bg-blue-400 p-3 rounded hover:underline decoration-1">
            <a href="{{ route('posts.create') }}" class="btn btn-primary ">E'lon yaratish</a>
        </button>
        <form action="{{route('posts.index')}}" method="get" class="rounded">
            @csrf
            <input type="text" name="name" placeholder="anyone searching">
            <button type="submit" class="bg-green-200 p-2">Search</button>
        </form>
    </div>
    <div class="flex w-[1280px] m-auto">
        <div class="filter w-[380px] bg-green-500 h-[400px] m-3 p-2">
            <h2>Filter Post</h2>
            <form action="#" method="GET">
                @csrf
                <label for="">Shaxar
                    <select name="region_id" id="" class="w-full m-1 rounded">
                        <option value=""></option>
                        @foreach ($regions as $region)
                            <option value="{{ $region->id }}"><strong>{{ $region->name }}</strong></option>
                        @endforeach
                    </select>
                </label>
                <label for="">Category
                    <select name="category_id" id="" class="w-full m-1 rounded">
                        <option value=""></option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </label>
                <div class="flex justify-between">
                    <input type="number" class="rounded p-2 bg-grey-100" name="min_price" placeholder="from">
                    <input type="number" class="rounded p-2 bg-grey-100" name="max_price" placeholder="to">
                </div>
                {{-- <div class="flex justify-between">
                    <button class="p-2 bg-blue-100 rounded w-full hover:bg-blue-400">so'm</button>
                    <button class="p-2 bg-blue-100 rounded w-full hover:bg-blue-400">y.e.</button>
                </div> --}}
                <button type="submit"
                    class="w-full bg-green-400 p-3 rounded hover:bg-blue-500 hover:text-white-500">Show</button>
            </form>
        </div>
        <div class="posts ml-1 m-3">
            <div class="div">
                Jami aloqador Post - <b>{{$count}}</b>
            </div>
            <div class="min-h-screen w-[900px] m-auto bg-gray-100  items-center justify-between -ml-[10px]">
                @foreach ($posts as $post)
                    <!-- component -->
                    <div
                        class=" w-[900px] bg-white flex flex-wrap justify-between rounded-xl shadow-lg overflow-hidden  transition-all mb-2">

                        <div class="p-5 flex-1 space-y-4 w-50 bg-blue-300">
                            <div>
                                <h3 class="text-xl font-bold text-gray-900">{{ $post->title }}</h3>
                                <p class="text-gray-500 mt-1">{{ $post->region->name }} - {{$post->region->address}}</p>
                                <h1 class="text-gray-500 mt-1">{{ $post->user->name }}</h1>
                            </div>

                            <div class="flex justify-between items-center">
                                <div class="space-y-1">
                                    <p class="text-2xl font-bold text-gray-900">{{ $post->price * 0.9 }}</p>
                                    <p class="text-sm text-gray-500 line-through">{{ $post->price }}</p>
                                </div>

                                <div class="items-center gap-1">
                                    <p class="text-sm text-gray-600 ml-1">{{ $post->created_at }}</p>
                                    <b class="text-sm text-gray-600 ml-1"><i class="bi bi-eye"></i>
                                        {{ $post->view_count ?? '12' }} </b>
                                </div>
                            </div>

                            <button
                                class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-3 rounded-lg transition-colors">
                                <a href="{{ route('posts.show', ['post' => $post->id]) }}">
                                    Learn more
                                </a>
                            </button>
                        </div>
                        <div class="relative flex-1  border-2">
                            <img src="{{ asset('storage/' . $post->image) }}" width="300px" alt="Product"
                                class="w-full h-52 object-cover" />
                            <span
                                class="absolute top-3 right-3 bg-red-500 text-white px-3 py-1 rounded-full text-sm font-medium">
                                News
                            </span>
                            <strong>Author</strong> {{auth()->user()->name}}
                        </div>

                    </div>
                @endforeach
            </div>
            {{-- {{ $posts->links() }} --}}
        </div>
    </div>
</x-app-layout>
