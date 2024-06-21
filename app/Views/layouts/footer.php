<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  function previewImg(){
    const sampul = document.querySelector('#inputGroupFile02');
    const imgPreview = document.querySelector('.img-preview');
    const fileSampul = new FileReader();
    
    fileSampul.readAsDataURL(sampul.files[0]);
    
    fileSampul.onload = function(e){
        imgPreview.src = e.target.result;
    }
  }
</script>
</body>
</html>