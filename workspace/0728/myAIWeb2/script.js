document.addEventListener('DOMContentLoaded', function () {
  
  // 1. 自動填入與限制訂位日期（不能選擇過去日期）
  const dateInputs = document.querySelectorAll('input[type="date"]');
  const today = new Date().toISOString().split('T')[0];
  dateInputs.forEach(input => {
    input.min = today;
    if (!input.value) input.value = today;
  });

  // 2. 美味菜單頁面 (menu.html) 的分類篩選功能
  const filterBtns = document.querySelectorAll('.filter-btn');
  const menuItems = document.querySelectorAll('.menu-item');

  if (filterBtns.length > 0) {
    filterBtns.forEach(btn => {
      btn.addEventListener('click', function () {
        filterBtns.forEach(b => b.classList.remove('active'));
        this.classList.add('active');

        const filterValue = this.getAttribute('data-filter');

        menuItems.forEach(item => {
          if (filterValue === 'all' || item.getAttribute('data-category') === filterValue) {
            item.style.display = 'block';
          } else {
            item.style.display = 'none';
          }
        });
      });
    });
  }

  // 3. 訂位表單送出監聽
  const bookingForms = document.querySelectorAll('form');
  bookingForms.forEach(form => {
    form.addEventListener('submit', function (e) {
      e.preventDefault();
      alert('感謝您的預約！我們已收到您的資訊，將盡快傳送確認簡訊至您的手機。');
      form.reset();
    });
  });

});