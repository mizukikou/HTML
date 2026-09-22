<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>年齡</title>
</head>
<body>
    <?php
        // 1. 將變數名稱修改為表單對應的 "userAge"，並給予預設值空字串
        $userAge = isset($_GET["userAge"]) ? $_GET["userAge"] : "";

        // 2. 判斷是否有選擇年齡（改用 switch 來對應不同的 value）
        if($userAge !== ""){
          echo "您選擇的年齡是：<br>";
          switch($userAge){
            case "age1":
              echo "未滿20歲";
              break;
            case "age2":
              echo "20~29歲";
              break;
            case "age3":
              echo "30~39歲";
              break;
            case "age4":
              echo "40歲以上";
              break;
            default:
              echo "未知的選項";
              break;
          }
        } else {
          echo "未選擇任何年齡";
        }
    ?>
</body>
</html>
