<?php


namespace app\builder;


use Aigletter\Interfaces\Builder\BuilderInterface;
use Aigletter\Interfaces\Builder\QueryBuilderInterface;
use Aigletter\Interfaces\Builder\QueryInterface;
use Exception;


class SqlBuilder implements QueryBuilderInterface
{
    public $select;
    public $where;
    public $table;
    public $limit;
    public $offset;
    public $order;


    /**
     * @param array|string $columns
     * @return $this
     * @throws Exception
     */
    public function select($columns): \Aigletter\Interfaces\Builder\BuilderInterface
    {
        if (is_array($columns) or is_string($columns))
        {
            $this->select = $columns;
            return $this;
        }
        else
        {
            throw new Exception('array or string required');
        }
    }


    /**
     * @param array|string $conditions
     * @return BuilderInterface
     * @throws Exception
     */
    public function where($conditions): \Aigletter\Interfaces\Builder\BuilderInterface
    {
        if (is_array($conditions) or is_string($conditions))
        {
            $this->where = $conditions;
            return $this;
        }
        else
        {
            throw new Exception('array or string required');
        }
    }


    /**
     * @param string $table
     * @return BuilderInterface
     */
    public function table($table): \Aigletter\Interfaces\Builder\BuilderInterface
    {
        $this->table = $table;
        return $this;
    }


    /**
     * @param int $limit
     * @return BuilderInterface
     */
    public function limit($limit): \Aigletter\Interfaces\Builder\BuilderInterface
    {
        $this->limit = $limit;
        return $this;
    }


    /**
     * @param int $offset
     * @return BuilderInterface
     */
    public function offset($offset): \Aigletter\Interfaces\Builder\BuilderInterface
    {
        $this->offset = $offset;
        return $this;
    }


    /**
     * @param array|string $order
     * @return BuilderInterface
     * @throws Exception
     */
    public function order($order): \Aigletter\Interfaces\Builder\BuilderInterface
    {
        if (is_array($order) or is_string($order))
        {
            $this->order = $order;
            return $this;
        }
        else
        {
            throw new Exception('array or string required');
        }
    }


    /**
     * @return QueryInterface
     */
    public function build(): QueryInterface
    {
        return new Query($this);
    }
}
