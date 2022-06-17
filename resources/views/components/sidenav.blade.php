@props(['tags' => $tags])
<aside class="m-4 transition-all duration-100 w-72" aria-label="Sidebar">
    <div class="px-3 py-4 overflow-y-auto font-normal shadow-md bg-gray-50 rounded-xl hover:shadow-lg">
        <ul class="space-y-2 pointer-events-auto">
            <li>
                <a href="{{ route('forum') }}"
                    class="flex items-center w-full p-2 transition duration-75 rounded-lg shadow-md bg-gray-50 hover:shadow-lg group hover:bg-white @if (request()->routeIs('forum')) border-r-8 border-indigo-500 @endif">
                    <x-icons.home />
                    <span class="ml-3 text-sm text-left">Forum Home</span>
                </a>
            </li>
            <li>
                <button wire:click="$toggle('ThreadModalStatus')" type="button"
                    class="flex items-center w-full p-2 transition duration-75 rounded-lg shadow-md bg-gray-50 hover:shadow-lg group hover:bg-white">
                    <x-icons.plus-circle />
                    <span class="ml-3 text-sm text-left">Create new Question</span>
                </button>
            </li>
            <li>
                <button wire:click="$toggle('TagModalStatus')" type="button"
                    class="flex items-center w-full p-2 transition duration-75 rounded-lg shadow-md bg-gray-50 hover:shadow-lg group hover:bg-white">
                    <x-icons.plus-circle />
                    <span class="ml-3 text-sm text-left">Create new Tag</span>
                </button>
            </li>
            <li>
                <button type="button"
                    class="flex items-center w-full p-2 transition duration-75 rounded-lg shadow-md bg-gray-50 hover:shadow-lg group hover:bg-white"
                    aria-controls="dropdown-example " data-collapse-toggle="dropdown-example">
                    <x-icons.tags />
                    <span class="flex-1 ml-3 text-sm text-left whitespace-nowrap" sidebar-toggle-item>Tags</span>
                    <x-icons.arrow-down />
                </button>
                <ul id="dropdown-example" class="hidden py-2 space-y-2 ">
                    @foreach ($tags as $tag)
                        <li>
                            <button wire:click="filter({{ $tag->id }})"
                                class="flex items-center w-full p-2 text-sm transition duration-75 rounded-lg shadow-md pl-11 bg-gray-50 hover:shadow-lg group hover:bg-white">
                                {{ $tag->title }}
                            </button>

                        </li>
                    @endforeach
                </ul>
            </li>
        </ul>
    </div>
</aside>
