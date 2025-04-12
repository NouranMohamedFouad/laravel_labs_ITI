<x-layout>

    <form action="{{ route('comments.update', $comment->id) }}" method="POST" class="max-w-lg mx-auto p-4 bg-white shadow-md rounded-lg">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="comment" class="block text-sm font-semibold text-gray-700">Edit Comment</label>
            <textarea name="comment" id="comment" rows="4" class="w-full p-3 mt-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none" required>{{ $comment->body }}</textarea>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none">Update Comment</button>
        </div>
    </form>
    
</x-layout>

