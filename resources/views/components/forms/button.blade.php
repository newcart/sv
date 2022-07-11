@if($type=='toast')
    <button class="btn bg-gradient-{{ $class }} w-100 mb-0 toast-btn" type="button" data-target="{{ $class }}Toast">{{ $value }}</button>
@else
    <button type="{{ $type??'button' }}" class="btn bg-gradient-{{ $class }} w-100 my-4 mb-2">{{ $value }}</button>
@endif
