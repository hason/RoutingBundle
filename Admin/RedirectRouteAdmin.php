<?php

namespace Symfony\Cmf\Bundle\RoutingBundle\Admin;

use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\DoctrinePHPCRAdminBundle\Admin\Admin;

class RedirectRouteAdmin extends Admin
{
    protected $translationDomain = 'CmfRoutingBundle';

    /**
     * work around https://github.com/sonata-project/SonataAdminBundle/pull/1472
     */
    protected $baseRouteName = 'cmf_routing_redirectroute';

    /**
     * work around https://github.com/sonata-project/SonataAdminBundle/pull/1472
     */
    protected $baseRoutePattern = '/cmf/routing/redirectroute';

     /**
     * Root path for the route parent selection
     * @var string
     */
    protected $routeRoot;

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id', 'text')
        ;
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('form.group_general')
                ->add('parent', 'doctrine_phpcr_odm_tree', array('choice_list' => array(), 'select_root_node' => true, 'root_node' => $this->routeRoot))
                ->add('name', 'text')
                ->add('routeName', 'text', array('required' => false))
                ->add('uri', 'text', array('required' => false))
                ->add('routeTarget', 'doctrine_phpcr_odm_tree', array('choice_list' => array(), 'required' => false, 'root_node' => $this->routeRoot))
            ->end();
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name',  'doctrine_phpcr_nodename')
            ;
    }

    public function setRouteRoot($routeRoot)
    {
        $this->routeRoot = $routeRoot;
    }

    public function getExportFormats()
    {
        return array();
    }

}
