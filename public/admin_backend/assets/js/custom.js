// main thamnial 
function mainThamUrl(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#mainThmb').attr('src', e.target.result).width(80).height(80);
        };
        reader.readAsDataURL(input.files[0]);
    }
}

// multi Image 
$(document).ready(function() {
    $('#multiImg').on('change', function() { //on file input change
        if (window.File && window.FileReader && window.FileList && window
            .Blob) //check File API supported browser
        {
            var data = $(this)[0].files; //this file data

            $.each(data, function(index, file) { //loop though each file
                if (/(\.|\/)(gif|jpe?g|png|webp)$/i.test(file
                        .type)) { //check supported file type
                    var fRead = new FileReader(); //new filereader
                    fRead.onload = (function(file) { //trigger function on successful read
                        return function(e) {
                            var img = $('<img/>').addClass('thumb').attr('src',
                                    e.target.result).width(100)
                                .height(80); //create image element 
                            $('#preview_img').append(
                                img); //append image to output element
                        };
                    })(file);
                    fRead.readAsDataURL(file); //URL representing the file's data.
                }
            });

        } else {
            alert("Your browser doesn't support File API!"); //if File API is absent
        }
    });
});

// Sub Category auto load 
$(document).ready(function() {
    $('select[name="category_id"]').on('change', function() {
        var category_id = $(this).val();
        if (category_id) {
            $.ajax({
                url: "{{ url('/subcategory/ajax') }}/" + category_id,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    $('select[name="subcategory_id"]').html('');
                    var d = $('select[name="subcategory_id"]').empty();
                    $.each(data, function(key, value) {
                        $('select[name="subcategory_id"]').append(
                            '<option value="' + value.id + '">' + value
                            .subcategory_name + '</option>');
                    });
                },
            });
        } else {
            alert('danger');
        }
    });
});