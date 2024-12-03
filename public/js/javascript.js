let slideIndex = 1; // Đặt slideIndex ban đầu thành 1 để bắt đầu với slide đầu tiên
window.onload = function () {
    showSlides(slideIndex); // Gọi showSlides với slide đầu tiên khi trang tải
}

// Hàm hiển thị slide tương ứng
function showSlides(n) {
    let slides = document.getElementsByClassName("mySlides");

    if (slides.length === 0) return;

    // Kiểm tra nếu chỉ số n vượt qua số lượng slide, quay về slide đầu tiên
    if (n > slides.length) slideIndex = 1;
    if (n < 1) slideIndex = slides.length;

    // Ẩn tất cả các slide
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }

    // hiển thị slide hiện tại
    slides[slideIndex - 1].style.display = "block";

}

// Điều khiển các nút điều hướng
function plusSlides(n) {
    showSlides(slideIndex += n);
}


// Tự động chuyển đổi slide sau mỗi 5 giây
setInterval(() => {
    plusSlides(1);
}, 5000);


// xem thêm chi tiết sản phẩm
document.addEventListener("DOMContentLoaded", function () {
    const detailSection = document.getElementById("product-detail");
    const toggleBtn = detailSection.querySelector(".toggle-btn");

    toggleBtn.addEventListener("click", function () {
        if (detailSection.classList.contains("collapsed")) {
            detailSection.classList.remove("collapsed");
            detailSection.classList.add("expanded");
            toggleBtn.textContent = "Thu gọn";
        } else {
            detailSection.classList.remove("expanded");
            detailSection.classList.add("collapsed");
            toggleBtn.textContent = "Xem thêm";
        }
    });
});

function ShowDropdown() {
    const dropdown = document.querySelector('.dropdown');
    dropdown.style.display = 'block';
    console.log('Hover');
}

function HideDropdown() {
    const dropdown = document.querySelector('.dropdown');
    dropdown.style.display = 'none';
    console.log('Hide');
}

function updateQuantity(index, change) {
    var quantityElement = document.getElementById('quantity-' + index);
    var maxQuantity = document.getElementById('max-quantity-in-product-' + index).value;
    var quantity = parseInt(quantityElement.innerText);
    var newQuantity = quantity + change;
    if (quantity == maxQuantity && change == 1) {exit()};
    if (newQuantity < 1) return; 
    quantityElement.innerText = newQuantity;
    var price = Cart[index][3];
    var discount = Cart[index][6];
    var newTotal = newQuantity * discount;
    document.getElementById('total-' + index).innerText = newTotal.toLocaleString() + 'đ';
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "index.php?Page=gio_hang", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = JSON.parse(xhr.responseText);
            document.getElementById('tongtien').innerText = 'Tổng: ' + response.totalPrice.toLocaleString() + 'đ';
        }
    };
    xhr.send("update_quantity=true&idcart=" + index + "&newQuantity=" + newQuantity);
}