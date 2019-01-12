<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>



<?php
if(!isset($_GET['catid']) || $_GET['catid']== NULL){
    header("location:catlist.php");

    
}else{
    $id=$_GET['catid'];
}

?>

<div class="grid_10">

    <div class="box round first grid">
        <h2>Add New Category</h2>
        <div class="block copyblock"> 


            <?php 
            if($_SERVER["REQUEST_METHOD"] == "POST"){

             $name = $_POST['name'];

             $name = mysqli_real_escape_string($db->link, $name);
             If(empty($name)){
                echo "<span class ='error'>Field must not be empty</span>";
            }else{
             $query = "update tbl_catagory set name = '$name' where id = $id";
             $cat_update = $db->update($query);

         }
     }
     ?>


     <?php
     $query= "SELECT * FROM tbl_catagory WHERE id='$id'";
     $category = $db->select($query);
     while ($result = $category->fetch_assoc()) {


        ?>

        <form action = "editcat.php?catid=<?php echo $id; ?>" method="post">
            <table class="form">					
                <tr>
                    <td>
                        <input type="text" name="name" value="<?php echo $result['name'];?>" class="medium" />
                    </td>
                </tr>
                <tr> 
                    <td>
                        <input type="submit" name="submit" Value="Save" />
                    </td>
                </tr>
            </table>
        </form>
    <?php } ?>
</div>
</div>
</div>
<?php include 'inc/footer.php';?>