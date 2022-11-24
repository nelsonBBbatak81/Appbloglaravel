<div>

    <input id="content" type="hidden" name="content" value="{{ $content }}">
    <trix-editor input="content"></trix-editor>

</div>

@push('scripts')
<script>
    var trixEditor = document.getElementById("content")

    addEventListener("trix-blur", function(event) {
        @this.set('content', trixEditor.getAttribute('content'))
    })
</script>
@endpush
