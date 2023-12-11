<!doctype html>
<html lang="en">

<head>
  <title>Add coupon</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <?php
  include("../ysl_project/ysl-css.php");
  ?>
  <style>
    .input-error {
      color: red;
    }
  </style>

</head>

<body>
  <div class="container">
    <!-- Back to coupon list -->
    <div class="py-2">
      <a href="coupon-list.php" class="btn btn-warning" title="回到優惠券一覽列表"><i class="fa-solid fa-arrow-left"></i></a>
    </div>
    <!-- Add Coupon form start -->
    <form action="doAddCoupon.php" method="post" id="addCouponform" onsubmit="return validateForm()">
      <div class="mb-3">
        <label for="title" class="form-label">優惠券名稱：</label>
        <input type="text" class="form-control validate-input" id="title" placeholder="請輸入優惠券名稱（限20字元內）" name="title" required>
        <span id="titleError" class="input-error"></span>
      </div>
      <div class="mb-3">
        <label for="coupon_code" class="form-label">優惠券代碼：</label>
        <input type="text" class="form-control validate-input" id="randomCouponInput" placeholder="請輸入優惠券代碼，限20字元內的數字、英文大小寫" name="coupon_code" required>
        <span id="randomCouponInputError" class="input-error pt-1"></span>
        <h6 class="small text-secondary p-2">(可自定義20字元內的大小寫英文、數字混雜字元)</h6>
        <button class="btn btn-warning mb-3" onclick="generateRandomCouponCode()">隨機生成一組代碼</button>
        <div class="mb-3 row">
          <div class="col-6">
            <label for="discount_type" class="form-label">優惠券類型：</label>
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
          <div class="col-6">
            <label for="discount_value" class="form-label">優惠券折扣百分比／折扣金額：</label>
            <input type="text" class="form-control" id="discount_value" placeholder="請輸入折扣的百分比或是折扣金額" name="discount_value" required>
            <span id="discountValueError" class="input-error"></span>
          </div>
        </div>
        <div class="mb-3">
          <label for="usage_times" class="form-label">可使用次數：</label>
          <input type="text" class="form-control" id="usage_times" placeholder="請輸入可使用次數" name="usage_times" oninput="validateNumberInput(this)" required>
          <span id="usage_timesError" class="input-error"></span>
        </div>
        <div class="mb-3 row">
          <div class="col-6">
            <label for="start_date" class="form-label">優惠券開始日期：</label>
            <input type="date" class="form-control" id="start_date" name="start_date" required>
          </div>
          <div class="col-6">
            <label for="expiration_date" class="form-label">優惠券截止日期：</label>
            <input type="date" class="form-control" id="expiration_date" name="expiration_date" required>
          </div>
          <span id="dateError" class="input-error pt-1"></span>
        </div>
        <div class="mb-3">
          <label for="price_rule" class="form-label">最低消費金額：</label>
          <input type="text" class="form-control" id="price_rule" placeholder="請輸入最低消費金額" name="price_rule" oninput="validateNumberInput(this)" required>
          <span id="price_ruleError" class="input-error"></span>
        </div>
        <div class="mb-3">
          <label for="applicable_scope" class="form-label">優惠券使用範圍</label>
          <select class="form-select" aria-label="applicable_scope" name="applicable_scope" required>
            <option>請選擇優惠券使用範圍</option>
            <option value="global">全站</option>
            <option value="type">依類別</option>
          </select>
        </div>
        <?php //$applicableScope=$_POST["applicableScope"]
        ?>
        <?php //if($applicableScope == 2): 
        ?>
        <div class="mb-3">
          <label for="applicable_type_id" class="form-label">優惠券使用類別</label>
          <select class="form-select" aria-label="applicable_type_id" name="applicable_type_id">
            <option selected>請選擇優惠券使用類別</option>
            <option value="0">全站使用</option>
            <option value="1">RPG</option>
            <option value="2">AVG</option>
            <option value="3">ETC</option>
            <option value="4">ACT</option>
            <option value="5">SLG</option>
            <option value="6">ARPG</option>
            <option value="7">SRPG</option>
            <option value="8">RAC</option>
            <option value="9">SPG</option>
            <option value="10">STG</option>
            <option value="11">AAPG</option>
            <option value="12">FTG</option>
          </select>
        </div>
        <div class="mb-3">
          <label for="status" class="form-label">優惠券狀態：</label>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="status" id="status_1" value="1" required>
            <label class="form-check-label" for="status_1">
              可使用
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="status" id="status_0" value="0" required>
            <label class="form-check-label" for="status_0">
              未啟用
            </label>
          </div>
        </div>
        <?php //endif; 
        ?>
        <button class="btn btn-warning mb-3" type="submit">建立優惠券</button>
      </div>
    </form>

  </div>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
  </script>

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
  </script>
  <!-- 驗證input -->
  <script>
    function validateNumberInput(inputElement){
      let inputValue = inputElement.value.trim();
      let errorElementId = inputElement.id + 'Error';
      //清空錯誤訊息
      document.getElementById(errorElementId).innerHTML='';

      //驗證是否為數字
      if(!/^\d+$/.test(inputValue)){
        document.getElementById(errorElementId).innerHTML='請輸入數字';
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
        document.getElementById('discountValueError').innerHTML = '請輸入數字';
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
      let isDateValid = validateDate();
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
      
      if(!validateDiscountValue()){
        return false;
      }
      //全部都通過：返回true
      return isDateValid;
    }
  </script>

</body>

</html>