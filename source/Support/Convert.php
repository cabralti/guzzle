<?php

namespace Source\Support;

/**
 * Class Convert
 * @package Source\Support
 */
class Convert
{
    public $rows;
    public $columns;
    public $convertedData;

    public function render()
    {
        foreach ($this->getColumns() as $keyColumn => $column) {
            foreach ($this->getRows() as $keyRow => $row) {
                $column = $this->formatIndex($column);
                $this->convertedData[$keyRow][$column] = $row[$keyColumn];
            }
        }

        return $this->convertedData;
    }

    private function formatIndex($text)
    {
        return preg_replace('/[`^~\'"]/', null, iconv('UTF-8', 'ASCII//TRANSLIT', str_replace([' ', '.'], ['_', ''], mb_strtolower($text, 'UTF-8'))));
    }

    /**
     * @return mixed
     */
    public function getRows()
    {
        return $this->rows;
    }

    /**
     * @param mixed $rows
     */
    public function setRows($rows)
    {
        $this->rows = $rows;
    }

    /**
     * @return mixed
     */
    public function getColumns()
    {
        return $this->columns;
    }

    /**
     * @param mixed $columns
     */
    public function setColumns($columns)
    {
        $this->columns = $columns;
    }
}