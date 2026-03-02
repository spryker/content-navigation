<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ContentNavigation\Business;

use Spryker\Zed\ContentNavigation\Business\Validator\Constraint\NavigationKeyExistsConstraint;
use Spryker\Zed\ContentNavigation\Business\Validator\ContentNavigationConstraintsProvider;
use Spryker\Zed\ContentNavigation\Business\Validator\ContentNavigationConstraintsProviderInterface;
use Spryker\Zed\ContentNavigation\Business\Validator\ContentNavigationValidator;
use Spryker\Zed\ContentNavigation\Business\Validator\ContentNavigationValidatorInterface;
use Spryker\Zed\ContentNavigation\ContentNavigationDependencyProvider;
use Spryker\Zed\ContentNavigation\Dependency\External\ContentNavigationToValidationAdapterInterface;
use Spryker\Zed\ContentNavigation\Dependency\Facade\ContentNavigationToNavigationFacadeInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use Symfony\Component\Validator\Constraint;

/**
 * @method \Spryker\Zed\ContentNavigation\ContentNavigationConfig getConfig()
 */
class ContentNavigationBusinessFactory extends AbstractBusinessFactory
{
    public function createContentNavigationValidator(): ContentNavigationValidatorInterface
    {
        return new ContentNavigationValidator(
            $this->getValidationAdapter(),
            $this->createContentNavigationConstraintsProvider(),
        );
    }

    public function createContentNavigationConstraintsProvider(): ContentNavigationConstraintsProviderInterface
    {
        return new ContentNavigationConstraintsProvider($this->createNavigationKeyExistsConstraint());
    }

    public function createNavigationKeyExistsConstraint(): Constraint
    {
        return new NavigationKeyExistsConstraint([
            NavigationKeyExistsConstraint::OPTION_NAVIGATION_FACADE => $this->getNavigationFacade(),
        ]);
    }

    public function getNavigationFacade(): ContentNavigationToNavigationFacadeInterface
    {
        return $this->getProvidedDependency(ContentNavigationDependencyProvider::FACADE_NAVIGATION);
    }

    public function getValidationAdapter(): ContentNavigationToValidationAdapterInterface
    {
        return $this->getProvidedDependency(ContentNavigationDependencyProvider::ADAPTER_VALIDATION);
    }
}
