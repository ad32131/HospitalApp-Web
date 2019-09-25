<?php

class Settings {  
    private static $instance;  
    private $settings;  
     
    private function __construct( $config_s) {  
        $this->settings = parse_ini_file( $config_s, true);  
    }  
     
    public static function getInstance( $config_s) {  
        if(! isset(self::$instance)) {  
            self::$instance = new Settings( $config_s);             
        }  
        return self::$instance;  
    }  
     
    public function __get($setting) {  
        if(array_key_exists($setting, $this->settings)) {  
            return $this->settings[$setting];  
        } else {  
            foreach($this->settings as $section) {  
                if(array_key_exists($setting, $section)) {  
                    return $section[$setting];  
                }  
            }  
        }  
    }  
 }

$config_s = Settings::getInstance('server_config.ini');
 echo   $config_s->Server_name;
 echo   $config_s->Db_account;
 echo   $config_s->Password;




 ?>  