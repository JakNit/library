<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>

table {
  width: 100%;
  border-collapse: collapse;
  background: #34495e;  
}

td, th {
  padding: 8px;
  text-align: left;
}

th {
  cursor: pointer;
}

th, td {
  text-align: left;
  padding: 16px;
}

tr:nth-child(even) {
  background-color: #496785;
  color: #ffffff;
}

tr:nth-of-type(odd) {
  background: #162029;
  color: #ffffff;
}

th {
  background: #2c3e50;
  font-weight: bold;
  color: #090466;
}

</style>

    <title>Document</title>
</head>
<body>
<div id="supAll">
<table class="supTable">
    <thread>
        <tr class="bg-info">
          <th onclick="sortTable('supTable', 0)"> Name of the Book</th>
          <th onclick="sortTable('supTable', 1)">ISBN</th>
          <th onclick="sortTable('supTable', 2)">Price</th>
          <th onclick="sortTable('supTable', 3)">Category</th>
          <th onclick="sortTable('supTable', 4)">Author</th>
        </tr>
        </thread>
        <tbody>
        <?php
          $db = mysqli_connect('localhost', 'root', '', 'library') or die($db);
          $query = "SELECT books.name as bookname, books.ISBN, books.price, books.category, authors.name as authorname  FROM books INNER JOIN authors ON books.author = authors.id ";
          $result = mysqli_query($db, $query);

          if($result){
            while($row = $result -> fetch_assoc()){
              echo "<tr><td>" . $row['bookname'] . "</td><td>" . $row['ISBN'] . "</td><td>" . $row['price'] . "</td><td>" . $row['category'] . "</td><td>" . $row['authorname'] . "</td></tr>";
            }
            echo "</table>";
          }else{
            echo "0 result";
          }
          $db -> close();

        ?>
    </tbody>
    </table>
    <script>
   function sortTable(tableClass, n) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;

  table = document.getElementsByClassName(tableClass)[0];
  switching = true;
  dir = "asc";
  while (switching) {
      switching = false;
      rows = table.getElementsByTagName("TR");
      for (i = 1; i < (rows.length - 1); i++) {
          shouldSwitch = false;
          x = rows[i].getElementsByTagName("TD")[n];
          y = rows[i + 1].getElementsByTagName("TD")[n];
          var xContent = (isNaN(x.innerHTML)) 
              ? (x.innerHTML.toLowerCase() === '-')
                    ? 0 : x.innerHTML.toLowerCase()
              : parseFloat(x.innerHTML);
          var yContent = (isNaN(y.innerHTML)) 
              ? (y.innerHTML.toLowerCase() === '-')
                    ? 0 : y.innerHTML.toLowerCase()
              : parseFloat(y.innerHTML);
          if (dir == "asc") {
              if (xContent > yContent) {
                  shouldSwitch= true;
                  break;
              }
          } else if (dir == "desc") {
              if (xContent < yContent) {
                  shouldSwitch= true;
                  break;
              }
          }
      }
      if (shouldSwitch) {
          rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
          switching = true;
          switchcount ++;      
      } else {
          if (switchcount == 0 && dir == "asc") {
              dir = "desc";
              switching = true;
          }
      }
   }
}
</script>
</body>
</html>

