@php
    $class .= " is-filled";
    if(empty($type)) $type = "text";
    if($type=='checkbox') $class .=' form-check form-switch'
@endphp
@if($type=='hidden')
    <input v-model="fields.{{ $name }}" type="{{ $type }}" name="{{ $name }}" >
@else
    <div class="input-group input-group-outline my-3 {{ $class }}">
        @if($type=='text')
            <label class="form-label">{{ $label }}</label>
            <input v-model="fields.{{ $name }}" type="{{ $type }}" name="{{ $name }}" class="form-control">
        @elseif($type=='password')
            <label class="form-label">{{ $label }}</label>
            <input v-model="fields.{{ $name }}" type="{{ $type }}" name="{{ $name }}" class="form-control">
        @elseif($type=='image')
            <label class="form-label">{{ $label }}</label>
            <input v-model="fields.{{ $name }}" type="{{ $type }}" name="{{ $name }}" class="form-control">
        @elseif($type=='checkbox')
            <input v-model="fields.{{ $name }}" class="form-check-input" type="checkbox">
            <label class="form-check-label mb-0 ms-2" for="rememberMe">{{ $label }}</label>
        @elseif($type=='textarea')
            <label class="form-label">{{ $label }}</label>
            <textarea v-model="fields.{{ $name }}" name="{{ $name }}" class="form-control" rows="10">{{ $value }}"</textarea>
        @else
            <label class="form-label">{{ $label }}</label>
            <input v-model="fields.{{ $name }}" type="{{ $type }}" name="{{ $name }}" class="form-control">
        @endif
    </div>
@endif
