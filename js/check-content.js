//驗證文章標題有無輸入
const articleForm = document.getElementById("article-form");
articleForm.onsubmit = function (even) {
  let title = document.getElementsByName("title")[0].value;

  if (title == "") {
    showAlert("請輸入文章標題");
    even.preventDefault();
  }
};

function showAlert(message) {
  const alertBar = document.querySelector("#alert-bar");
  const alertMessage = document.querySelector(".alert-message");
  alertMessage.textContent = message;
  alertBar.classList.remove("d-none");
}
