<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Copyright Text</h2>
        <?php 
           if($_SERVER["REQUEST_METHOD"] == "POST"){
               
              $copyright = $fm->validation($_POST['copyright']);
    
              $copyright = mysqli_real_escape_string($db->link, $copyright);

                If($copyright==""){  
                echo "<span class ='error'>Field must not be empty</span>";
                }else{
                       $query="UPDATE tbl_copyright
                       SET
                       copyright='$copyright'
                      
                       WHERE id = '1'";
                       $updated_row = $db->update($query);
                   
                   if($updated_row){
                        echo "<span class='success'>data update successfully</span>";
                      }else{
                        echo "<span class='error'>data not update</span>";
                      }
                }
          }
         ?>      
                
        <?php
         $query="select * from tbl_copyright where id=1";
         $copyright=$db->select($query);
         if ($copyright) {
            while ($result=$copyright->fetch_assoc()) {
         
         
         ?> 

                <div class="block copyblock"> 
                 <form action="copyright.php" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" value="<?php echo $result['copyright'];?>" name="copyright" class="large" />
                            </td>
                        </tr>
						
						 <tr> 
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
                <?php } } ?>
            </div>
        </div>
        <?php include 'inc/footer.php';?>