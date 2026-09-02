<?php
include("./connect.php");
$id = $_GET["id"];
$editMessage = null;
//fetch the selected post
try{
   $sql = "SELECT * FROM posts WHERE id=:id";
   $query = $conn->prepare($sql);
   $query->execute(["id"=>$id]);
   $result = $query->fetch();
   if($result){
     $title = $result["title"];
     $body = $result["body"];
}else{
   throw new Error("unavailable content!!");
}
}catch(Exception $e){
   die("Error found!!");
}

//edit functionality
try{
   $sql = "SELECT * FROM posts WHERE id=:id";
   $query = $conn->prepare($sql);
   $query->execute(["id"=>$id]);
   $result = $query->fetch();
   if($result){
     $title = $result["title"];
     $body = $result["body"];
}else{
   throw new Error("unavailable content!!");
}
}catch(Exception $e){
   die("Error found!!");
}

//edit the post
if(isset($_POST["edit"])){
  $sql = "UPDATE posts SET title=:title, body=:body, posted=:posted WHERE id=:id";
  $query = $conn->prepare($sql);
  if($query->execute([
    "title"=>$title,
    "body"=>$body,
    'posted' =>date("Y-m-d"),
    "id"=>$id])){
       $editMessage = "edit successfull!!";
       header('Location: ./home.php');
       exit();
    }else{
      $editMessage = "edit failed!!";
    };
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <?php if($result): ?>
  <h2>Edit the post</h2>
  <form action="#" method="post" class="container">
    <!-- the title of the post -->
    <label for="title">Title</label>
    <input type="text" value="<?php  echo $result["title"]  ?>" id="title">

    <!-- the message content -->
    <label for="message">Message</label>
    <input type="text" value="<?php echo $result["body"]   ?>" id="message">

    <!-- the submit button -->
    <input type="submit" value="Edit" name="edit">
    <?php if($editMessage): ?>
      <p><?php echo $editMessage; ?></p>
    <?php endif; ?>
  </form>
  <?php else: ?>
    <p>Not available for edit</p>
  <?php endif;  ?>
</body>
</html>