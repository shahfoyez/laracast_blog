@auth
<x-panel>
    <form action="/posts/{{ $post->slug }}/comments" method="POST">
        @csrf
        <header class="flex items-center">
            <img
                src="https://i.pravatar.cc/60?u={{ auth()->id() }}"
                width="30"
                height="60"
                class="rounded-full"/>
            <h2
                class="ml-4">
                Want to Participate?
            </h2>
        </header>
        <div class="mt-6">
            <textarea
                name="body"
                class="w-full text-sm focus:outline-none focus:ring"
                rows="5"
                placeholder="Write here"
                required></textarea>
            @error('body')
                <span class="text-xs text-red-500">{{ $message }}</span>
            @enderror
        </div>
        <x-submit-button>Post</x-submit-button>
    </form>
</x-panel>
@else
    <p class="font-semibold">
        <a href="/register" class="hover:underline">Register </a>or <a href="/login" class="hover:underline"> log in</a> to leave a comment.
    </p>
@endauth
