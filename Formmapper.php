$formMapper

// * Int with min and max
->add('numportable2','integer', ['attr' => array('min' => 692000000, 'max' => 693999999),'label' => 'Numéro de portable 2','required'=>false])

// * Get original data before the object updated 

  public function preUpdate($object){
        $em = $this->getModelManager()->getEntityManager($this->getClass());
        $original = (object)  $em->getUnitOfWork()->getOriginalEntityData($object);
        $original-> mission->getName() ;
        }

// * OnetoMany side to update or persist 
// source : https://github.com/sonata-project/SonataAdminBundle/issues/165#issuecomment-1772219
public function prePersist($object)
{
    $object->setPictures($object->getPictures());
}

public function preUpdate($object)
{
    $object->setPictures($object->getPictures());
}

    public function setPictures($pictures)
    {
        $this->pictures = $pictures;

        foreach ($pictures as $picture) {
            $picture->setProduct($this);
        }
    }
