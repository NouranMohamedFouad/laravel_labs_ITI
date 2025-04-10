<x-layout>
    <div class="max-w-2xl mx-auto mt-10">
        <form method="POST" action="{{ route('posts.update', $post->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700">Title</label>
                <input type="text" name="title" value="{{ $post->title }}" class="w-full border border-gray-300 rounded px-3 py-2 mt-1" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Description</label>
                <textarea name="description" class="w-full border border-gray-300 rounded px-3 py-2 mt-1" required>{{ $post->description }}</textarea>
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

            <div class="flex justify-end">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Update Post
                </button>
            </div>
        </form>
    </div>
</x-layout>
