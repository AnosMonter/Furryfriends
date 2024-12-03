<main>
  <div class="rating">
    <p>Đánh giá tổng quan:</p>
    <form action="index.php?Page=danh_gia&ID=<?= $_GET['ID'].'&ID_Order_Detail='.$_GET['ID_Order_Detail'] ?>" method="post" class="form-danh-gia-san-pham">
      <div class="stars">
        <input type="radio" id="star5" name="star" value="5" onchange="get_rate()" />
        <label for="star5" title="5 stars"></label>
        <input type="radio" id="star4" name="star" value="4" onchange="get_rate()" />
        <label for="star4" title="4 stars"></label>
        <input type="radio" id="star3" name="star" value="3" onchange="get_rate()" />
        <label for="star3" title="3 stars"></label>
        <input type="radio" id="star2" name="star" value="2" onchange="get_rate()" />
        <label for="star2" title="2 stars"></label>
        <input type="radio" id="star1" name="star" value="1" onchange="get_rate()" />
        <label for="star1" title="1 star"></label>
      </div>
      <textarea id="review" name="Review" placeholder="Viết đánh giá của bạn..." value=""></textarea>
      <input type="hidden" name="Rate" id="Rating" value="">
      <input type="hidden" name="ID_DG" value="<?= $_GET['ID'] ?>">
      <input type="hidden" name="ID_Order_Detail" value="<?= $_GET['ID_Order_Detail'] ?>">
      <input type="submit" name="Sub_Rate" value="Đăng Đánh Giá" class="DDG">
    </form>
  </div>
</main>

<script>
  function get_rate() {
    const selectedRating = document.querySelector('input[name="star"]:checked').value;
    document.getElementById('Rating').value = selectedRating;
  }
</script>