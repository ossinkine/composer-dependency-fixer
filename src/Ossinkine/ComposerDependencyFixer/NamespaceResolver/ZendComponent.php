<?php

namespace Ossinkine\ComposerDependencyFixer\NamespaceResolver;

class ZendComponent extends AbstractNamespaceResolver
{
    /**
     * @return array
     */
    public function getMap()
    {
        return array(
            'Zend\Authentication'   => 'zendframework/zend-authentication',
            'Zend\Barcode'          => 'zendframework/zend-barcode',
            'Zend\Cache'            => 'zendframework/zend-cache',
            'Zend\Captcha'          => 'zendframework/zend-captcha',
            'Zend\Code'             => 'zendframework/zend-code',
            'Zend\Config'           => 'zendframework/zend-config',
            'Zend\Console'          => 'zendframework/zend-console',
            'Zend\Crypt'            => 'zendframework/zend-crypt',
            'Zend\Db'               => 'zendframework/zend-db',
            'Zend\Debug'            => 'zendframework/zend-debug',
            'Zend\Di'               => 'zendframework/zend-di',
            'Zend\Dom'              => 'zendframework/zend-dom',
            'Zend\Escaper'          => 'zendframework/zend-escaper',
			'Zend\EventManager'     => 'zendframework/zend-eventmanager',
            'Zend\Feed'             => 'zendframework/zend-feed',
            'Zend\File'             => 'zendframework/zend-file',
            'Zend\Filter'           => 'zendframework/zend-filter',
            'Zend\Form'             => 'zendframework/zend-form',
            'Zend\Http'             => 'zendframework/zend-http',
            'Zend\I18n'             => 'zendframework/zend-i18n',
            'Zend\InputFilter'      => 'zendframework/zend-inputfilter',
            'Zend\Json'             => 'zendframework/zend-json',
            'Zend\Ldap'             => 'zendframework/zend-ldap',
            'Zend\Loader'           => 'zendframework/zend-loader',
            'Zend\Log'              => 'zendframework/zend-log',
            'Zend\Mail'             => 'zendframework/zend-mail',
            'Zend\Math'             => 'zendframework/zend-math',
            'Zend\Memory'           => 'zendframework/zend-memory',
            'Zend\Mime'             => 'zendframework/zend-mime',
            'Zend\ModuleManager'    => 'zendframework/zend-modulemanager',
            'Zend\Mvc'              => 'zendframework/zend-mvc',
            'Zend\Navigation'       => 'zendframework/zend-navigation',
            'Zend\Paginator'        => 'zendframework/zend-paginator',
            'Zend\Permissions\Acl'  => 'zendframework/zend-permissions-acl',
            'Zend\Permissions\Rbac' => 'zendframework/zend-permissions-rbac',
            'Zend\Progressbar'      => 'zendframework/zend-progressbar',
            'Zend\Serializer'       => 'zendframework/zend-serializer',
            'Zend\Server'           => 'zendframework/zend-server',
			'Zend\ServiceManager'   => 'zendframework/zend-servicemanager',
            'Zend\Session'          => 'zendframework/zend-session',
            'Zend\Soap'             => 'zendframework/zend-soap',
            'Zend\Stdlib'           => 'zendframework/zend-stdlib',
            'Zend\Tag'              => 'zendframework/zend-tag',
            'Zend\Test'             => 'zendframework/zend-test',
            'Zend\Text'             => 'zendframework/zend-text',
            'Zend\Uri'              => 'zendframework/zend-uri',
			'Zend\Validator'        => 'zendframework/zend-validator',
            'Zend\Version'          => 'zendframework/zend-version',
            'Zend\View'             => 'zendframework/zend-view',
            'Zend\XmlRpc'           => 'zendframework/zend-xmlrpc',
        );
    }
}
