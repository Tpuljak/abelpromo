console.log("js works?")

window.onload = () => {
  var colourSwitches = document.querySelectorAll('.colour-switch');

  if (colourSwitches) {
    colourSwitches.forEach(cs => {
      cs.addEventListener('click', changeImageColour);
    })
  }
}

function changeImageColour(e) {
  var cs = e.target;

  if (cs) {
    var colour = rgbToHex(cs.style.backgroundColor);

    document.querySelectorAll('[colour]').forEach(obj => obj.style.opacity = 0);

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