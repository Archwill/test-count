<?php

namespace Count\Interfaces;

interface DirectoryHandlerInterface
{
    /**
     * Opens directory for reading
     * @param $path
     */
    public function openDir($path);

    /**
     * Reads directory
     * @return array list of elements
     */
    public function readDir();
}