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
$(document).ready(function(){

   //Global to hold the JSON for the items received from the
   //REST get for whatever category the user requested. This
   //will cache the results so more info won't require another
   //request.
   var returnedItemsJson;

   //Function to handle adding the star rating. This will take
   //in the float star value and return the HTML for the stars.
   function addStars(rating)
   {
      var returnString = "<div class=\"card-footer\"><small class=\"text-muted\">";
      //Whole stars supported only
      var r = parseInt(rating);
      //Five stars is max
      var i;
      for(i = 0; i < 5; ++i)
      {
         if(r > 0)
         {
            returnString = returnString + '&#9733;';
            --r;
         }
         else
         {
            returnString = returnString + '&#9734;';
         }
      }

      //add ending tags
      returnString = returnString + '</small></div>';
      return returnString;
   }


   //Function to add the images to the modal image slider.
   //Taking in the JSON for the image it will add the iamges
   function addPicsToModal(imageJson)
   {
      var i;
      for( i = 0; i < imageJson.pics.length; i=i+1)
      {
         var indicatorText = "<li data-target=\"#modalCarousel\" data-slide-to=\""+i+"\"";
         var carouselText = "<div class=\"carousel-item";
         //First Image so make it active
         if(i == 0)
         {
            $("#detailItemModalSlide #modalCarousel #modalCarouselIndicators").text("");
            $("#detailItemModalSlide #modalCarousel #modalCarouselInner").text("");
            carouselText += " active";
            indicatorText += "class=\"active\"";
         }
         
         indicatorText += "></li>";
         carouselText += "\"> <img class=\"d-block img-fluid\" src=\""+imageJson.pics[i]["pic_location"]+"\"></div>";
         $("#detailItemModalSlide #modalCarousel #modalCarouselIndicators").append(indicatorText);
         $("#detailItemModalSlide #modalCarousel #modalCarouselInner").append(carouselText);
         
      }
   }

   
   //The main guts of the script. This will request the items from the REST interface
   //and then begin to print them to the page.
   var cat_name = $("#cat_p").text();
   $.get("/ecommerce/category/"+cat_name, function(data, status)
   {
      if(status == "success")
      {
         returnedItemsJson = JSON.parse(data);
         var objs = returnedItemsJson;
         var i;
         //Check that it was successful
         if(objs.success)
         {

            if(objs.result.records.length > 0)
            {
               $(".item-row").text("");
            }
            for(i = 0; i < objs.result.records.length; i=i+1)
            {
               var price = Number(objs.result.records[i]['price']);
               var newItemText = "<div class=\"col-lg-4 col-md-6 mb-4\"><div class=\"card h-100\">";
               if(objs.result.records[i].pics.length > 0)
               {
                  newItemText += "<a href=#\""+objs.result.records[i]['id']+"Item\"><img class=\"card-img-top\" src=\""+objs.result.records[i].pics[0]["pic_location"]+"\" alt=\"\"></a>";
               } 

               newItemText += "<div class=\"card-body\"><h4 class=\"card-title\"><a class=\"store_item_button\" id=\""+objs.result.records[i]['id']+"Item\" href=\"#"+objs.result.records[i]['id']+"Item\">"+objs.result.records[i]['name']+"</a></h4><h5>$"+price.toFixed(2)+"</h5><p class=\"card-text\">"+objs.result.records[i]['short_description']+"</p></div>" + addStars(objs.result.records[i]['rating']);

               $(".item-row").append(newItemText);
            }

            //Function to display the Modal for an item click. This will
            //be this sites "more info" for an item. 
            $(".store_item_button").click(function(){
               //Get the name of the item clicked
               var itemName = $(this).text();
               //Find the Cached JSON data about item
               var i;
               var itemJson = null;
               for( i = 0; i < returnedItemsJson.result.records.length; i=i+1)
               {  //Item found so stash it
                  if( returnedItemsJson.result.records[i]['name'] == itemName)
                  {
                     itemJson = returnedItemsJson.result.records[i];
                     break;
                  }
               }
               
               //Item found continue
               if( itemJson != null)
               {
                  addPicsToModal(itemJson);
                  $("#detailItemModal #detailItemModalTitle").text(itemJson["name"]);
                  $("#detailItemModal #detailItemModalBody").text(itemJson["description"]);
                  $("#detailItemModal").modal('show');
               }
            });
         }
         
      }
   });
 
    //$(".top-banner")
});

