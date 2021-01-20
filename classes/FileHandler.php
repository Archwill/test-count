<?php


namespace Count\Classes;


class FileHandler
{
    /**
     * Counts the sum of all numbers present in the file
     * @param $filepath
     * @return float|int
     * @throws \Exception
     */
    public function countSum($filepath)
    {
        if (empty($filepath)) {
            throw new \Exception("Файл не обнаружен");
        }

        if (!file_exists($filepath)) {
            throw new \Exception("Файл не существует");
        }

        $fileContents = file_get_contents($filepath);
        $fileContents = explode(" ", str_replace("\n", " ", $fileContents));
        return array_sum($fileContents);
    }
}