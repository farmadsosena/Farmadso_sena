"use strict";
function initMap() {
  const CONFIGURATION = {
    ctaTitle: "confirmar",
    mapOptions: {
      center: { lat: 1.61438, lng:  -75.60623 },
      fullscreenControl: true,
      mapTypeControl: false,
      streetViewControl: true,
      zoom: 13,
      zoomControl: true,
      maxZoom: 22,
      mapId: "gmp-map",
    },
    mapsApiKey: "AIzaSyARqXhqVZfBQNW43eJ1fHsyMdq3cUjYRS8",
    capabilities: {
      addressAutocompleteControl: true,
      mapDisplayControl: true,
      ctaControl: true,
    },
  };
  const componentForm = [
    "location",
    "locality",
    "administrative_area_level_1",
    "country",
    "postal_code",
  ];
  
  const getFormInputElement = (component) =>
    document.getElementById(component + "-input");
  const map = new google.maps.Map(document.getElementById("gmp-map"), {
    zoom: CONFIGURATION.mapOptions.zoom,
    center: { lat: 1.61438, lng: -75.60623 },
    mapTypeControl: false,
    fullscreenControl: CONFIGURATION.mapOptions.fullscreenControl,
    zoomControl: CONFIGURATION.mapOptions.zoomControl,
    streetViewControl: CONFIGURATION.mapOptions.streetViewControl,
  });
  const marker = new google.maps.Marker({ map: map, draggable: false });
  const autocompleteInput = getFormInputElement("location");
  const autocomplete = new google.maps.places.Autocomplete(autocompleteInput, {
    fields: ["address_components", "geometry", "name"],
    types: ["address"],
  });
  autocomplete.addListener("place_changed", function () {
    marker.setVisible(false);
    const place = autocomplete.getPlace();
    if (!place.geometry) {
      // User entered the name of a Place that was not suggested and
      // pressed the Enter key, or the Place Details request failed.
      window.alert("No details available for input: '" + place.name + "'");
      return;
    }
    renderAddress(place);
    fillInAddress(place);
  });
  function fillInAddress(place) {
    // optional parameter
    const addressNameFormat = {
      street_number: "short_name",
      route: "long_name",
      locality: "long_name",
      administrative_area_level_1: "short_name",
      country: "long_name",
      postal_code: "short_name",
    };
    const getAddressComp = function (type) {
      for (const component of place.address_components) {
        if (component.types[0] === type) {
          return component[addressNameFormat[type]];
        }
      }
      return "";
    };
    getFormInputElement("location").value =
      getAddressComp("street_number") + " " + getAddressComp("route");
    for (const component of componentForm) {
      // Location field is handled separately above as it has different logic.
      if (component !== "location") {
        getFormInputElement(component).value = getAddressComp(component);
      }
    }
  }
  function renderAddress(place) {
    map.setCenter(place.geometry.location);
    marker.setPosition(place.geometry.location);
    marker.setVisible(true);
  }
}

// api geocoding

// var geocoder;
// var map;

// function initialize() {
//   geocoder = new google.maps.Geocoder();
//   var latlng = new google.maps.LatLng(1.61438, -75.60623);
//   var mapOptions = {
//     zoom: 14,
//     center: latlng,
//     region: "CO",
//   };
//   map = new google.maps.Map(document.getElementById("map"), mapOptions);
// }

// function codeAddress() {
//   var address = document.getElementById("address").value;

//   // Definir límites para Florencia, Caquetá
//   var florenciaBounds = new google.maps.LatLngBounds(
//     new google.maps.LatLng(1.574, -75.634),
//     new google.maps.LatLng(1.651, -75.581)
//   );

//   geocoder.geocode(
//     {
//       address: address,
//       bounds: florenciaBounds, // Especificar los límites aquí
//     },
//     function (results, status) {
//       if (status === "OK" && results && results.length > 0) {
//         // Utilizar los límites proporcionados por la respuesta de geocodificación
//         var resultBounds = results[0].geometry.bounds;

//         // Verificar si hay límites en la respuesta
//         if (resultBounds) {
//           map.fitBounds(resultBounds);
//         } else {
//           // Si no hay límites en la respuesta, centrar el mapa en la ubicación encontrada
//           map.setCenter(results[0].geometry.location);
//           map.setZoom(14); // Establecer el zoom según sea necesario
//         }

//         // Agregar marcador en la ubicación encontrada
//         var marker = new google.maps.Marker({
//           map: map,
//           position: results[0].geometry.location,
//         });

//         // Actualizar los datos de geolocalización
//         var geolocationData = {
//           address: results[0].formatted_address,
//           latitude: results[0].geometry.location.lat(),
//           longitude: results[0].geometry.location.lng(),
//         };
//         document.getElementById("geolocationData").value =
//           JSON.stringify(geolocationData);
//       } else {
//         console.error("Geocode request failed with status:", status);
//         toastr.error("Geocode request failed. Please try again.");
//       }
//     }
//   );
// }















// places

// This sample uses the Places Autocomplete widget to:
// 1. Help the user select a place
// 2. Retrieve the address components associated with that place
// 3. Populate the form fields with those address components.
// This sample requires the Places library, Maps JavaScript API.
// Include the libraries=places parameter when you first load the API.
// For example: <script
// src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
let autocomplete;
let address1Field;
let address2Field;
let postalField;

function initAutocomplete() {
  address1Field = document.querySelector("#ship-address");
  address2Field = document.querySelector("#address2");
  postalField = document.querySelector("#postcode");
  // Create the autocomplete object, restricting the search predictions to
  // addresses in the US and Canada.
  autocomplete = new google.maps.places.Autocomplete(address1Field, {
    componentRestrictions: { country: ["us", "ca"] },
    fields: ["address_components", "geometry"],
    types: ["address"],
  });
  address1Field.focus();
  // When the user selects an address from the drop-down, populate the
  // address fields in the form.
  autocomplete.addListener("place_changed", fillInAddress);
}

function fillInAddress() {
  // Get the place details from the autocomplete object.
  const place = autocomplete.getPlace();
  let address1 = "";
  let postcode = "";

  // Get each component of the address from the place details,
  // and then fill-in the corresponding field on the form.
  // place.address_components are google.maps.GeocoderAddressComponent objects
  // which are documented at http://goo.gle/3l5i5Mr
  for (const component of place.address_components) {
    // @ts-ignore remove once typings fixed
    const componentType = component.types[0];

    switch (componentType) {
      case "street_number": {
        address1 = `${component.long_name} ${address1}`;
        break;
      }

      case "route": {
        address1 += component.short_name;
        break;
      }

      case "postal_code": {
        postcode = `${component.long_name}${postcode}`;
        break;
      }

      case "postal_code_suffix": {
        postcode = `${postcode}-${component.long_name}`;
        break;
      }
      case "locality":
        document.querySelector("#locality").value = component.long_name;
        break;
      case "administrative_area_level_1": {
        document.querySelector("#state").value = component.short_name;
        break;
      }
      case "country":
        document.querySelector("#country").value = component.long_name;
        break;
    }
  }

  address1Field.value = address1;
  postalField.value = postcode;
  // After filling the form with address components from the Autocomplete
  // prediction, set cursor focus on the second address line to encourage
  // entry of subpremise information such as apartment, unit, or floor number.
  address2Field.focus();
}

window.initAutocomplete = initAutocomplete;