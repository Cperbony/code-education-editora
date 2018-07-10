<?php
/**
 * Created by PhpStorm.
 * User: Claus Perbony
 * Date: 09/07/2018
 * Time: 14:48
 */

namespace CodeEduStore\Models;

class ProducStore
{
    private $id;
    private $name;
    private $price;
    private $productOriginal;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return ProducStore
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return ProducStore
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     * @return ProducStore
     */
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getProductOriginal()
    {
        return $this->productOriginal;
    }

    /**
     * @param mixed $productOriginal
     * @return ProducStore
     */
    public function setProductOriginal($productOriginal)
    {
        $this->productOriginal = $productOriginal;
        return $this;
    }

}