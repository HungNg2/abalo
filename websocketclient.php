<?php
/**
 * /websocketclient.php
 * Installieren in das Laravel-Wurzelverzeichnis.
 *
 * composer.json +Abhängigkeit: ratchet/pawl
 * Quelle des Beispiels: https://github.com/ratchetphp/Pawl (Letzter Zugriff 8.3.2022)
 */
require __DIR__ . '/vendor/autoload.php';

\Ratchet\Client\connect('ws://localhost:8085/chat')->then(function($conn) {
     // Hier können Sie die empfangene Nachricht weiterverarbeiten
    $conn->on('message', function($msg) use ($conn) {
        echo "Received: {$msg}\n";
        $conn->close();
    });
    // Nachricht an den Server senden
    $conn->send('Hello to everyone!');
}, function ($e) {
    echo "Could not connect: {$e->getMessage()}\n";
});

