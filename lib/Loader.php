<?php 
class Loader
{
    private $directories = array();

    public function regDirectory($dir)
    {
        $this->directories[] = $dir;
        return;
    }

    public function register()
    {
        spl_autoload_register(array($this, 'loadClass'));
    }

    public function loadClass($className)
    {
        foreach ($this->directories as $directorie) {
            $filePath = $directorie . '/' . $className . '.php';
            if(is_readable($filePath)) {
                require $filePath;
                return;
            }
        }
    }
}
?>