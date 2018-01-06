<?php

namespace Midnite81\StarRenderer\Tests;

use Midnite81\StarRenderer\Exceptions\NumberOfStarsCannotBeMoreThanMaxStarsException;
use Midnite81\StarRenderer\StarRenderer;
use PHPUnit\Framework\TestCase;

class StarRendererTest extends TestCase
{
    /**
     * @var StarRenderer
     */
    protected $starRenderer;

    /**
     * Bootstrap the test
     */
    public function bootstrap()
    {
        $this->starRenderer = new StarRenderer();
    }

    public function bootstrapWithConfig()
    {
        $this->config = [
            'fullStar' => 'full',
            'halfStar' => 'half',
            'emptyStar' => 'empty',
        ];
        $this->starRenderer = new StarRenderer($this->config);
    }

    public function setLetters()
    {
        $this->starRenderer->setFullStar('f')->setHalfStar('h')->setEmptyStar('e');
    }

    public function test_the_render_method_returns_a_string()
    {
        $this->bootstrap();
        $result = $this->starRenderer->render(3, 5);

        $this->assertInternalType('string', $result);
    }

    public function test_passing_config_sets_full_star_property()
    {
        $this->bootstrapWithConfig();

        $this->assertEquals($this->config['fullStar'], $this->starRenderer->getFullStar());
    }

    public function test_passing_config_sets_half_star_property()
    {
        $this->bootstrapWithConfig();

        $this->assertEquals($this->config['halfStar'], $this->starRenderer->getHalfStar());
    }

    public function test_passing_config_sets_empty_star_property()
    {
        $this->bootstrapWithConfig();

        $this->assertEquals($this->config['emptyStar'], $this->starRenderer->getEmptyStar());
    }

    public function test_setting_full_star_returns_class()
    {
        $this->bootstrap();
        $result = $this->starRenderer->setFullStar('string');

        $this->assertInstanceOf(StarRenderer::class, $result);
    }

    public function test_full_star_string_gets_set()
    {
        $this->bootstrap();

        $string = '<i class="fa fa-star"></i>';

        $this->starRenderer->setFullStar($string);

        $this->assertEquals($string, $this->starRenderer->getFullStar());
    }

    public function test_half_star_string_gets_set()
    {
        $this->bootstrap();

        $string = '<i class="fa fa-star"></i>';

        $this->starRenderer->setHalfStar($string);

        $this->assertEquals($string, $this->starRenderer->getHalfStar());
    }

    public function test_empty_star_string_gets_set()
    {
        $this->bootstrap();

        $string = '<i class="fa fa-star"></i>';

        $this->starRenderer->setEmptyStar($string);

        $this->assertEquals($string, $this->starRenderer->getEmptyStar());
    }

    public function test_two_point_five_returns_two_full_stars_and_a_half_star()
    {
        $this->bootstrap();
        $this->setLetters();

        $rendered = $this->starRenderer->render(2.5, 5);

        $this->assertEquals('f f h e e', $rendered);
    }

    public function test_setting_out_of_six_stars_with_a_value_of_five_returns_five_full_stars()
    {
        $this->bootstrap();
        $this->setLetters();

        $rendered = $this->starRenderer->render(5, 6);

        $this->assertEquals('f f f f f e', $rendered);
    }

    /**
     * @expectedException Midnite81\StarRenderer\Exceptions\StarValueExceedsMaximum
     */
    public function test_exception_thrown_if_stars_are_greater_than_out_of()
    {
        $this->bootstrap();
        $this->setLetters();

        $this->starRenderer->render(6, 5);

    }

    public function test_passing_nothing_to_render_returns_no_stars()
    {
        $this->bootstrap();
        $this->setLetters();

        $rendered = $this->starRenderer->render();

        $this->assertEquals('e e e e e', $rendered);
    }

}