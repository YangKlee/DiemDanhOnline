let stream;
const camera = document.getElementById('camera');
const startBtn = document.getElementById('startScan');
const stopBtn = document.getElementById('stopScan');
const resultEl = document.getElementById('scanResult');

// Demo: mô phỏng quét QR sau 2s
async function start() {
  try {
    stream = await navigator.mediaDevices.getUserMedia({ video: { facingMode: 'environment' } });
    camera.srcObject = stream;
    resultEl.textContent = 'Đang quét...';
    setTimeout(() => {
      const payload = { code: 'DD101', class: 'CT101', window: '08:00 - 08:10' };
      resultEl.innerHTML = `Đã đọc QR: <strong>${payload.code}</strong> – ${payload.class} (${payload.window})`;
      const form = document.createElement('form');
      form.method = 'post'; form.action = '/views/student/qr_confirm.php';
      const input = document.createElement('input');
      input.name = 'session_code'; input.value = payload.code;
      form.appendChild(input); document.body.appendChild(form); form.submit();
    }, 10000);
  } catch (e) {
    resultEl.textContent = 'Không thể truy cập camera.';
  }
}

function stop() {
  if (stream) {
    stream.getTracks().forEach(t => t.stop());
    resultEl.textContent = 'Đã dừng quét.';
  }
}

document.addEventListener('DOMContentLoaded', () => {
  startBtn.addEventListener('click', start);
  stopBtn.addEventListener('click', stop);
});
