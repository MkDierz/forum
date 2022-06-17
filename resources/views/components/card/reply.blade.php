@props(['reply' => $reply])
@foreach ($reply as $r)
    <div class="flex flex-row px-5 py-2 text-indigo-800 bg-indigo-200 border-b-2 border-indigo-400 rounded-b-md">
        @if (Auth::id() == $r->user_id)
            <span>
                you replied : {{ $r->title }}
            </span>
            <button wire:click="updateReplyShow({{ $r->id }})">
                <x-icons.pencil-alt />
            </button>
        @else
            <span>
                {{ $r->User->name }} replied : {{ $r->title }}
            </span>
        @endif
    </div>
@endforeach
