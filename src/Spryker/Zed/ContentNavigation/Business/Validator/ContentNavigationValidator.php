<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ContentNavigation\Business\Validator;

use Generated\Shared\Transfer\ContentNavigationTermTransfer;
use Generated\Shared\Transfer\ContentParameterMessageTransfer;
use Generated\Shared\Transfer\ContentValidationResponseTransfer;
use Generated\Shared\Transfer\MessageTransfer;
use Spryker\Zed\ContentNavigation\Dependency\External\ContentNavigationToValidationAdapterInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class ContentNavigationValidator implements ContentNavigationValidatorInterface
{
    /**
     * @var \Spryker\Zed\ContentNavigation\Dependency\External\ContentNavigationToValidationAdapterInterface
     */
    protected $validationAdapter;

    /**
     * @var \Spryker\Zed\ContentNavigation\Business\Validator\ContentNavigationConstraintsProviderInterface
     */
    protected $contentNavigationConstraintsProvider;

    public function __construct(
        ContentNavigationToValidationAdapterInterface $validationAdapter,
        ContentNavigationConstraintsProviderInterface $contentNavigationConstraintsProvider
    ) {
        $this->validationAdapter = $validationAdapter;
        $this->contentNavigationConstraintsProvider = $contentNavigationConstraintsProvider;
    }

    public function validateContentNavigationTerm(ContentNavigationTermTransfer $contentNavigationTermTransfer): ContentValidationResponseTransfer
    {
        $isSuccess = true;
        $validator = $this->validationAdapter->createValidator();
        $properties = $contentNavigationTermTransfer->toArray(true, true);
        $contentValidationResponseTransfer = new ContentValidationResponseTransfer();

        foreach ($this->contentNavigationConstraintsProvider->getConstraintsMap() as $parameter => $constraintCollection) {
            $violations = $validator->validate(
                $properties[$parameter] ?? null,
                $constraintCollection,
            );
            if (count($violations) !== 0) {
                $contentParameterMessageTransfer = $this->createContentParameterMessageTransfer($parameter, $violations);
                $contentValidationResponseTransfer->addParameterMessages($contentParameterMessageTransfer);
                $isSuccess = false;
            }
        }

        return $contentValidationResponseTransfer->setIsSuccess($isSuccess);
    }

    protected function createContentParameterMessageTransfer(string $parameter, ConstraintViolationListInterface $violations): ContentParameterMessageTransfer
    {
        $contentParameterMessageTransfer = (new ContentParameterMessageTransfer())->setParameter($parameter);

        foreach ($violations as $violation) {
            $contentParameterMessageTransfer->addMessage(
                (new MessageTransfer())->setValue($violation->getMessage()),
            );
        }

        return $contentParameterMessageTransfer;
    }
}
