<?php


namespace app\builder;


use Aigletter\Interfaces\Builder\QueryBuilderInterface;
use Aigletter\Interfaces\Builder\QueryInterface;
use Exception;


class Query implements QueryInterface
{
    private QueryBuilderInterface $params;


    /**
     * @param QueryBuilderInterface $params
     */
    public function __construct(QueryBuilderInterface $params)
    {
        $this->params = $params;
    }


    /**
     * @return string
     * @throws Exception
     */
    public function __toString(): string
    {
        return $this->toSql();
    }


    /**
     * @return string
     * @throws Exception
     */
    public function toSql(): string
    {
        // SELECT
        if ($this->params->select) {
            if (is_array($this->params->select)) {
                $select = 'SELECT ' . implode(", ", $this->params->select);
            } elseif (is_string($this->params->select)) {
                $select = 'SELECT ' . $this->params->select;
            }
        }
        else {
            $select = 'SELECT *';
        }


        // FROM
        if ($this->params->table) {
            $table = 'FROM ' . $this->params->table;
        } else {
            throw new Exception('Table name required');
        }


        // WHERE
        if ($this->params->where) {
            if (is_array($this->params->where)) {
                $whereKey = array_keys($this->params->where)[0];
                $whereValue = '"' . current($this->params->where) . '"';
                $where = 'WHERE ' . $whereKey . ' = ' . $whereValue;
            } elseif (is_string($this->params->select)) {
                $where = 'WHERE ' . $this->params->where;
            }
        }
        else {
            $where = '';
        }


        // ORDER BY
        if ($this->params->order) {
            if (is_array($this->params->order)) {
                $orderKey = array_keys($this->params->order)[0];
                $orderValue = current($this->params->order);
                $orderBy = 'ORDER BY ' . $orderKey . ' ' . $orderValue;
            } elseif (is_string($this->params->select)) {
                $orderBy = 'ORDER BY ' . $this->params->order;
            }
        }
        else {
            $orderBy = '';
        }


        // LIMIT
        if ($this->params->limit) {
            $limit = 'LIMIT ' . $this->params->limit;
        } else {
            $limit = '';
        }


        // OFFSET
        if ($this->params->offset) {
            $offset = 'OFFSET ' . $this->params->offset;
        } else {
            $offset = '';
        }

        return "$select $table $where $orderBy $limit $offset";
    }
}