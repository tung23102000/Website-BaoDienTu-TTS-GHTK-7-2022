$(document).ready(function() {
    $('#summernote').summernote(
    {
      callbacks: {
        onPaste: function (e) {
            var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');

            e.preventDefault();

            // Firefox fix
            setTimeout(function () {
                document.execCommand('insertText', false, bufferText);
            }, 10);
        }
    }
     
      ,height: 300
    }
    );
  });

window.addEventListener('scroll', function () {
  var nav = document.querySelector(".box-menu");
  //console.log(nav);
  nav.classList.toggle("sticky", window.scrollY>0);
})
