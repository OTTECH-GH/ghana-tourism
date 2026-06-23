@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-ghana-green focus:ring-ghana-green rounded-lg shadow-sm']) !!}>
