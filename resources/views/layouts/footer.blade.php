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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
