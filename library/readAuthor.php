<?php


$db = mysqli_connect('localhost', 'root', '', 'library') or die($db);
if(!empty($_POST["keyword"])) {
$query ="SELECT * FROM authors WHERE name like '" . $_POST["keyword"] . "%' ORDER BY name LIMIT 0,6";
$result = mysqli_query($db, $query);
if(!empty($result)) {
?>
<ul id="author-list">
<?php
foreach($result as $author) {
?>
<li onClick="selectAuthor('<?php echo $author["name"]; ?>');"><?php echo $author["name"]; ?></li>
<?php } ?>
</ul>

<?php } } ?>