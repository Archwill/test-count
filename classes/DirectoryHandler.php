<?php

namespace Count\Classes;

use Count\Interfaces\DirectoryHandlerInterface;

class DirectoryHandler implements DirectoryHandlerInterface
{
    private $directoryHandler;
    public $realPath;

    /**
     * Opens a directory for reading
     * @param $path
     * @return DirectoryHandler
     * @throws \Exception
     */
    public function openDir($path)
    {
        $this->setRealPath($path);
        $this->directoryHandler = opendir($path);
        if (!$this->directoryHandler) {
            throw new \Exception("Не удалось открыть раздел " . $path);
        }
        return $this;
    }

    /**
     * Sets realpath of the element
     * @param $path
     */

    private function setRealPath($path)
    {
        $this->realPath = realpath($path);
    }

    /**
     * Reads directory
     * @return array list of elements
     */

    public function readDir()
    {
        $elements = [];

        while (($element = readdir($this->directoryHandler)) !== false) {
            if ($element != "." && $element != "..") {
                $elements[] = $element;
            }
        }

        closedir($this->directoryHandler);

        return $elements;

    }


}