<div class="">
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Forum') }}
        </h2>
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Home') }}
        </h2>
    </x-slot>
    <div class="flex flex-row transition-all">
        <x-sidenav :tags="$tags" />
        <div class="flex flex-col w-full text-white divide-y-2 md:flex-row divide-slate-300 md:divide-x-0">
            <div class="flex flex-col w-full gap-4 p-4 px-0">
                <div class="flex flex-col w-full gap-4 mx-auto transition-all md:w-1/2 md:rounded-lg">

                    @if ($filter)
                        {{-- {{ dd($filterTag) }} --}}
                        <div class="text-gray-800">
                            <div class="flex justify-between w-full">

                                <div class="flex flex-row w-full">
                                    <btn class="my-auto" wire:click="updateTagShow({{ $filterTag->id }})">
                                        <x-icons.pencil />
                                    </btn>
                                    <h1 class="my-auto text-2xl font-extrabold leading-snug">
                                        {{ $filterTag->title }}
                                    </h1>
                                </div>
                                <button class="px-1 bg-indigo-400 rounded" wire:click="resetAll">
                                    Reset Filter
                                </button>
                            </div>
                            <p>
                                {{ $filterTag->desc }}
                            </p>
                        </div>
                        @foreach ($filterThread as $thread)
                            <x-post-card :data="$thread" />
                        @endforeach
                    @else
                        @foreach ($threads as $thread)
                            <x-post-card :data="$thread" />
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>


    {{-- MODAL THREAD --}}
    <x-jet-dialog-modal wire:model="ThreadModalStatus">
        <x-slot name="title">
            <h1>Create a new question.</h1>
        </x-slot>
        <x-slot name="content">
            <!-- Title -->
            <div class="col-span-6 mb-4 sm:col-span-4">
                <x-jet-label for="threadContent" value="{{ __('Select Tag') }}" />
                <div class="flex flex-row">
                    <select wire:model="threadTag"
                        class=" bg-gray-50 border  border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5 ">
                        <option>Select Tag</option>
                        @foreach ($tags as $tag)
                            <option value="{{ $tag->id }}">{{ $tag->title }}</option>
                        @endforeach
                    </select>
                    <x-jet-button class="ml-4" wire:click="$toggle('TagModalStatus')">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                        </svg>
                    </x-jet-button>
                </div>
            </div>
            <div class="col-span-6 mb-4 sm:col-span-4">
                <x-jet-label for="threadTitle" value="{{ __('Title') }}" />
                <x-jet-input wire:model="threadTitle" type="text" class="block w-full mt-1" autofocus required />
                <x-jet-input-error for="threadTitle" class="mt-2" />
            </div>
            <div class="col-span-6 mb-4 sm:col-span-4">
                <x-jet-label for="threadContent" value="{{ __('Description') }}" />
                <x-textarea wire:model="threadContent" type="text" class="block w-full mt-1" required />
                <x-jet-input-error for="threadContent" class="mt-2" />
            </div>
            <div class="col-span-6 mb-4 sm:col-span-4">
                <x-jet-label for="threadAttachment" value="{{ __('Description') }}" />
                <x-jet-input wire:model="threadAttachment" type="file" class="block w-full mt-1" accept="image/*"
                    required />
                <x-jet-input-error for="threadAttachment" class="mt-2" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <div class="flex flex-row justify-between w-full">
                @if ($threadId)
                    <x-jet-secondary-button class="content-start" class="text-white bg-red-600"
                        wire:click="$toggle('DeleteThreadModalStatus')" wire:loading.attr="disabled">
                        {{ __('Delete') }}
                    </x-jet-secondary-button>
                @else
                    <span> be courious </span>
                @endif
                <div>

                    <x-jet-secondary-button wire:click="resetAll" wire:loading.attr="disabled">
                        {{ __('Cancel') }}
                    </x-jet-secondary-button>

                    <x-jet-button class="" wire:click="saveThread" wire:loading.attr="disabled">
                        Submit
                    </x-jet-button>

                </div>
            </div>
        </x-slot>
    </x-jet-dialog-modal>

    {{-- MODAL TAG --}}

    <x-jet-dialog-modal wire:model="TagModalStatus">
        <x-slot name="title">
            <h1>Create a new tag.</h1>
        </x-slot>

        <x-slot name="content">
            <!-- Title -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="tagTitle" value="{{ __('Title') }}" />
                <x-jet-input wire:model="tagTitle" type="text" class="block w-full mt-1" autofocus required />
                <x-jet-input-error for="tagTitle" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="tagDesc" value="{{ __('Description') }}" />
                <x-textarea wire:model="tagDesc" type="text" class="block w-full mt-1" required />
                <x-jet-input-error for="tagDesc" class="mt-2" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <div class="flex flex-row justify-between w-full">
                @if ($tagId)
                    <x-jet-secondary-button class="content-start" class="text-white bg-red-600"
                        wire:click="$toggle('DeleteTagModalStatus')" wire:loading.attr="disabled">
                        {{ __('Delete') }}
                    </x-jet-secondary-button>
                @else
                    <span> be courious </span>
                @endif
                <div>
                    <x-jet-secondary-button wire:click="$toggle('TagModalStatus')" wire:loading.attr="disabled">
                        {{ __('Cancel') }}
                    </x-jet-secondary-button>

                    <x-jet-button class="" wire:click="saveTag" wire:loading.attr="disabled">
                        Submit
                    </x-jet-button>
                </div>
            </div>
        </x-slot>

    </x-jet-dialog-modal>

    {{-- MODAL REPLY --}}

    <x-jet-dialog-modal wire:model="ReplyModalStatus">
        <x-slot name="title">
            <h1>Post a reply.</h1>
        </x-slot>

        <x-slot name="content">
            <!-- Title -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="replyTitle" value="{{ __('Title') }}" />
                <x-jet-input wire:model="replyTitle" type="text" class="block w-full mt-1" autofocus />
                <x-jet-input-error for="replyTitle" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="replyContent" value="{{ __('Description') }}" />
                <x-textarea type="text" wire:model="replyContent" class="block w-full mt-1" />
                <x-jet-input-error for="replyContent" class="mt-2" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <div class="flex flex-row justify-between w-full">
                @if ($replyId)
                    <x-jet-secondary-button class="content-start" class="text-white bg-red-600"
                        wire:click="$toggle('DeleteReplyModalStatus')" wire:loading.attr="disabled">
                        {{ __('Delete') }}
                    </x-jet-secondary-button>
                @else
                    <span> be courious </span>
                @endif
                <div>
                    <x-jet-secondary-button wire:click="$toggle('ReplyModalStatus')" wire:loading.attr="disabled">
                        {{ __('Cancel') }}
                    </x-jet-secondary-button>

                    <x-jet-button class="" wire:click="saveReply" wire:loading.attr="disabled">
                        Submit
                    </x-jet-button>
                </div>
            </div>
        </x-slot>

    </x-jet-dialog-modal>

    {{-- The Delete Modal --}}

    <x-jet-dialog-modal wire:model="DeleteThreadModalStatus">
        <x-slot name="title">
            {{ __('Delete Page') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete this thread? Once the thread is deleted, all of its resources and data will be permanently deleted.') }}
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('DeleteThreadModalStatus')" wire:loading.attr="disabled">
                {{ __('Nevermind') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-2" wire:click="deleteThread" wire:loading.attr="disabled">
                {{ __('Delete Thread') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>

    <x-jet-dialog-modal wire:model="DeleteReplyModalStatus">
        <x-slot name="title">
            {{ __('Delete Reply') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete this reply? Once the reply is deleted, all of its resources and data will be permanently deleted.') }}
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('DeleteReplyModalStatus')" wire:loading.attr="disabled">
                {{ __('Nevermind') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-2" wire:click="deleteReply" wire:loading.attr="disabled">
                {{ __('Delete Reply') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>

    <x-jet-dialog-modal wire:model="DeleteTagModalStatus">
        <x-slot name="title">
            {{ __('Delete Reply') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete this tag? Once the tag is deleted, all of its resources and data will be permanently deleted.') }}
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('DeleteTagModalStatus')" wire:loading.attr="disabled">
                {{ __('Nevermind') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-2" wire:click="deleteTag" wire:loading.attr="disabled">
                {{ __('Delete Reply') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
