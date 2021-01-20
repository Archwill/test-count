<?php

namespace Count\Classes;

use Count\Interfaces\DirectoryHandlerInterface;

class DirectoryStructureHandler
{
    protected $rootDirectory;
    protected $directoryHandlerService;

    /**
     * DirectoryHandler constructor.
     * @param string $rootDirectory
     */
    public function __construct($rootDirectory, DirectoryHandlerInterface $directoryHandlerService)
    {
        $this->directoryHandlerService = $directoryHandlerService;
        $this->rootDirectory = $rootDirectory;
    }

    /**
     * Searches file with the specified name
     * @param $filename
     * @return string
     * @throws \Exception
     */
    public function lookForFile($filename, $directory = null)
    {
        $directoryHandler = clone $this->directoryHandlerService;

        $filePath = false;

        if (is_null($directory)) {
            $directory = $this->rootDirectory;
        }

        $elements = $directoryHandler->openDir($directory)->readDir();

        foreach ($elements as $element) {

            $elementPath = $directoryHandler->realPath . DIRECTORY_SEPARATOR . $element;

            if (is_file($elementPath) && $element == $filename) {
                $filePath = $elementPath;
            } elseif (is_dir($elementPath)) {
                $filePath = $this->lookForFile($filename, $elementPath);
            } else {
                throw new \Exception("Директория должна содержать только разделы и файлы");
            }
            if ($filePath) {
                unset($directoryHandler);

                return $filePath;
            }
        }
        unset($directoryHandler);

        return $filePath;
    }
}