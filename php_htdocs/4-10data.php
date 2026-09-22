<?php
$fieldLabels = array(
    'username' => '姓名',
    'search' => '搜尋',
    'email' => '信箱1',
    'email2' => '信箱2',
    'url' => '網址',
    'tel' => '電話',
    'number' => '數字',
    'date' => '日期',
    'time' => '時間',
    'range' => '程度',
    'color' => '顏色',
);

$formData = array();
foreach ($fieldLabels as $name => $label) {
    $value = isset($_GET[$name]) && is_string($_GET[$name]) ? trim($_GET[$name]) : '';
    $formData[$name] = htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

$hasData = $formData['username'] !== '';
?>
<!DOCTYPE html>
<html lang="zh-Hant-TW">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>表單提交結果</title>
  <style>
    :root {
      font-family: "Noto Sans TC", "Microsoft JhengHei", sans-serif;
      color: #18332b;
      background: #eef4f1;
    }

    * { box-sizing: border-box; }

    body {
      display: grid;
      min-height: 100vh;
      margin: 0;
      padding: 24px;
      place-items: center;
    }

    .result-card {
      width: min(100%, 680px);
      padding: clamp(24px, 5vw, 40px);
      border: 1px solid #d5e3dd;
      border-radius: 12px;
      background: #ffffff;
      box-shadow: 0 16px 40px rgb(36 74 61 / 12%);
    }

    h1 { margin: 0 0 8px; font-size: clamp(1.5rem, 4vw, 2rem); }
    .summary { margin: 0 0 24px; color: #557067; }

    .data-table {
      width: 100%;
      border-collapse: collapse;
      overflow: hidden;
      border: 1px solid #d5e3dd;
      border-radius: 8px;
    }

    th, td { padding: 12px 14px; border-bottom: 1px solid #d5e3dd; text-align: left; }
    th { width: 30%; background: #eff8f3; color: #14563f; }
    tr:last-child th, tr:last-child td { border-bottom: 0; }
    .empty { padding: 16px; border-radius: 8px; background: #f3f6f5; color: #557067; }
    .back { display: inline-block; margin-top: 28px; color: #1d7053; font-weight: 700; }

    @media (max-width: 480px) {
      th, td { display: block; width: 100%; }
      th { padding-bottom: 4px; border-bottom: 0; }
      td { padding-top: 4px; }
    }
  </style>
</head>
<body>
  <main class="result-card">
    <h1>表單提交結果</h1>
    <?php if ($hasData) : ?>
      <p class="summary">以下是您送出的資料：</p>
      <table class="data-table">
        <tbody>
          <?php foreach ($fieldLabels as $name => $label) : ?>
            <tr>
              <th scope="row"><?php echo htmlspecialchars($label, ENT_QUOTES, 'UTF-8'); ?></th>
              <td><?php echo $formData[$name] !== '' ? $formData[$name] : '未填寫'; ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php else : ?>
      <p class="empty">尚未收到表單資料，請先填寫表單。</p>
    <?php endif; ?>
    <a class="back" href="4-10.html">返回表單</a>
  </main>
</body>
</html>
?>
<!DOCTYPE html>
<html lang="zh-Hant-TW">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
    <?php
    if (isset($_GET['username'])) {
        echo "姓名：" . $_GET['username'] . "<br>";
    }
    ?>
</body>
</html>