function validateForm(input) {
  var ptrn = /^([^0-9]*)$/,
    ptrn2 = /[!@#$%^&*]/,
    mailptrn = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
    name = input.name,
    phone = input.phone,
    email = input.email,
    message = input.message;
    
  if (!ptrn.test(name.value)) {
    name.nextElementSibling.innerHTML = "Please Do not use Numbers";
    return false;
  } else if (name.value.search(ptrn2) != -1) {
    name.nextElementSibling.innerHTML = "Please Do not Special Characters";
    return false;
  } else if (name.value.length < 3) {
    name.nextElementSibling.innerHTML = "Name is Too Short Enter Min 3 Char";
    return false;
  } else {
    name.nextElementSibling.innerHTML = "";
  }


  if (!mailptrn.test(String(email.value).toLowerCase())) {
    email.nextElementSibling.innerHTML = "Email is Not Vaild";
    return false;
  } else {
    email.nextElementSibling.innerHTML = "";
  }


  if (ptrn.test(phone.value)) {
    phone.nextElementSibling.innerHTML = "Please Enter Valid Number";
    return false;
  } else if (phone.value.length > 10 || phone.value.length < 10) {
    phone.nextElementSibling.innerHTML = "Please Enter 10 Digit number";
    return false;
  } else if (phone.value.search(ptrn2) != -1) {
    phone.nextElementSibling.innerHTML = "Please Do Not Use Special Characters";
    return false;
  } else {
    phone.nextElementSibling.innerHTML = "";
  }

  if (message.value =="") {
    message.nextElementSibling.innerHTML = "Please Type Something in Message";
    return false;
  } else {
    message.nextElementSibling.innerHTML = "";
  }
  return true;
}
// document.myform.name.addEventListener('keyup',validateForm);
// document.myform.phone.addEventListener('keyup',validateForm);
// document.myform.email.addEventListener('keyup',validateForm);
// document.myform.message.addEventListener('keyup',validateForm);
