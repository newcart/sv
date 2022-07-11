<div id="vueForm" class="row">
    <form method="POST" class="text-start"  v-on:submit.prevent="onSubmit">
        @csrf
        <x-forms.input type="text" label="Title" name="title" class="" value="" required autofocus />
        <x-forms.input type="text" label="Slug" name="slug" class="" value="" required />
        <x-forms.input type="textarea" label="Content" name="content" class="" value="" required />
        <x-forms.input type="text" label="Image" name="image" class="" value="" required />
        <x-forms.button type="submit" class="danger" value="Save" name="submit" />
        <x-forms.input type="hidden" label="" name="id" class="" value="" />
        <x-item.notice />
    </form>
</div>
<script>
    panel.editForm('#vueForm', '<?=$data['apiget']?>', '<?=$data['apipost']?>');
</script>

