@props(['data' => $data])
<div>
    <div class="px-6 py-5 bg-indigo-800 rounded-b-xl md:rounded-xl">
        <div class="flex items-start">
            <!-- Card content -->
            <div class="flex-grow truncate">
                <div class="flex justify-between">
                    <span class="text-sm font-extralight">
                        {{-- {{ dd($data->reply) }} --}}
                        @if (Auth::id() == $data->user_id)
                            you
                        @else
                            {{ $data->user->name }}
                        @endif
                        asked a question on {{ $data->created_at->format('H:i d, M Y') }}
                    </span>
                    @if (Auth::id() == $data->user_id)
                        <button wire:click="updateThreadShow({{ $data->id }})">
                            <x-icons.pencil />
                        </button>
                    @endif
                </div>
                <!-- Card header -->
                <div class="items-center justify-between w-full sm:flex">
                    <h2 class="mb-1 text-2xl font-extrabold leading-snug truncate sm:mb-0">
                        {{ $data->title }}
                    </h2>
                </div>

                <x-pill :name="$data->tag" />
                <!-- Card body -->
                <div class="flex flex-row items-start justify-between whitespace-normal">
                    <!-- Paragraph -->
                    <div class="max-w-md ">
                        <p class="mb-2">
                            {{ $data->content }}
                        </p>
                    </div>
                    <x-card.comment-icon :comment="$data->reply" :id="$data->id" />
                </div>
            </div>
        </div>
    </div>
    <x-card.reply :reply="$data->reply" />
</div>
