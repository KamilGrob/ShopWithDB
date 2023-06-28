function split(address){ 
  var array = address.split(',');
    street = array[0], rest = array[1];
    var test = array[1].split(/ (.*)/s);
    var array2 = test[1].split(/ (.*)/s);
    zipcode = array2[0], city = array2[1];
    var addressData = {
        street: street,
        zipcode: zipcode,
        city: city
      };
      return addressData;
}
function submitForm(name, username, email, address, phone, company) {
    
  var splittedAddress = split(address);
  var data = {
    name: name,
    username: username,
    email: email,
    street: splittedAddress.street,
    zipcode: splittedAddress.zipcode,
    city: splittedAddress.city,
    phone: phone,
    company: company
  };
  $.ajax({
    type: 'GET', 
    url: 'partials/add.php',
    data: data,
    success: function(response) {
      console.log(response);
    },
    error: function(xhr, status, error) {
      console.error(error);
    }
  });
  window.location.href = 'index.php';
  }
