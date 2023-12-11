const allCheckbox = document.getElementById("all-checkbox");
const allInputs = document.querySelectorAll(".check-box");
const allDelsBtn = document.querySelector(".all-del");

// 勾選或取消勾選所有文章的checkbox
allCheckbox.addEventListener("change", function (e) {
  allInputs.forEach(function (checkbox) {
    //當allCheckbox的選中狀態觸發 change 事件時，e.target 就是它當時的checked屬性狀態
    checkbox.checked = e.target.checked;
  });
});

//收集所有被勾選checkbox的id
allDelsBtn.addEventListener("click", function () {
  let selectedIDs = [];
  let selectedTitles = [];
  document.querySelectorAll(".check-box:checked").forEach(function (selected) {
    selectedTitles.push(
      selected.closest("tr").querySelector(".post-title").textContent.trim()
    );
    selectedIDs.push(selected.value);
  });
  //console.log(selectedIDs);

  // 檢查是否至少選擇了一篇文章
  if (selectedIDs.length == 0) {
    alert("請選擇需要刪除的文章");
    return; //中斷執行
  }

  // 填充Modal中的文章列表-li
  const ulDelList = document.querySelector("#deleteArticleList");
  let delList = selectedTitles.map((title) => `<li>${title}</li>`).join("");
  ulDelList.innerHTML = delList;

  // 顯示Modal
  const confirmationModal = new bootstrap.Modal(
    document.getElementById("confirmationModal"),
    {
      keyboard: false,
    }
  );
  confirmationModal.show();

  //處理確認刪除
  document
    .getElementById("confirmDelete")
    .addEventListener("click", function () {
      //如果有選文章再傳送ajax
      $.ajax({
        method: "POST",
        url: "../articles/api/all-delete.php",
        dataType: "json",
        data: JSON.stringify({
          articleIDs: selectedIDs,
        }),
      })
        .done(function (reponse) {
          let status = reponse.status;
          let message = reponse.message;
          // 註冊Modal隱藏後的事件處理器
          $("#confirmationModal").on("hidden.bs.modal", function () {
            alert(message);
            if (status != 0) {
              window.location.reload();
            }
            $(this).off("hidden.bs.modal"); // 移除事件處理器，避免重複註冊
          });

          // 先關閉Modal
          confirmationModal.hide();
        })
        .fail(function (jqXHR, textStatus) {
          console.log("Request failed: " + textStatus);
        });
    });
});
