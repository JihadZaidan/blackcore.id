document.addEventListener('DOMContentLoaded', function() {
    const chooseImageBtn = document.getElementById('chooseImageBtn');
    const productImageFile = document.getElementById('productImageFile');
    const productImagePath = document.getElementById('productImagePath');
    const imagePreview = document.getElementById('imagePreview');

    chooseImageBtn.addEventListener('click', function() {
        productImageFile.click();
    });

    productImageFile.addEventListener('change', function(event) {
        handleImageUpload(event.target);
    });

    function handleImageUpload(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function(e) {
                productImagePath.value = input.files[0].name;
                imagePreview.src = e.target.result;
                imagePreview.style.display = 'block';
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
});