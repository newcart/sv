<div id="vueForm" class="row" style="opacity: 0">
    <form method="POST" class="text-start"  v-on:submit.prevent="onSubmit">
        @csrf
        <x-forms.input type="text" label="Code" name="store_code" class="" value="" required autofocus />
        <x-forms.input type="text" label="Name" name="store_name" class="" value="" required autofocus />
        <x-forms.input type="email" label="Email" name="email" class="" value="" required />
        <x-forms.input type="phone" label="Mobile" name="mobile" class="" value="" />
        <x-forms.input type="phone" label="Telefon" name="telephone" class="" value="" />
        <x-forms.input type="text" label="Logo" name="image" class="" value="" />
        <x-forms.input type="text" label="tax_number" name="tax_number" class="" value="" />
        <x-forms.input type="text" label="tax_office" name="tax_office" class="" value="" />
        <x-forms.input type="text" label="address" name="address" class="" value="" />
        <x-forms.input type="select" label="town_id" name="town_id" class="" value="" />
        <x-forms.input type="select" label="city_id" name="city_id" class="" value="" />
        <x-forms.input type="select" label="country_id" name="country_id" class="" value="" />
        <x-forms.input type="checkbox" label="status" name="status" class="" value="1" />
        <x-forms.input type="hidden" label="" name="store_id" class="" value="" />
        <x-forms.button type="submit" class="danger" value="Save" name="save" />
        <x-item.notice />
    </form>
</div>
<script>
    panel.editForm('#vueForm', '<?=$data['apiget']?>', '<?=$data['apipost']?>');
</script>


