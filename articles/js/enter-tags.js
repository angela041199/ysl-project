document.addEventListener("DOMContentLoaded", function () {
  initializeTags();
  updateHiddenTagsInput(); //頁面加載後就更新隱藏input的值
});

//針對現有的標籤處理-初始化
function initializeTags() {
  const existTags = document.querySelectorAll(".tags-container .badge");
  existTags.forEach(function (tag) {
    addRemoveFunction(tag);
  });
}

function addRemoveFunction(tagElement) {
  //建立移除按鈕
  let cancelIcon = document.createElement("i");
  cancelIcon.className = "fa-regular fa-circle-xmark";
  cancelIcon.addEventListener("click", function () {
    tagElement.remove();
    //當移除標籤時，同時也更新隱藏input的值
    updateHiddenTagsInput();
  });
  tagElement.appendChild(cancelIcon);
}

const tagInput = document.querySelector(".tag-input");
tagInput.addEventListener("keypress", function (event) {
  if (event.key === "Enter") {
    //阻止按下 Enter 鍵時觸發默認的提交行為
    event.preventDefault();
    let tagVal = tagInput.value.trim();
    //如果有輸入tag
    if (tagVal) {
      addTag(tagVal);
      //使用者新增標籤後，即清空輸入框(將input的值設置為空字串)，以便使用者可以輸入下一個標籤
      this.value = "";
    }
  }
});

function addTag(value) {
  const tagsContainer = document.querySelector(".tags-container");
  const hiddenTagsInput = document.getElementById("hiddenTags");
  //製作標籤們
  let tag = document.createElement("span");
  tag.className = "badge";
  tag.textContent = value;

  addRemoveFunction(tag); // 應用移除邏輯

  tagsContainer.appendChild(tag);
  //當新增標籤時，同時也更新隱藏input的值
  updateHiddenTagsInput();
}

//更新存入隱藏的input
function updateHiddenTagsInput() {
  const tagsContainer = document.querySelector(".tags-container");
  const hiddenTagsInput = document.getElementById("hiddenTags");

  let tags = Array.from(tagsContainer.getElementsByClassName("badge")).map(
    function (tagElement) {
      return tagElement.textContent.trim();
    }
  );

  hiddenTagsInput.value = tags.join(",");
}

