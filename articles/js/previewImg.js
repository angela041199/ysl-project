function previewImg(event) {
  var reader = new FileReader(); //FileReader 是一個內建的對象類型，用於讀取用戶電腦上的文件
  reader.onload = function () {
    var output = document.getElementById("preview");
    output.src = reader.result; //當讀取操作完成時，result 屬性包含一個數據URL
  };
  //event.target指的是觸發<input type="file">的onchange="previewImg(event)"事件
  //files[0]: 由於 files 是一個列表，files[0] 就是這個列表中的第一個元素，即用戶選擇的第一個文件。
  reader.readAsDataURL(event.target.files[0]);
}
