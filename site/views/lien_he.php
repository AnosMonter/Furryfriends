<main>
    <div class="container">
        <div class="contact-page-layout">
            <div class="contact-left">
                <div class="contact-info">
                    <h2>Liên hệ với chúng tôi</h2>
                    <p><i class="fas fa-map-marker-alt"></i> QTSC 9 Building, Đ. Tô Ký, Tân Chánh Hiệp, Quận 12, Hồ Chí Minh, Việt Nam</p>
                    <p><i class="fas fa-phone"></i> 0987654321</p>
                    <p><i class="fas fa-envelope"></i> FURRYFRIENDS@GMAIL.COM</p>
                </div>
                <div class="contact-form">
                    <h2>Liên hệ với chúng tôi</h2>
                    <form action="index.php?Page=lien_he" method="post">
                        <input type="text" name="name" placeholder="Tên">
                        <input type="email" name="email" placeholder="Email">
                        <input type="text" name="phone" placeholder="SĐT">
                        <textarea name="message" placeholder="Nội Dung"></textarea>
                        <p id="warning" style="color:red; display:none;">Nội dung quá dài, tối đa 1000 từ.</p>
                        <button type="submit">Gửi Liên Hệ</button>
                    </form>
                </div>
            </div>
            <iframe class="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3918.486274709451!2d106.62966331480045!3d10.85382406083264!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317529292b2a1b1d%3A0x8d8f8f8f8f8f8f8f!2sFPT%20Polytechnic!5e0!3m2!1sen!2s!4v1616581234567!5m2!1sen!2s" allowfullscreen="" loading="lazy"></iframe>
        </div>
    </div>
</main>
<script>
  document.getElementById('message').addEventListener('input', function() {
    var text = this.value;
    var wordCount = text.split(/\s+/).filter(function(word) {
      return word.length > 0; // Loại bỏ khoảng trắng không có chữ
    }).length;

    if (wordCount > 1000) {
      document.getElementById('warning').style.display = 'block';
    } else {
      document.getElementById('warning').style.display = 'none';
    }
  });
</script>
