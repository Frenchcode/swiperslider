<?php
/**
 * Copyright since 2007 PrestaShop SA and Contributors
 * PrestaShop is an International Registered Trademark & Property of PrestaShop SA.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License 3.0 (AFL-3.0)
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright Since 2007 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License 3.0 (AFL-3.0)
 */

declare(strict_types=1);

namespace PrestaShop\Module\SwiperSlider\Form;

use PrestaShop\PrestaShop\Core\Configuration\DataConfigurationInterface;
use PrestaShop\PrestaShop\Core\ConfigurationInterface;

/**
 * Configuration used to save data to configuration table and retrieve from it
 */

final class SwiperConfigurationTextDataConfiguration implements DataConfigurationInterface
{
    public const SWIPER_SYMFONY_FORM_SIMPLE_TEXT_TYPE = 'SWIPER_SYMFONY_FORM_SIMPLE_TEXT_TYPE';
    public const CONFIG_MAXLENGTH = 32;

    /**
     * @var ConfigurationInterface
     */
    private ConfigurationInterface $configuration;

    public function __construct(ConfigurationInterface $configuration)
    {
        $this->configuration = $configuration;
    }

    public function getConfiguration(): array
    {
        $return = [];
        $return['config_text'] = $this->configuration->get(static::SWIPER_SYMFONY_FORM_SIMPLE_TEXT_TYPE);

        return $return;
    }


    public function updateConfiguration(array $configuration): array
    {
        $errors = [];

        if ($this->validateConfiguration($configuration)) {
            if (strlen($configuration['config_text']) <= static::CONFIG_MAXLENGTH) {
                $this->configuration->set(static::SWIPER_SYMFONY_FORM_SIMPLE_TEXT_TYPE, $configuration['config_text']);
            } else{
                $errors[] = 'SWIPER_SYMFONY_FORM_TEXT_TYPE value is too long';
            }
        }
        return $errors;
    }

    public function validateConfiguration(array $configuration): bool
    {
        return isset($configuration['config_text']);
    }
}