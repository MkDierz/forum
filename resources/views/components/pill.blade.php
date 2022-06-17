@props(['name' => $name])
@if ($name)
    <span class="bg-indigo-100 text-indigo-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">
        {{ $name->title }}
    </span>
@endif
