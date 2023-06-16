<?php
/** /websocketserver.php
 *  Installieren in das Laravel-Wurzelverzeichnis.
 *
 *  composer.json +Abhängigkeit: cboden/ratchet
 *  Quelle: https://github.com/ratchetphp/Ratchet (Letzter Zugriff 8.3.2022)
 */
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

require __DIR__ . '/vendor/autoload.php';

/**
 * chat.php
 * Send any incoming messages to all connected clients (except sender)
 */
class MyChat implements MessageComponentInterface {
    protected $clients;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn) {
        echo "Adding new connection\n";
        $this->clients->attach($conn);

    }

    //Dieser Code wird immer dann ausgeführt, wenn der Server eine Nachricht von einem Client erhält.

    public function onMessage(ConnectionInterface $from, $msg) {
        echo "Received: $msg\n";
        //Aufgabe 8
       /*$message = [
            "type" => "Wartung"
        ];
        $msgJSON = json_encode($message);
          // Nachricht an alle verbundenen Clients senden
        foreach ($this->clients as $client) {
            $client->send($msgJSON);
        }*/

        //Aufgabe 10
        foreach ($this->clients as $client) {
            if ($from != $client) {
                $client->send($msg);
            }
        }
    }

    public function onClose(ConnectionInterface $conn) {
        echo "Closing connection\n";
        $this->clients->detach($conn);
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "Closing connection with errors\n";
        $conn->close();
    }
}

$app = new Ratchet\App('localhost', 8085);
$app->route('/chat', new MyChat, array('*'));
$app->route('/echo', new Ratchet\Server\EchoServer, array('*'));

echo "Starting WebSocketServer\n";
$app->run();
