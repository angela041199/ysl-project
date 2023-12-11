<?php

// require_once("../db_connect.php");



// $password=md5('123');
// $sql="INSERT INTO ysl_admin (name, username, password)
// VALUES ('GNN 記者 犬拓', 'admin3', '$password')";




// Assuming $birthday is the user's birthday received from the form
$dateTime = new DateTime($birthday);
$birthdayMonth = $dateTime->format('m');

// Now, you can use $birthdayMonth in your SQL query
$sql = "INSERT INTO ysl_member (`id`, `name`, `account`, `password`, `phone`, `email`, `postalCode`, `address`, `birthday`, `gender`, `member_identity`, `created_at`, `valid`, `birthday_month`, `member`) VALUES

(2, '陳冠宇', 'chen.gy', '202CB962AC59075B964B07152D234B70', '0923456787', 'chen.gy@email.com', 242, '新北市三峽區明德路 20 號', '1994-12-07', 'Male', 2, '2022-01-07 09:06:30', 1, '$birthdayMonth', ''),
(3, '林雅琳', 'lin.yl', '202CB962AC59075B964B07152D234B70', '0934567891', 'lin.yl@email.com', 807, '高雄市前鎮區興仁路 15 號', '1994-12-08', 'Female', 3, '2022-01-08 08:07:56', 1, '$birthdayMonth', ''),
(4, '王瑞祥', 'wang.rx', '202CB962AC59075B964B07152D234B70', '0945678901', 'wang.rx@email.com', 407, '台中市西屯區東山路 8 號', '1994-12-09', 'Male', 4, '2022-01-09 20:50:07', 1, '$birthdayMonth', ''),
(5, '陳怡君', 'chen.yj', '202CB962AC59075B964B07152D234B70', '0967890144', 'chen.yj@email.com', 320, '桃園市中壢區文化路 45 號', '1994-12-10', 'Female', 5, '2022-01-10 17:15:42', 1, '$birthdayMonth', ''),
(6, '黃信宏', 'huang.xh', '202CB962AC59075B964B07152D234B70', '0967890122', 'huang.xh@email.com', 500, '彰化縣彰化市光復路 30 號', '1994-12-11', 'Male', 6, '2022-01-11 16:40:16', 1, '$birthdayMonth', ''),
(7, '蔡宛儒', 'tsai.wr', '202CB962AC59075B964B07152D234B70', '0978901234', 'tsai.wr@email.com', 600, '嘉義市東區民生路 12 號', '1994-12-12', 'Male', 7, '2022-01-12 22:22:22', 1, '$birthdayMonth', ''),
(8, '鄭家豪', 'zheng.jh', '202CB962AC59075B964B07152D234B70', '0989012345', 'zheng.jh@email.com', 704, '台南市北區北門路 88 號', '1994-12-13', 'Female', 8, '2022-01-13 21:14:38', 1, '$birthdayMonth', ''),
(9, '許雅文', 'xu.yw', '202CB962AC59075B964B07152D234B70', '0901234567', 'xu.yw@email.com', 360, '苗栗縣苗栗市府前路 6 號', '1994-12-14', 'Male', 9, '2022-01-14 12:15:23', 1, '$birthdayMonth', ''),
(10, '楊宗翰', 'yang.zh', '202CB962AC59075B964B07152D234B70', '0902345678', 'yang.zh@email.com', 260, '宜蘭縣宜蘭市民權路 18 號', '1994-12-15', 'Male', 10, '2022-01-15 14:14:14', 1, '$birthdayMonth', '')";


if($conn->query($sql)){
    echo "輸入成功";
}else{
    die("輸入失敗".$conn->error);
}

$conn->close();


