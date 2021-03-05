<?php

    $author = "";
    $name = "";
    $ISBN  = "";
    $price = "";
    $category = "";
    $errors = array();

    $db = mysqli_connect('localhost', 'root', '', 'library') or die($db);

    if (isset($_POST['add-btn'])) {

        $author = mysqli_real_escape_string($db, $_POST['author']);
        $name = mysqli_real_escape_string($db, $_POST['name']);
        $ISBN = mysqli_real_escape_string($db, $_POST['ISBN']);
        $price = mysqli_real_escape_string($db, $_POST['price']);
        $category = mysqli_real_escape_string($db, $_POST['category']);
      
        if (empty($author)) { array_push($errors, "Author is required"); }
        if (empty($name)) { array_push($errors, "Book name is required"); }
        if (empty($ISBN)) { array_push($errors, "ISBN is required"); }
        if (empty($price)) { array_push($errors, "Price is required"); }
        if (empty($category)) { array_push($errors, "Category is required"); }
    }

    $book_check_query = "SELECT * FROM books WHERE ISBN='$ISBN' LIMIT 1";
    $result = mysqli_query($db, $book_check_query);
    $book = mysqli_fetch_assoc($result);

    if($book){
      if ($book['ISBN'] === $ISBN) {
        array_push($errors, "Book already exists");
      }
    }
      

    if (count($errors) == 0) {
      $author_check_query = "SELECT * FROM authors WHERE name='$author' LIMIT 1";
      $result = mysqli_query($db, $author_check_query);
      $author_result = mysqli_fetch_assoc($result);

      if($author_result){
        if ($author_result['name'] === $author) {
          $author_id = $author_result['id'];
        }
      }else{
        $query = "INSERT INTO authors (name) VALUES('$author')";
        mysqli_query($db, $query);
        $result = mysqli_query($db, $author_check_query);
        $author_result = mysqli_fetch_assoc($result);
        $author_id = $author_result['id'];
      }
  
      $query = "INSERT INTO books (name, price, category, ISBN, author) VALUES('$name', '$price', '$category', '$ISBN', '$author_id')";
      mysqli_query($db, $query);
      
  	header('location: library.php');
    }
    $db -> close();
?>