<?php declare(strict_types=1);

namespace ItdelightArraySorts;

use ItdelightArraySorts\Util\Lifecycle\CustomFieldManager;
use Shopware\Core\Framework\Plugin;
use Shopware\Core\Framework\Plugin\Context\InstallContext;
use Shopware\Core\Framework\Plugin\Context\UninstallContext;

class ItdelightArraySorts extends Plugin
{
    public function install(InstallContext $installContext): void
    {
        parent::install($installContext);
        $customFieldManager = new CustomFieldManager($this->container, $installContext->getContext());
        $customFieldManager->create();
    }

    public function uninstall(UninstallContext $uninstallContext): void
    {
        parent::uninstall($uninstallContext);
        if ($uninstallContext->keepUserData()) {
            return;
        }
        $customFieldManager = new CustomFieldManager($this->container, $uninstallContext->getContext());
        $customFieldManager->remove();
    }
}
