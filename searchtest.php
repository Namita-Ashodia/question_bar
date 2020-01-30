<?php include "inc/session.php"; ?>
<?php include "inc/db.php"; ?>
<?php include "inc/header.php"; ?>
<head>
<script src="https://cdn.tiny.cloud/1/7jtq3zp135f1urp2geyqoe9e7dv6hfsavh02cxizjhue0etb/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
       <script>tinymce.init({selector:'textarea'});</script>

<script>
   tinymce.init({
   selector: 'textarea',
     plugins: 'a11ychecker advcode casechange formatpainter linkchecker lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinydrive tinymcespellchecker',
     toolbar: 'a11ycheck addcomment showcomments casechange checklist code formatpainter insertfile pageembed permanentpen table',
     toolbar_drawer: 'floating',
     tinycomments_mode: 'embedded',
     tinycomments_author: 'Author name',
   });
 </script>


<style> .w3-white a{
         text-decoration:none;
	  }
	  .w3-input {padding:2%;}
	  
@media (max-width: 867px) { 
	.m3 {display:none;}
    .m10    {
        width:99.99999%;
    }

.w3-col.m9 {
    width: 99.99999%!important; 
}

}


@media (max-width: 867px) { 
	.m2 {display:none;}
    .m9    {
        width:99.99999%;
    }

.w3-col.m10 {
    width: 99.99999%!important; 
}

}
#error_message{
    background: #F3A6A6;
}
#error_client_add{
    background: #F3A6A6;
}

#success_message{
    background: #CCF5CC;
}

#success_client_add{
    background: #CCF5CC;
}

.ajax_response {
    padding: 10px 20px;
    border: 0;
    width:70%;
    display: inline-block;
    margin-top: 20px;
    cursor: pointer;
	display:none;
	color:#555;
}
	  </style></head>
      <body>
<!-- Page Container -->
<div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">    
   <!-- The Grid -->
  <div class="w3-row">
  <div class="w3-col m2">
      <!-- Profile -->
      <div class="w3-card-2 w3-round w3-white">
        <div class="w3-container">
          <p class="w3-center"><img src="images/employee/<?php echo $_SESSION['profile_picture']; ?>" class="w3-circle" style="height:106px;width:106px" alt="profile picture"></p>
         <hr>
         <p><i class="fa fa-pencil fa-fw w3-margin-right w3-text-theme"></i> <?php echo $_SESSION['fname']; ?> </p>
         <p><i class="fa fa-user fa-fw w3-margin-right w3-text-theme"></i> <?php echo $_SESSION['designation']; ?></p>
        <!-- <p><i class="fa fa-birthday-cake fa-fw w3-margin-right w3-text-theme"></i>Techabn</p>-->
        </div>
      </div>
      <br>
	   <style> .w3-white a{ text-decoration:none;  } .w3-input {padding:2%;}  </style>
       
     <?php include "inc/accordancesearch.php"; ?>
      <br>
    
     
    <!-- End Left Column -->
    </div>
<div class="col-md-8 offset-md-2 bg-light p-4 mt-3 rounded">
<!--<h4>Search</h4>-->
<form class="form-inline p3" action="../searchpage1.php" method="POST" >
                                                <!--<input class="form-control" type="text" name="search" id="search" placeholder="Search" >
                                          -->
                                                <center><input type="text" name="search" id="search" class="form-control form-control-lg rounded-0" placeholder="Search.." style="width:40%;">    
                                                <input type="submit" name="submit" value="Search" class="btn btn-info btn-lg rounded-0" style="width:20%;"> 
                                               <!-- onclick="search();"><i class="fas fa-search"></i></button>-->
                                              <br>
                                              
     
                                               </center> </form>
                                          <center> 
                                   <!--<a href='askquestion.php'><button>ASK Question</button></a>-->
     <a href="#" onclick="document.getElementById('question').style.display='block'" class="w3-button w3-bar-item w3-hover-green w3-orange w3-text-white w3-right w3-margin-right <?php echo $hide; ?>" 
                      title="Add question"><i class="fa fa-plus fa-fw w3-margin-right"></i>Ask Question</a>
                            <br><br>          
                                          <!--for printing-->
       
<?php  
         $clnt_qry ="SELECT * from question ";
         $clnt_result = mysqli_query($dbc, $clnt_qry) or die(mysqli_error($dbc));
         if(mysqli_num_rows($clnt_result)>0) : ?>
         <?php while($clnt_rs = mysqli_fetch_assoc($clnt_result)) : ?>
         <tr>
         name= <th ><?php echo $uname = $clnt_rs['uname']; ?></th> 
         <th><?php echo $question = $clnt_rs['question']; ?></th>
         </tr>
         <a href="#" onclick="document.getElementById('reply').style.display='block'" ><i class="fa fa-plus fa-fw w3-margin-right"></i>reply</a>
         <th><?php echo $question = $clnt_rs['namereply']; ?></th>
         </tr>
         <th><?php echo $question = $clnt_rs['reply']; ?></th>
         </tr>
       
         <?php endwhile; ?>
<?php endif; ?>
</center>
<!--end of printing-->
</div>
<div class="col-md-5">
<div class="list-group" id="show-list" style="position:relative; margin-top:-38px; margin-left:215px;">

</div>
</div>

    <!-- Left Column -->
    
    </div>
  </div>
  
</div>

<!-- ask question in popup form-->
<div id="question" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px;border-radius:3px;">
      <div class="w3-center"><br>
        <span onclick="document.getElementById('question').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close">&times;</span>
        <img src="../images/techabnlogo.png" alt="Avatar" style="width:30%" class="w3-circle w3-margin-top">
      </div>
      <div id="error_client_add" class="ajax_response"></div>
 <div id="success_client_add" class="ajax_response"></div>
 <br>
      <form  class="w3-container w3-card-4" method="POST" action="processform/add-question.php">
<br>

<div class="w3-row-padding">
    
    <div class="w3-half">
            <p><input class="w3-input" type="text" id="uname" name="uname" maxlength="25" placeholder="Name" ></p>
        
            <label class="w3-text-grey">Category</label><br>
        <select id="category" name="category[]" multiple>
        
                <option value="AI">AI&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
                <option value="Website">Website</option>
                <option value="Sales">Sales</option>
                <option value="other">Other</option>
      </select>

    </div>
    
   
</div>


   
<textarea class="w3-input w3-border" style="width:90%" id="question" name="question"></textarea>
<br>
<br>
  <p><center><button type="submit" id="submit" class="w3-btn w3-padding w3-teal" name="submit" style="width:120px">Ask Question &nbsp; ❯</button></center></p>
</form>
      <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
        <button onclick="document.getElementById('question').style.display='none'" type="button" class="w3-button w3-red">Cancel</button>
      </div>

    </div>
  </div>
<!--end of pop up-->

<!-- reply in popup form-->
<div id="reply" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px;border-radius:3px;">
      <div class="w3-center"><br>
        <span onclick="document.getElementById('reply').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close">&times;</span>
        <img src="../images/techabnlogo.png" alt="Avatar" style="width:30%" class="w3-circle w3-margin-top">
      </div>
      <div id="error_client_add" class="ajax_response"></div>
 <div id="success_client_add" class="ajax_response"></div>
 <br>
      <form  class="w3-container w3-card-4" method="POST" action="processform/searchapproval.php">
<br>
<div class="w3-row-padding">
    <div class="w3-half">
            <p><input class="w3-input" type="text" id="namereply" name="namereply" maxlength="25" placeholder="Name" ></p>
    </div>
</div>  
<textarea class="w3-input w3-border" style="width:90%" id="reply" name="reply"></textarea>
<br>

<?php  
         $clnt_qry ="SELECT * from question ";
         $clnt_result = mysqli_query($dbc, $clnt_qry) or die(mysqli_error($dbc));
         if(mysqli_num_rows($clnt_result)>0) : ?>
         <?php while($clnt_rs = mysqli_fetch_assoc($clnt_result)) : ?>
<br> <input type="text" value="<?php echo $clnt_rs['id']; ?>" name="reply_id">
   
<?php endwhile; ?>
<?php endif; ?>
  <p><center><button type="submit" id="submit" class="w3-btn w3-padding w3-teal" name="submit" style="width:120px">Reply&nbsp; ❯</button></center></p>
</form>
      <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
        <button onclick="document.getElementById('reply').style.display='none'" type="button" class="w3-button w3-red">Cancel</button>
      </div>

    </div>
  </div>
  <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
	  $(document).ready(function() {
  function setHeight() {
    windowHeight = $(window).innerHeight();
    $('#middlecol').css('min-height', windowHeight);
  };
  setHeight();
  
  $(window).resize(function() {
    setHeight();
  });
});
</script>
</body>

<?php include "inc/footer.php"; ?>
