function cropImage(file, aspectRatio = 1) {
    return new Promise((resolve) => {
      const img = new Image();
      img.onload = function() {
        const canvas = document.createElement('canvas');
        const ctx = canvas.getContext('2d');
        
        let width = img.width;
        let height = img.height;
        
        if (width / height > aspectRatio) {
          width = height * aspectRatio;
        } else {
          height = width / aspectRatio;
        }
        
        canvas.width = width;
        canvas.height = height;
        
        ctx.drawImage(
          img,
          (img.width - width) / 2,
          (img.height - height) / 2,
          width,
          height,
          0,
          0,
          width,
          height
        );
        
        canvas.toBlob(resolve, 'image/jpeg');
      };
      img.src = URL.createObjectURL(file);
    });
  }
  
  async function previewImage(event) {
    const file = event.target.files[0];
    if (file) {
      const croppedBlob = await cropImage(file);
      const img = document.getElementById('profile-preview');
      img.src = URL.createObjectURL(croppedBlob);
      console.log(img.src)
    }
  }
  