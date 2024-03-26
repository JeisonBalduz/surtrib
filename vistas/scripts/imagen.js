const defaultFile = '.../public/images/libertador2.jpg';

const file = document.getElementById( 'imagen' );
const img = document.getElementById( 'imagenactual' );
file.addEventListener( 'change', e => {
  if( e.target.files[0] ){
    const reader = new FileReader( );
    reader.onload = function( e ){
      img.src = e.target.result;
      $("#imagenactual").show();
    }
    reader.readAsDataURL(e.target.files[0])
  }else{
    img.src = defaultFile;
  }
} );