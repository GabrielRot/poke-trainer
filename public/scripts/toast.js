let toastBox = document.getElementById('toast-box');

function showToast(pMsg, type) {
  let toast = document.createElement('div');

  let successMsg = `<i class="fa-solid fa-circle-check"></i> ${pMsg}`;
  let errorMsg   = `<i class="fa-solid fa-circle-xmark"></i> ${pMsg}`;
  let warningMsg = `<i class="fa-solid fa-triangle-exclamation"></i> ${pMsg}`;
  let infoMsg    = `<i class="fa-solid fa-circle-exclamation"></i> ${pMsg}`; 
  
  toast.classList.add('toast');


  if (type == 'error') {
    toast.classList.add('error');
    toast.innerHTML = errorMsg;

  } else if (type == 'warning') {
    toast.classList.add('warning');
    toast.innerHTML = warningMsg;

  } else if (type == 'info') {
    toast.classList.add('info');
    toast.innerHTML = infoMsg;

  } else if (type == 'success') {
    toast.classList.add('success');
    toast.innerHTML = successMsg;

  }

  toastBox.appendChild(toast);

  setTimeout(() => {
    toast.remove();
  }, 6000);
}