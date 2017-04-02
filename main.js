function checkForm() {
   var result = false;
    var retailer = document.getElementById('retailer');
if(retailer.selectedOptions[0].value!==''){
    result = true;
} else {
    result = false;
    alert('Retailer invalid');
}
    var product = document.getElementById('product');
    if(product.selectedOptions[0].value!==''){
        result = true;
    } else {
        result = false;
        alert('Product invalid');
    }
    var price = document.getElementById('price');
    if(product.selectedOptions[0].value!==''){
        result = true;
    } else {
        result = false;
        alert('Price invalid');
    }
    var result = false;
    var items = document.getElementById('items');
    if(items.selectedOptions[0].value!==''){
        result = true;
    } else {
        result = false;
        alert('Items invalid');
    }
    var result = false;
    var quarter = document.getElementById('quarter');
    if(quarter.selectedOptions[0].value!==''){
        result = true;
    } else {
        result = false;
        alert('Quarter invalid');
    }
    return result;
}