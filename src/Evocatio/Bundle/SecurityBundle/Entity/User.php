<?php

namespace Evocatio\Bundle\SecurityBundle\Entity;

// Symfony includes
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
// Doctrine includes
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
// Evocatio includes
use Evocatio\Bundle\PersonaBundle\Entity\Contact as Contact;
use Evocatio\Bundle\SecurityBundle\Entity\UserMappedBase;

/**
 * Evocatio\Bundle\SecurityBundle\Entity\User
 *
 * @ORM\Table(name="User")
 * @ORM\Entity(repositoryClass="Evocatio\Bundle\SecurityBundle\Entity\UserRepository")
 */
class User extends UserMappedBase implements UserInterface {

    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
//    /**
//     * @ORM\OneToOne(targetEntity="Evocatio\Bundle\PersonaBundle\Entity\Contact", cascade={"persist"})
//     */
//    private $contact;
    /**
     * Plain password. Used for model validation. Must not be persisted.
     *
     * @var string
     */
    protected $plainPassword;

    /**
     * Sets the plain password.
     *
     * @param string $password
     * @return User
     */
    public function setPlainPassword($password) {
        $this->plainPassword = $password;
        return $this;
    }

    /**
     * Gets the plain password.
     *
     * @return string
     */
    public function getPlainPassword() {
        return $this->plainPassword;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    public function __toString() {
        return $this->getUsername();
    }
//
//    public function __call($function, $options) {
//        if (\method_exists($this->getContact(), $name = 'get' . \ucfirst($function))) {
//            return $this->getContact()->$name($options);
//        }
//    }


}