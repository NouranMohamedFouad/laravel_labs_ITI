<x-layout>
    <div class="max-w-3xl mx-auto space-y-6">
        <div class="bg-white rounded border border-gray-200">
            <div class="px-4 py-3 bg-gray-50 border-b border-gray-200">
                <h2 class="text-base font-medium text-gray-700">Post Info</h2>
            </div>
            <div class="px-4 py-4">
                <div class="mb-2">
                    <h3 class="text-lg font-medium text-gray-800">Title :- <span class="font-normal">{{ $post['title'] }}</span></h3>
                </div>
                <div>
                    <h3 class="text-lg font-medium text-gray-800">Description :-</h3>
                    <p class="text-gray-600">{{ $post['description'] }}.</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded border border-gray-200">
            <div class="px-4 py-3 bg-gray-50 border-b border-gray-200">
                <h2 class="text-base font-medium text-gray-700">Post Creator Info</h2>
            </div>
            <div class="px-4 py-4">
                <div class="mb-2">
                    <h3 class="text-lg font-medium text-gray-800">Name :- <span class="font-normal">{{$post['user']['name']}}</span></h3>
                </div>
                <div class="mb-2">
                    <h3 class="text-lg font-medium text-gray-800">Email :- <span class="font-normal">{{$post['user']['email']}}</span></h3>
                </div>
                <div>
                    <h3 class="text-lg font-medium text-gray-800">Created At :- 
                        <span class="font-normal">
                            {{ \Carbon\Carbon::parse($post->created_at)->format('l jS \\of F Y h:i:s A') }}
                        </span>
                    </h3>
                </div>
            </div>
        </div>

        <div class="bg-white rounded border border-gray-200">
            <div class="px-4 py-3 bg-gray-50 border-b border-gray-200">
                <h2 class="text-base font-medium text-gray-700">Comments</h2>
            </div>
            <div class="px-4 py-4 space-y-4">
                @forelse($post->comments as $comment)
                    <div class="border border-gray-100 p-4 rounded">
                        <p class="text-gray-800">{{ $comment->body }}</p>
                        <div class="flex justify-between items-center mt-2">
                            <form action="{{ route('comments.edit', $comment) }}" method="GET">
                                @csrf
                                <button type="submit" class="px-4 py-1 text-xs font-medium text-white bg-blue-600 rounded hover:bg-blue-700">
                                    Update
                                </button>
                            </form>

                            <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="mt-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="px-4 py-1 text-xs font-medium text-white bg-red-600 rounded hover:bg-red-700"
                                    onclick="return confirm('Are you sure you want to delete this comment?')">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-600">No comments yet.</p>
                @endforelse
            </div>
        </div>

        <div class="bg-white rounded border border-gray-200">
            <div class="px-4 py-3 bg-gray-50 border-b border-gray-200">
                <h2 class="text-base font-medium text-gray-700">Add a Comment</h2>
            </div>
            <div class="px-4 py-4">
                <form action="{{ route('comments.store', $post) }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label for="comment" class="block text-sm font-medium text-gray-700">Your Comment</label>
                        <textarea name="comment" id="comment" rows="4" required
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm p-2"></textarea>
                    </div>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Add Comment
                    </button>
                </form>
            </div>
        </div>

        <div class="flex justify-end">
            <a href="{{ route('posts.index') }}" class="px-4 py-2 bg-gray-600 text-white font-medium rounded hover:bg-black-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                Back to All Posts
            </a>
        </div>
    </div>
</x-layout> 