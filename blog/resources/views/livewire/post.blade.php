<div>
    <div class="max-w-4xl mx-auto py-20 prose lg:prose-xl">
        <h1>{{ $post->title }}</h1>
        <p>{!! $post->body !!}</p>

        <div class="sm:col-span-6 pt-5">
            <label for="body" class="block text-sm font-medium text-gray-700">Leave a comment</label>
            <div class="mt-1">
                <input id="body" wire:model="comment" class="shadow-sm focus:ring-indigo-500 appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
            </div>
        </div>
        <div wire:click="saveComment" class="inline-flex justify-center px-4 py-2 text-sm font-medium leading-5 text-white transition duration-150 ease-in-out bg-indigo-500 border border-transparent rounded-md hover:bg-indigo-600 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 cursor-pointer">Submit Comment</div>

        @foreach ($post->comments->sortDesc() as $comment)
        <div class="flex">
            <img class="h-10 w-10 rounded-full" src="https://www.pngitem.com/pimgs/m/421-4212341_default-avatar-svg-hd-png-download.png" alt="avatar">
            <div class="ml-4">
                <div class="flex items-center">
                    <div class="font-semibold">{{ $comment->user_id=-1 ? 'Guest': "User: $comment->user_id" }}</div>
                    <div class="text-gray-500 ml-2">{{ $comment->created_at->diffForHumans() }}</div>
                </div>
                <div class="text-gray-700 mt-2">{{ $comment->content }}</div>
            </div>
        </div>
        @endforeach
    </div>
</div>

