@props(['comment' => $comment, 'id' => $id])
<span wire:click="$set('replyThread', {{ $id }})">
    <button class="btn" wire:click="$toggle('ReplyModalStatus')">
        <div class="relative">
            @if (count($comment) > 0)
                <x-icons.comment-filled />
                <span class="absolute top-0 right-0 px-1 text-xs text-indigo-800 bg-white rounded-full">
                    {{ count($comment) }}
                </span>
            @else
                <x-icons.comment />
            @endif
        </div>
    </button>
</span>
