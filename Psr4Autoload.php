class Psr4Autoload
{
    /**
     * @var string Nom del prefix del namespace 
     */
    const DEFAULT_PREFIX = "App";
    
    /**
     * Register Autoloader
     * 
     * @param string $prefix PSR-4 namespace prefix
     */
    public static function register($prefix=null)
    {
        $prefix = ($prefix) ? (string)$prefix : self::DEFAULT_PREFIX;
        
        spl_autoload_register(function ($classname) use ($prefix) {
            // Prefix check
            if (strpos(strtolower($classname), "{$prefix}\\")===0) {
                // Locate class relative path
                $classname = str_replace("{$prefix}\\", "", $classname);
                $filepath = APPPATH.  str_replace('\\', DIRECTORY_SEPARATOR, ltrim($classname, '\\')) . '.php';
                
                if (file_exists($filepath)) {
                    
                    require $filepath;
                }
            }
            // Es un vendor ?
            else
            {
                $filepath = APPPATH.'vendor/'.  str_replace('\\', DIRECTORY_SEPARATOR, ltrim($classname, '\\')) . '.php';
                if (file_exists($filepath)) {

                    require $filepath;
                }
            }
        });
    }
}
