<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Client\ContentNavigation;

use Spryker\Client\ContentNavigation\Dependency\Client\ContentNavigationToContentStorageClientBridge;
use Spryker\Client\ContentNavigation\Dependency\Client\ContentNavigationToContentStorageClientInterface;
use Spryker\Client\Kernel\AbstractDependencyProvider;
use Spryker\Client\Kernel\Container;

class ContentNavigationDependencyProvider extends AbstractDependencyProvider
{
    /**
     * @var string
     */
    public const CLIENT_CONTENT_STORAGE = 'CLIENT_CONTENT_STORAGE';

    public function provideServiceLayerDependencies(Container $container): Container
    {
        $container = parent::provideServiceLayerDependencies($container);
        $container = $this->addClientStorage($container);

        return $container;
    }

    protected function addClientStorage(Container $container): Container
    {
        $container->set(static::CLIENT_CONTENT_STORAGE, function (Container $container): ContentNavigationToContentStorageClientInterface {
            return new ContentNavigationToContentStorageClientBridge(
                $container->getLocator()->contentStorage()->client(),
            );
        });

        return $container;
    }
}
