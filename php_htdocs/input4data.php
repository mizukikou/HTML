<?php
// =========================================================================
// 1. 【核心邏輯與資料處理区】（放最前面）
// =========================================================================

// 初始化變數，儲存最後要在網頁上顯示的所有文字訊息
$message = "";

// 攔截前端傳來的生日資料
if (isset($_REQUEST['birthday']) && trim($_REQUEST['birthday']) !== "") {
    
    $birthday = $_REQUEST['birthday'];
    
    try {
        // 建立生日與今天的 DateTime 物件
        $birthDate = new DateTime($birthday);
        $todayDate = new DateTime();
        
        // 【後端防繞過機制】：如果輸入的生日大於今天，主動進行阻擋
        if ($birthDate > $todayDate) {
            
            $message = "<span style='color: red;'>錯誤：生日不能在未來！請返回重新選擇。</span>";
            
        } else {
            
            /**
             * 【核心優化：改為虛歲計算演算法】
             * 1. $todayDate->format('Y') ：動態取得當前西元年份（例如：2026）
             * 2. $birthDate->format('Y') : 動態取得出生西元年份（例如：2000）
             * 3. 虛歲公式：(今年 - 出生年) + 1 （出生當下即算 1 歲）
             */
            $currentYear = (int)$todayDate->format('Y');
            $birthYear   = (int)$birthDate->format('Y');
            $nominalAge  = ($currentYear - $birthYear) + 1; // 計算出虛歲
            
            // 將生日物件格式化為標準的「年-月-日」格式
            $formattedDate = $birthDate->format('Y-m-d');
            
            // 組合成功訊息，使用 htmlspecialchars() 防止 XSS 攻擊
            $message = "您輸入的生日是：<strong>" . htmlspecialchars($formattedDate) . "</strong><br>";
            $message .= "您目前的民間傳統<span style='color: blue; font-weight: bold;'>【虛歲】</span>是：";
            $message .= "<span style='color: red; font-weight: bold; font-size: 1.2em;'>" . $nominalAge . "</span> 歲";
        }
        
    } catch (Exception $e) {
        // 格式錯誤攔截，防止網站當掉
        $message = "<span style='color: red;'>請輸入正確的日期格式！</span>";
    }
    
} else {
    $message = "請先透過表單提交您的生日。";
}
?>

<!DOCTYPE html>
<html lang="zh-Hant-TW">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>生日查詢結果（虛歲）</title>
</head>
<body>

  <!-- ========================================================================= -->
  <!-- 2. 【畫面單純輸出區】（放 body 內） -->
  <!-- ========================================================================= -->
  <div>
      <!-- 直接印出上面已經用虛歲公式計算完畢的訊息 -->
      <p><?php echo $message; ?></p>
  </div>

</body>
</html>
