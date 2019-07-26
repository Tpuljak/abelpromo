window.onload = () => {
  var colourSwitches = document.querySelectorAll('.colour-switch');

  if (colourSwitches.length) {
    colourSwitches.forEach(cs => {
      cs.addEventListener('click', changeImageColour);
    });
    colourSwitches[0].setAttribute('active', '');
  }

  var colourDropdown = document.querySelector('.colour-dropdown');
  if (colourDropdown) {
    var cb = document.querySelector('.colour-box');
    cb.style.backgroundColor = colourDropdown.value;
    cb.style.opacity = 1;

    colourDropdown.addEventListener('change', (e) => {
      document.querySelector('.colour-box').style.backgroundColor = e.target.value;
    })
  }

  if (location.search.includes('search-focus=yes')) {
    var searchBar = document.querySelector('.search-input');

    if (searchBar) {
      searchBar.focus();
    }
  }
}

function changeImageColour(e) {
  var cs = e.target;

  if (cs) {
    var colourSwitches = document.querySelectorAll('.colour-switch');

    colourSwitches.forEach(obj => obj.removeAttribute('active'));
    colourSwitches.forEach(obj => {
      if (obj == cs) {
        obj.setAttribute('active', '');
      }
    })

    var colour = rgbToHex(cs.style.backgroundColor);

    var colours = document.querySelectorAll('[colour]');
    colours.forEach(obj => obj.style.opacity = 0);

    var target = document.querySelector('[colour=' + CSS.escape(colour) + ']');

    if (target) {
      target.style.opacity = 1;
    }
  }
}

//Hex is without leading #
function rgbToHex(col)
{
    if(col.charAt(0)=='r')
    {
        col=col.replace('rgb(','').replace(')','').split(',');
        var r=parseInt(col[0], 10).toString(16);
        var g=parseInt(col[1], 10).toString(16);
        var b=parseInt(col[2], 10).toString(16);
        r=r.length==1?'0'+r:r; g=g.length==1?'0'+g:g; b=b.length==1?'0'+b:b;
        var colHex=r+g+b;
        return colHex;
    }
}

function incrementQuantity(step) {
  var quantity = document.querySelector('.quantity--number');

  if (quantity) {
    quantity.innerHTML = parseInt(quantity.innerHTML) + step;
  }
}

function decrementQuantity(step, moq) {
  var quantity = document.querySelector('.quantity--number');

  if (quantity) {
    if (parseInt(quantity.innerHTML) - step >= moq) {
      quantity.innerHTML = parseInt(quantity.innerHTML) - step;
    }
  }
}

function redirectToOrder() {
  var productId = document.querySelector('[product-id]');
  if (productId) {
    productId = parseInt(productId.getAttribute('product-id'));
  }

  var activeColour = document.querySelector('.colour-switch[active]');
  
  activeColour = rgbToHex(activeColour.style.backgroundColor);

  var quantity = document.querySelector('.quantity--number');

  if (quantity) quantity = quantity.innerHTML;

  var materialCbxs = document.querySelectorAll('.material-checkbox');
  var options = new Array();

  materialCbxs.forEach(cb => {
    if (!cb.classList.contains('unchecked')) {
      options[cb.getAttribute('type')] = (cb.classList.contains('empty')) ? '0' : '1';
    }
  });

  var delivery = document.querySelector('.delivery-checkbox.checked');

  if (delivery) {
    delivery = delivery.getAttribute('type');
  }

  var customPackage = document.querySelector('.package-checkbox');

  if (customPackage && customPackage.classList.contains('checked')) {
    customPackage = 1;
  } else {
    customPackage = 0;
  }

  var origin = window.origin;
  if (window.location.pathname.includes('snap-products')) {
    origin += '/snap-products';
  }

  var queryString = '?';
  queryString += 'product_id=' + productId;

  for (var key in options) {
    queryString +=  '&' + key + '=' + options[key];
  }

  queryString += '&custom_package=' + customPackage;
  queryString += '&delivery=' + delivery;
  queryString += '&quantity=' + quantity;
  queryString += '&active_colour=' + activeColour;

  // console.log(queryString);
  window.location.href = origin + '/order' + queryString;
}

function checkedChanged(e) {
  if (e.classList.contains('delivery-checkbox')) {
    document.querySelectorAll('.delivery-checkbox').forEach(db => {
      if (db.classList.contains('checked')) {
        db.classList.remove('checked');
        db.classList.add('empty');
      }
    })
  }
  if (e.classList.contains('empty')) {
    e.classList.remove('empty');
    e.classList.add('checked');
  } else {
    e.classList.remove('checked');
    e.classList.add('empty');
  }
}

function sendOrder() {
  var productTitle = document.querySelector('.input--product-title');

  productTitle = productTitle ? productTitle.value : null;

  var activeColour = document.querySelector('.colour-dropdown');
  
  activeColour = activeColour ? activeColour.value : null;

  var quantity = document.querySelector('.quantity--number');

  if (quantity) quantity = quantity.innerHTML;

  var materialCbxs = document.querySelectorAll('.material-checkbox');
  var options = {};

  materialCbxs.forEach(cb => {
    if (!cb.classList.contains('unchecked')) {
      options[cb.getAttribute('type')] = (cb.classList.contains('empty')) ? '0' : '1';
    }
  });

  var delivery = document.querySelector('.delivery-checkbox.checked');

  if (delivery) {
    delivery = delivery.getAttribute('type');
  }

  var customPackage = document.querySelector('.package-checkbox');

  if (customPackage && customPackage.classList.contains('checked')) {
    customPackage = 1;
  } else {
    customPackage = 0;
  }

  var customer = new Object();

  customer.name = document.querySelector('input[name="name"]');

  if (customer.name) customer.name = customer.name.value;

  customer.email = document.querySelector('input[name="email"]');

  if (customer.email) customer.email = customer.email.value;

  customer.company = document.querySelector('input[name="company"]');

  if (customer.company) customer.company = customer.company.value;

  customer.phone = document.querySelector('input[name="phone"]');

  if (customer.phone) customer.phone = customer.phone.value;

  customer.pid = document.querySelector('input[name="PID"]');

  if (customer.pid) customer.pid = customer.pid.value;
  
  customer.address1 = document.querySelector('input[name="address"].address--1');

  if (customer.address1) customer.address1 = customer.address1.value;

  customer.address2 = document.querySelector('input[name="address"].address--2');

  if (customer.address2) customer.address2 = customer.address2.value;

  customer.city = document.querySelector('input[name="city"]');

  if (customer.city) customer.city = customer.city.value;

  customer.region = document.querySelector('input[name="region"]');

  if (customer.region) customer.region = customer.region.value;

  customer.postalCode = document.querySelector('input[name="postal"]');

  if (customer.postalCode) customer.postalCode = customer.postalCode.value;

  customer.country = document.querySelector('input[name="country"]');

  if (customer.country) customer.country = customer.country.value;

  customer.comment = document.querySelector('textarea[name="comment"]');

  if (customer.comment) customer.comment = customer.comment.value;

  var postObject = new Object();
  postObject.customerInfo = customer;
  postObject.productTitle = productTitle;
  postObject.productColour = activeColour;
  postObject.quantity = quantity;
  postObject.options = options;
  postObject.delivery = delivery;
  postObject.customPackage = customPackage;

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState === 4 && request.status === 200) {
      sendOrderCallback(postObject, request.response);
    }
  }

  var append = '';

  if (location.pathname.includes('snap-products')) {
    append += '/snap-products';
  }

  request.open('POST', location.origin + append + '/wp-json/api/order/send', true);
  request.send(JSON.stringify(postObject));
}

function sendOrderCallback(data, response) {
  console.log(response);
}

function loadMore() {
  var spinner = document.querySelector('.spinner');
  var loadMoreButton = document.querySelector('.load-more');

  loadMoreButton.style.display = 'none';
  spinner.style.display = 'block';

  var productsContainer = document.querySelector('.menu-grid');
  var products = document.querySelectorAll('.menu-grid-item');

  var offset = products.length;

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState === 4 && request.status === 200) {
      loadMoreCallback(request.response);
    }
  }

  var append = '';

  if (location.pathname.includes('snap-products')) {
    append += '/snap-products';
  }

  var filters = location.search || '';

  filters = filters.substring(1);

  var queryString = '?how-many=20&' + filters;
  queryString += '&offset=' + offset;

  request.open('POST', location.origin + append + '/wp-json/api/products/load-more' + queryString, true);
  request.send(null);
}

function loadMoreCallback (response) {
  var productsResponse = JSON.parse(response);
  var menuGrid = document.querySelector('.menu-grid')
  var productsArray = [];
  for (var prod in productsResponse) {
    productsArray.push(productsResponse[prod]);
  }

  productsArray = productsArray.chunk(5);

  var condition = 0;
  productsArray.forEach((products, index) => {
    if (index % 2 == 0) {
      condition = 2;
    } else {
      condition = 0;
    }

    products.forEach((product, pIndex) => {
      var element = '<article class="menu-grid-item ';
      if (pIndex == condition) {
        element += 'menu-item-big';
      }

      element += '">';
      element += '<img src="' + product.thumbnail + '" alt="" srcset="">';
      element += '</article>';

      menuGrid.innerHTML += element;
    })
  });


  var spinner = document.querySelector('.spinner');
  var loadMoreButton = document.querySelector('.load-more');
  var noMoreProductsButton = document.querySelector('.no-more-products');

  if (productsResponse == null) {
    noMoreProductsButton.style.display = 'block';
    spinner.style.display = 'none';
    loadMoreButton.style.display = 'none';
  } else {
    spinner.style.display = 'none';
    noMoreProductsButton.style.display = 'none';
    loadMoreButton.style.display = 'block';
  }
}

Object.defineProperty(Array.prototype, 'chunk', {
  value: function(chunkSize) {
    var array = this;
    return [].concat.apply([],
      array.map(function(elem, i) {
        return i % chunkSize ? [] : [array.slice(i, i + chunkSize)];
      })
    );
  }
})

function uploadFile() {
  document.querySelector('.file-input').click();
}

function uploadFileOnChange(e) {
  if(e.value.length === 0) {
    e.classList.add('empty')
  } else {
    e.classList.remove('empty')
  }
}

function clearFiles() {
  document.querySelector('.file-input').value = "";
  document.querySelector('.file-input').classList.add('empty')
}

function redirectTo(to) {
  window.location.href = to;
}