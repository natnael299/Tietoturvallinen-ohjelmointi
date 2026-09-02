<?php
include("./connect.php");
$id = $_GET["id"];
$deleteMessage = null;
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

//delete functionality
try{
  if(isset($_POST["delete"])){
    $sql = "DELETE FROM posts WHERE id=:id";
    $query = $conn->prepare($sql);
    if($query->execute(["id"=>$id])){
      $deleteMessage = "Successfully deleted!!";
      header('Location: ./home.php');
       exit();
      }else{
        $deleteMessage = "unable to delete!!";
      };
  }
}catch(Exception $e){
   $deleteMessage = "unable to delete!!";
   die("Error found!!");
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
    <input type="text" value="<?php  echo $result["title"]  ?>" id="title" disabled>

    <!-- the message content -->
    <label for="message">Message</label>
    <input type="text" value="<?php echo $result["body"]   ?>" id="message" disabled>

    <!-- the submit button -->
    <input type="submit" value="Confirm deletetion" name="delete">
    <?php if($deleteMessage): ?>
      <p><?php echo $deleteMessage; ?></p>
    <?php endif; ?>
  </form>
  <?php else: ?>
    <p>Not available for edit</p>
  <?php endif;  ?>
</body>
</html>