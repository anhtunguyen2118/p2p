(() => {
  'use strict';

  let mode = 1; // 1 = chạy tool, 2 = chỉ báo lỗi

  if (mode === 2) {
    console.error("❌ Đã limit");
    return;
  }

  let counter = 0; // Đếm số lần thao tác thành công

  async function run() {
    while (true) {
      try {
        const paymentButton = [...document.querySelectorAll('a')]
          .find(btn => (btn.textContent || '').includes('Tôi muốn thanh toán lệnh này'));

        if (paymentButton) {
          paymentButton.click();
          counter++;
          console.log(`${counter}. ✅ Đã thao tác đơn thành công`);

          // Nhấn Enter 10 lần, mỗi lần cách nhau 30ms
          for (let i = 0; i < 10; i++) {
            const enterEvent = new KeyboardEvent('keydown', {
              key: 'Enter',
              code: 'Enter',
              keyCode: 13,
              which: 13,
              bubbles: true
            });
            (document.activeElement || document.body).dispatchEvent(enterEvent);
            await new Promise(r => setTimeout(r, 30));
          }

          // Chờ 2 giây rồi lặp lại
          await new Promise(r => setTimeout(r, 2000));
        } else {
          console.log('Đang chờ đơn...');
          await new Promise(r => setTimeout(r, 120));
        }
      } catch (e) {
        // im lặng
      }
    }
  }

  run();
})();
