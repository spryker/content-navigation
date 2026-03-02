<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Client\ContentNavigation\Dependency\Client;

use Generated\Shared\Transfer\ContentTypeContextTransfer;

interface ContentNavigationToContentStorageClientInterface
{
    public function findContentTypeContextByKey(string $contentKey, string $localeName): ?ContentTypeContextTransfer;
}
