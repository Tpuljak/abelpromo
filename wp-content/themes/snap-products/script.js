window.onload = () => {
  var colourSwitches = document.querySelectorAll('.colour-switch');

  if (colourSwitches.length) {
    colourSwitches.forEach(cs => {
      cs.addEventListener('click', changeImageColour);
    });
    colourSwitches[0].setAttribute('active', '');
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