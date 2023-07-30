<?php
require __DIR__ . '/vendor/autoload.php';
use \Ovh\Api;

/**
 * Keys for authorization on OVH
 */
$ovh = new Api( 'XXXXXXXXXXXX',
                'XXXXXXXXXXXX',
                'ovh-ca',
                'XXXXXXXXXXXX');



// Defining a list of servers
$array_servers = array(
    'server1.example.com',
    'server2.example.com',
    'server3.example.com',
    'server4.example.com'
);



// Initializing an empty array to store results
$server_results = array();

// Cycle for each server
foreach ($array_servers as $server) {
    // Getting the server's IP address
    $ip_address = gethostbyname($server);

    // Forming a request to the OVH API
    $endpoint = '/ip/' . $ip_address . '/mitigation/' . $ip_address;
    $params = array(
        'from' => NULL,
        'scale' => '5m',
        'to' => NULL,
    );

    // Execute a request with an exception handled
    try {
        $result = $ovh->get($endpoint, $params);
        $server_results[$server] = 1; // Successful execution of the request, assigning the value 1
    } catch (GuzzleHttp\Exception\ClientException $e) {
        $server_results[$server] = 0; // Query Execution Error, Assigning Value 0
    }
}


?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DDOS Status servers</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  </head>

  <body>

    <div class="container p-4">

        <h1 class="text-center">DDOS Status servers</h1>

        <div class="p-5 mb-4 bg-body-tertiary rounded-3 lead">
<?php 
foreach ($server_results as $server => $result) {
//Result for the server 
echo '
              <div class="row p-3">
                <div class="col">
                  ' . $server . '
                </div>
                <div class="col text-end">
                  ' . ($result ? '<span class="badge rounded-pill text-bg-danger">DDOS Attack</span>' : '<span class="badge rounded-pill text-bg-success">Stable</span>') . PHP_EOL;
echo '              </div>
                </div><hr>
';
}
?>

        </div>  

    </div>

    <div class="text-center"><?php echo date("Y")?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

  </body>

</html>
