// // script.js

// document.addEventListener('DOMContentLoaded', function() {
//     const fileInput = document.getElementById('productImage');
//     const fileNameSpan = document.getElementById('file-name');
  
//     fileInput.addEventListener('change', function() {
//       if (fileInput.files.length > 0) {
//         fileNameSpan.textContent = fileInput.files[0].name;
//       } else {
//         fileNameSpan.textContent = '';
//       }
//     });
//   });
  

  document.addEventListener('click', function(e) {
    const dropdowns = document.getElementsByClassName('dropdown');
    for (let i = 0; i < dropdowns.length; i++) {
      const dropdownContent = dropdowns[i].querySelector('.dropdown-content');
      if (dropdownContent && !dropdowns[i].contains(e.target)) {
        dropdownContent.classList.remove('show');
      }
    }
  });
  
  document.querySelectorAll('.dropbtn').forEach(function(btn) {
    btn.addEventListener('click', function(e) {
      e.preventDefault();
      const dropdownContent = this.parentElement.querySelector('.dropdown-content');
      dropdownContent.classList.toggle('show');
    });
  });
  
  document.getElementById('lookupButton').addEventListener('click', function() {
    var productId = document.getElementById('productId').value;

    // Make an AJAX request to fetch the product details based on the product ID
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var product = JSON.parse(xhr.responseText);
            if (product) {
                document.getElementById('productName').value = product.product_name;
            } else {
                document.getElementById('productName').value = '';
                alert('Product not found!');
            }
        }
    };
    xhr.open('GET', 'fetch_product.php?productId=' + productId, true);
   
    xhr.send();
});