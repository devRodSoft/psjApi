var settings = {
  "async": true,
  "crossDomain": true,
  "url": "http://taquilla.localhost/oauth/token",
  "method": "POST",
  "headers": {
    "Accept": "*/*",
    "Content-Type": "application/json",
    "cache-control": "no-cache",
  },
  "processData": false,
  "data": "{\"grant_type\":\"password\",\"username\":\"carlosA\",\"password\":\"testing\",\"client_id\":\"taquillaClient\",\"client_secret\":\"@4816152342\"\n}"
}

$.ajax(settings).done(function (response) {
  console.log(response);
});
