<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Elonlar') }}
        </h2>
    </x-slot>
    <div class="title">
        <div class="min-h-screen bg-gray-100 flex items-center justify-center p-2">
            <div class="max-w-md w-full bg-white rounded-xl shadow-lg p-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6 text-center">E'lon yaratish</h2>

                <form class="space-y-4" method="POST" enctype="multipart/form-data" action="{{ route('posts.store') }}">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                        <input type="text" name="title"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all"
                            placeholder="Samsung S 25 ultra" />
                        @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <label for="">Shaxar
                        <select name="region_id" id="" class="w-full m-1 rounded">
                            @foreach ($regions as $region)
                                <option value="{{ $region->id }}"><strong>{{ $region->name }}</strong></option>
                            @endforeach
                        </select>
                        @error('region_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </label>
                    <label for="">Category
                        <select name="category_id" id="" class="w-full m-1 rounded">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </label>
                    <label for="">Taglar
                        <select name="tags[]" id="" class="w-full m-1 rounded" multiple>
                            @foreach ($tags as $tag)
                                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                            @endforeach
                        </select>
                    </label>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Content</label>
                        <input type="text" name="content"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all"
                            placeholder="apple max pro" />
                        @error('content')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Image</label>
                        <input type="file" name="image"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all" />
                        @error('image')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Price</label>
                        <input type="number" name="price"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all"
                            placeholder="300" />
                        @error('price')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button
                        class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2.5 rounded-lg transition-colors"
                        type="submit">
                        Create
                    </button>
                </form>


            </div>
        </div>
    </div>
</x-app-layout>
