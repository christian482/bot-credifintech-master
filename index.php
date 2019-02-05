<?php
//Este archivo importa todos los drivers necesarios para imoprtarlos con "use"
require __DIR__ . '/vendor/autoload.php';

//Importando archivos necesarios
require_once __DIR__."/src/Constantes.php";
require_once __DIR__."/src/conversations/instituciones/TipoInstitucionConversation.php";
require_once __DIR__."/src/conversations/MenuConversation.php";
require_once __DIR__."/src/conversations/SalidaConversation.php";

//Extra Facebook Drivers
//require_once __DIR__."/vendor/botman/driver-facebook/src/FacebookDriver.php";
require_once __DIR__."/vendor/botman/driver-facebook/src/FacebookImageDriver33.php";
require_once __DIR__."/vendor/botman/driver-facebook/src/FacebookFileDriver.php";

//Configurando namespace de clases de botman (Plantillas de facebook)
use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;

use BotMan\BotMan\Drivers\DriverManager;

use BotMan\Drivers\Facebook\Extensions\ButtonTemplate;
use BotMan\Drivers\Facebook\Extensions\ElementButton;
use BotMan\Drivers\Facebook\Extensions\Message;
use BotMan\Drivers\Facebook\Extensions\Element;

use BotMan\BotMan\Messages\Conversations\Conversation;

use BotMan\BotMan\Cache\DoctrineCache;
use Doctrine\Common\Cache\FilesystemCache;

//Configurando namespace de clases personalizadas
use BotCredifintech\Constantes;
use BotCredifintec\Conversations\Instituciones\TipoInsitucionConversation;
use BotCredifintech\Conversations\MenuConversation;
use BotCredifintech\Conversations\SalidaConversation;

//Ca,
// Driver de chatbot para Facebook
DriverManager::loadDriver(\BotMan\Drivers\Facebook\FacebookDriver::class);
DriverManager::loadDriver(\Botman\Drivers\Facebook\FacebookImageDriver::class);
DriverManager::loadDriver(\Botman\Drivers\Facebook\FacebookFileDriver::class);

$config = [
  ///*
  'facebook'=> [
    //Botencio McBot
    'token' => Constantes::generateTokenArray()["T_BOTENCIO"],
    'app_secret' => Constantes::APP_SECRET,
    'verification'=> Constantes::VERIFICATION,
  ],
  //*/
  /*
  'facebook'=> [
    //Credifintech
    'token' => Constantes::generateTokenArray()["T_CF"],
    'app_secret' => Constantes::APP_SECRET,
    'verification'=> Constantes::VERIFICATION,
  ],
  */
  /*
  'facebook'=> [
    //testing
    'token' => Constantes::BOTENCIO_TEST,
    'app_secret' => Constantes::APP_SECRET_TEST,
    'verification'=> Constantes::VERIFICATION_TEST,
  ]
  */
];

$doctrineCacheDriver = new FilesystemCache(__DIR__);
$botman = BotManFactory::create($config, new DoctrineCache($doctrineCacheDriver));

$botman->hears('^(?!.*\basesor|ASESOR|Asesor\b).*$', function (BotMan $bot) {
  $nombre = $bot->getUserWithFields(["first_name"]);
  $nombre = $nombre->getFirstName();
  $bot -> reply("Bienvenido $nombre. te comento que nos  especializamos en la asesoria para Pensionados y Jubilados del IMSS, de igual forma contamos con asesoria para activos del IMSS. ");
  $bot -> startConversation(new MenuConversation($nombre));
});

$botman->hears('.*(Menu|menu|Menú|MENU|menú).*', function(BotMan $bot) {

})->stopsConversation();

$botman->hears('.*(asesor|ASESOR|Asesor).*', function(BotMan $bot) {
    $bot->reply(Constantes::MENSAJE_AYUDA_ASESOR);
})->stopsConversation();

$botman->listen();
//echo "This is botman running";

?>
