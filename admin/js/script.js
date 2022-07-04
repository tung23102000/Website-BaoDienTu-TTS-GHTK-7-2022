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


// loader process
var div_box = "<div id='load-screen'><div id='loading'></div></div>";
// hàm append trong jquery để chèn một dung lên trc 
// ở đây chúng ta sẽ chèn div_box lên trc phần body trong index của admin
$("body").append(div_box);
// trì hoãn việc xuất hiện thẻ div trong 600ms sau rồi biến mất phai đi sau 500ms
$('#load-screen').delay(600).fadeOut(500, function () {
  $(this).remove();// loại bỏ thẻ div load-screen đi để cho nó hiện cái phần body index admin
});