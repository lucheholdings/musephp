<?php
namespace Calliope\Adapter\Doctrine\Core\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\Query\ResultSetMapping;

/**
 * AbstractSchemeRepository 
 * 
 * @uses EntityRepository
 * @uses SchemeRepository
 * @abstract
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
abstract class AbstractSchemeRepository extends EntityRepository implements SchemeRepository 
{
	/**
	 * countBy 
	 * 
	 * @param array $criteria 
	 * @access public
	 * @return void
	 */
	public function countBy(array $criteria)
	{
		$query = $this->createQueryBy($criteria);

		// Check Composite Key or not
		if($this->getClassMetadata()->isIdentifierComposite) {
			// Select COUNT
        	if ( ! $query->getHint(\Doctrine\ORM\Tools\Pagination\CountOutputWalker::HINT_DISTINCT)) {
        	    $query->setHint(\Doctrine\ORM\Tools\Pagination\CountOutputWalker::HINT_DISTINCT, true);
        	}

            $platform = $query->getEntityManager()->getConnection()->getDatabasePlatform(); // law of demeter win

            $rsm = new ResultSetMapping();
            $rsm->addScalarResult($platform->getSQLResultCasing('dctrn_count'), 'count');

            $query->setHint(Query::HINT_CUSTOM_OUTPUT_WALKER, 'Doctrine\ORM\Tools\Pagination\CountOutputWalker');
            $query->setResultSetMapping($rsm);

		} else {
			// Set Distinct 
        	if ( ! $query->getHint(\Doctrine\ORM\Tools\Pagination\CountWalker::HINT_DISTINCT)) {
        	    $query->setHint(\Doctrine\ORM\Tools\Pagination\CountWalker::HINT_DISTINCT, true);
        	}

			// Select COUNT
        	$query->setHint(\Doctrine\ORM\Query::HINT_CUSTOM_TREE_WALKERS, array('Doctrine\ORM\Tools\Pagination\CountWalker'));
		}
        $query->setFirstResult(null)->setMaxResults(null);

		// Convert to CountQuery
		return $query->getSingleScalarResult();
	}

	/**
	 * findBy 
	 * 
	 * @param array $criteria 
	 * @param array $orderBy 
	 * @param mixed $limit 
	 * @param mixed $offset 
	 * @access public
	 * @return void
	 */
	public function findBy(array $criteria, array $orderBy = array(), $limit = null, $offset = null)
	{
		$query = $this->createQueryBy($criteria, $orderBy, $limit, $offset);

		return $query->getResult();
	}

	/**
	 * findBy 
	 * 
	 * @param array $criteria 
	 * @param array $orderBy 
	 * @param mixed $limit 
	 * @param mixed $offset 
	 * @access public
	 * @return void
	 */
	public function findOneBy(array $criteria, array $orderBy = array())
	{
		$query = $this->createQueryBy($criteria, $orderBy, 1, 0);

		return $query->getSingleResult();
	}
}

