<div id="vueForm" class="row">
    <form method="POST" class="text-start"  v-on:submit.prevent="onSubmit">
        @csrf
        <x-forms.input type="text" label="Name" name="name" class="" value="" required autofocus />
        <x-forms.input type="email" label="Email" name="email" class="" value="" required />
        <x-forms.input type="password" label="Şifre" name="password" class="" value="" required />
        <x-forms.input type="hidden" label="" name="id" class="" value="" />
        <x-forms.button type="submit" class="danger" value="Save" name="save" />
        <x-item.notice />
    </form>
</div>
<script>
    panel.editForm('#vueForm', '<?=$data['apiget']?>', '<?=$data['apipost']?>');
</script>

