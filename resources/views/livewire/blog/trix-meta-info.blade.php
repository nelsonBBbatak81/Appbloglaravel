<div>


    <input id="metainfo" type="hidden" name="metainfo" value="{{ $metainfo }}">
    <trix-editor input="metainfo"></trix-editor>

</div>

@push('scripts')
<script>
    var trixEditor = document.getElementById("metainfo")

    addEventListener("trix-blur", function(event) {
        @this.set('metainfo', trixEditor.getAttribute('metainfo'))
    })
</script>
@endpush
