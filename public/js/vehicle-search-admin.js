!function(e){var t={};function a(s){if(t[s])return t[s].exports;var i=t[s]={i:s,l:!1,exports:{}};return e[s].call(i.exports,i,i.exports,a),i.l=!0,i.exports}a.m=e,a.c=t,a.d=function(e,t,s){a.o(e,t)||Object.defineProperty(e,t,{configurable:!1,enumerable:!0,get:s})},a.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return a.d(t,"a",t),t},a.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},a.p="",a(a.s=44)}({44:function(e,t,a){e.exports=a(45)},45:function(e,t){var a=void 0===window.vehicles?[]:window.vehicles,s=window.site_name,i=[],n=[],l=[],c=[],r=[],d="All",o="All",v="All",h="Any",u="Ascending",f="All";function p(e,t){return e.name>t.name?-1:e.name<t.name?1:0}function g(e,t){return e.name<t.name?-1:e.name>t.name?1:0}function _(e,t,a){""===a[t]&&(a[t]="N/A"),e.includes(a[t])||e.push(a[t])}function m(e){var t=null!==e.next_reservation,a=null!==e.active_hire,i="",n="";return i=t?"ID ["+e.next_reservation.name+"]<br>"+e.next_reservation.start_date+" to<br>"+e.next_reservation.end_date:"No reservations",n=a?"ID ["+e.active_hire.name+"]<br>"+e.active_hire.start_date+" to<br>"+e.active_hire.end_date:"No active hire",'<div class="col-lg-4 col-md-6 col-sm-12">                     <div class="panel panel-default">                       <div class="panel-heading vehicle-panel-admin-heading">                         <h3>'+e.make+" "+e.model+"</h3>                       </div>"+function(e){var t=e.images.length>0,a=s+"admin/vehicles/"+e.slug;return t?'<div class="vehicle-img">                     <img class="admin" src="'+(s+e.images[0].image_uri)+'" alt="'+e.make+" "+e.model+" - "+e.images[0].name+'">                     <button class="btn btn-info vehicle-img-button vehicle-open-modal" data-vehicle="'+e.slug+'">View images</button>                     <a href="'+a+'" class="btn btn-info vehicle-dashboard-button">Dashboard</a>                 </div>':'<div class="vehicle-img">                   <div class="vehicle-img-na">                     <h2 class="admin"><span class="glyphicon glyphicon-picture"></span>&nbsp;&nbsp;No Image(s)</h2>                   </div>                   <a href="'+a+'" class="btn btn-info vehicle-dashboard-button">Dashboard</a>                 </div>'}(e)+'<table class="table table-condensed vehicle-table-admin">                         <tr>                           <th class="first">ID</th>                           <td class="first">'+e.id+"</td>                         </tr>                         <tr>                           <th>Status</th>                           <td>"+e.status+"</td>                         </tr>                         <tr>                           <th>Vehicle Type</th>                           <td>"+e.type+"</td>                         </tr>                         <tr>                           <th>Fuel Type</th>                           <td>"+e.fuel_type+"</td>                         </tr>                         <tr>                           <th>Gear Type</th>                           <td>"+e.gear_type+"</td>                         </tr>                         <tr>                           <th>Seats</th>                           <td>"+e.seats+"</td>                         </tr>                         <tr>                           <th>Next Reservation</th>                           <td>"+i+'</td>                         </tr>                         <tr>                           <th class="last">Active Hire</th>                           <td class="last">'+n+"</td>                         </tr>                       </table>                     </div>                 </div>"}function y(e,t,a){for(var s=$("#"+t),i="",n="",l=0;l<a.length;l++)n="vehicle_type"===e&&0===l||"vehicle_type"!==e?"":"s",i+='<li class="'+(0===l?"active ":"")+(0===l?e+"_all":"")+'">                     <a data-toggle="pill" class="btn">'+a[l]+n+"</a>                 </li>";s.append(i)}function b(){var e=$("#vehicle-search-results");e.empty(),"Ascending"===u?a.sort(g):a.sort(p);for(var t="",s=0;s<a.length;s++){var i=a[s].type===d||"All"===d,n=a[s].fuel_type===v||"All"===v,l=a[s].gear_type===o||"All"===o,c=a[s].seats===h||"Any"===h,r=a[s].status===f||"All"===f;i&&n&&l&&c&&r&&(t+=m(a[s]))}var _=t.length>0;_||(t='<div class="col-lg-12"><h1 style="text-align: center">No Vehicles Found</h1><h3 style="text-align: center">Selected options didn\'t match any vehicles</h3></div>');t='<article class="'+(_?"tab-pane ":"tab-pane-no-vehicles ")+'fade in" id="vehicle-search-results-tab">'+t+"</article>",e.append(t),e.tab("show")}$(document).ready(function(){!function(){for(var e=0;e<a.length;e++)_(i,"type",a[e]),_(n,"gear_type",a[e]),_(l,"fuel_type",a[e]),_(c,"seats",a[e]),_(r,"status",a[e]);i.sort(),i.unshift(d),n.sort(),n.unshift(o),l.sort(),l.unshift(v),c.sort(),c.unshift(h),r.sort(),r.unshift(f)}(),console.log(a),y("vehicle_type","vehicle_types",i),y("fuel_type","fuel_types",l),y("gear_type","gear_types",n),y("seats","seats",c),y("status","vehicle_states",r),b(),$("#vehicle_types").find("a").click(function(e){"All"!==(d=$(this).text())&&(d=d.slice(0,d.length-1)),b()}),$("#fuel_types").find("a").click(function(e){v=$(this).text(),b()}),$("#gear_types").find("a").click(function(e){o=$(this).text(),b()}),$("#seats").find("a").click(function(e){h=$(this).text(),b()}),$("#vehicle_states").find("a").click(function(e){f=$(this).text(),b()}),$("#vehicle-sort-ascending").find("a").click(function(e){$("#vehicle-sort-descending").removeClass("active"),u="Ascending",b(),$(this).parent().addClass("active")}),$("#vehicle-sort-descending").find("a").click(function(e){$("#vehicle-sort-ascending").removeClass("active"),u="Descending",b(),$(this).parent().addClass("active")}),$("#vehicle-search-reset").click(function(){console.log("Resetting vehicle search results"),d=i[0],v=l[0],o=n[0],h=c[0],u="Ascending",f=r[0],b(),$("#vehicle_types").find("li.active").removeClass("active"),$("#vehicle_types").find("li.vehicle_type_all").addClass("active"),$("#fuel_types").find("li.active").removeClass("active"),$("#fuel_types").find("li.fuel_type_all").addClass("active"),$("#gear_types").find("li.active").removeClass("active"),$("#gear_types").find("li.gear_type_all").addClass("active"),$("#seats").find("li.active").removeClass("active"),$("#seats").find("li.seats_all").addClass("active"),$("#vehicle-sort-descending").removeClass("active"),$("#vehicle-sort-ascending").addClass("active"),$("#vehicle_states").find("li.active").removeClass("active"),$("#vehicle_states").find("li.status_all").addClass("active")})})}});