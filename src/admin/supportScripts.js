//Copyright 2021 - Kyle Johnson
/* This program is free software: you can redistribute it and/or modify
   it under the terms of the GNU General Public License as published by
   the Free Software Foundation, either version 3 of the License, or
   (at your option) any later version.

   This program is distributed in the hope that it will be useful,
   but WITHOUT ANY WARRANTY; without even the implied warranty of
   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
   GNU General Public License for more details.

   You should have received a copy of the GNU General Public License
   along with this program.  If not, see <https://www.gnu.org/licenses/>.
*/

function GETRequest(name, element, para) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
      document.getElementById(element).innerHTML = xhttp.responseText;
    }
  };
  xhttp.open("GET", name+para, true);
  xhttp.send();
}

function _ajax_request(url, data, callback, method) {
    return jQuery.ajax({
        url: url,
        type: method,
        data: data,
        success: callback
    });
}

function PUTRequest(name, element, para) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
      document.getElementById(element).innerHTML = xhttp.responseText;
    }
    if (xhttp.readyState == 4 && xhttp.status == 400)
    {
      document.getElementById(element).innerHTML = xhttp.responseText;
    }
  };
  xhttp.open("POST", name, true);
  xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhttp.send(para);
}

function submit(){
   var form = document.getElementById("create_form");
   if(form != null)
   {
      var data = 
         "name="+form[0].value+"&description="+form[1].value+"&short_description="+form[2].value+"&price="+form[3].value+"&rating="+form[4].value+"&num_in_stock="+form[5].value+"&cat="+form[6].value+"&pic_location="+form[7].value;

      PUTRequest("api/products/create.php", "response-text", data);
   } 
}


$("#addButton").click(function() {
	submit();
});


