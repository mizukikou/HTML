<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
      $uploadDir = 'uploads/';  
      /*字串最後一定要加上 /。如果少了最後的斜線，檔名直接黏在資料夾名稱後面，導致上傳失敗。*/
      if (!is_dir($uploadDir)) {
          mkdir($uploadDir, 0777, true);
      }
      $uploadFile = $uploadDir . basename($_FILES['file']['name']);
      if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadFile)) {
          echo "檔案上傳成功: " . htmlspecialchars(basename($_FILES['file']['name']));
      } else {
          echo "檔案上傳失敗";
      }
  } else {
      echo "沒有選擇檔案或上傳錯誤";
  }
}
?>