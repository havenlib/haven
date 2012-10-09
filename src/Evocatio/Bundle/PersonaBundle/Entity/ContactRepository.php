<?php
//
//namespace Evocatio\Bundle\PersonaBundle\Entity;
//
//use Doctrine\ORM\EntityRepository;
//
///**
// * ContactRepository
// *
// */
//class ContactRepository extends EntityRepository
//{
//    public function findUserWithAddresss($id){
//       $query = $this->createQueryBuilder('u')
//               ->leftJoin("u.contact_address", "uha")
//               ->leftJoin('uha.address', 'a')
//                ->where('u.id = :id')
//                ->setParameter('id', $id)
//                ->getQuery();
//       $result = $query->getOneOrNullResult();
//       $addresses = $result->getContactAddress();
////       print_r($query->getResult());die();
//       echo "<pre>";
//       \Doctrine\Common\Util\Debug::dump( $query->getDQL());
//
//       foreach($result->getContactAddress() as $hasad)
//       \Doctrine\Common\Util\Debug::dump( $hasad->getAddress());
//
//       \Doctrine\Common\Util\Debug::dump( $result->getContactAddress());
//       echo "</pre>";
//       return $result;
//    }
//
//}