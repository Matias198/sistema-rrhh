@props([
    'theme' => '',
    'inline' => null,
    'filter' => null,
    'column' => '',
])

@php
    $fieldClassName = data_get($filter, 'className');

    $field = data_get($filter, 'field');

    $componentAttributes = (array) data_get($filter, 'attributes');

    $defaultAttributes = $fieldClassName::getWireAttributes($field, array_merge($filter, (array)$column));

    $filterClasses = Arr::toCssClasses([theme_style($theme, 'filterNumber.input')]);

    $placeholder = data_get($filter, 'placeholder');

    $params = array_merge([...data_get($filter, 'attributes'), ...$defaultAttributes, $filterClasses], $filter);
@endphp

@if ($params['component'])
    @unset($params['attributes'])

    <x-dynamic-component
        :component="$params['component']"
        :attributes="new \Illuminate\View\ComponentAttributeBag($params)"
    />
@else
    <div
        class="{{ theme_style($theme, 'filterNumber.base') }}"
    >
        <div>
            <input
                {{ $defaultAttributes['inputStartAttributes'] }}
                @if ($inline) style="{{ data_get($column, 'headerStyle') }}" @endif
                type="text"
                class="{{ $filterClasses }}"
                placeholder="{{ $placeholder['min'] ?? __('Min') }}"
            >
        </div>
        <div class="mt-1">
            <input
                {{ $defaultAttributes['inputEndAttributes'] }}
                @if ($inline) style="{{ data_get($column, 'headerStyle') }}" @endif
                type="text"
                class="{{ $filterClasses }}"
                placeholder="{{ $placeholder['max'] ?? __('Max') }}"
            >
        </div>
    </div>
@endif
