<?php 
include 'connect.php';
?>
<ul>
    <hr>
    <?php      
            $sql = "SELECT * FROM posts;";
            try {
                $query = $conn->prepare($sql);
                $query->execute();
            } catch (PDOException $e) {
                die("Error: " . $e->getMessage());
            }
            $res = $query->fetchAll();
            foreach($res as $row) {
                $author = array_filter($_SESSION['users'], function($v, $k) use($row) {
                    return $v['id'] === $row['author'];
                }, ARRAY_FILTER_USE_BOTH);
                $author = array_values($author);
                $author = $author[0];
                ?>
            <li>
                <h3><?php echo $row['title']; ?></h3>
                <p><i><?php echo $row['posted'] . ' – ' . $author['realname']; ?></i></p>
                <p><?php echo $row['body']; ?></p>
                   <a type="button" href="./edit.php?id=<?= $row["id"] ?>">
                    Edit Message
                </a>
                   <a href='./delete.php?id=<?= $row["id"] ?>'>
                    Delete Message
                </a>
                <hr>
            </li>
            <?php }
    ?>
</ul>