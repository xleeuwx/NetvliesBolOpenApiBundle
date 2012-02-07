<?php
/*
 * This file is part of the NetvliesBolOpenApiBundle.
 *
 * (c) Netvlies Internetdiensten
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Netvlies\Bundle\BolOpenApiBundle\Model;

use Netvlies\Bundle\BolOpenApiBundle\Model\Refinement;

class RefinementGroup
{
    protected $id;
    protected $name;
    protected $refinements;

    public function __construct(\SimpleXMLElement $xmlElement)
    {
        $this->fromXml($xmlElement);
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param \Netvlies\Bundle\BolOpenApiBundle\Model\Refinement $refinement
     */
    public function addRefinement(Refinement $refinement)
    {
        $this->refinements[] = $refinement;
    }

    /**
     * @param $refinements
     */
    public function setRefinements($refinements)
    {
        $this->refinements = $refinements;
    }

    /**
     * @return \Netvlies\Bundle\BolOpenApiBundle\Model\Refinement[]
     */
    public function getRefinements()
    {
        return $this->refinements;
    }

    /**
     * @param \SimpleXMLElement $xmlElement
     */
    public function fromXml(\SimpleXMLElement $xmlElement)
    {
        // @todo weird xml structure with multiple Refinements without Refinement parent element
        foreach ($xmlElement->children() as $child) {
            if($child->getName() == 'Id') {
                $this->setId((string) $xmlElement->Id);
            } elseif($child->getName() == 'Name') {
                $this->setName((string) $xmlElement->Name);
            } elseif($child->getName() == 'Refinement') {
                $refinement = new Refinement($child);
                $this->addRefinement($refinement);
            }
        }
    }
}