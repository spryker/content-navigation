<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Shared\ContentNavigation;

use Spryker\Shared\Kernel\AbstractSharedConfig;

class ContentNavigationConfig extends AbstractSharedConfig
{
    /**
     * @api
     *
     * Content item navigation
     *
     * @var string
     */
    public const CONTENT_TYPE_NAVIGATION = 'Navigation';

    /**
     * @api
     *
     * Content item navigation
     *
     * @var string
     */
    public const CONTENT_TERM_NAVIGATION = 'Navigation';

    /**
     * @api
     *
     * Content item navigation tree-inline template identifier
     *
     * @var string
     */
    public const WIDGET_TEMPLATE_IDENTIFIER_TREE_INLINE = 'tree-inline';

    /**
     * @api
     *
     * Content item navigation tree template identifier
     *
     * @var string
     */
    public const WIDGET_TEMPLATE_IDENTIFIER_TREE = 'tree';

    /**
     * @api
     *
     * Content item navigation list-inline template identifier
     *
     * @var string
     */
    public const WIDGET_TEMPLATE_IDENTIFIER_LIST_INLINE = 'list-inline';

    /**
     * @api
     *
     * Content item navigation list template identifier
     *
     * @var string
     */
    public const WIDGET_TEMPLATE_IDENTIFIER_LIST = 'list';

    /**
     * @api
     *
     * Content item navigation function name
     *
     * @var string
     */
    public const TWIG_FUNCTION_NAME = 'content_navigation';
}
