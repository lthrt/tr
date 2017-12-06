<?php

namespace TRBundle\Model;

class ConditionResolver
{
    private $resourceTypes = ['dogs', 'pigs', 'sheep'];

    private $resources;

    public function normalize($resources = [])
    {
        $resources = array_merge(
            [
                'dogs'  => 0,
                'pigs'  => 0,
                'sheep' => 0,
            ],
            $resources
        );

        return $resources;
    }

    public function resolve(
        $condition,
        $resources
    ) {
        $method = str_replace(" ", "", ucwords($condition));

        return $this->$method($this->normalize($resources));
    }

    public function dogsMajority($resources)
    {
        return $this->normalize($resources)[str_replace('majority', '', strtolower(__FUNCTION__))] && $this->majority(str_replace('majority', '', strtolower(__FUNCTION__)), $this->normalize($resources));
    }
    public function sheepMajority($resources)
    {
        return $this->normalize($resources)[str_replace('majority', '', strtolower(__FUNCTION__))] && $this->majority(str_replace('majority', '', strtolower(__FUNCTION__)), $this->normalize($resources));
    }
    public function pigsMajority($resources)
    {
        return $this->normalize($resources)[str_replace('majority', '', strtolower(__FUNCTION__))] && $this->majority(str_replace('majority', '', strtolower(__FUNCTION__)), $this->normalize($resources));
    }

    public function majority(
        $resource,
        $resources
    ) {
        $others =
            array_map(
            function ($r) use ($resources) {return $resources[$r];},
            array_filter(
                $this->resourceTypes,
                function ($r) use ($resource) {
                    return $r != $resource;
                }
            )
        );

        return $this->normalize($resources)[$resource] > array_sum($others);
    }

    public function dogsMinority($resources)
    {
        return $this->minority(str_replace('minority', '', strtolower(__FUNCTION__)), $this->normalize($resources));
    }

    public function pigsMinority($resources)
    {
        return $this->minority(str_replace('minority', '', strtolower(__FUNCTION__)), $this->normalize($resources));
    }

    public function sheepMinority($resources)
    {
        return $this->minority(str_replace('minority', '', strtolower(__FUNCTION__)), $this->normalize($resources));
    }

    public function minority(
        $resource,
        $resources
    ) {
        return $this->normalize($resources)[$resource] && ($this->normalize($resources)[$resource] == min($this->normalize($resources)));
    }

    public function dogsPlurality($resources)
    {
        return $this->plurality(str_replace('plurality', '', strtolower(__FUNCTION__)), $this->normalize($resources));
    }

    public function pigsPlurality($resources)
    {
        return $this->plurality(str_replace('plurality', '', strtolower(__FUNCTION__)), $this->normalize($resources));
    }

    public function sheepPlurality($resources)
    {
        return $this->plurality(str_replace('plurality', '', strtolower(__FUNCTION__)), $this->normalize($resources));
    }

    public function plurality(
        $resource,
        $resources
    ) {
        return $this->normalize($resources)[$resource] && ($this->normalize($resources)[$resource] == max($this->normalize($resources)));
    }

    public function moreDogsThanPigs($resources)
    {
        return $this->moreThan(__FUNCTION__, $this->normalize($resources));
    }

    public function moreDogsThanSheep($resources)
    {
        return $this->moreThan(__FUNCTION__, $this->normalize($resources));
    }

    public function morePigsThanDogs($resources)
    {
        return $this->moreThan(__FUNCTION__, $this->normalize($resources));
    }

    public function morePigsThanSheep($resources)
    {
        return $this->moreThan(__FUNCTION__, $this->normalize($resources));
    }

    public function moreSheepThanDogs($resources)
    {
        return $this->moreThan(__FUNCTION__, $this->normalize($resources));
    }

    public function moreSheepThanPigs($resources)
    {
        return $this->moreThan(__FUNCTION__, $this->normalize($resources));
    }

    public function moreThan(
        $condition,
        $resources
    ) {
        $subject   = strtolower(strrev(strstr(strrev(strstr($condition, 'Than', true)), 'erom', true)));
        $predicate = strtolower(strrev(strstr(strrev($condition), 'nahT', true)));
        return $this->normalize($resources)[$subject] && ($this->normalize($resources)[$subject] > $this->normalize($resources)[$predicate]);
    }

    public function fewerDogsThanPigs($resources)
    {
        return $this->fewerThan(__FUNCTION__, $this->normalize($resources));
    }

    public function fewerDogsThanSheep($resources)
    {
        return $this->fewerThan(__FUNCTION__, $this->normalize($resources));
    }

    public function fewerPigsThanDogs($resources)
    {
        return $this->fewerThan(__FUNCTION__, $this->normalize($resources));
    }

    public function fewerPigsThanSheep($resources)
    {
        return $this->fewerThan(__FUNCTION__, $this->normalize($resources));
    }

    public function fewerSheepThanDogs($resources)
    {
        return $this->fewerThan(__FUNCTION__, $this->normalize($resources));
    }

    public function fewerSheepThanPigs($resources)
    {
        return $this->fewerThan(__FUNCTION__, $this->normalize($resources));
    }

    public function fewerThan(
        $condition,
        $resources
    ) {
        $subject   = strtolower(strrev(strstr(strrev(strstr($condition, 'Than', true)), 'rewef', true)));
        $predicate = strtolower(strrev(strstr(strrev($condition), 'nahT', true)));

        return $this->normalize($resources)[$subject] < $this->normalize($resources)[$predicate];
    }
}
