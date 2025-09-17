<?php
  
  session_start();
  include("../common/db.php");

  if(isset($_POST["signup"])){
      $username = $_POST["username"];
      $email = $_POST["email"];
      $password = $_POST["password"];
      $address = $_POST["address"];
 
       $user = $con ->prepare("Insert into `users`(`username`,`email`,`password`,`address`) 
       values('$username','$email','$password','$address');
  ");

  $result = $user->execute();
  $user->insert_id;

  if($result){
    echo "New user registered";
    $_SESSION["user"] = ["username" => $username , "email" => $email, "user_id"=> $user->insert_id];
    header("location: /discuss");

  }
  else{
    echo "New user not registered";
  }
} 
else if(isset($_POST["login"])){
  $email = $_POST["email"];
  $password = $_POST["password"];
  $username="";
  $user_id=0;
  $query = "select * from users where email='$email' and password='$password'";
  $result = $con->query($query);
  if($result->num_rows==1){

    foreach($result as $row){
      $username = $row["username"];
      $user_id = $row["id"];
    }
    //echo $username;
     $_SESSION["user"] = ["username" => $username , "email" => $email, "user_id"=> $user_id];
    header("location: /discuss");
  }
  else{
    echo "New user not registered";
  } 
}
else if(isset($_GET["logout"])){
    session_unset();       // saare session variables clear
    session_destroy();     // session destroy
    header("Location: /discuss");
    exit();
}
else if(isset($_POST["ask"])){
  $title = $_POST["title"];
  $description = $_POST["description"];
  $category_id = $_POST["category"];
  $user_id = $_SESSION["user"]["user_id"];
 
   $question = $con ->prepare("Insert into `questions`(`title`,`description`,`category_id`,`user_id`) 
   values('$title','$description','$category_id','$user_id');
  ");

  $result = $question->execute();
  $question->insert_id;

  if($result){
    header("location: /discuss");

  }
  else{
    echo "Question is not added to website";
  }
}
else if(isset($_POST["answer"])){
  $answer = $_POST["answer"];
  $question_id = $_POST["question_id"];
  $user_id = $_SESSION["user"]["user_id"];
 
   $query = $con ->prepare("Insert into `answers`(`answer`,`question_id`,`user_id`) 
   values('$answer','$question_id','$user_id');
  ");

  $result = $query->execute();

  if($result){
    header("location: /discuss/?q-id=$question_id");

  }
  else{
    echo "Answer is not submitted";
  }
} 
else if(isset($_GET["delete"])){
  echo $qid = $_GET["delete"];
  $query = $con->prepare("delete from questions where id = $qid");
  $result = $query->execute();
  if($result){
    header("location: /discuss");
  }else{
    echo "Question not deleted";
  }

}
?>