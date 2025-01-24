<?php
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$database = "bookinformation"; 


$conn = new mysqli($servername, $username, $password, $database);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $name = $_POST['bookname'];
    $author = $_POST['author']; 
    $isbn = $_POST['isbn'];  
    $count = $_POST['count'];
    $category = $_POST['categ']; 
    
    $sql = "INSERT INTO booksinfo (Name, Author, ISBN, Count, Category) VALUES (?, ?, ?, ?, ?)";

    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssds", $name, $author, $isbn, $count, $category);

    
    if ($stmt->execute()) {
        echo "New record created successfully";
        echo "<meta http-equiv='refresh' content='3;url=index.php'>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    
    $stmt->close();
}

$conn->close();
?>
