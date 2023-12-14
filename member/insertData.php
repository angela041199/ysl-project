<?php

require_once("../db_connect.php");



// $password=md5('123');
// $sql="INSERT INTO ysl_admin (name, username, password)
// VALUES ('GNN 記者 犬拓', 'admin3', '$password')";




// Assuming $birthday is the user's birthday received from the form
$dateTime = new DateTime($birthday);
$birthdayMonth = $dateTime->format('m');

// Now, you can use $birthdayMonth in your SQL query
$sql = "INSERT INTO ysl_member (`id`, `name`, `account`, `password`, `phone`, `email`, `postalCode`, `address`, `birthday`, `gender`, `member_identity`, `created_at`, `valid`, `birthday_month`, `member`) VALUES


(11, '范欣怡', 'fan.xy', '202CB962AC59075B964B07152D234B70', '0903456789', 'fan.xy@email.com', 970, '花蓮縣花蓮市新興路 25 號', '1994-12-16', 'Female', 0, '2022-01-16 18:20:25', 1, '$birthdayMonth', ''),
(12, '朱志明', 'zhu.zm', '202CB962AC59075B964B07152D234B70', '0904567890', 'zhu.zm@email.com', 200, '基隆市仁愛區中正路 33 號', '1994-12-17', 'Male', 0, '2022-01-17 19:36:26', 1, '$birthdayMonth', ''),
(13, '邱佳琪', 'qiu.jq', '202CB962AC59075B964B07152D234B70', '0905678901', 'qiu.jq@email.com', 640, '雲林縣斗六市復興路 14 號', '1994-12-18', 'Female', 0, '2022-01-18 20:07:35', 1, '$birthdayMonth', ''),
(14, '余宗翰', 'yu.zh', '202CB962AC59075B964B07152D234B70', '0906789012', 'yu.zh@email.com', 900, '屏東縣屏東市中山路 22 號', '1994-12-19', 'Male', 0, '2022-01-19 19:07:05', 1, '$birthdayMonth', ''),
(15, '張雅琴', 'zhang.yq', '202CB962AC59075B964B07152D234B70', '0907890123', 'zhang.yq@email.com', 540, '南投縣南投市南崗路 11 號', '1994-12-20', 'Female', 0, '2022-01-20 06:05:38', 1, '$birthdayMonth', ''),
(16, '洪家瑋', 'hong.jw', '202CB962AC59075B964B07152D234B70', '0908901234', 'hong.jw@email.com', 612, '嘉義縣太保市中山路 9 號', '1994-12-21', 'Male', 0, '2022-01-21 08:12:56', 1, '$birthdayMonth', ''),
(17, '周思婷', 'zhou.st', '202CB962AC59075B964B07152D234B70', '0909012345', 'zhou.st@email.com', 893, '金門縣金城鎮民生路 7 號', '1994-12-22', 'Female', 0, '2022-01-22 18:06:39', 1, '$birthdayMonth', ''),
(18, '葉宗翰', 'ye.zh', '202CB962AC59075B964B07152D234B70', '0910123456', 'ye.zh@email.com', 880, '澎湖縣馬公市中正路 55 號', '1994-12-23', 'Male', 0, '2022-01-23 17:05:05', 1, '$birthdayMonth', ''),
(19, '彭佳玲', 'peng.jl', '202CB962AC59075B964B07152D234B70', '0911234567', 'peng.jl@email.com', 302, '新竹縣竹北市光明路 26 號', '1994-12-24', 'Female', 0, '2022-01-24 07:15:09', 1, '$birthdayMonth', ''),
(20, '許家豪', 'xu.jh', '202CB962AC59075B964B07152D234B70', '0912345678', 'xu.jh@email.com', 201, '基隆市信義區信義路 17 號', '1994-12-25', 'Male', 0, '2022-01-25 12:24:07', 1, '$birthdayMonth', ''),
(21, '鄭心怡', 'zhengxinyi', '202CB962AC59075B964B07152D234B70', '0923456789', 'zhengxinyi@email.com', 104, '台北市中正區忠孝東路一段100號', '1992-08-15', 'Female', 0, '2023-01-11 15:15:28', 1, '$birthdayMonth', ''),
(22, '許彥宇', 'xuyanyu', '202CB962AC59075B964B07152D234B70', '0912345676', 'xuyanyu@email.com', 220, '新北市板橋區文化路二段200號', '1986-04-25', 'Male', 0, '2023-01-12 06:09:03', 1, '$birthdayMonth', ''),
(23, '張雅琪', 'zhangyaqi', '202CB962AC59075B964B07152D234B70', '0934567890', 'zhangyaqi@email.com', 402, '台中市南區建國北路300號', '1996-11-03', 'Female', 0, '2023-01-13 03:06:09', 1, '$birthdayMonth', ''),
(24, '謝政宏', 'xiezhenghong', '202CB962AC59075B964B07152D234B70', '0956789011', 'xiezhenghong@email.com', 811, '高雄市楠梓區德民路四段400號', '1983-02-12', 'Male', 0, '2023-01-14 07:42:08', 1, '$birthdayMonth', ''),
(25, '林婷婷', 'lintingting', '202CB962AC59075B964B07152D234B70', '0930123456', 'lintingting@email.com', 701, '台南市中西區民權路五段500號', '1989-07-28', 'Female', 0, '2023-01-15 08:52:49', 1, '$birthdayMonth', ''),
(26, '葉志明', 'yezhiming', '202CB962AC59075B964B07152D234B70', '0967890123', 'yezhiming@email.com', 500, '彰化市彰化區和平路六段600號', '1994-09-05', 'Male', 0, '2023-01-16 05:04:16', 1, '$birthdayMonth', ''),
(27, '吳雅芬', 'wuyafen', '202CB962AC59075B964B07152D234B70', '0932345678', 'wuyafen@email.com', 202, '基隆市仁愛區中正路七段700號', '1981-12-22', 'Female', 0, '2023-01-17 16:24:36', 1, '$birthdayMonth', ''),
(28, '洪志偉', 'hongzhiwei', '202CB962AC59075B964B07152D234B70', '0918765432', 'hongzhiwei@email.com', 300, '新竹市東區民生路八段800號', '1999-05-30', 'Male', 0, '2023-01-18 18:18:35', 1, '$birthdayMonth', ''),
(29, '蔡雅琪', 'caiyaqi', '202CB962AC59075B964B07152D234B70', '0954321098', 'caiyaqi@email.com', 600, '嘉義市西區仁愛路九段900號', '1988-08-25', 'Female', 0, '2023-01-19 10:22:48', 1, '$birthdayMonth', ''),
(30, '陳俊宇', 'chenjunyu', '202CB962AC59075B964B07152D234B70', '0987654321', 'chenjunyu@email.com', 900, '屏東市林森路十段1000號', '1992-03-14', 'Male', 0, '2023-01-11 13:01:05', 1, '$birthdayMonth', '')";


if($conn->query($sql)){
    echo "輸入成功";
}else{
    die("輸入失敗".$conn->error);
}

$conn->close();


