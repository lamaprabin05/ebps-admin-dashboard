<?php 
include 'inc/header.php';
include 'inc/nav.php';
?>
<div class="container">
<div class="row justify-content-center">
<div class="col-md-10">
<div class="card">
<header class="card-header">
    <h4 class="card-title mt-2">Add New User:</h4>
</header>
<article class="card-body">
<form>
    <div class="form-row">
        <div class="col form-group">
            <label>Username </label>   
            <input type="text" class="form-control" name="username" placeholder="">
        </div> <!-- form-group end.// -->

        <div class="col form-group">
            <label>User Email:</label>
            <input type="text" class="form-control" name="user_email" placeholder=" ">
        </div> <!-- form-group end.// -->

    </div> <!-- form-row end.// -->
    
        <div class="form-group">
      <label class="form-control-label">Contact Address:</label>
      <input class="form-control" type="text" name="contact_number"></input>
    </div>

    <div class="form-row">
      <div class="form-group col-md-6">
          <label>Password:</label>
          <input type="password" name="password" class="form-control">    
      </div>

      <div class="form-group col-md-6">
          <label>Confirm Password:</label>
          <input type="password" name="confirm_password" class="form-control">
      </div>

    </div>

    <div class="form-group">
            <label> Account Type: </label>
            <select name="account_type" id="account_type" class="form-control">
                <option>...Select Any One... </option>
                <option value="1">1 </option>
                <option value="2">2</option>
                <option value="3">3</option>
            </select>
    </div>
    
    <div class="form-row">
        
        <div class="col form-group">
            <label>Extension Number:</label>
            <input type="number" name="extension_number" class="form-control">
        </div>

        <!-- <div class="col form-group"> 
            <label>Staff Id:</label>
            <input type="number" name="staff_id" class="form-control">
        </div>  auto generate-->
    </div>

   <div class="form-row">
      <div class="col form-group">
          <label>Consultancy Name:</label>
          <input class="form-control" type="text" name="consultancy_name"></input>
      </div>  

      <div class="col form-group">
          <label>Consultancy Address:</label>
          <input class="form-control" type="text" name="consultancy_address"></input>
      </div>  

   </div>

  <div class="form-group">
      <label class="form-control-label">Consultancy License Number:</label>
      <input class="form-control" type="number" name="consultancy_license_number"></input>
  </div>
      
  <div class="form-group">
      <label class="form-control-label">Consultancy License:</label>
      <input class="form-control" type="number" name="consultancy_license_number"></input>
  </div>
   
   <div class="form-group">
       <label>Upload your Profile Picture:</label> 
     </br>
       <input type="file" accept="image/* name=
       profile_pic" >       
   </div>   

   <div class="form-row">
      <div class="col form-group">
          <label>Post:</label>
          <select name="post" id="post" class="form-control">
              <option >Enginer</option>
              <option>साखा  अधिकृत </option>
          </select>
      </div>  


      <div class="col form-group">
          <label>Role:</label>
          <select name="role" id="role" class="form-control">
              <option value="1">Enginer</option>
              <option value="2">साखा  अधिकृत </option>
          </select>
      </div>  

   </div>

    <div class="form-group">
          <label>Registered Date:</label>
          <input class="form-control" type="date" name="registered_date"></input>
    </div>  

   <div class="form-group " style="margin-left: 280px;">
      <button class="btn btn-primary col-md-5">Add User</button>
   </div>
       
    
</form>
</article> <!-- card-body end .// -->

</div> <!-- card.// -->
</div> <!-- col.//-->

</div> <!-- row.//-->


</div> 
<?php include 'inc/footer.php'; ?>