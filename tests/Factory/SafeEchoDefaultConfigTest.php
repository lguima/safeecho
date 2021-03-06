<?php

declare(strict_types=1);

namespace Linio\SafeEcho\Factory;

use Linio\SafeEcho\Decorator\ApiDecryptionDecorator;
use Linio\SafeEcho\Decorator\NoWrapDecorator;
use Noodlehaus\AbstractConfig;
use PHPUnit\Framework\TestCase;

/**
 * Default configuration file. Used in the absence of a configuration file.
 * Or, it is merged with the existing configuration to assert all fields exist.
 */
class SafeEchoDefaultConfigTest extends TestCase
{
    public function testIsAbstractConfig(): void
    {
        $safeEchoDefaultConfig = new SafeEchoDefaultConfig([]);

        $this->assertInstanceOf(AbstractConfig::class, $safeEchoDefaultConfig);
    }

    public function testHasDefaults(): void
    {
        $safeEchoDefaultConfig = new SafeEchoDefaultConfig([]);

        $this->assertEquals(NoWrapDecorator::class, $safeEchoDefaultConfig->get('decorator'));
        $this->assertEquals('*', $safeEchoDefaultConfig->get('hideChar'));
    }

    public function testFillsMissingDefaults(): void
    {
        $safeEchoDefaultConfig = new SafeEchoDefaultConfig(['decorator' => ApiDecryptionDecorator::class]);

        $this->assertEquals(ApiDecryptionDecorator::class, $safeEchoDefaultConfig->get('decorator'));
        $this->assertEquals('*', $safeEchoDefaultConfig->get('hideChar'));
    }

    public function testOverridesDefaults(): void
    {
        $safeEchoDefaultConfig = new SafeEchoDefaultConfig(['decorator' => ApiDecryptionDecorator::class, 'hideChar' => '!']);

        $this->assertEquals(ApiDecryptionDecorator::class, $safeEchoDefaultConfig->get('decorator'));
        $this->assertEquals('!', $safeEchoDefaultConfig->get('hideChar'));
    }
}
