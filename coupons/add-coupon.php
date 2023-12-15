<?php 
require_once("../includes/connect_sever.php");

//類別SQL
$sqlType = "SELECT * FROM type WHERE valid = 1";
$resultType = $conn->query($sqlType);
$rowsType = $resultType->fetch_all(MYSQLI_ASSOC);

//time
//$time=date('Y-m-d H:i:s');
?>

<!doctype html>
<html lang="en">

<head>
  <title>Add coupon</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


  <?php
  include("../coupons/ysl-css.php");
  require_once("../includes/connect_sever.php");
  include("../style/admin-nav.php");
  include("../style/side-nav-js.php");

  ?>
  <style>
    .input-error {
      color: red;
    }
  </style>

</head>

<body class="sb-nav-fixed">
  <!-- Modal -->
  <!-- <div class="modal" tabindex="-1" id="alertModal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">新增成功</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>成功新增優惠券</p>
        </div>
        <div class="modal-footer">          
          <a href="coupon-list.php" class="btn btn-primary">確認</a>
        </div>
      </div>
    </div>
  </div> modal -->
  <div id="layoutSidenav">
    <div id="layoutSidenav_content">
      <?php include("../style/admin_dashboard.php");
      ?>
      <main>
        <div class="container-fluid px-4">
          <!-- Back to coupon list -->
          <ol class="breadcrumb mb-4  mt-3">
            <li class="breadcrumb-item"><a href="../style/admin_index.php">首頁</a></li>
            <li class="breadcrumb-item"><a href="coupon-list.php">行銷管理</a></li>
            <li class="breadcrumb-item"><a href="coupon-list.php">優惠券列表</a></li>
            <li class="breadcrumb-item active">新增優惠券</li>
          </ol>

          <!-- Add Coupon form start -->
          <form action="doAddCoupon.php" method="post" id="addCouponform" onsubmit="return validateForm()">
            <div class="row">
              <div class="mb-3 col-10">
                <label for="title" class="form-label">優惠券名稱<i class="fa-solid fa-circle-info ps-1" title="此資料必填"></i></label>
                <input type="text" class="form-control validate-input" id="title" placeholder="請輸入優惠券名稱（限20字元內）" name="title" maxlength="20" required>
                <span id="titleError" class="input-error pt-2"></span>
                <h6 class="small p-2 text-success">(日後不可修改優惠券名稱)</h6>
              </div>
              <div class="mb-3 col-10">
                <label for="coupon_code" class="form-label">優惠券代碼<i class="fa-solid fa-circle-info ps-1" title="此資料必填"></i></label>
                <div class="input-group">
                  <input type="text" class="form-control validate-input" id="randomCouponInput" placeholder="請輸入優惠券代碼，可自定義20字元內的數字、英文大小寫" name="coupon_code"  maxlength="20" required>
                  <button class="btn btn-warning" onclick="generateRandomCouponCode()">隨機生成一組代碼</button>
                </div>
                <span id="randomCouponInputError" class="input-error pt-2"></span>
                <h6 class="small p-2 text-success">(日後不可修改優惠券代碼)</h6>
              </div>
              <div class="mb-3 row">
                <div class="col-5">
                  <label for="discount_type" class="form-label">優惠券類型<i class="fa-solid fa-circle-info ps-1" title="此資料必填"></i></label>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="discount_type" id="percentage" value="percentage" required>
                    <label class="form-check-label" for="percentage">
                      依售價百分比折價
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="discount_type" id="amount" value="amount" required>
                    <label class="form-check-label" for="amount">
                      依優惠金額折價
                    </label>
                  </div>
                </div>
                <div class="col-5">
                  <label for="discount_value" class="form-label">優惠券折扣百分比(%)／折扣金額<i class="fa-solid fa-circle-info ps-1" title="此資料必填"></i></label>
                  <input type="text" class="form-control" id="discount_value" placeholder="請輸入折扣百分比(%)或折扣金額" name="discount_value" required>
                  <span id="discountValueError" class="input-error pt-2"></span>
                </div>
              </div>
              <div class="row">
                <div class="mb-3 col-5">
                  <label for="usage_times" class="form-label">可使用次數<i class="fa-solid fa-circle-info ps-1" title="此資料必填"></i></label>
                  <input type="number" class="form-control" id="usage_times" placeholder="請輸入可使用次數" name="usage_times" oninput="validateNumberInput(this)" required>
                  <span id="usage_timesError" class="input-error pt-2"></span>
                </div>
                <div class="mb-3 col-5">
                  <label for="price_rule" class="form-label">最低消費金額<i class="fa-solid fa-circle-info ps-1" title="此資料必填"></i></label>
                  <input type="number" class="form-control" id="price_rule" placeholder="請輸入最低消費金額" name="price_rule" oninput="validateNumberInput(this)" required>
                  <span id="price_ruleError" class="input-error pt-2"></span>
                </div>
              </div><!--row-->
              <div class="mb-3 row">
                <div class="col-5">
                  <label for="start_date" class="form-label">優惠券開始日期<i class="fa-solid fa-circle-info ps-1" title="此資料必填"></i></label>
                  <input type="date" class="form-control" id="start_date" name="start_date" min="<?=date("Y-m-d")?>" required>
                </div>
                <div class="col-5">
                  <label for="expiration_date" class="form-label">優惠券截止日期<i class="fa-solid fa-circle-info ps-1" title="此資料必填"></i></label>
                  <input type="date" class="form-control" id="expiration_date" name="expiration_date" min="" required>
                </div>
                <span id="dateError" class="input-error pt-2"></span>
              </div>
              <div class="row">
                <div class="mb-3 col-3">
                  <label for="applicable_scope" class="form-label">優惠券使用範圍<i class="fa-solid fa-circle-info ps-1" title="選擇全站或依商品類別使用"></i></label>
                  <select class="form-select" aria-label="applicable_scope" name="applicable_scope" id="applicable_scope" onchange="updateApplicableTypeOptions()" required>
                    <option>請選擇</option>
                    <option value="global">全站</option>
                    <option value="type">依商品類別</option>
                  </select>
                </div>
                <div class="mb-3 col-5">
                  <label for="applicable_type_id" class="form-label">優惠券使用商品類別<span class="small text-secondary ps-2">(若選擇全站使用不需填寫)</span></label>
                  <select class="form-select" aria-label="applicable_type_id" name="applicable_type_id">
                  <option selected>請選擇</option>
                    <?php foreach ($rowsType as $type): ?>                    
                    <option value=<?=$type['id']?>><?=$type['name']?></option>
                    <?php endforeach; ?>
                    <option value="0" id="global_option">全站使用</option>
                  </select>
                </div>
                <div class="mb-3 col-2">
                  <label for="status" class="form-label">優惠券狀態<i class="fa-solid fa-circle-info ps-1" title="是否開始使用"></i></label>
                  <select class="form-select" name="status" id="" required>
                    <option selected>請選擇</option>
                    <option value="0">尚不啟用</option>
                    <option value="1">上架使用</option>
                  </select>
                  <!-- <div class="form-check">
                  <input class="form-check-input" type="radio" name="status" id="status_1" value="1" required>
                  <label class="form-check-label" for="status_1">
                    可使用
                  </label>
                </div> -->
                  <!-- <div class="form-check">
                  <input class="form-check-input" type="radio" name="status" id="status_0" value="0" required>
                  <label class="form-check-label" for="status_0">
                    未啟用
                  </label>
                </div> -->
                </div>
              </div>
              <?php //endif; 
              ?>
              <div class="row">
                <!-- 要用modal 把按鈕從submit 變成button 加上submitForm函數 -->
                <!-- <button class="btn btn-warning my-3 col-4 offset-3" data-bs-toggle="modal" data-bs-target="#alertModal" type="button" onclick="submitForm()">建立優惠券</button> -->
                <button class="btn btn-warning my-3 col-4 offset-3" type="submit" >建立優惠券</button>
              </div>
            </div>

          </form>
      </main>
      <footer class="py-4 bg-light mt-auto">
        <?php include("../style/footer.php"); ?>
      </footer>
    </div><!--layoutSidenav_content"-->
  </div><!--layoutSidenav-->
  </div><!-- container -->
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
  </script>
  <!-- Jquery cdn -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
  </script>
  <!-- 隨機碼產生按鈕JS -->
  <script>
    function generateRandomCode(length) {
      const characters =
        '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      let randomCode = '';
      for (let i = 0; i < length; i++) {
        randomCode += characters.charAt(Math.floor(Math.random() * characters.length));
      }
      return randomCode;
    }

    function generateRandomCouponCode() {
      // 生成20個字元的隨機碼
      const randomCode = generateRandomCode(20);
      // 將隨機碼產生在input框框中
      document.getElementById('randomCouponInput').value = randomCode;
    }
  </script>
  <!-- 驗證截止日期不會早於開始日期 -->
  <script>
    let startDate = document.getElementById('start_date');
    let expirationDate = document.getElementById('expiration_date');

    function setMinDate(value){
      let str ="";
      let minValue = startDate.value;
      str = minValue;
      $("#expiration_date").attr("min", str);
    }
    startDate.addEventListener("change", setMinDate);
  </script>
  <!-- <script>
    function validateDate() {
      //獲得開始日期和截止日期的值
      let startDate = document.getElementById('start_date').value;
      let expirationDate = document.getElementById('expiration_date').value;
      //把日期字串轉換成date
      let startDateObj = new Date(startDate);
      let expirationDateObj = new Date(expirationDate);
      //清空日期錯誤訊息
      document.getElementById('dateError').innerHTML = '';
      //驗證截止日期是否早於開始日期
      if (expirationDateObj < startDateObj) {
        //顯示錯誤
        document.getElementById('dateError').innerHTML = '優惠券截止日期不可以早於開始日期';
        return false;
      } else {
        return true;
      }
    }
  </script> -->
  <!-- 驗證input -->
  <script>
    function validateNumberInput(inputElement) {
      let inputValue = inputElement.value.trim();
      let errorElementId = inputElement.id + 'Error';
      //清空錯誤訊息
      document.getElementById(errorElementId).innerHTML = '';

      //驗證是否為數字
      if (!/^\d+$/.test(inputValue)) {
        document.getElementById(errorElementId).innerHTML = '請輸入數字';
      }
    }

    function clearErrors() {
      //清空所有錯誤訊息
      let errorElements = document.getElementsByClassName('input-error');
      for (let i = 0; i < errorElements.length; i++) {
        errorElements[i].innerHTML = '';
      }
    }

    function validateDiscountValue() {
      let discountType = document.querySelector('input[name="discount_type"]:checked').value;
      let discountValueInput = document.getElementById('discount_value');
      let discountValue = discountValueInput.value.trim();
      //驗證discount_value是否為數字
      if (!/^\d+$/.test(discountValue)) {
        document.getElementById('discountValueError').innerHTML = '請輸入有效的數字';
        return false;
      }
      //優惠券類型為百分比時，驗證discount_value
      if (discountType === 'percentage') {
        discountValue = parseInt(discountValue);
        //驗證discount_value範圍        
        if (isNaN(discountValue) || discountValue < 0 || discountValue > 100) {
          document.getElementById('discountValueError').innerHTML = '請輸入有效的百分比（0-100）';
          return false;
        }
      }
      return true;
    }

    function validateForm() {
      clearErrors();
      //檢查可使用次數是否為數字
      validateNumberInput(document.getElementById('usage_times'));
      //檢查最低消費金額是否為數字
      validateNumberInput(document.getElementById('price_rule'));
      //日期驗證
      // let isDateValid = validateDate();
      //獲取輸入值：：驗證是否符合20字元內
      let inputs = document.getElementsByClassName('validate-input');
      //正規表達式：驗證是否符合20字元內
      let pattern = /^.{1,20}$/;
      //進行驗證：驗證是否符合20字元內
      for (let i = 0; i < inputs.length; i++) {
        let inputValue = inputs[i].value;
        let isValid = pattern.test(inputValue);
        //獲得錯誤提示
        let errorElement = document.getElementById(inputs[i].id + 'Error');
        //顯示驗證結果
        errorElement.innerHTML = isValid ? '' : '輸入內容必須在20字元內';
        //如果有資料沒通過驗證，就會返回false
        if (!isValid) {
          return false;
        }
      }

      if (!validateDiscountValue()) {
        return false;
      }
      //全部都通過：返回true
      return true;
    }
  </script>
  <!-- 增加type option的判定 -->
  <script>
    function updateApplicableTypeOptions() {
      let scopeSelect = document.getElementById('applicable_scope');
      let typeSelect = document.getElementsByName('applicable_type_id')[0];
      let globalOption = document.getElementById('global_option');

      if (scopeSelect.value === 'global') {
        typeSelect.value = '0';
        typeSelect.disabled = true;
        globalOption.style.display = "none";
      } else {
        typeSelect.disabled = false;
        if (scopeSelect.value === 'type') {
          // typeSelect.value = '';
          globalOption.style.display = "none";
        }
      }
    }
  </script>
  <!-- AJAX 表單提交
  <script>
    function submitForm(){
      clearErrors();
      if (validateForm()){
        //使用AJAX提交表單
        let form = document.getElementById('addCouponform');
        let formData = new FormData(form);

        let xhr = new XMLHttpRequest();
        xhr.open('POST', 'doAddCoupon.php', true);

        xhr.onload = function(){
          if(xhr.status === 200){
            //假設服務器響應為success
            if(xhr.responseText.trim() === 'success'){
              //成功就跳出Modal
              $('#alertModal').modal('show');
            }else{
              //表單還有其他錯誤
              console.log('表單提交失敗', xhr.responseText);
            }
          }
        };
      xhr.onerror = function(){
        console.log('請求失敗');
      };
      xhr.send(formData);
      }
    }
  </script> -->

</body>

</html>