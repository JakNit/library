<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">

  <style>
    body{
      background-color: #2c3e50;
    }
    table {
  table-layout: fixed;
  width: 100%;  
}
form {
    display: grid;
    grid-template-columns: 1fr 1fr;
    grid-gap: 20px;
    width: 100%;
}
    input[type=text], select, textarea{
      width: 300px;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  resize: vertical;
    }
    #author-list{float:left;list-style:none;margin-top:-3px;padding:0;width:300px;position: relative;}
#author-list li{padding: 10px; background: #f0f0f0; border-bottom: #bbb9b9 1px solid;}
#author-list li:hover{background:#ece3d2;cursor: pointer;}
  </style>
    <script>
    $(document).ready(function(){
	    $("#search-box").keyup(function(){
		    $.ajax({
		      type: "POST",
		      url: "readAuthor.php",
		      data:'keyword='+$(this).val(),
		      beforeSend: function(){
			      $("#search-box").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
		      },
		      success: function(data){
  			    $("#suggesstion-box").show();
	  		    $("#suggesstion-box").html(data);
			      $("#search-box").css("background","#FFF");
		      }
		    });
	    });
    });

    function selectAuthor(val) {
      $("#search-box").val(val);
      $("#suggesstion-box").hide();
    }
    </script>

    <title>Library</title>
</head>
<body>
    <h3>Library</h3>
    <form method="POST" action="server.php">
        <div class="frmSearch">
          <input type="text" name="author" id="search-box"  placeholder="Author">
          <div id="suggesstion-box"></div>
        </div>
        <div class="input-group">
          <input type="text" name="name"  placeholder="Name of the Book" >
        </div>
        <div class="input-group">
            <input type="text" name="ISBN"  placeholder="ISBN" >
        </div>
        <div class="input-group">
            <input type="text" name="price"  placeholder="Price">
        </div>
        <div class="input-group">
            <select name="category">
            <option value="" disabled selected hidden>Category</option>
              <option value="Drama">Drama</option>
              <option value="Fable">Fable</option>
              <option value="Fairy Tale">Fairy Tale</option>
              <option value="Fantasy">Fantasy</option>
              <option value="Fiction">Fiction</option>
              <option value="Fiction in Verse">Fiction in Verse</option>
              <option value="Folklore">Folklore</option>
              <option value="Historical Fiction">Historical Fiction</option>
              <option value="Horror">Horror</option>
              <option value="Humor">Humor</option>
              <option value="Legend">Legend</option>
              <option value="Mystery">Mystery</option>
              <option value="Mythology">Mythology</option>
              <option value="Poetry">Poetry</option>
              <option value="Realistic Fiction">Realistic Fiction</option>
              <option value="Science Fiction">Science Fiction</option>
              <option value="Short Story">Short Story</option>
              <option value="Tall Tale">Tall Tale</option>
            </select>
        <div class="input-group">
          <button type="submit" class="btn btn-primary btn-lg active" name="add-btn" >Add book to the library</button>
        </div>
      </form>
      <?php include('libraryPrint.php') ?>
      <!-- Latest compiled and minified JavaScript -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
</body>
</html>