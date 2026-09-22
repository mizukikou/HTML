<?php
$county = filter_input(INPUT_GET, 'county', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
$county = is_array($county) ? array_values(array_filter($county, 'is_string')) : array();
$county = array_values(array_unique($county));
$escapedCounty = array_map(
    static fn(string $value): string => htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'),
    $county
);
?>

<!DOCTYPE html>
<html lang="zh-Hant-TW">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>居住縣市選擇結果</title>
  <style>
      :root { font-family: "Noto Sans TC", "Microsoft JhengHei", sans-serif; color: #18332b; background: #eef4f1; }
      * { box-sizing: border-box; }
      body { display: grid; min-height: 100vh; margin: 0; padding: 24px; place-items: center; }
      .result-box { width: min(100%, 560px); padding: clamp(24px, 5vw, 40px); border: 1px solid #d5e3dd; border-radius: 12px; background: #fff; box-shadow: 0 16px 40px rgb(36 74 61 / 12%); }
      h1 { margin: 0 0 8px; font-size: clamp(1.5rem, 4vw, 2rem); }
      .summary { margin: 0 0 20px; color: #557067; }
      .counties { display: flex; flex-wrap: wrap; gap: 10px; padding: 0; margin: 0; list-style: none; }
      .county { padding: 8px 14px; border-radius: 999px; background: #dff2e9; color: #14563f; font-weight: 700; }
      .empty { padding: 16px; border-radius: 8px; background: #f3f6f5; color: #557067; }
      .back { display: inline-block; margin-top: 28px; color: #1d7053; font-weight: 700; }
  </style>
</head>
<body>

    <div class="result-box">
        <h1>選擇結果</h1>
        <?php if ($escapedCounty) : ?>
            <p class="summary">您選擇的居住縣市共有 <?php echo count($escapedCounty); ?> 個：</p>
            <ul class="counties">
                <?php foreach ($escapedCounty as $value) : ?>
                    <li class="county"><?php echo $value; ?></li>
                <?php endforeach; ?>
            </ul>
        <?php else : ?>
            <p class="empty">尚未選擇任何縣市。</p>
        <?php endif; ?>
        <a class="back" href="select.html">返回重新選擇</a>
    </div>

</body>
</html>