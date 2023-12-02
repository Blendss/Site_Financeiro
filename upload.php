<?php
if ($_FILES['file']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = 'img/'; // Diretório onde as imagens são armazenadas

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    // Remove a imagem antiga se existir
    if (file_exists($uploadDir . 'user_image.jpg')) {
        unlink($uploadDir . 'user_image.jpg');
    }

    $fileName = 'user_image.jpg'; // Nome fixo para a imagem
    $uploadFile = $uploadDir . $fileName;

    move_uploaded_file($_FILES['file']['tmp_name'], $uploadFile);

    $base64Image = 'img/' . $fileName;
    echo $base64Image;
}
?>
