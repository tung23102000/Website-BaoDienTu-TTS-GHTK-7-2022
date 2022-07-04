
<?php include "include/header.php"; ?>

<?php

if (isset($_POST['submit'])) {
    $to = "testmailphpmtp@gmail.com";
    $subject = wordwrap($_POST['subject'],70);//chỉ hiện ngắn thôi nếu độ dài quá 70 kí tự
    $body = $_POST['body'];
    $header = "From: ".$_POST['email'];
    // send email
$success=mail($to,$subject,$body,$header);
if( $success == true )
{
    echo'
                                    <script>
                                    swal({
                                        title: "Đã gửi mail thành công!",
                                        text: "",
                                        icon: "Success",
                                        button: "Ok",
                                    });
                                    </script>';
}
else
{
    echo'
    <script>
    swal({
        title: "Không gửi đi được !",
        text: "",
        icon: "error",
        button: "Ok",
    });
    </script>';
}
 
}


?>
<!-- Page Content -->
<div class="container-fluid">

    <section id="login">
        <div class="container">
            <div class="row my-3" style="margin-right: 0;">
                <div class="col-6" style="margin-left: 30%; margin-right: 30%;">
                    <div class="form-wrap">
                        <h2 style="text-align:center; color:#5495a1;">Contact</h2>
                      
                        <form role="form" action="" method="post" id="login-form" autocomplete="off">
                           
                            <div class="form-group">
                                <label for="email" class="sr-only">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email">
                            </div>
                            <div class="form-group">
                                <label for="email" class="sr-only">Subject</label>
                                <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter your subject">
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="body" id="body" cols="50" rows="10"></textarea>
                            </div>

                            <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block btn-success" value="Submit">
                        </form>

                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>


    <hr>
   
</div>
<?php include "include/footer.php"; ?>