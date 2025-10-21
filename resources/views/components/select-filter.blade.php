@props(['label', 'name', 'filterKey', 'options' => [], 'placeholder' => '-- Select ' . ucfirst(str_replace('_', ' ',
$name)) . ' --'])

<div>
    <x-label for="{{ $filterKey }}" :value="$label" />
    <select name="filter[{{ $filterKey }}]" id="{{ $filterKey }}"
        class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        <option value="">{{ $placeholder }}</option>
        @foreach($options as $value => $label)
        <option value="{{ $value }}" {{ request('filter.' . $filterKey)===(string)$value ? 'selected' : '' }}>
            {{ $label }}
        </option>
        @endforeach
    </select>
</div>