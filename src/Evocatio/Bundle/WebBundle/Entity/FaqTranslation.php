<?php

namespace Evocatio\Bundle\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Evocatio\Bundle\CoreBundle\Entity\TranslationMappedBase;

/**
 * Evocatio\Bundle\WebBundle\Entity\FaqTranslation
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class FaqTranslation extends TranslationMappedBase
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @var text $question
     * 
     * @ORM\Column(name="question", type="text", nullable=false)
     * @Assert\NotNull
     */
    protected $question;

    /**
     * @var text $reponse
     * 
     * @ORM\Column(name="reponse", type="text", nullable=true)
     */
    protected $reponse;
    
    /**
     * @ORM\ManyToOne(targetEntity="Faq", inversedBy="translations")
     * @ORM\JoinColumn(name="faq_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $parent;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set question
     *
     * @param text $question
     */
    public function setQuestion($question)
    {
        $this->question = $question;
    }

    /**
     * Get question
     *
     * @return text 
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Set reponse
     *
     * @param text $reponse
     */
    public function setReponse($reponse)
    {
        $this->reponse = $reponse;
    }

    /**
     * Get reponse
     *
     * @return text 
     */
    public function getReponse()
    {
        return $this->reponse;
    }


    /**
     * Set parent
     *
     * @param Evocatio\Bundle\WebBundle\Entity\Faq $parent
     */
    public function setParent(\Evocatio\Bundle\WebBundle\Entity\Faq $parent)
    {
        $this->parent = $parent;
    }

    /**
     * Get parent
     *
     * @return Evocatio\Bundle\WebBundle\Entity\Faq 
     */
    public function getParent()
    {
        return $this->parent;
    }
}