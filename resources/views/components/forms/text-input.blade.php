@props([
    'type' => 'text',
    'isInvalid' => false
])

<input {{ $attributes->class(['is-invalid' => $isInvalid, 'form-control']) }}>
