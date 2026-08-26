<?php
    $userName = $_GET['userName'];
    $userPWD = $_GET['userPWD'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
          table {
            width: 100%;               /* 表格寬度佔滿父容器的 100% */
            border-collapse: collapse; /* 關鍵：將雙線邊框「合併」為單一邊框，消除格子間的醜縫隙 */
            margin: 20px 0;            /* 表格的上下外距 20 像素，左右為 0 */
            font-size: 16px;           /* 設定表格內文字的大小 */
          }

          /* 同時把細邊框顏色套用在：表格本體、表頭格子(th)、資料格子(td) */
          table, th, td {
            border: 1px solid #cbd5e1; /* 全局格線為 1 像素寬、實線、淺灰色 */
          }

          /* 針對表格最外圍的一圈強化視覺 */
          table {
            border: 3px solid rgb(226, 16, 86); /* 最外圍大框線加粗為 3 像素、桃紅色 */
          }

          /* 控制所有格子的內襯距離與對齊 */
          th, td {
            padding: 12px 16px;        /* 格子內文字上下留白 12px，左右留白 16px */
            text-align: left;          /* 文字一律靠左對齊 */
          }

          /* 專屬表頭（th）的樣式 */
          th {
            background-color: rgb(226, 16, 86); /* 表頭整列背景填滿桃紅色 */
            color: white;              /* 表頭文字改為純白色 */
            font-weight: 600;          /* 字體加粗 */
          }

          /* 斑馬線效果：nth-child(even) 代表選取「所有偶數列（2, 4, 6...）」 */
          tbody tr:nth-child(even) {
            background-color: #f8fafc; /* 讓偶數列的背景變成極淡的灰色 */
          }

          /* 滑鼠懸停效果：當使用者的滑鼠游標移到資料列（tr）上方時觸發 */
          tbody tr:hover {
            background-color: #ffe4e6; /* 讓滑鼠指到的那一列瞬間變成淡淡的桃粉色 */
            cursor: pointer;           /* 讓滑鼠游標變成「超連結的手指形狀」 */
          }
    </style>
</head>
<body>
    <div>
        <table>
            <tr>
                <th>帳號</th>
                <th>密碼</th>
            </tr>
            <tr>
                <td><?php echo $userName; ?></td><td><?php echo $userPWD; ?></td>
            </tr>
        </table>
    </div>
</body>
</html>