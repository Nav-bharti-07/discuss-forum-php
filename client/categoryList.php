<div class="container">
  <h1>Categories</h1>
  <?php
  include("./common/db.php");
  $query="select * from category";
$result = $con->query($query);
foreach($result as $row){
  $name = ucfirst($row["name"]);
  $id = $row["id"];
  echo "<div class='row question-list'>
  <h4><a href='?c-id=$id'>$name</a></h4>
  </div>";
}
  ?>
</div>