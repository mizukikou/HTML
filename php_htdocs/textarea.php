<?php
// =========================================================================
// 1. 【核心邏輯與資料處理區】（放最前面）
//    核心觀念：先在大腦攔截文字、進行安全過濾，並把結果封裝成一個變數。
// =========================================================================

// 初始化訊息變數，做為保底預設值
$message = "請先透過表單提交您的問題。";

/**
 * 攔截前端傳來的多行文字（Textarea）資料：
 * - trim($_GET['trouble']) !== ""：防止使用者只輸入空白鍵。
 */
if (isset($_GET['trouble']) && trim($_GET['trouble']) !== "") {
    
    $trouble = $_GET['trouble'];
    
    /**
     * 【重要優化】：多行文字換行處理
     * 使用者在 <textarea> 中按下 Enter 鍵產生的換行符號（\n），在 HTML 畫面上是看不出來的。
     * 1. 必須先用 htmlspecialchars() 過濾掉惡意駭客程式碼（防 XSS 攻擊）。
     * 2. 再用 nl2br() 函數將過濾後的換行符號自動轉換為網頁看得懂的 <br> 標籤，這樣畫面才會正確換行。
     */
    $message = "您輸入的問題是：<br>" . nl2br(htmlspecialchars($trouble, ENT_QUOTES, 'UTF-8'));
}
// 注意：PHP 程式碼結束後，必須加上結束標籤，否則下方的 <!DOCTYPE html> 會被當成 PHP 語法而報錯！
?>

<!DOCTYPE html>
<html lang="zh-Hant-TW">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>問題回報結果</title>
  <style>
      body { font-family: sans-serif; margin: 20px; line-height: 1.6; }
      .result-box { background: #f4f4f4; padding: 15px; border-radius: 5px; border-left: 5px solid #dc3545; display: inline-block; min-width: 300px; }
  </style>
</head>
<body>

    <!-- ========================================================================= -->
    <!-- 2. 【畫面單純輸出區】（放 body 內） -->
    <!--    核心觀念：這裡保持絕對乾淨，不重複寫 if 判斷，直接 echo 最上面算好的 $message。 -->
    <!-- ========================================================================= -->
    <div class="result-box">
        <!-- 
           直接輸出最上方大腦已經處理好、防禦好、換行好的結果。
           因為最上方有加入安全過濾，這裡可以安心印出。
        -->
        <p><?php echo $message; ?></p>
    </div>

</body>
</html>
