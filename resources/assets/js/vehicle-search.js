var vehicles = window.vehicles === undefined ? [] : window.vehicles;
var site_name = window.site_name;
var vehicle_types = [];
var gear_types = [];
var fuel_types = [];
var seats = [];

var type_selection = "All";
var gear_selection = "All";
var fuel_selection = "All";
var seats_selection = "Any";
var sort_vehicles = "Ascending";
var caret = '<span class="caret"></span>';

function sortVehiclesDesc(a, b) {
    if (a.make_model > b.make_model) return -1;
    else if (a.make_model < b.make_model) return 1;
    else return 0;
}

function sortVehicleAsc(a, b) {
    if (a.make_model < b.make_model) return -1;
    else if (a.make_model > b.make_model) return 1;
    else return 0;
}

function parseVehicles() {
    for (var i = 0; i < vehicles.length; i++) {
        pushDistinct(vehicle_types, "type_name", vehicles[i]);
        pushDistinct(gear_types, "gear_type_name", vehicles[i]);
        pushDistinct(fuel_types, "fuel_type_name", vehicles[i]);
        pushDistinct(seats, "seats", vehicles[i]);
    }
    vehicle_types.sort();
    vehicle_types.unshift(type_selection);
    gear_types.sort();
    gear_types.unshift(gear_selection);
    fuel_types.sort();
    fuel_types.unshift(fuel_selection);
    seats.sort();
    seats.unshift(seats_selection);
}

function pushDistinct(arr, type, vehicle) {
    if (vehicle[type] === null) {
        vehicle[type] = "N/A";
    }
    if (!arr.includes(vehicle[type])) {
        arr.push(vehicle[type]);
    }
}

function drawImageThumbnail(vehicle) {
    var hasImages = vehicle.images.length > 0;
    var html = "";
    if (hasImages) {
        var image_uri = site_name + vehicle.images[0].image_uri;
        var image_name = vehicle.make_model + ' - ' + vehicle.images[0].name;
        html = '<div class="vehicle-img"> \
                    <img class="public" src="'+ image_uri + '" alt="' + image_name + '"> \
                    <button class="btn btn-info vehicle-img-button vehicle-open-modal" data-vehicle="' + vehicle.slug + '">View images</button> \
                </div>'
    }
    else {
        html = '<div class="vehicle-img"> \
                  <div class="vehicle-img-na"> \
                    <h2 class="public"><span class="glyphicon glyphicon-picture"></span>&nbsp;&nbsp;No Image(s)</h2> \
                  </div> \
                </div>'
    }

    return html;
}

function drawVehicleSummary(vehicle) {
    var html = '<div class="col-lg-4 col-md-6 col-sm-6"> \
                    <div class="panel panel-default public-vehicle-panel"> \
                      <div class="panel-heading vehicle-panel-heading"> \
                        <h3>' + vehicle.make_model + '</h3> \
                      </div>'
                      + drawImageThumbnail(vehicle) +
                      '<table class="table table-condensed vehicle-table-public"> \
                        <tr> \
                          <th class="first">Vehicle Type</th> \
                          <td class="first">' + vehicle.type_name + '</td> \
                        </tr> \
                        <tr> \
                          <th>Fuel Type</th> \
                          <td>' + vehicle.fuel_type_name + '</td> \
                        </tr> \
                        <tr> \
                          <th>Gear Type</th> \
                          <td>' + vehicle.gear_type_name + '</td> \
                        </tr> \
                        <tr> \
                          <th class="last">Seats</th> \
                          <td class="last">' + vehicle.seats + '</td> \
                        </tr> \
                      </table> \
                    </div> \
                </div>';

    return html;
}

function drawAllRadioBtns() {
    drawRadioBtnsForAttribute("vehicle_type", "vehicle_types", vehicle_types);
    drawRadioBtnsForAttribute("fuel_type", "fuel_types", fuel_types);
    drawRadioBtnsForAttribute("gear_type", "gear_types", gear_types);
    drawRadioBtnsForAttribute("seats", "seats", seats);
}

function drawRadioBtnsForAttribute(attribute_id, container_id, attribute_arr) {
    var attribute_container = $("#" + container_id);
    var html = "";
    var active = "";
    var id = "";
    var plural = "";
    var seats = "";
    for (var i = 0; i < attribute_arr.length; i++) {
        active = i === 0 ? "active " : "";
        id = i === 0 ? attribute_id + "_all" : "";
        plural = (attribute_id === "vehicle_type" && i === 0) || attribute_id !== "vehicle_type" ? "" : "s";
        seats = (attribute_id === "seats" && i === 0) || attribute_id !== "seats" ? '' : ' seats';
        html += '<li class="' + active + id + '"> \
                    <a data-toggle="pill" class="btn">' + attribute_arr[i] + seats + plural + '</a> \
                </li>'
    }

    attribute_container.append(html);
}

function drawVehicles() {
    var vehicleSearchResults = $('#vehicle-search-results');
    vehicleSearchResults.empty();
    if (sort_vehicles === "Ascending") {
        vehicles.sort(sortVehicleAsc);
    } else {
        vehicles.sort(sortVehiclesDesc);
    }
    var html = '';
    for (var i = 0; i < vehicles.length; i++) {
        var type_matches = vehicles[i].type_name === type_selection || type_selection === "All";
        var fuel_matches = vehicles[i].fuel_type_name === fuel_selection || fuel_selection === "All";
        var gear_matches = vehicles[i].gear_type_name === gear_selection || gear_selection === "All";
        var seats_matches = vehicles[i].seats + " seats" === seats_selection || seats_selection === "Any";
        var vehicle_matches = type_matches && fuel_matches && gear_matches && seats_matches;
        if (vehicle_matches) {
            html += drawVehicleSummary(vehicles[i]);
        }
    }
    var matchedVehicles = html.length > 0;
    if (!matchedVehicles) {
        html = '<div class="col-lg-12">' +
                    '<h1 style="text-align: center">No Vehicles Found</h1>' +
                    '<h3 style="text-align: center">Selected options didn\'t match any vehicles</h3>' +
                '</div>'
    }
    var tab_class = matchedVehicles ? 'tab-pane ' : 'tab-pane-no-vehicles ';
    var start = '<article class="' + tab_class + 'fade in" id="vehicle-search-results-tab">';
    var end = '</article>';
    html = start + html + end;
    vehicleSearchResults.append(html);
    vehicleSearchResults.tab('show');
}

function setupCategoryDefaults()
{
    $('#vehicle_types_selection').html('All ' + caret);
    $('#fuel_types_selection').html('All ' + caret);
    $('#gear_types_selection').html('All ' + caret);
    $('#seats_selection').html('Any ' + caret);
}

$(document).ready(function () {
    parseVehicles();
    drawAllRadioBtns();
    drawVehicles();

    setupCategoryDefaults();

    $('#vehicle_types').find('a').click(function (e) {
        $('#vehicle_types').find('li.active').removeClass('active');
        type_selection = $(this).text();
        $('#vehicle_types_selection').html(type_selection + ' ' + caret);
        if (type_selection !== "All") {
            type_selection = type_selection.slice(0, type_selection.length - 1);
        }
        drawVehicles();
    });

    $('#fuel_types').find('a').click(function (e) {
        $('#fuel_types').find('li.active').removeClass('active');
        fuel_selection = $(this).text();
        $('#fuel_types_selection').html(fuel_selection + ' ' + caret);
        drawVehicles();
    });

    $('#gear_types').find('a').click(function (e) {
        $('#gear_types').find('li.active').removeClass('active');
        gear_selection = $(this).text();
        $('#gear_types_selection').html(gear_selection + ' ' + caret);
        drawVehicles();
    });

    $('#seats').find('a').click(function (e) {
        $('#seats').find('li.active').removeClass('active');
        seats_selection = $(this).text();
        console.log(seats_selection);
        $('#seats_selection').html(seats_selection + ' ' + caret);
        drawVehicles();
    });

    $('#vehicle-type-options').click(function (e) {
        e.stopPropagation();
        var link = $(this).find('#vehicle_types_selection');
        link.dropdown('toggle');
    });

    $('#fuel-type-options').click(function (e) {
        e.stopPropagation();
        var link = $(this).find('#fuel_types_selection');
        link.dropdown('toggle');
    });

    $('#gear-type-options').click(function (e) {
        e.stopPropagation();
        var link = $(this).find('#gear_types_selection');
        link.dropdown('toggle');
    });

    $('#seat-options').click(function (e) {
        e.stopPropagation();
        var link = $(this).find('#seats_selection');
        link.dropdown('toggle');
    });

    $('#vehicle-sort-ascending').find('a').click(function (e) {
        $('#vehicle-sort-descending').removeClass('active');
        sort_vehicles = "Ascending";
        drawVehicles();
        $(this).parent().addClass('active');
    });

    $('#vehicle-sort-descending').find('a').click(function (e) {
        $('#vehicle-sort-ascending').removeClass('active');
        sort_vehicles = "Descending";
        drawVehicles();
        $(this).parent().addClass('active');
    });

    $('#vehicle-search-reset').click(function () {
        console.log("Resetting vehicle search results");
        type_selection = vehicle_types[0];
        fuel_selection = fuel_types[0];
        gear_selection = gear_types[0];
        seats_selection = seats[0];
        sort_vehicles = "Ascending";
        setupCategoryDefaults();
        drawVehicles();

        $('#vehicle_types').find('li.active').removeClass('active');
        $('#vehicle_types').find('li.vehicle_type_all').addClass('active');

        $('#fuel_types').find('li.active').removeClass('active');
        $('#fuel_types').find('li.fuel_type_all').addClass('active');

        $('#gear_types').find('li.active').removeClass('active');
        $('#gear_types').find('li.gear_type_all').addClass('active');

        $('#seats').find('li.active').removeClass('active');
        $('#seats').find('li.seats_all').addClass('active');

        $('#vehicle-sort-descending').removeClass('active');
        $('#vehicle-sort-ascending').addClass('active');

    });
});