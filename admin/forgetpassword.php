              <?php 
              include '../lib/Session.php';
              Session::init();
              ?>

              <?php include '../config/config.php'; ?>
              <?php include '../lib/Database.php'; ?>
              <?php include '../helpers/format.php';?>

              <?php

              $db = new Database();

              $fm = new format();

              ?>
              <!DOCTYPE html>
              <head>
                <meta charset="utf-8">
                <title>Password Recovery</title>
                <link rel="stylesheet" type="text/css" href="css/stylelogin.css"/>
              </head>
              <body>
                <div class="container">
                  <section id="content">
                    <?php
                    $db = new Database();

                    if($_SERVER["REQUEST_METHOD"] == "POST"){

                     $email = $fm->validation($_POST['email']);
                     $email = mysqli_real_escape_string($db->link, $email);

                     if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
                      echo "<span style='color:red;font-size:18px;'>Invailed email address</span>";
                    }else{


                    $mailquery = "select * from tbl_user where email='$email' limit 1";
                    $mailcheck = $db->select($mailquery);
                     if ($mailcheck != false) {
                      while( $value = $mailcheck->fetch_assoc() ) {
                        
                        $userid=$value['id'];
                        $username=$value['username'];
                      }
                      $text = substr($email, 0, 3);
                      $rand = rand(1000, 9999);
                      $newpass ="$text$rand ";
                      $password =md5($newpass);
                      $updatequery ="UPDATE tbl_user SET password='$password' WHERE id='$userid'";
                      $update_row=$db->update($updatequery);

                      $to = "$email";
                      $from = "admin@project";
                      $headers = "From: $from\n";

                      $headers .= 'MIME-Version: 1.0';
                      $headers .= 'Content-type: text/html; charset=iso-8859-1';
                      $subject = "Password Recovery";
                      $subject = "Your User Name is".$username."And Your Password is".$newpass."please reset your password";

                      $sendmail = mail(to,subject,message,headers);
                      if ($sendmail) {
                        echo "<span style='color:green;font-size:18px;'>please check your mail for new password</span>";
                      }else{
                        echo "<span style='color:red;font-size:18px;'>mail not send!</span>";
                      }


                      } else { echo "<span style='color:red;font-size:18px;'>email not exist!!</span>";

                      }
                    }
                  }
                ?>

                    <form action="" method="post">
                      <h1>Password Recovery</h1>
                      <div>
                       <input type="text" placeholder="Enter Valid Email" required="1" 
                       name="email" />
                     </div>
                     <div>
                       <input type="submit" value="Send" />
                     </div>
                   </form><!-- form -->

                   <div class="button">
                    <a href="login.php">Login</a>
                  </div>

                  <div class="button">
                    <a href="">Blog project</a>
                  </div><!-- button -->

                </section><!-- content -->
              </div><!-- container -->
            </body>
            </html>