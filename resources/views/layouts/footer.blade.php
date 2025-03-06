<script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>
<script>
 ClassicEditor.create(document.querySelector('#content'))
 .then( editor => {
        editor.editing.view.change( writer => {
            writer.setStyle('height', '200px', editor.editing.view.document.getRoot());
        })
    })
 .catch(error => {
    console.error(error);
 });
</script>
</body>
</html>
