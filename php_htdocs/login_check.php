<?php
// 初始化變數，避免 HTML 抓不到而報錯
$login_status = "";
$user_info = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // 1. 安全接收 POST 參數
    $username = isset($_POST['userName']) ? $_POST['userName'] : '';
    $password = isset($_POST['userPWD']) ? $_POST['userPWD'] : '';
    
    // 2. 建立一條共用的資料庫連線
    $conn = mysqli_connect("127.0.0.1", "root", "", "mydb");
    
    if ($conn) {
        mysqli_set_charset($conn, "utf8mb4");
        
        // 防止 SQL 注入攻擊的安全防護轉義
        $safe_username = mysqli_real_escape_string($conn, $username);
        $safe_password = mysqli_real_escape_string($conn, $password);
        
        // 🚀 修改點：在 SELECT 指令中多加入 login_time 欄位
        $sql = "SELECT username, password, login_time FROM users WHERE username = '$safe_username' AND password = '$safe_password'";
        $result = mysqli_query($conn, $sql);
        
        // 4. 如果資料庫有找到剛好符合的一筆資料
        if ($result && mysqli_num_rows($result) > 0) {
            $user_info = mysqli_fetch_assoc($result);
            $login_status = "登入成功";
            
            // 5. 登入成功後，立刻在「同一個連線下」更新資料庫中的 login_time 欄位為最新當前時間
            $update_sql = "UPDATE users SET login_time = NOW() WHERE username = '$safe_username'";
            mysqli_query($conn, $update_sql);
            
            // 🚀 貼心優化：將畫面上要顯示的時間，同步更新為「剛剛寫入的當下時間」
            $user_info['login_time'] = date('Y-m-d H:i:s');
            
        } else {
            $login_status = "登入失敗";
        }
        
        // 6. 所有資料庫操作結束後，最後「只關閉一次」連線
        mysqli_close($conn);
    } else {
        $login_status = "資料庫連線失敗";
    }
}
?>

<!DOCTYPE html>
<html lang="zh-Hant-TW">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>登入結果</title>
  <style>
    body { font-family: Arial, sans-serif; margin: 20px; line-height: 1.6; }
    .status { font-weight: bold; font-size: 1.2rem; }
    .success { color: green; }
    .error { color: red; }
    .info-box { background: #f4f4f4; padding: 15px; border-radius: 5px; margin-top: 15px; width: 350px; }
  </style>
</head>
<body>

    <!-- 顯示登入狀態 -->
    <?php if ($login_status !== ""): ?>
        <p class="status <?php echo ($login_status === '登入成功') ? 'success' : 'error'; ?>">
            系統訊息：<?php echo htmlspecialchars($login_status); ?>
        </p>
    <?php endif; ?>

    <!-- 登入成功後才顯示使用者資訊區塊 -->
    <?php if ($user_info): ?>
        <div class="info-box">
            <h3>目前登入使用者資訊</h3>
            <p>使用者名稱：<?php echo htmlspecialchars($user_info['username']); ?></p>
            <p>資料庫密碼：<?php echo htmlspecialchars($user_info['password']); ?></p>
            <!-- 🚀 修改點：在畫面上多渲染出登入時間 -->
            <p>登入時間：<?php echo htmlspecialchars($user_info['login_time']); ?></p>
        </div>
    <?php endif; ?>

</body>
</html>
