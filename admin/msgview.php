<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php
if(!isset($_GET['msgid']) || $_GET['msgid']== NULL){
    header("location:inbox.php");

    
}else{
    $id=$_GET['msgid'];
}

?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>View Message</h2>
         <?php 
            if($_SERVER["REQUEST_METHOD"] == "POST"){

                header("location:inbox.php");
            }
            ?>

        <div class="block">               
           <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
               <?php
                   $query= "SELECT * FROM tbl_contact WHERE id='$id'";
                   $msg = $db->select($query);
                   if ($msg) {
                  
                   while ($result = $msg->fetch_assoc()) {
                           

                   ?>

                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input type="text" readonly value="<?php echo $result['firstname']. " ".$result['lastname'];?>" class="medium" />
                    </td>
                </tr>


                <tr>
                    <td>
                        <label>Email</label>
                    </td>
                    <td>
                        <input type="text" readonly value="<?php echo $result['email'];?>" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Date</label>
                    </td>
                    <td>
                        <input type="text" readonly value="<?php echo $fm->formatDate($result['date']);?>" class="medium" />
                    </td>
                </tr>



            <tr>

                <td style="vertical-align: top; padding-top: 9px;">
                    <label>Content</label>
                </td>
                <td>
                    <textarea class="tinymce">value="<?php echo $result['body'];?>"</textarea>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="submit" name="submit" Value="OK" />
                </td>
            </tr>
        </table>
    <?php }}?>
    </form>
</div>
</div>
</div>


<!-- Load TinyMCE -->
    <script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            setupTinyMCE();
            setDatePicker('date-picker');
            $('input[type="checkbox"]').fancybutton();
            $('input[type="radio"]').fancybutton();
        });
    </script>
        <script type="text/javascript">
        $(document).ready(function () {
            setupLeftMenu();
            setSidebarHeight();
        });
    </script>
    <!-- /TinyMCE -->
    <?php include 'inc/footer.php';?>