<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Elonlar') }}
        </h2>
    </x-slot>
    <div class="title">
        <div class="flex w-[1280px] flex-start p-2 m-auto ">
            <button type="submit" class="btn btn-primary bg-blue-400 p-3 rounded hover:underline decoration-1">
                <a href="{{ route('posts.index') }}" class="btn btn-primary ">Ortga</a>
            </button>
        </div>
        <!-- component -->
        <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden  m-3">
            <div class="flex flex-col items-center md:flex-row">
                <!-- Product Image -->
                <div class="md:w-1/3 p-4 relative">
                    <div class=" ">
                        <img src="{{ asset('storage/' . $post->image) }}" width="500px" alt="HP Victus Laptop"
                            class="w-full h-auto object-cover rounded-lg" />
                        <button class="absolute top-2 right-2 text-red-500 hover:text-red-600 focus:outline-none">
                            <svg class="w-6 h-6 absolute top-0 right-2" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                                </path>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Product Details -->
                <div class="md:w-2/3 p-6">
                    <h1 class="text-2xl font-bold text-gray-800 mb-2">{{ $post->title }}</h1>
                    <p class="text-sm text-gray-600 mb-4">{{ $post->content }}</p>

                    <div class="flex items-center mb-4">
                        <span class="bg-green-500 text-white text-sm font-semibold px-2.5 py-0.5 rounded">4.5 ★</span>
                        <span class="text-sm text-gray-500 ml-2">{{ $post->view_count }} reviews</span>
                    </div>
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <span class="text-3xl font-bold text-gray-900">{{ $post->price * 0.9 }}</span>
                            <span class="ml-2 text-sm font-medium text-gray-500 line-through">{{ $post->price }}</span>
                        </div>
                        <span class="bg-red-100 text-red-800 text-xs font-semibold px-2.5 py-0.5 rounded">Save
                            10%</span>
                    </div>

                    <p class="text-green-600 text-sm font-semibold mb-4">Free Delivery</p>
                    @if (auth()->user()->id == $post->user_id)
                    <div class="flex">
                        <a class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-300" href="{{ route('posts.edit', ['post' => $post->id]) }}">Postni
                            o'zgartirish</a>
                        <form action="{{ route('posts.destroy', ['post' => $post->id]) }}" method="post"
                            class="mx-2" onsubmit="return confirm('postni o\'chirishga ishonchingiz komilmi?')">
                            @method('delete')
                            @csrf<button type="submit" class="flex-1 bg-red-400 hover:bg-red-700  text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-300">O'chirish</button>
                        </form>
                    </div>
                    @else
                        <div class="flex space-x-4">
                            <button
                                class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-300">
                                Buy Now
                            </button>
                            <button
                                class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-300">
                                Add to Cart
                            </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
