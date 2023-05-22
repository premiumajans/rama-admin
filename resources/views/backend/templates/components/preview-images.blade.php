<script>
    $(document).ready(function () {
        $('#photos').change(function () {
            let images = $('#image-preview-container');
            images.empty();
            for (let i = 0; i < this.files.length; i++) {
                let reader = new FileReader();
                reader.onload = (e) => {
                    let div = $('<div>');
                    div.attr('class', 'd-flex');
                    div.attr('style', 'height: 150px; overflow: hidden; margin-bottom: 10px;');
                    let img = $('<img>');
                    img.attr('src', e.target.result);
                    img.attr('style', 'height: 200px;margin-right:20px; width: 200px; object-fit: cover;');
                    div.append(img);
                    images.append(div);
                }
                reader.readAsDataURL(this.files[i]);
            }
        });
        $('#photo').change(function () {
            let imageContainer = $('#image-preview-container');
            imageContainer.empty();

            let reader = new FileReader();
            reader.onload = (e) => {
                let div = $('<div>');
                div.attr('class', 'd-flex');
                div.attr('style', 'height: 150px; overflow: hidden; margin-bottom: 10px;');
                let img = $('<img>');
                img.attr('src', e.target.result);
                img.attr('style', 'height: 200px; margin-right: 20px; width: 200px; object-fit: cover;');
                div.append(img);
                imageContainer.append(div);
            }
            reader.readAsDataURL(this.files[0]);
        });
    });
</script>
