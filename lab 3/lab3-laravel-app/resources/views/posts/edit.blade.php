<x-layout>
    <div class="max-w-2xl mx-auto mt-10">
        <form method="POST" action="{{ route('posts.update', $post->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700">Title</label>
                <input type="text" name="title" value="{{ $post->title }}" class="w-full border border-gray-300 rounded px-3 py-2 mt-1" required>
                @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Description</label>
                <textarea name="description" class="w-full border border-gray-300 rounded px-3 py-2 mt-1" required>{{ $post->description }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Posted By</label>
                <select name="post_creator" class="w-full border border-gray-300 rounded px-3 py-2 mt-1" required>

                    @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ $user->id == $post->user_id ? 'selected' : '' }}>
                                {{$user->name}}
                            </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Post Image</label>
                <input type="file" name="image" class="w-full px-4 py-2 border rounded-lg">
                @error('image')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
                
                @isset($post->image)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $post->image) }}" alt="Current post image" class="h-32">
                        <p class="text-sm text-gray-500 mt-1">Current image</p>
                    </div>
                @endisset
            </div>

            <div class="flex justify-end">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Update Post
                </button>
            </div>
        </form>
    </div>
</x-layout>
