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
            <input v-model="fields.{{ $name }}" type="checkbox" name="{{ $name }}" class="form-check-input" value="{{ $value }}">
            <label class="form-check-label mb-0 ms-2" for="rememberMe">{{ $label }}</label>
        @elseif($type=='textarea')
            <label class="form-label">{{ $label }}</label>
            <textarea v-model="fields.{{ $name }}" name="{{ $name }}" class="form-control" rows="10">{{ $value }}"</textarea>
        @elseif($type=='countries')
            <label class="form-label">{{ $label }}</label>
            <select v-model="fields.{{ $name }}" name="{{ $name }}" class="form-control">
            <?php
            $cities = Hattat::get_countries();
            foreach($cities as $city_name=>$city_code){
                if($city_code==$value){
                    $selected = 'selected';
                } else {
                    $selected = '';
                }
            ?>
                <option value="{{ $city_code }}" {{ $selected }}>{{ $city_name }}</option>
            <?php } ?>
            </select>
        @elseif($type=='cities')
            <label class="form-label">{{ $label }}</label>
            <select v-model="fields.{{ $name }}" name="{{ $name }}" class="form-control">
            <?php
            $cities = Hattat::get_cities();
            foreach($cities as $city_name=>$city_code){
                if($city_code==$value){
                    $selected = 'selected';
                } else {
                    $selected = '';
                }
            ?>
                <option value="{{ $city_code }}" {{ $selected }}>{{ $city_name }}</option>
            <?php } ?>
            </select>
        @elseif($type=='towns')
            <label class="form-label">{{ $label }}</label>
            <select v-model="fields.{{ $name }}" name="{{ $name }}" class="form-control">
            <?php
            $cities = Hattat::get_towns();
            foreach($cities as $city_code=>$towns){
                foreach($towns as $town_name=>$town_code){
                    if($town_code==$value){
                        $selected = 'selected';
                    } else {
                        $selected = '';
                    }
                ?>
                <option value="{{ $town_code }}" {{ $selected }}>{{ $town_name }}</option>
                <?php
                }
            } ?>
            </select>
        @else
            <label class="form-label">{{ $label }}</label>
            <input v-model="fields.{{ $name }}" type="{{ $type }}" name="{{ $name }}" class="form-control">
        @endif
    </div>
@endif
