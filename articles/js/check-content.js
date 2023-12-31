//驗證文章標題有無輸入
const articleForm = document.getElementById("article-form");

articleForm.onsubmit = function (even) {
  let title = document.getElementsByName("title")[0].value;
  let image = document.getElementById("imageUpload").files[0];
  let category = document.querySelector("[name='category_id']").value;
  if (title == "") {
    showAlert("請輸入文章標題");
    even.preventDefault();
  } else if (!image) {
    showAlert("請上傳文章預覽圖片");
    even.preventDefault();
  } else if (category == "0" || category == "") {
    showAlert("請選擇文章分類");
    even.preventDefault();
  }
};

function showAlert(message) {
  const alertBar = document.querySelector("#alert-bar");
  const alertMessage = document.querySelector(".alert-message");
  alertMessage.textContent = message;
  alertBar.classList.remove("d-none");
}
