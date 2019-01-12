<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<style>
   .leftside{float: left;width:70%}
   .rightside{float: left;width:20%}
   .rightside img{height: 160px;weidth:170;}
</style>







        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Site Title and Description</h2>


    <?php 
   if($_SERVER["REQUEST_METHOD"] == "POST"){
       
      $title = $fm->validation($_POST['title']);
      $sologan =$fm->validation($_POST['sologan']);

   
      $title = mysqli_real_escape_string($db->link, $title);
      $sologan = mysqli_real_escape_string($db->link, $sologan);
     
       $permited  = array('png');
       $file_name = $_FILES['logo']['name'];
       $file_size = $_FILES['logo']['size'];
       $file_temp = $_FILES['logo']['tmp_name'];
       
     $div = explode('.', $file_name);
       $file_ext = strtolower(end($div));
       $same_logo ='logo'.'.' .$file_ext;
       $uploaded_image = "uploads/".$same_logo;
   
      If($title=="" || $sologan==""){  
       echo "<span class ='error'>Field must not be empty</span>";
   }else{
  if(!empty($file_name)){
    if($file_size >1048567){
      echo "<span class='error'>Image size should be less then 1mb!</span>";
    }elseif(in_array($file_ext,$permited) == false ){
      echo "<span class='error'>you can upload only:-".implode(',',$permited)."</span>";
    }else{
      move_uploaded_file($file_temp, $uploaded_image);
      $query="UPDATE title_sologan
          SET
          title = '$title',
          sologan = '$sologan',
          logo = '$logo'
          where id= '1'";
          $updated_row = $db->update($query);
          if($updated_row){
            echo "<span class='success'>data update successfully</span>";
          }else{
            echo "<span class='error'>data not update</span>";
          }
    }
  }else{
    $query="UPDATE title_sologan
           SET
           title='$title',
           sologan='$sologan'
           WHERE id = '1'";
           $updated_row = $db->update($query);
       
       if($updated_row){
            echo "<span class='success'>data update successfully</span>";
          }else{
            echo "<span class='error'>data not update</span>";
          }
      }   
   
    
     }
   }
  ?>
      <?php
         $query="select * from title_sologan where id=1";
         $blog_litle=$db->select($query);
         if ($blog_litle) {
            while ($result=$blog_litle->fetch_assoc()) {
         
         
         ?>
						
				
				
				<div class="block sloginblock">               
                 <div class="leftside">
				 <form action="" method="post" enctype="multipart/from-data">
                    <table class="form" >					
                        <tr>
                            <td>
                                <label>Website Title</label>
                            </td>
                            <td>
                                <input type="text" value="<?php echo $result['title'];?>"  name="title" class="medium" />
                            </td>
                        </tr>
						 <tr>
                            <td>
                                <label>Website Slogan</label>
                            </td>
                            <td>
                                <input type="text" value="<?php echo $result['sologan'];?>" name="sologan" class="medium" />
                            </td>
                        </tr>
							<tr>
								<td>
									<label>Upload Image</label>
								</td>
								<td>
									<input type="file" name= "logo" />
								</td>
							</tr>
						 
						
						 <tr>
                            <td>
                            </td>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
					 </div>
					 <div class= "rightside">
						<img src="<?php echo $result['logo'];?>" alt="logo">
					</div>
                </div>
				<?php } } ?>
            </div>
        </div>
        <?php include 'inc/footer.php';?>
